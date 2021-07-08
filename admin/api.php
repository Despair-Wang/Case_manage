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
                if ($row['role'] == 'admin') {$role = "管理者";} else if ($row['role'] == 'operator') {$role = "司機";} else { $role = "使用者";}
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
        $sql = "DELETE FROM `users` WHERE `serial` = '{$serial}';";
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
        $sql = "UPDATE `users` set `name`= '{$_POST['name']}',`nickname`= '{$_POST['nickname']}',";
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
        $sql = "SELECT `serial`,`day1_at`,`service`,`name`,`status`,`created_at`,`status`.`content` AS `status` FROM `orders` JOIN `status` ON `orders`.`status` = `status`.`title` WHERE {$_POST['where']} limit {$_POST['start']},{$_POST['count']};";
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
        // $sql = "SELECT `orders`.*, `users`.`name` AS `staff` FROM `orders` JOIN `users` ON `orders`.`staff` = `users`.`serial` WHERE `orders`.`serial` = '{$serial}';";
        $sql = "SELECT `orders`.*,`status`.`content` AS `status`, `users`.`name` AS `staff` FROM `orders` LEFT JOIN `users` ON `orders`.`staff` = `users`.`serial` JOIN `status` ON `status`.`title` = `orders`.`status` WHERE `orders`.`serial` = '{$serial}';";
        // echo $sql;
        $result = mysqli_query($con, $sql);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            // print_r($row);
            $can_reply = '';
            if ($row['status'] == 'over') {
                $can_reply = '$("#reply_block").show();';
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
                    $('#staff').html('{$row['staff']}');
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
        $sql = "insert into `orders` (`service`,`name`,`tel`,`mail`,`number`,`car_type`,`day1_at`,`day2_at`,`day3_at`,`option`,`remark`,`status`) ";
        $sql .= "values('{$_POST['service']}','{$_POST['name']}','{$_POST['tel']}','{$_POST['mail']}',{$_POST['number']},'{$_POST['car_type']}','{$day1}','{$day2}','{$day3}','{$option}','{$_POST['remark']}','ready');";
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
        $sql = "SELECT `orders`.*,`users`.`name` AS `staff` FROM `orders` LEFT JOIN `users` ON `orders`.`staff` = `users`.`serial` WHERE `orders`.`serial` = '{$serial}';";
        // echo $sql;
        $result = mysqli_query($con, $sql);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $status_rows = mysqli_fetch_all(mysqli_query($con, "SELECT * FROM `status`"), MYSQLI_ASSOC);
            $status = '';
            foreach ($status_rows as $value) {
                $status .= "<option value=\"{$value['title']}\">{$value['content']}</option>";
            }
            $option = '';
            $op_rs = explode(',', $row['option']);
            foreach ($op_rs as $op_r) {
                $val = explode('=', $op_r);
                if ($val[1] == 'true') {
                    $option .= "$('#{$val[0]}').attr('checked','true');";
                }
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
                    $("select[name=number]").find("option[value={$row['number']}]").attr('selected',true);
                    $('#staff').html('{$row['staff']}');
                    $('#remark').val('{$row['remark']}');
                    $("select[name=car_type]").find("option[value='{$row['car_type']}']").attr('selected',true);
                    $('#date1').val('{$date1}');
                    $("select[name=time1]").find("option[value='{$time1}']").attr('selected',true);
                    $('#date2').val('{$date2}');
                    $("select[name=time2]").find("option[value='{$time2}']").attr('selected',true);
                    $('#date3').val('{$date3}');
                    $("select[name=time3]").find("option[value='{$time3}']").attr('selected',true);
                    $('#serial').html('{$row['serial']}');
                    $('#serial_block').show();
                    $('.info_header:eq(-1) > .col-12:eq(-1)').append('<div class="row"><div class="col-5"><h5>處理狀態</h5></div><div class="col-7"><h5><select name="status" id="status">{$status}</select></h5></div></div>');
                    $('#serial_back').val('{$row['serial']}');
                    $("select[name=status]").find("option[value='{$row['status']}']").attr('selected',true);
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
            $sql = "UPDATE `orders` SET `status` = 'assigned' , `staff` = '{$_POST['user_serial']}' ";
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
    case 'schedule_get':
        $sql = "SELECT `name`,`image` FROM `users` WHERE `serial` = '{$_POST['serial']}';";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            echo <<<user_info
                    <script>
                    $(function(){
                    $('#serial').html('ID:{$_POST['serial']}');
                    $('#name').html('{$row['name']}');
                    $('#pic').attr('src','{$row['image']}');
                    var c = document.getElementById('calendar');
                    var calendar = new FullCalendar.Calendar(c, {
                            height: '100%',
                            headerToolbar: {
                                left: 'prev,next,today',
                                center: 'title',
                                right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek',
                            },
                            selectable: true,
                            editable: true,
                            events: {
                                url: 'get-events.php?serial={$_POST['serial']}',
                                failure: function () {
                                    $('#calendar').show();
                                },
                            },
                            dateClick:function(info){
                                let t = $('input:focus');
                                if(t.attr('id') === undefined){
                                    $('#start').val(info.dateStr);
                                }else if (t.attr('id') == 'start' || t.attr('id') == 'end') {
                                    t.val(info.dateStr);
                                }
                            },
                            eventClick: function(info){
                                $('#event_id').val(info.event.id);
                                $('#event_title').val(info.event.title);
                                if (info.event.allDay) {
                                    $('#start').val(info.event.startStr);
                                    $('#allday').attr('checked', 'true');
                                    $('#start_time,#end,#end_time').attr('disabled', 'disabled').addClass('input_disabled');
                                    $('#start_time,#end,#end_time').val('');
                                } else {
                                    $('#start_time,#end,#end_time').removeAttr('disabled').removeClass('input_disabled');
                                    $('#allday').removeAttr('checked');
                                    let start = info.event.startStr.split('T'),
                                        end = info.event.endStr.split('T');
                                    $('#start').val(start[0]);
                                    $('#start_time').val(start[1].slice(0, 5));
                                    $('#end').val(end[0]);
                                    $('#end_time').val(end[1].slice(0, 5));
                                }
                                $('#added').children('h4').html('更新');
                                $('#type').val('update');
                            }
                        });
                        calendar.render();
                    })
                    </script>
                    user_info;
        } else {
            echo 'FAIL';
        }
        break;
    case 'schedule_set':
        $sql = "INSERT INTO `schedule` (`title`,`start`,`end`,`user_serial`,`allDay`) VALUES ('{$_POST['title']}','{$_POST['start']}','{$_POST['end']}','{$_POST['user_serial']}',{$_POST['allDay']});";
        // echo $sql;
        $result = mysqli_query($con, $sql);
        if ($result) {
            echo 'ADDED';
        } else {
            echo 'FAIL';
            echo $result;
        }
        break;
    case 'schedule_update':
        $sql = "UPDATE `schedule` SET `title` = '{$_POST['title']}', `start` = '{$_POST['start']}',`end` = '{$_POST['end']}',`allDay` = {$_POST['allDay']} WHERE `id` = {$_POST['id']};";
        $result = mysqli_query($con, $sql);
        if ($result) {
            echo 'UPDATED';
        } else {
            echo 'FAIL';
        }
        break;
    case 'options_get':
        $sql = 'SELECT * FROM `options` WHERE 1;';
        $result = mysqli_query($con, $sql);
        if ($result) {
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
            foreach ($rows as $row) {
                echo <<<option
                    <div class="col-12">
                    <label for="{$row['name']}">{$row['content']}</label>
                    <input id="{$row['name']}" type="checkbox" class="options w-auto" value="{$row['name']}">
                    </div>
                    option;
            }
        } else {
            echo $result;
        }
        break;
    case 'remark_get':
        $sql = 'SELECT * FROM `remarks` WHERE 1;';
        $result = mysqli_query($con, $sql);
        if ($result) {
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
            foreach ($rows as $row) {
                echo "<option value=\"{$row['id']}\">{$row['title']}</option>";
            }
        } else {
            echo $result;
        }
        break;
    case 'service_insert':
        $gallery = array();
        $price = array();
        $step = array();
        $image_save = array();
        for ($i = 0; $i < count($_POST['number']); $i++) {
            $temp = $_POST['number'][$i] . ',' . $_POST['price'][$i];
            array_push($price, $temp);
        }
        $price = base64_encode(serialize($price));
        $options = base64_encode(serialize($_POST['options']));
        $sql = "INSERT INTO `service` (`title`,`times`,`introduction`,`prices`,`options`,`hot`,`remark`,`enable`)";
        $sql .= " VALUES('{$_POST['service']}','{$_POST['times']}','{$_POST['intro']}','{$price}','{$options}',";
        $sql .= "{$_POST['hot']},'{$_POST['remark']}',{$_POST['enable']});";
        $result = mysqli_query($con, $sql);
        // echo 'INSERTED';
        if ($result) {
            $sql = "SELECT `id` FROM `service` WHERE `title` = '{$_POST['service']}' ORDER BY `created_at` DESC LIMIT 1;";
            $id = mysqli_fetch_row(mysqli_query($con, $sql))[0];
            define('SAVE_FOLDER', '../image/' . $id . '/');
            if (!is_dir(SAVE_FOLDER)) {
                mkdir(SAVE_FOLDER);
            }
            $ba = $_POST['banner'];
            $ba = str_replace('data:image/png;base64,', '', $ba);
            $ba = str_replace(' ', '+', $ba);
            $data = base64_decode($ba);
            $banner = SAVE_FOLDER . uniqid('ban', false) . '.png';
            array_push($image_save, array($banner, $data));
            $ind = $_POST['index'];
            $ind = str_replace('data:image/png;base64,', '', $ind);
            $ind = str_replace(' ', '+', $ind);
            $data = base64_decode($ind);
            $index = SAVE_FOLDER . uniqid('index', false) . '.png';
            array_push($image_save, array($index, $data));
            $type = '';
            foreach ($_POST['gallery'] as $key => $value) {
                if (strpos($value, 'jpeg') != false) {
                    $value = str_replace('data:image/jpeg;base64,', '', $value);
                    $type = '.jpeg';
                } elseif (strpos($value, 'png') != false) {
                    $value = str_replace('data:image/png;base64,', '', $value);
                    $type = '.png';
                }
                $value = str_replace(' ', '+', $value);
                $data = base64_decode($value);
                $file = SAVE_FOLDER . uniqid('gall', false) . '-' . $key . $type;
                array_push($gallery, $file);
                array_push($image_save, array($file, $data));
            }
            for ($i = 0; $i < count($_POST['step_title']); $i++) {
                $temp = '';
                $pic = $_POST['step_pic'][$i];
                if (strpos($pic, 'jpeg') != false) {
                    $pic = str_replace('data:image/jpeg;base64,', '', $pic);
                    $type = '.jpeg';
                } elseif (strpos($pic, 'png') != false) {
                    $pic = str_replace('data:image/png;base64,', '', $pic);
                    $type = '.png';
                }
                $pic = str_replace(' ', '+', $pic);
                $data = base64_decode($pic);
                $file = SAVE_FOLDER . uniqid('step', false) . '-' . $i . $type;
                $temp = array($_POST['step_title'][$i], $_POST['step_time'][$i], $_POST['step_content'][$i], $file);
                array_push($step, $temp);
                array_push($image_save, array($file, $data));
            }
            $step = base64_encode(serialize($step));
            $gallery = base64_encode(serialize($gallery));
            $alt = base64_encode(serialize($_POST['gallery_alt']));
            $sql = "UPDATE `service` SET `banner` = '{$banner}',`content` = '{$step}',`gallery` = '{$gallery}',`alt` = '{$alt}',`indexImage` = '{$index}' WHERE `id` = '{$id}';";
            $result = mysqli_query($con, $sql);
            if ($result) {
                foreach ($image_save as $value) {
                    file_put_contents($value[0], $value[1]);
                }
                echo 'INSERTED';
            } else {
                echo 'FAIL';
                echo $result;
            }
        } else {
            echo 'FAIL';
            echo $result;
        }
        break;
    case 'service_show':
        $sql = "SELECT `service`.*,`remarks`.`content` AS 'rc' FROM `service` LEFT JOIN `remarks` ON `remarks`.`id` = `service`.`remark` WHERE `service`.`id` = '{$_POST['id']}';";
        // echo $sql;
        $result = mysqli_query($con, $sql);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $prices = unserialize(base64_decode($row['prices']));
            $price = "";
            $options = unserialize(base64_decode($row['options']));
            $option = "$('#option > div:first-child').after('";
            $contents = unserialize(base64_decode($row['content']));
            $content = "";
            $galleries = unserialize(base64_decode($row['gallery']));
            $gallery = "";
            $gallery2 = "";
            $alts = unserialize(base64_decode($row['alt']));
            foreach ($prices as $v) {
                $v = explode(',', $v);
                $price .= "<div class=\"row\"><div class=\"col-3\">{$v[0]}人</div><div class=\"col-9\">{$v[1]}元</div></div>";
            }
            foreach ($options as $v) {
                if ($v == 'no_Option') {
                    $option = "$('#option').parent().hide('";
                } else {
                    $sql = "SELECT * FROM `options` WHERE `name` = '{$v}';";
                    $opt = mysqli_fetch_assoc(mysqli_query($con, $sql));
                    $option .= "<div class=\"row\"><div class=\"col-12 col-md-6\">{$opt['content']}</div><div class=\"col-12 col-md-6\">{$opt['price']}元</div></div>";
                }
            }
            $option .= "');";
            foreach ($contents as $v) {
                $content .= "<div class=\"row step_block\"><div class=\"col-1 step_mark\"><div></div><div></div><div></div></div><div class=\"col-11\"><div class=\"row p-3 mt-4\"><div class=\"col-lg-8\"><h3>{$v[0]}</h3><h4 style=\"display:inline\">{$v[1]}</h4><hr /><h4>{$v[2]}</h4></div><div class=\"col-lg-4 modal-dialog modal-dialog-centered\"><img src=\"../admin/{$v[3]}\" class=\"img-fluid rounded\" /></div></div></div></div>";
            }
            for ($i = 0; $i < count($galleries); $i++) {
                $gallery .= "<li><img class=\"te\" src=\"{$galleries[$i]}\" alt=\"{$alts[$i]}\"></li>";
                $gallery2 .= "<img class=\"te\" src=\"{$galleries[$i]}\" alt=\"{$alts[$i]}\">";

            }
            echo <<<info
                <script>
                $('#banner').css('background-image','url(admin/{$row['banner']})');
                $('#service_title').html('{$row['title']}');
                $('#intro').html('{$row['introduction']}');
                $('#price').html('{$price}');
                {$option};
                $('#service_content').html('{$content}');
                $('#gallery2').html('{$gallery2}');
                $('#a1 > ul').html('{$gallery}');
                $('#remark').html(`{$row['rc']}`);
                let steps = $('.step_mark');
                for(let i = 0;i < steps.length;i++){
                    if(i==0){
                        $(steps[i]).addClass('bottom_line');
                    }else if(i==steps.length-1){
                        $(steps[i]).addClass('top_line');
                    }else{
                        $(steps[i]).addClass('top_line bottom_line');
                    }
                }
                </script>
                info;
        }
        break;
    case 'service_list':
        $sql = "SELECT `id`,`indexImage`,`title`,`enable` FROM `service` WHERE {$_POST['where']} limit {$_POST['start']},{$_POST['count']};";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
            foreach ($rows as $row) {
                $enable = ($row['enable']) ? ('開放') : ('關閉');
                echo <<<info
                <div class="case_list" onclick="submit('{$row['id']}')">
                <div class="row list_title">
                        <div class="col-6 col-md-2">
                            <div class="list_df">
                                <h5>{$row['id']}</h5>
                            </div>
                        </div>
                        <div class="col-6 col-md-1">
                            <div class="list_df">
                                <img src="{$row['indexImage']}" class="img-fluid">
                            </div>
                        </div>
                        <div class="col-5 col-md-7">
                            <div class="list_df">
                                <h5>{$row['title']}</h5>
                            </div>
                        </div>
                        <div class="col-7 col-md-2">
                            <div class="list_df">
                                <h5>{$enable}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                info;
            }
        }
        break;
    case 'get_menu':
        $sql = "SELECT `id`,`title` FROM `service` WHERE `enable` = 1;";
        $rows = mysqli_fetch_all(mysqli_query($con, $sql));
        // print_r($rows);
        foreach ($rows as $row) {
            echo "<li><a href=\"service.php?id={$row[0]}\">{$row[1]}</a>";
        }
        break;
    case 'service_get':
        $sql = "SELECT * FROM `service` WHERE `id` = '{$_POST['id']}';";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $prices = unserialize(base64_decode($row['prices']));
            $price = "";
            $options = unserialize(base64_decode($row['options']));
            $option = "";
            $contents = unserialize(base64_decode($row['content']));
            $content = "";
            $step_pic_temp = "";
            $galleries = unserialize(base64_decode($row['gallery']));
            $gallery = "";
            $gallery_temp = "";
            $alts = unserialize(base64_decode($row['alt']));
            foreach ($prices as $v) {
                $v = explode(',', $v);
                $price .= "<div class=\"row\"><div class=\"col-9 col-md-4\"><input class=\"number\" type=\"text\" value=\"{$v[0]}\"></div><div class=\"col-3 col-md-2\"><span>人</span></div><div class=\"col-9 col-md-4\"><input class=\"price\" type=\"number\" value={$v[1]} min=\"0\"></div><div class=\"col-3 col-md-2\"><span>元</span></div></div>";
            }
            foreach ($options as $v) {
                if ($v != 'no_Option') {
                    $option .= "$('input[value={$v}]').attr('checked','true');\n";
                    $option .= "$('input[value={$v}]').next().removeClass('lcs_off').addClass('lcs_on');\n";
                }
            }
            $content_count = 1;
            foreach ($contents as $v) {
                $content .= "<div class=\"row\"><div class=\"col-12 col-md-8\"><label>地點名稱${content_count}</label><input class=\"step_title\" type=\"text\" value=\"$v[0]\"><label>時長</label><input class=\"step_time\" type=\"text\" value=\"$v[1]\"><label>地點簡介</label><div class=\"textarea step_content\" contenteditable=\"true\" placeholder=\"請輸入地點簡介\">$v[2]</div></div><div class=\"col-12 col-md-4\"><label>相關圖片</label><div class=\"over_hide\"><img src=\"{$v[3]}\" class=\"img-fluid\"></div><input id=\"step_pic-${content_count}\" class=\"step_pic\" type=\"file\"></div></div><hr style=\"border-top: 1px solid #999;\">";
                $content_count++;
                $step_pic_temp .= $v[3];
                $step_pic_temp .= '|';
            }
            $gallery_count = 1;
            for ($i = 0; $i < count($galleries); $i++) {
                $gallery .= "<div class=\"row mb-2\"><div class=\"col-12 col-md-5\"><div class=\"over_hide\"><img src=\"{$galleries[$i]}\" class=\"img-fluid\"></div><input id=\"gallery-${gallery_count}\" class=\"gallery\" type=\"file\"><label>請輸入圖片說明</label><input class=\"gallery_alt\" type=\"text\" value=\"{$alts[$i]}\"></div></div>";
                $gallery_temp .= $galleries[$i];
                if ($i != count($galleries) - 1) {
                    $gallery_temp .= '|';
                }
            }
            $hot = ($row['hot']) ? ("$('#hot').attr('checked','true');") . ("$('#hot').next().removeClass('lcs_off').addClass('lcs_on');") : ('');
            $enable = ($row['enable']) ? ("$('#enable').attr('checked','true');") . ("$('#enable').next().removeClass('lcs_off').addClass('lcs_on');") : ('');
            $step_pic_temp = substr($step_pic_temp, 0, -1);
            echo <<<info
                    <script>
                    $(function(){
                        $('#id').html('{$row['id']}');
                        $('#service').val('{$row['title']}');
                        $('#times').val('{$row['times']}');
                        $('#newBanner').html('<img src="{$row['banner']}" class="img-fluid">');
                        $('#banner_post').val('{$row['banner']}');
                        $('#newIndex').html('<img src="{$row['indexImage']}" class="img-fluid">');
                        $('#index_post').val('{$row['indexImage']}');
                        $('#intro').html('{$row['introduction']}');
                        $('#price').html('{$price}');
                        $('#service_content').html('{$content}');
                        $('#gallery').html('{$gallery}');
                        {$option}
                        $('#remark').find('option[value={$row['remark']}]').attr('selected','true');
                        {$hot}
                        {$enable}
                        $('#gallery_temp').val('{$gallery_temp}');
                        $('#step_pic_temp').val('{$step_pic_temp}');
                    })
                    </script>
                info;
        } else {
            echo 'FAIL';
            echo $result;
        }
        break;
    case 'service_set':
        $gallery = array();
        $prices = array();
        $step = array();
        $image_save = array();
        $id = $_POST['id'];
        for ($i = 0; $i < count($_POST['number']); $i++) {
            $temp = $_POST['number'][$i] . ',' . $_POST['price'][$i];
            array_push($prices, $temp);
        }
        $prices = base64_encode(serialize($prices));
        $options = base64_encode(serialize($_POST['options']));
        define('SAVE_FOLDER', '../image/' . $id . '/');
        if (!is_dir(SAVE_FOLDER)) {
            mkdir(SAVE_FOLDER);
        }
        $data_check = "data";
        $banner = $_POST['banner'];
        if (strpos($banner, $data_check) !== false) {
            $banner = str_replace('data:image/png;base64,', '', $banner);
            $banner = str_replace(' ', '+', $banner);
            $data = base64_decode($banner);
            $banner = SAVE_FOLDER . uniqid('ban', false) . '.png';
            array_push($image_save, array($banner, $data));
        }
        $index = $_POST['index'];
        if (strpos($index, $data_check) !== false) {
            $index = str_replace('data:image/png;base64,', '', $index);
            $index = str_replace(' ', '+', $index);
            $data = base64_decode($index);
            $index = SAVE_FOLDER . uniqid('index', false) . '.png';
            array_push($image_save, array($index, $data));
        }
        $type = '';
        foreach ($_POST['gallery'] as $key => $value) {
            if (strpos($value, $data_check) !== false) {
                if (strpos($value, 'jpeg') != false) {
                    $value = str_replace('data:image/jpeg;base64,', '', $value);
                    $type = '.jpeg';
                } elseif (strpos($value, 'png') != false) {
                    $value = str_replace('data:image/png;base64,', '', $value);
                    $type = '.png';
                }
                $value = str_replace(' ', '+', $value);
                $data = base64_decode($value);
                $value = SAVE_FOLDER . uniqid('gall', false) . '-' . $key . $type;
                array_push($image_save, array($value, $data));
            }
            array_push($gallery, $value);
        }
        for ($i = 0; $i < count($_POST['step_title']); $i++) {
            $temp = '';
            $pic = $_POST['step_pic'][$i];
            if (strpos($pic, $data_check) !== false) {
                if (strpos($pic, 'jpeg') != false) {
                    $pic = str_replace('data:image/jpeg;base64,', '', $pic);
                    $type = '.jpeg';
                } elseif (strpos($pic, 'png') != false) {
                    $pic = str_replace('data:image/png;base64,', '', $pic);
                    $type = '.png';
                }
                $pic = str_replace(' ', '+', $pic);
                $data = base64_decode($pic);
                $pic = SAVE_FOLDER . uniqid('step', false) . '-' . $i . $type;
                array_push($image_save, array($pic, $data));
            }
            $temp = array($_POST['step_title'][$i], $_POST['step_time'][$i], $_POST['step_content'][$i], $pic);
            array_push($step, $temp);
        }
        $step = base64_encode(serialize($step));
        $gallery = base64_encode(serialize($gallery));
        $alt = base64_encode(serialize($_POST['gallery_alt']));
        $sql = "UPDATE `service` SET `title` = '{$_POST['service']}',";
        $sql .= "`times`= {$_POST['times']},";
        $sql .= "`banner` = '{$banner}',";
        $sql .= "`indexImage` = '{$index}',";
        $sql .= "`introduction` = '{$_POST['intro']}',";
        $sql .= "`prices` = '{$prices}',";
        $sql .= "`options` = '{$options}',";
        $sql .= "`content` = '{$step}',";
        $sql .= "`gallery` = '{$gallery}',";
        $sql .= "`alt` = '{$alt}',";
        $sql .= "`remark` = {$_POST['remark']},";
        $sql .= "`hot` = {$_POST['hot']},";
        $sql .= "`enable` = {$_POST['enable']} ";
        $sql .= "WHERE `id` = '{$id}';";
        // echo $sql;
        $result = mysqli_query($con, $sql);
        if ($result) {
            foreach ($image_save as $value) {
                file_put_contents($value[0], $value[1]);
            }
            echo 'UPDATED';
        } else {
            echo 'FAIL';
            echo $result;
        }
        break;
    case 'service_delete':
        $sql = "DELETE FROM `service` WHERE `id` = '{$_POST['id']}';";
        $result = mysqli_query($con, $sql);
        if ($result) {
            echo 'DELETED';
        } else {
            echo 'FAIL';
            echo $result;
        }
        break;
    default:
        # code...
        break;
}

mysqli_close($con);

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