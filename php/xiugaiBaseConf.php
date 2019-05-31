<?php
      $Mode = $_POST['Mode'];
      $IdNum = $_POST['IdNum'];
      $Gap = $_POST['Gap'];
      $ReportTime = $_POST['ReportTime'];
      $PollingTime = $_POST['PollingTime'];
      $ModbusTime = $_POST['ModbusTime'];
      $link = mysql_connect('127.0.0.1', 'root', '123');
      if (!$link) {
      die('Not connected : ' . mysql_error());
      }
      // make foo the current db
      $db_selected = mysql_select_db('mytest', $link);
      if (!$db_selected) {
      die ('Can\'t use foo : ' . mysql_error());
      }

        $result = mysql_query("update BaseConf set Mode=$Mode,IdNum=$IdNum,Gap=$Gap,ReportTime=$ReportTime,PollingTime=$PollingTime,ModbusTime=$ModbusTime");
        // $result = mysql_query("update BaseConf set Mode=5,IdNum=9,ReportTime=10,PollingTime=4,ModbusTime=8");

        if($result){
            echo "1";
        }else{
            echo "2";
        }
    ?>
