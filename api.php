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
        $row = mysqli_fetch_row($result);
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
    case 'case_list':
        $sql = "select `case_id`,`create_date`,`c_title`,`c_name`,`case_status` from `order_case` where {$_POST['where']} limit {$_POST['start']},{$_POST['count']};";
        $result = mysqli_query($con, $sql);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        foreach ($rows as $row) {
            $c_date = substr("{$row['create_date']}", 0, 10);
            echo <<<list
                <div class="case_list" onclick="submit('{$row['case_id']}')">
                    <div class="row">
                        <div class="col-10">
                            <div class="row">
                                <div class="col-6 col-md-3"><h5>{$row['case_id']}</h5></div>
                                <div class="col-6 col-md-2"><h5>$c_date</h5></div>
                                <div class="col-5 col-md-3"><h5>{$row['c_name']}</h5></div>
                                <div class="col-7 col-md-4"><h5>{$row['c_title']}</h5></div>
                            </div>
                        </div>
                        <div class="col-2 d-flex align-items-center justify-content-center">
                            <h5>{$row['case_status']}</h5>
                        </div>
                    </div>
                </div>
            list;
        }
        break;
    case 'case_info':
        $case_id = $_POST['case_id'];
        $sql = "select * from `order_case` where `case_id` = '{$case_id}';";
        // echo $sql;
        $result = mysqli_query($con, $sql);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $can_reply = '';
            if ($row['case_status'] == '已結束') {
                $can_reply = '$("#reply_block").show();';
            }
            $c_option = '';
            $op_rs = explode(',', $row['c_option']);
            foreach ($op_rs as $op_r) {
                $val = explode('=', $op_r);
                $c_option .= set_option($val[0], $val[1]);
            }
            $c_date1 = get_c_time($row['c_day1'], 0);
            $c_time1 = substr(get_c_time($row['c_day1'], 1), 0, 5);
            $c_date2 = get_c_time($row['c_day2'], 0);
            $c_time2 = substr(get_c_time($row['c_day2'], 1), 0, 5);
            $c_date3 = get_c_time($row['c_day3'], 0);
            $c_time3 = substr(get_c_time($row['c_day3'], 1), 0, 5);
            echo <<<info
            <script>
                $(function(){
                    $('#case_id').html('{$row['case_id']}');
                    $('#c_name').html('{$row['c_name']}');
                    $('#c_title').html('{$row['c_title']}');
                    $('#c_mail').html('{$row['c_mail']}');
                    $('#c_tel').html('{$row['c_tel']}');
                    $('#c_number').html('{$row['c_number']}人');
                    $('#order_name').html('{$row['order_name']}');
                    $('#c_remark').html('{$row['c_remark']}');
                    $('#car_type').html('{$row['car_type']}');
                    $('#case_status').html('{$row['case_status']}');
                    $('#c_option').html('{$c_option}');
                    $('#c_date1').html('{$c_date1}');
                    $('#c_time1').html('{$c_time1}');
                    $('#c_date2').html('{$c_date2}');
                    $('#c_time2').html('{$c_time2}');
                    $('#c_date3').html('{$c_date3}');
                    $('#c_time3').html('{$c_time3}');
                    {$can_reply}
                })
            </script>
            info;
        } else {
            echo "FAIL";
        }
        break;
    case 'case_insert':
        $c_day1 = date('Y-m-d H:i:s', strtotime($_POST['c_date1'] . " " . $_POST['c_time1']));
        $c_day2 = date('Y-m-d H:i:s', strtotime($_POST['c_date2'] . " " . $_POST['c_time2']));
        $c_day3 = date('Y-m-d H:i:s', strtotime($_POST['c_date3'] . " " . $_POST['c_time3']));
        $opt1 = (isset($_POST['option1'])) ? ('option1=true') : ('option1=false');
        $opt2 = (isset($_POST['option2'])) ? ('option2=true') : ('option2=false');
        $c_option = $opt1 . ',' . $opt2;
        $sql = "insert into `order_case` (`c_title`,`c_name`,`c_tel`,`c_mail`,`c_number`,`car_type`,`c_day1`,`c_day2`,`c_day3`,`c_option`,`c_remark`,`case_status`) ";
        $sql .= "values('{$_POST['c_title']}','{$_POST['c_name']}','{$_POST['c_tel']}','{$_POST['c_mail']}',{$_POST['c_number']},'{$_POST['car_type']}','{$c_day1}','{$c_day2}','{$c_day3}','{$c_option}','{$_POST['c_remark']}','待處理');";
        // echo $sql;
        $result = mysqli_query($con, $sql);
        if ($result) {
            echo "INSERTED";
        } else {
            echo 'ERROR';
            echo $result;
        }
        break;
    case 'case_update_get':
        $case_id = $_POST['case_id'];
        $sql = "select * from `order_case` where `case_id` = '{$_POST['case_id']}';";
        // echo $sql;
        $result = mysqli_query($con, $sql);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $c_option = '';
            $op_rs = explode(',', $row['c_option']);
            foreach ($op_rs as $op_r) {
                $val = explode('=', $op_r);
                if ($val[1] == 'true') {
                    $c_option .= "$('#{$val[0]}').attr('checked','true');";
                }
            }
            $c_date1 = get_c_time($row['c_day1'], 0);
            $c_time1 = substr(get_c_time($row['c_day1'], 1), 0, 5);
            $c_date2 = get_c_time($row['c_day2'], 0);
            $c_time2 = substr(get_c_time($row['c_day2'], 1), 0, 5);
            $c_date3 = get_c_time($row['c_day3'], 0);
            $c_time3 = substr(get_c_time($row['c_day3'], 1), 0, 5);
            echo <<<info
                <script>
                $(document).ready(function(){
                    $('#c_name').val('{$row['c_name']}');
                    $('#c_title').val('{$row['c_title']}');
                    $('#c_mail').val('{$row['c_mail']}');
                    $('#c_tel').val('{$row['c_tel']}');
                    $("select[name=c_number]").find("option[value={$row['c_number']}]").attr('selected',true);
                    $('#order_name').val('{$row['order_name']}');
                    $('#c_remark').val('{$row['c_remark']}');
                    $("select[name=car_type]").find("option[value='{$row['car_type']}']").attr('selected',true);
                    $('#c_date1').val('{$c_date1}');
                    $("select[name=c_time1]").find("option[value='{$c_time1}']").attr('selected',true);
                    $('#c_date2').val('{$c_date2}');
                    $("select[name=c_time2]").find("option[value='{$c_time2}']").attr('selected',true);
                    $('#c_date3').val('{$c_date3}');
                    $("select[name=c_time3]").find("option[value='{$c_time3}']").attr('selected',true);
                    $('#case_id').html('{$row['case_id']}');
                    $('#case_id_block').show();
                    $('.info_header:last-child > .col-12:last-child').append('<div class="row"><div class="col-5"><h5>處理狀態</h5></div><div class="col-7"><h5><select name="case_status" id="case_status"><option value="待處理">待處理</option><option value="已指派">已指派</option><option value="已結束">已結束</option><option value="已取消">已取消</option></select></h5></div></div>');
                    $('#case_id_back').val('{$row['case_id']}');
                    $("select[name=case_status]").find("option[value='{$row['case_status']}']").attr('selected',true);
                    {$c_option}
                });
                </script>
                info;
        } else {
            echo 'error is ' . $result;
            echo 'FAIL';
        }
        break;
    case 'case_update_set':
        $c_day1 = date('Y-m-d H:i:s', strtotime($_POST['c_date1'] . " " . $_POST['c_time1']));
        $c_day2 = date('Y-m-d H:i:s', strtotime($_POST['c_date2'] . " " . $_POST['c_time2']));
        $c_day3 = date('Y-m-d H:i:s', strtotime($_POST['c_date3'] . " " . $_POST['c_time3']));
        $opt1 = (isset($_POST['option1'])) ? ('option1=true') : ('option1=false');
        $opt2 = (isset($_POST['option2'])) ? ('option2=true') : ('option2=false');
        $c_option = $opt1 . ',' . $opt2;
        $sql = "update `order_case` set `c_title`= '{$_POST['c_title']}',`c_name`='{$_POST['c_name']}',";
        $sql .= "`c_tel`='{$_POST['c_tel']}',`c_mail`='{$_POST['c_mail']}',`c_number`={$_POST['c_number']},";
        $sql .= "`car_type` = '{$_POST['car_type']}',`c_option`='{$c_option}',`c_remark`='{$_POST['c_remark']}',";
        $sql .= "`c_day1` = '{$c_day1}',`c_day2`='{$c_day2}',`c_day3`='{$c_day3}',";
        $sql .= "`case_status`='{$_POST['case_status']}' where `case_id` = '{$_POST['case_id']}';";
        // echo $sql;
        $result = mysqli_query($con, $sql);
        if ($result) {
            echo "UPDATED";
        } else {
            echo 'ERROR';
            echo $result;
        }
        break;
    case 'case_reply':
        $sql = "select `order_name` from `order_case` where `case_id` = '{$_POST['case_id']}';";
        // echo $sql;
        $result = mysqli_query($con, $sql);
        if ($result) {
            $row = mysqli_fetch_row($result);
            $order_name = $row[0];
            $sql = "insert into `case_reply` (`case_id`,`order_name`,`reply_people`,`people_type`,`reply_score`,`reply_message`) values ('{$_POST['case_id']}','{$order_name}','{$_POST['user_name']}','{$_POST['user_role']}',{$_POST['score']},'{$_POST['reply']}');";
            $result = mysqli_query($con, $sql);
            if ($result) {
                echo 'DONE';
            } else {
                echo 'FAIL';
                echo 'error is ' . $result;
            }
        } else {
            echo 'FAIL';
            echo 'error is ' . $result;
        }
        break;
    case 'show_reply':
        $sql = "select * from `case_reply` where `case_id` = '{$_POST['case_id']}';";
        $result = mysqli_query($con, $sql);
        if ($result) {
            // echo 1;
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $onlimit = (count($rows) == 3) ? (true) : (false);
            foreach ($rows as $row) {
                if ($row['people_type'] == 'admin') {$role = "管理者";} else if ($row['people_type'] == 'operator') {$role = "司機";} else { $role = "使用者";}
                ;

                if ($row['reply_type'] == 'main') {
                    echo $row['reply_score'];
                }
                echo <<<mes
                        <div class="col-12 reply_content {$row['reply_type']}">
                        <h6 style="color:yellow">from {$role} {$row['reply_people']} <span style="font-size: 0.9rem;color:#fff;">{$row['create_date']}</span></h6>
                            <h5>
                                {$row['reply_message']}
                            </h5>
                        </div>
                        mes;
                if (!$onlimit) {
                    echo <<<input_a
                    <div class="col-12 reply_keyin">
                        <div id="reply" class="textarea" contenteditable="true" placeholder="please key in..."></div>
                        <div class="d-flex justify-content-end my-4">
                            <a class="btn reply_btn" onclick="reply()">回覆</a>
                        </div>
                    </div>
                    input_a;
                }
            }
        } else {
            echo 0;
            echo <<<input_a
                    <div class="col-12 reply_keyin">
                        <div id="reply" class="textarea" contenteditable="true" placeholder="please key in..."></div>
                        <div class="d-flex justify-content-end my-4">
                            <a class="btn reply_btn" onclick="reply()">回覆</a>
                        </div>
                    </div>
                    input_a;
        }
        break;
    default:
        # code...
        break;
}

function set_option($opt, $bool)
{
    global $con;
    if ($bool == 'true') {
        $sql = "select option_name from `case_option` where `option_id` = '{$opt}';";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_row($result);
        return "<h5>{$row[0]}</h5>";
    } else {
        return '';
    }
}

function get_c_time($str, $index)
{
    return explode(" ", $str)[$index];
}