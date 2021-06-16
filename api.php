<?php

require_once "db_cone.php";

switch ($_GET['do']) {
    case 'login':
        $mail = $_POST['mail'];
        $pw = $_POST['pw'];
        $sql = "SELECT `pw` FROM `users` WHERE `mail` = '{$mail}';";
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
        $list = "SELECT serial,name,role,mail,enable FROM `users` WHERE {$_POST['where']} limit {$_POST['start']},{$_POST['limit']};";
        // echo $list;
        $result = mysqli_query($con, $list);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        if ($rows) {
            foreach ($rows as $row) {
                if ($row['role'] == 'admin') {$role = "管理者";} else if ($row['role'] == 'operator') {$role = "幹員";} else { $role = "使用者";}
                ;
                $enable = ($row['enable']) ? ("啟用") : ("凍結");
                echo <<<block
                        <div class="case_list" onclick="submit('{$row['serial']}')">
                            <div class="row">
                                <div class="col-10">
                                    <div class="row">
                                        <div class="col-6 col-md-2">
                                            <div class="list_df">
                                                <h5>{$row['serial']}</h5>
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
        $serial = $_POST['serial'];
        $sql = "SELECT * FROM `users` WHERE `serial` = '{$serial}';";
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
        $serial = $_POST['serial'];
        $sql = "delete FROM `users` WHERE `serial` = '{$serial}';";
        $result = mysqli_query($con, $sql);
        if ($result) {
            echo "DELETED";
        } else {
            echo "FAIL";
        }
        break;

    case 'update_get':
        $serial = $_POST['serial'];
        $sql = "SELECT * FROM `users` WHERE `serial` = {$_POST['serial']};";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_row($result);
        $oper_only = "";
        if ($row['role'] == 'operator') {
            $oper_only = "$('.oper_only').removeClass('oper_only');";
        }
        echo <<<info
                <script>
                $(document).ready(function(){
                    $('#serial').val('{$row['serial']}');
                    $('#serial_back').val('{$row['serial']}');
                    $('#name').val('{$row['name']}');
                    $('#nickname').val('{$row['nickname']}');
                    $('#pw').val('{$row['pw']}');
                    $("input[name=sex][value='{$row['sex']}']").attr('checked',true);
                    $("#newImg").css('padding','25px');
                    $("#newImg").html('<img id="pic" src="{$row['image']}">');
                    $("#img").val("{$row['image']}");
                    $("#role").val("{$row['role']}");
                    $("SELECT[name=car_type]").find("option[value='{$row['car_type']}']").attr('SELECTed',true);
                    $("SELECT[name=identity]").find("option[value='{$row['identity']}']").attr('SELECTed',true);
                    $('#mail').val('{$row['mail']}');
                    $('#tel').val('{$row['tel']}');
                    $('#remark').val('{$row['remark']}');
                    $('SELECT[name=enable]').find("option[value='{$row['enable']}']").attr('SELECTed',true);
                    $('SELECT[name=role_SELECT]').find("option[value='{$row['role']}']").attr('SELECTed',true);
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
                $file = UPLOAD_PATH . $_POST['serial'] . '.png';

            } else {
                $file = $_POST['img'];
            }
        }

        $remark = (isset($_POST['remark'])) ? ("{$_POST['remark']}") : ("");
        $enable = (isset($_POST['enable'])) ? ($_POST['enable']) : (0);
        $role = (isset($_POST['role_SELECT'])) ? ($_POST['role_SELECT']) : ($_POST['role']);

        $serial = $_POST['serial'];
        $sql = "update `users` set `name`= '{$_POST['name']}',`nickname`= '{$_POST['nickname']}',";
        $sql .= "`sex`= '{$_POST['sex']}',`pw`= '{$_POST['pw']}',`identity`= '{$_POST['identity']}',";
        $sql .= "`car_type`= '{$_POST['car_type']}',`mail`= '{$_POST['mail']}',`tel`= '{$_POST['tel']}',";
        $sql .= "`remark`= '{$_POST['remark']}',`image`= '{$file}',`enable`= '{$_POST['enable']}',";
        $sql .= "`role`= '{$role}' ";
        $sql .= "WHERE `serial` = {$_POST['serial']};";
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
        $mail_check = "SELECT `serial` FROM `users` WHERE `mail` = '{$_POST['mail']}'";
        $check_result = mysqli_query($con, $mail_check);
        $result_row = mysqli_fetch_all($check_result, MYSQLI_ASSOC);
        if (count($result_row) > 0) {
            echo "OVERLAP";
        } else {

            $sql = "INSERT INTO `users` (`role`, `name`, `sex`, `pw`, `mail`, `tel`, `identity`, `car_type`, `nickname`, `enable`) VALUES ('{$_POST['role']}', '{$_POST['name']}', '{$_POST['sex']}', '{$_POST['pw']}', '{$_POST['mail']}', '{$_POST['tel']}', '{$_POST['identity']}', '{$_POST['car_type']}', '{$_POST['nickname']}', 0);";
            // echo $sql;
            $result = mysqli_query($con, $sql);
            if ($result) {
                $sql = "SELECT `serial` FROM `users` WHERE `mail` = '{$_POST['mail']}';";
                $result = mysqli_query($con, $sql);
                $id = mysqli_fetch_row($result)[0];
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
                        $file = UPLOAD_PATH . $id . '.png';
                        $result = file_put_contents($file, $data);

                    } else {
                        $file = $_POST['img'];
                    }
                }
                $sql = "update `users` set `image`= '{$file}' WHERE `serial` = '{$id}';";
                $result = mysqli_query($con, $sql);
                if ($result) {
                    echo "INSERTED";
                } else {
                    echo 'second error is ' . $result;
                }
            } else {
                echo 'first error is ' . $result;
            }
        }
        break;
    case 'get_number':
        $sql = "SELECT `{$_POST['target']}` FROM `{$_POST['table']}` WHERE {$_POST['where']};";
        $result = mysqli_query($con, $sql);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        echo count($rows); //
        // return count($rows);
        break;
    case 'case_list':
        $sql = "SELECT `serial`,`day1_at`,`service`,`name`,`status`,`created_at` FROM `orders` WHERE {$_POST['where']} limit {$_POST['start']},{$_POST['count']};";
        // echo $sql;
        $result = mysqli_query($con, $sql);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        foreach ($rows as $row) {
            $day1 = substr("{$row['day1_at']}", 0, 10);
            $created = substr("{$row['created_at']}", 0, 10);
            echo <<<list
                <div class="case_list" onclick="submit('{$row['serial']}')">
                    <div class="row">
                        <div class="col-11">
                            <div class="row">
                                <div class="col-4 col-md-3"><h5>{$row['serial']}</h5></div>
                                <div class="col-4 col-md-2"><h5>{$day1}</h5></div>
                                <div class="col-4 col-md-2"><h5>{$row['name']}</h5></div>
                                <div class="col-5 col-md-3"><h5>{$row['service']}</h5></div>
                                <div class="col-7 col-md-2"><h5>{$created}</h5></div>
                            </div>
                        </div>
                        <div class="col-1 d-flex align-items-center justify-content-center">
                            <h5>{$row['status']}</h5>
                        </div>
                    </div>
                </div>
            list;
        }
        break;
    case 'case_info':
        $serial = $_POST['serial'];
        $sql = "SELECT * FROM `orders` WHERE `serial` = '{$serial}';";
        // echo $sql;
        $result = mysqli_query($con, $sql);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $staff = '';
            $can_reply = '';
            if ($row['status'] == '已結束') {
                $can_reply = '$("#reply_block").show();';
            }
            if ($row['staff'] != '') {
                $staff = mysqli_fetch_row(mysqli_query($con, "SELECT `name` FROM `users` WHERE `serial` = '{$row['staff']}';"))[0];
            }
            $option = '';
            $op_rs = explode(',', $row['option']);
            foreach ($op_rs as $op_r) {
                $val = explode('=', $op_r);
                $option .= set_option($val[0], $val[1]);
            }
            $date1 = get_time($row['day1_at'], 0);
            $time1 = substr(get_time($row['day1_at'], 1), 0, 5);
            $date2 = get_time($row['day2_at'], 0);
            $time2 = substr(get_time($row['day2_at'], 1), 0, 5);
            $date3 = get_time($row['day3_at'], 0);
            $time3 = substr(get_time($row['day3_at'], 1), 0, 5);
            echo <<<info
            <script>
                $(function(){
                    $('#serial').html('{$row['serial']}');
                    $('#name').html('{$row['name']}');
                    $('#service').html('{$row['service']}');
                    $('#mail').html('{$row['mail']}');
                    $('#tel').html('{$row['tel']}');
                    $('#number').html('{$row['number']}人');
                    $('#staff').html('{$staff}');
                    $('#remark').html('{$row['remark']}');
                    $('#car_type').html('{$row['car_type']}');
                    $('#status').html('{$row['status']}');
                    $('#option').html('{$option}');
                    $('#date1').html('{$date1}');
                    $('#time1').html('{$time1}');
                    $('#date2').html('{$date2}');
                    $('#time2').html('{$time2}');
                    $('#date3').html('{$date3}');
                    $('#time3').html('{$time3}');
                    {$can_reply}
                })
            </script>
            info;
        } else {
            echo "FAIL";
        }
        break;
    case 'case_insert':
        $day1 = date('Y-m-d H:i:s', strtotime($_POST['date1'] . " " . $_POST['time1']));
        $day2 = date('Y-m-d H:i:s', strtotime($_POST['date2'] . " " . $_POST['time2']));
        $day3 = date('Y-m-d H:i:s', strtotime($_POST['date3'] . " " . $_POST['time3']));
        $opt1 = (isset($_POST['option1'])) ? ('option1=true') : ('option1=false');
        $opt2 = (isset($_POST['option2'])) ? ('option2=true') : ('option2=false');
        $option = $opt1 . ',' . $opt2;
        $sql = "insert into `orders` (`title`,`name`,`tel`,`mail`,`number`,`car_type`,`day1_at`,`day2_at`,`day3_at`,`option`,`remark`,`status`) ";
        $sql .= "values('{$_POST['title']}','{$_POST['name']}','{$_POST['tel']}','{$_POST['mail']}',{$_POST['number']},'{$_POST['car_type']}','{$day1}','{$day2}','{$day3}','{$option}','{$_POST['remark']}','待處理');";
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
        $serial = $_POST['serial'];
        $sql = "SELECT * FROM `orders` WHERE `serial` = '{$_POST['serial']}';";
        // echo $sql;
        $result = mysqli_query($con, $sql);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $option = '';
            $op_rs = explode(',', $row['option']);
            foreach ($op_rs as $op_r) {
                $val = explode('=', $op_r);
                if ($val[1] == 'true') {
                    $option .= "$('#{$val[0]}').attr('checked','true');";
                }
            }
            $staff = '';
            if ($row['staff'] != '') {
                $staff = mysqli_fetch_row(mysqli_query($con, "SELECT `name` FROM `users` WHERE `serial` = '{$row['staff']}';"))[0];
            }
            $date1 = get_time($row['day1_at'], 0);
            $time1 = substr(get_time($row['day1_at'], 1), 0, 5);
            $date2 = get_time($row['day2_at'], 0);
            $time2 = substr(get_time($row['day2_at'], 1), 0, 5);
            $date3 = get_time($row['day3_at'], 0);
            $time3 = substr(get_time($row['day3_at'], 1), 0, 5);
            echo <<<info
                <script>
                $(document).ready(function(){
                    $('#name').val('{$row['name']}');
                    $('#service').val('{$row['service']}');
                    $('#mail').val('{$row['mail']}');
                    $('#tel').val('{$row['tel']}');
                    $("SELECT[name=number]").find("option[value={$row['number']}]").attr('SELECTed',true);
                    $('#staff').html('{$staff}');
                    $('#remark').val('{$row['remark']}');
                    $("SELECT[name=car_type]").find("option[value='{$row['car_type']}']").attr('SELECTed',true);
                    $('#date1').val('{$date1}');
                    $("SELECT[name=time1]").find("option[value='{$time1}']").attr('SELECTed',true);
                    $('#date2').val('{$date2}');
                    $("SELECT[name=time2]").find("option[value='{$time2}']").attr('SELECTed',true);
                    $('#date3').val('{$date3}');
                    $("SELECT[name=time3]").find("option[value='{$time3}']").attr('SELECTed',true);
                    $('#serial').html('{$row['serial']}');
                    $('#serial_block').show();
                    $('.info_header:eq(-1) > .col-12:eq(-1)').append('<div class="row"><div class="col-5"><h5>處理狀態</h5></div><div class="col-7"><h5><SELECT name="status" id="status"><option value="待處理">待處理</option><option value="已指派">已指派</option><option value="已結束">已結束</option><option value="已取消">已取消</option></SELECT></h5></div></div>');
                    $('#serial_back').val('{$row['serial']}');
                    $("SELECT[name=status]").find("option[value='{$row['status']}']").attr('SELECTed',true);
                    {$option}
                });
                </script>
                info;
        } else {
            echo 'error is ' . $result;
            echo 'FAIL';
        }
        break;
    case 'case_update_set':
        $day1 = date('Y-m-d H:i:s', strtotime($_POST['date1'] . " " . $_POST['time1']));
        $day2 = date('Y-m-d H:i:s', strtotime($_POST['date2'] . " " . $_POST['time2']));
        $day3 = date('Y-m-d H:i:s', strtotime($_POST['date3'] . " " . $_POST['time3']));
        $opt1 = (isset($_POST['option1'])) ? ('option1=true') : ('option1=false');
        $opt2 = (isset($_POST['option2'])) ? ('option2=true') : ('option2=false');
        $option = $opt1 . ',' . $opt2;
        $sql = "update `orders` set `service`= '{$_POST['service']}',`name`='{$_POST['name']}',";
        $sql .= "`tel`='{$_POST['tel']}',`mail`='{$_POST['mail']}',`number`={$_POST['number']},";
        $sql .= "`car_type` = '{$_POST['car_type']}',`option`='{$option}',`remark`='{$_POST['remark']}',";
        $sql .= "`day1_at` = '{$day1}',`day2_at`='{$day2}',`day3_at`='{$day3}',";
        $sql .= "`status`='{$_POST['status']}' WHERE `serial` = '{$_POST['serial']}';";
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
        $sql = "SELECT `staff` FROM `orders` WHERE `serial` = '{$_POST['serial']}';";
        // echo $sql;
        $result = mysqli_query($con, $sql);
        if ($result) {
            $row = mysqli_fetch_row($result);
            $staff = $row[0];
            $sql = "insert into `replies` (`serial`,`staff`,`name`,`role`,`score`,`message`) values ('{$_POST['serial']}','{$staff}','{$_POST['name']}','{$_POST['role']}',{$_POST['score']},'{$_POST['message']}');";
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
        $sql = "SELECT * FROM `replies` WHERE `serial` = '{$_POST['serial']}';";
        // echo $sql;
        $result = mysqli_query($con, $sql);
        // print_r($result);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        if (count($rows) > 0) {
            echo 1;
            $on_limit = (count($rows) == 3) ? (true) : (false);
            foreach ($rows as $row) {
                if ($row['role'] == 'admin') {
                    $role = "管理者";
                } elseif ($row['role'] == 'operator') {
                    $role = "司機";
                } else {
                    $role = "使用者";
                }

                if ($row['type'] == 'main') {
                    echo $row['score'];
                }
                echo <<<mes
                        <div class="col-12 reply_content {$row['type']}">
                        <h5 style="color:yellow">FROM {$role} {$row['name']} <span style="font-size: 0.9rem;color:#fff;">{$row['created_at']}</span></h5>
                            <h5 id="rc">
                                {$row['message']}
                            </h5>
                        </div>
                        mes;
            }
            if (!$on_limit) {
                echo <<<input_a
                    <div class="col-12 reply_keyin">
                        <div id="message" class="textarea" contenteditable="true" placeholder="please key in..."></div>
                        <div class="d-flex justify-content-end my-4">
                            <a class="btn reply_btn" onclick="reply()">回覆</a>
                        </div>
                    </div>
                    input_a;
            }

        } else {
            echo 0;
            echo <<<input_a
                    <div class="col-12 reply_keyin">
                        <div id="message" class="textarea" contenteditable="true" placeholder="please key in..."></div>
                        <div class="d-flex justify-content-end my-4">
                            <a class="btn reply_btn" onclick="reply()">回覆</a>
                        </div>
                    </div>
                    input_a;
        }
        break;
    case 'assign_list':
        $sql = "SELECT `serial`,`name`,`image` FROM `users` WHERE `role` = 'operator';";
        $result = mysqli_query($con, $sql);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        foreach ($rows as $row) {
            echo <<<list
                    <div id="{$row['serial']}" class="col-4 col-md-2 oper">
                        <div class="members" onclick="sub_form('{$row['serial']}')">
                            <img src="{$row['image']}" alt="" class="img-fluid" />
                            <div>
                                <h6>{$row['name']}</h6>
                            </div>
                        </div>
                    </div>
            list;
        }
        break;
    case 'assign_case_get':
        $sql = "SELECT `serial`,`service`,`day1_at`,`day2_at`,`day3_at` FROM `orders` WHERE `serial` = '{$_POST['order_serial']}';";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $date1 = get_time($row['day1_at'], 0);
            $time1 = substr(get_time($row['day1_at'], 1), 0, 5);
            $date2 = get_time($row['day2_at'], 0);
            $time2 = substr(get_time($row['day2_at'], 1), 0, 5);
            $date3 = get_time($row['day3_at'], 0);
            $time3 = substr(get_time($row['day3_at'], 1), 0, 5);

            echo <<<info
            <script>
                $(function(){
                    $('#serial').html('{$row['serial']}');
                    $('#service').html('{$row['service']}');
                    $('#date').append('<option val="{$date1}">{$date1}</option>');
                    $('#date').append('<option val="{$date2}">{$date2}</option>');
                    $('#date').append('<option val="{$date3}">{$date3}</option>');
                    $('#time').html('{$time1}');
                    $('#date').change(function(){
                        switch ($('#date').val()) {case '{$date1}':\n
                                $('#time').html('{$time1}');\nbreak;case '{$date2}':\n$('#time').html('{$time2}');\nbreak;\ncase '{$date3}':\n$('#time').html('{$time3}');\nbreak;
                        }
                    });
                    match_check('$date1');
                });
                </script>
            info;
        } else {
            echo "FAIL";
        }
        break;
    case 'assign_sub_form':
        $sql = "SELECT `serial`,`name`,`sex`,`car_type`,`identity`,`remark`,`image` FROM `users` WHERE `serial` = '{$_POST['user_serial']}';";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            if ($row['sex'] == 'F') {$sex = '女';} else if ($row['sex'] == 'M') {$sex = '男';} else { $sex = '其他';}
            ;
            echo <<<info
            <script>
                $('#name').html('{$row['name']}');
                $('#user_serial').html('ID:{$_POST['user_serial']}');
                $('#sex').html('{$sex}');
                $('#car_type').html('{$row['car_type']}');
                $('#identity').html('{$row['identity']}');
                $('#remark').html('{$row['remark']}');
                $('#pic').attr('src','{$row['image']}');
                var c = document.getElementById('calendar');
                console.log('done');
                var calendar = new FullCalendar.Calendar(c, {
                    headerToolbar: {
                        left: 'prev,next,today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek',
                    },
                    events: {
                        url: 'get-events.php?serial={$row['serial']}',
                        failure: function () {
                            $('#calendar').show();
                        },
                    },
                    loading: function (bool) {
                        if(bool){la.l.fadeIn('fast');}else{la.l.hide()}
                    },
                });
                calendar.render();
            </script>
            info;
        }
        break;
    case 'match_check':
        $match_list = "";
        $sql = "SELECT `user_serial` FROM `schedule` WHERE `start` LIKE '{$_POST['time']}%';";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
            foreach ($rows as $row) {
                $match_list .= '#' . $row['user_serial'] . ',';
            }
            echo $match_list;
        } else {
            echo 'NO_MATCH';
        }
        break;
    case "assign_set":
        $sql = "SELECT * FROM `schedule` WHERE `order_serial` = '{$_POST['order_serial']}';";
        $result = mysqli_query($con, $sql);
        if (mysqli_fetch_lengths($result) > 0) {
            $sql = "UPDATE `schedule` SET `title` = '{$_POST['title']}',`start` = '{$_POST['start']}',";
            $sql .= "`end` = '{$_POST['end']}',`user_serial` = '{$_POST['user_serial']}' ";
            $sql .= "WHERE `order_serial` = '{$_POST['order_serial']}';";
        } else {
            $sql = "INSERT INTO `schedule` (`title`,`start`,`end`,`order_serial`,`user_serial`) ";
            $sql .= "VALUES ('{$_POST['title']}','{$_POST['start']}','{$_POST['end']}',";
            $sql .= "'{$_POST['order_serial']}','{$_POST['user_serial']}');";
        }
        $result = mysqli_query($con, $sql);
        if ($result) {
            $sql = "SELECT `name` FROM `users` WHERE `serial` = '{$_POST['user_serial']}';";
            $name = mysqli_fetch_row(mysqli_query($con, $sql))[0];
            $sql = "UPDATE `orders` SET `status` = '已指派' , `staff` = '{$_POST['user_serial']}' ";
            $sql .= "WHERE `serial` = '{$_POST['order_serial']}';";
            $result = mysqli_query($con, $sql);
            if ($result) {
                echo "ASSIGNED";
            } else {
                echo "FAIL";
                echo $result;
            }
        } else {
            echo "FAIL";
            echo $result;
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
        $sql = "SELECT `content` FROM `options` WHERE `name` = '{$opt}';";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_row($result);
        return "<h5>{$row[0]}</h5>";
    } else {
        return '';
    }
}

function get_time($str, $index)
{
    return explode(" ", $str)[$index];
}