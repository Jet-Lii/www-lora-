<?php
      $cmd = $_POST['cmd'];
      $usrid = $_POST['usrid'];
      $link = mysql_connect('127.0.0.1', 'root', '123');
      if (!$link) {
      die('Not connected : ' . mysql_error());
      }
      // make foo the current db
      $db_selected = mysql_select_db('mytest', $link);
      if (!$db_selected) {
      die ('Can\'t use foo : ' . mysql_error());
      }
        $exist = mysql_query("select * from Modbus where usrid=$usrid");

        if (mysql_num_rows($exist) < 1){
            $result = mysql_query("insert into Modbus(usrid,cmd) values('$usrid','$cmd')");
            if($result){
              echo "1";
            }else{
              echo "2";
            }
        }else{
            $result1 = mysql_query("update Modbus set cmd='$cmd' where usrid=$usrid");
            if($result1){
              echo "3";
            }else{
              echo "4";
            }
        }
  ?>
