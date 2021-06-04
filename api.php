<?php

require_once "db_cone.php";

switch ($_GET['do']) {
    case 'login':
        $mail = $_POST['mail'];
        $pw = $_POST['pw'];
        $sql = "select `pw` from `user` where `mail` = '{$mail}';";
        $result = mysqli_query($con, $sql);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        // print_r($rows);
        if (count($rows) > 0) {
            foreach ($rows as $row) {
                if ($row['pw'] == $pw) {
                    echo "MATCH";
                    return;
                } else {
                    echo "FAIL";
                }
            }
        } else {
            echo "NO_RESULT";
        }
        break;
    case 'user_list':
        $list = "select row_id,name,role,mail,enable from `user` where {$_POST['where']} limit {$_POST['start']},{$_POST['limit']};";
        // echo $list;
        $result = mysqli_query($con, $list);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        if ($rows) {
            foreach ($rows as $row) {
                if ($row['role'] == 'admin') {$role = "管理者";} else if ($row['role'] == 'operator') {$role = "幹員";} else { $role = "使用者";}
                ;
                $enable = ($row['enable']) ? ("啟用") : ("凍結");
                echo <<<block
                        <div class="case_list" onclick="submit('{$row['row_id']}')">
                            <div class="row">
                                <div class="col-10">
                                    <div class="row">
                                        <div class="col-6 col-md-2">
                                            <div class="list_df">
                                                <h5>{$row['row_id']}</h5>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <div class="list_df">
                                                <h5>{$row['name']}</h5>
                                            </div>
                                        </div>
                                        <div class="col-5 col-md-3">
                                            <div class="list_df">
                                                <h5>{$role}</h5>
                                            </div>
                                        </div>
                                        <div class="col-7 col-md-4">
                                            <div class="list_df">
                                                <h5>{$row['mail']}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="list_df">
                                        <h5>{$enable}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        block;
            }
        } else {
            echo 'FAIL';
        }
        break;
    case 'user_info':
        $row_id = $_POST['row_id'];
        $sql = "select * from `user` where `row_id` = '{$row_id}';";
        $result = mysqli_query($con, $sql);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        foreach ($rows as $row) {
            if ($row['role'] == 'admin') {$role = "管理者";} else if ($row['role'] == 'operator') {$role = "司機";} else { $role = "使用者";}
            ;
            if ($row['sex'] == 'M') {$sex = "男";} else if ($row['sex'] == 'F') {$sex = "女";} else { $sex = "其他";}
            ;
            $enable = ($row['enable']) ? ("啟用") : ("凍結");
            $oper_only = "";
            if ($row['role'] == 'operator') {
                $oper_only = "$('.oper_only').removeClass('oper_only');";
            }
            echo <<<info
                <script>
                $(document).ready(function(){
                    $('#pic').attr('src','{$row['image']}');
                    $('#name').html('{$row['name']}');
                    $('#nickname').html('{$row['nickname']}');
                    $('#sex').html('{$sex}');
                    $('#identity').html('{$row['identity']}');
                    $('#car_type').html('{$row['car_type']}');
                    $('#mail').html('{$row['mail']}');
                    $('#tel').html('{$row['tel']}');
                    $('#remark').html('{$row['remark']}');
                    $('#enable').html('$enable');
                    $('#role').val('{$row['role']}');
                    {$oper_only}
                });
                </script>
                info;
        }
        break;
    case 'user_delete':
        $row_id = $_POST['row_id'];
        $sql = "delete from `user` where `row_id` = '{$row_id}';";
        $result = mysqli_query($con, $sql);
        if ($result) {
            echo "DELETED";
        } else {
            echo "FAIL";
        }
        break;

    case 'update_get':
        $row_id = $_POST['row_id'];
        $sql = "select * from `user` where `row_id` = {$_POST['row_id']};";
        $result = mysqli_query($con, $sql);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        foreach ($rows as $row) {
            $oper_only = "";
            if ($row['role'] == 'operator') {
                $oper_only = "$('.oper_only').removeClass('oper_only');";
            }
            echo <<<info
                <script>
                $(document).ready(function(){
                    $('#row_id').val('{$row['row_id']}');
                    $('#row_id_back').val('{$row['row_id']}');
                    $('#name').val('{$row['name']}');
                    $('#nickname').val('{$row['nickname']}');
                    $('#pw').val('{$row['pw']}');
                    $("input[name=sex][value='{$row['sex']}']").attr('checked',true);
                    $("#newImg").css('padding','25px');
                    $("#newImg").html('<img id="pic" src="{$row['image']}">');
                    $("#img").val("{$row['image']}");
                    $("#role").val("{$row['role']}");
                    $("select[name=car_type]").find("option[value='{$row['car_type']}']").attr('selected',true);
                    $("select[name=identity]").find("option[value='{$row['identity']}']").attr('selected',true);
                    $('#mail').val('{$row['mail']}');
                    $('#tel').val('{$row['tel']}');
                    $('#remark').val('{$row['remark']}');
                    $('select[name=enable]').find("option[value='{$row['enable']}']").attr('selected',true);
                    $('select[name=role_select]').find("option[value='{$row['role']}']").attr('selected',true);
                    {$oper_only}
                });
                </script>
                info;
        }

        break;
    case 'update_set':
        define('UPLOAD_PATH', 'img/');
        if ($_POST['img'] == "") {
            $img_name = "default";
            $file = UPLOAD_PATH . $img_name . '.png';

        } else {
            $base64 = "data";
            if (strpos($_POST['img'], $base64) !== false) {
                // echo "have pic up<br>";
                $img = $_POST['img'];
                $img = str_replace('data:image/png;base64,', '', $img);
                $img = str_replace(' ', '+', $img);
                $data = base64_decode($img);
                $file = UPLOAD_PATH . $_POST['mail'] . '.png';

            } else {
                $file = $_POST['img'];
            }
        }

        $remark = (isset($_POST['remark'])) ? ("{$_POST['remark']}") : ("");
        $enable = (isset($_POST['enable'])) ? ($_POST['enable']) : (0);
        $role = (isset($_POST['role_select'])) ? ($_POST['role_select']) : ($_POST['role']);

        $row_id = $_POST['row_id'];
        $sql = "update `user` set `name`= '{$_POST['name']}',`nickname`= '{$_POST['nickname']}',";
        $sql .= "`sex`= '{$_POST['sex']}',`pw`= '{$_POST['pw']}',`identity`= '{$_POST['identity']}',";
        $sql .= "`car_type`= '{$_POST['car_type']}',`mail`= '{$_POST['mail']}',`tel`= '{$_POST['tel']}',";
        $sql .= "`remark`= '{$_POST['remark']}',`image`= '{$file}',`enable`= '{$_POST['enable']}',";
        $sql .= "`role`= '{$role}' ";
        $sql .= "where `row_id` = {$_POST['row_id']};";
        $result = mysqli_query($con, $sql);

        if ($result) {
            echo "UPDATED";
            if (isset($data)) {
                $result = file_put_contents($file, $data);
            }
        } else {
            echo "FAIL";
            echo $sql;
        }

        break;
    case 'sign_up':
        $mail_check = "SELECT `row_id` from `user` WHERE `mail` = '{$_POST['mail']}'";
        $check_result = mysqli_query($con, $mail_check);
        $result_row = mysqli_fetch_all($check_result, MYSQLI_ASSOC);
        if (count($result_row) > 0) {
            echo "OVERLAP";
        } else {
            define('UPLOAD_PATH', 'img/');
            if ($_POST['img'] == "") {
                $img_name = "default";
                $file = UPLOAD_PATH . $img_name . '.png';

            } else {
                $base64 = "data";
                if (strpos($_POST['img'], $base64) !== false) {
                    $img = $_POST['img'];
                    $img = str_replace('data:image/png;base64,', '', $img);
                    $img = str_replace(' ', '+', $img);
                    $data = base64_decode($img);
                    $file = UPLOAD_PATH . $_POST['mail'] . '.png';
                    $result = file_put_contents($file, $data);

                } else {
                    $file = $_POST['img'];
                }
            }

            $sql = "INSERT INTO `user` (`role`, `name`, `sex`, `pw`, `mail`, `tel`, `identity`, `car_type`, `nickname`, `image`, `enable`) VALUES ('{$_POST['role']}', '{$_POST['name']}', '{$_POST['sex']}', '{$_POST['pw']}', '{$_POST['mail']}', '{$_POST['tel']}', '{$_POST['identity']}', '{$_POST['car_type']}', '{$_POST['nickname']}','{$file}', '0');";
            $result = mysqli_query($con, $sql);
            if ($result) {
                echo "INSERTED";
            } else {
                echo $result;
            }
        }
        break;
    case 'get_number':
        $sql = "select `{$_POST['target']}` from `{$_POST['table']}` WHERE {$_POST['where']};";
        $result = mysqli_query($con, $sql);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        echo count($rows); //
        // return count($rows);
        break;
    default:
        # code...
        break;
}