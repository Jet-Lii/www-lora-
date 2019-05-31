<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>科瑞杰云平台</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/sidebar-menu.css">
  </head>
  <body>

    <!-- 模态框（Modal） -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div style="text-align: center;" class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" style="color:#333" id="myModalLabel">添加设备</h4>
              </div>
              <!-- <div class="modal-body">在这里添加一些文本</div> -->
              <form>
                 <div style="text-align:center;margin-top: 23px;" class="form-group form_one">
                    <label for="exampleInputEmail1">ID</label>
                    <input style="width: 361px;" type="text" class="weatherId id" name="usrid" id="exampleInputEmail1" placeholder="">
                  </div>
                  <div style="text-align:center;" class="form-group">
                    <label for="exampleInputPassword1">类型</label>
                    <select style="width: 361px;" class="selectpicker show-tick" name="deviceid" id="exampleInputPassword1" ><!-- deviceid是设备类型 -->
          							<option value="1">气象站</option>
          							<option value="2">土壤</option>
          							<option value="3">水阀</option>
          					</select>
                  </div>
                  <div style="text-align:center;" class="form-group">
                    <label for="exampleInputPassword1">模式</label>
                    <select style="width: 361px;" class="selectpicker gongzuoMode" name="deviceid" id="exampleInputPassword1" ><!-- deviceid是设备类型 -->
          							<option value="1">主动上报模式</option>
          							<option value="2">轮询模式</option>
          							<option value="3">modbus模式</option>
          					</select>
                  </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-close" data-dismiss="modal">关闭</button>
                  <button type="button" value="提交" id="button1" class="weatherSub sub btn btn-default">提交</button>
                </div>
              </form>
          </div><!-- /.modal-content -->
      </div><!-- /.modal -->
  </div>

    <div class="warpBox">
      <!-- header -->
      <div class="header">
        <b>LoRa 网关本地配置系统</b>
        <div class="hRight">
          <img class="mainPng" src="./img/main.png" alt="">
          <span class="userName">admin</span>
          <img class="delPng" src="./img/del.png" alt="">
        </div>
      </div>
      <!-- 菜单 -->
      <aside class="main-sidebar">
        <section  class="sidebar">
          <!-- nav -->
          <div class="leftNav">
            <div class="headerLogo">
              <img src="./img/logo.png" alt="">
              <b>科瑞杰云平台</b>
            </div>
          </div>
        	<ul class="sidebar-menu">
        	  <li class="treeview active">
          		<a href="#">
          		  <i class="iconTu"><img src="./img/tu1.png" alt=""></i><span>设备管理</span><i class="fa fa-angle-down pull-right"></i>
          		</a>
          		<ul class="treeview-menu">
                <!-- <li class="blueBoder"><a href="#"><i class="fa fa-circle"></i>添加设备</a></li> -->
                <!-- <li class="blueBoder"><a href="#" style="color:#fff"><i class="fa fa-circle"></i>设备列表</a></li> -->
          		  <!-- <li class="blueBoder"><a href="#"><i class="fa fa-circle"></i>查看设备</a></li> -->
                <li class="blueBoder"><a href="#"><i class="fa fa-circle"></i></i>设备列表</a></li>
                <li class="blueBoder"><a href="#"><i class="fa fa-circle"></i></i>系统设置</a></li>
          		  <!-- <li class="treeview blueBoder">
                  <a href="#"><i class="fa fa-circle"></i>配置<i class="fa fa-angle-down pull-right"></i></a>
                  <ul class="treeview-menu">
              		  <li><a href="#"><i class="fa fa-circle-o"></i>当前状态</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i>串口设置</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i>通讯设置</a></li>
              		</ul>
                </li> -->
          		</ul>
        	  </li>
        	  <li class="treeview">
          		<a href="#">
          		  <i class="iconTu gujian"><img src="./img/tu2.png" alt=""></i><span>固件管理</span><i class="fa fa-angle-down pull-right"></i>
          		</a>
          		<ul class="treeview-menu">
          		  <li><a href="#"><i class="fa fa-circle"></i>设备管理</a></li>
          		</ul>
        	  </li>
        	</ul>
        </section>
      </aside>
      <!-- countent -->
      <div class="countent">
        <!-- 设备列表 -->
        <div class="equipmentList">
          <div class="divActive">
            <p class="tabHeader">
              设备列表
              <span class="tianjia">
                <a href="#" class="dropdown-toggle" data-toggle="modal" data-target="#myModal">添加设备</a>
              </span>
            </p>
            <div class="table-a">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <thead>
                  <tr style="background:#F5F6FA;height:44px;">
                    <th width="16.666667%">设备ID</th>
                    <th width="16.666667%">设备类型</th>
                    <th width="16.666667%">模式</th>
                    <th width="16.666667%">采集数据间隔时间</th>
                    <th width="16.666667%">操作</th>
                  </tr>
                </thead>

                <?php
                  $link = mysql_connect('127.0.0.1', 'root', '123');
                  if (!$link) {
                  die('Not connected : ' . mysql_error());
                  }

                  // make foo the current db
                  $db_selected = mysql_select_db('mytest', $link);

                  $result = mysql_query("select * from device");

                ?>

                <tbody>
            		  <?php while($row = mysql_fetch_assoc($result)){ ?>
                      <tr>
            			      <td><?php echo $row['usrid'] ?></td>
                        <td>
                          <?php
                            if ($row['type']==1) {
                              echo "气象站";
                            } else if ($row['type']==2) {
                              echo "土壤";
                            } else {
                              echo "水阀";
                            }
                          ?>
                        </td>
                        <td>
                          <?php
                            if ($row['mode']==1) {
                              echo "主动上报模式";
                            } else if ($row['mode']==2) {
                              echo "轮询模式";
                            } else {
                              echo "modbus模式";
                            }
                          ?>
                        </td>
                        <td><?php echo $row['status'] ?></td>
                        <td>
                          <button class="btnAdd" type="button" name="button" data-mode=<?php echo $row['mode'] ?> data-id=<?php echo $row['usrid'] ?>>配置</button>
                          <button type="button" class="btnDelete del" data-id=<?php echo $row['usrid'] ?>>删除</button>
                        </td>
                      </tr>
            		 <?php }?>
                </tbody>

                <!-- <tr>
                  <td>01</td>
                  <td>KRQ-LW001</td>
                  <td>气象传感器</td>
                  <td>运行</td>
                  <td>20 分钟</td>
                  <td>
                    <button class="btnAdd" type="button" name="button">配置</button>
                    <button class="btnDelete" type="button" name="button">删除</button>
                  </td>
                </tr>
                <tr>
                  <td>02</td>
                  <td>KRQ-LW002</td>
                  <td>土壤传感器</td>
                  <td>运行</td>
                  <td>20 分钟</td>
                  <td>
                    <button class="btnAdd" type="button" name="button">配置</button>
                    <button class="btnDelete" type="button" name="button">删除</button>
                  </td>
                </tr> -->
              </table>
            </div>
          </div>
        </div>
        <!-- 查看设备 -->
        <!-- <div class="check divActive">
          <form class="" action="index.html" method="post">
            <ul class="checkList">
              <li>
                <label for="">Mac</label><input type="text" name="" value="">
              </li>
              <li>
                <label for="">Mac</label><input type="text" name="" value="">
              </li>
              <li>
                <label for="">Mac</label><input type="text" name="" value="">
              </li>
              <li>
                <label for="">Mac</label><input type="text" name="" value="">
              </li>
              <li>
                <label for="">Mac</label><input type="text" name="" value="">
              </li>
              <li>
                <label for="">Mac</label><input type="text" name="" value="">
              </li>
              <li>
                <label for="">Mac</label><input type="text" name="" value="">
              </li>
              <li>
                <label for="">Mac</label><input type="text" name="" value="">
              </li>
              <li>
                <label for="">Mac</label><input type="text" name="" value="">
              </li>
              <li>
                <label for="">Mac</label><input type="text" name="" value="">
              </li>
            </ul>
          </form>
        </div> -->
        <!-- 当前状态 -->
        <div class="status">
          <p><span class="goBank">设备管理</span> &gt; <span class="sheibeiID">设备ID</span> &gt; 配置</p>
          <div class="divActive">
            <p>串口配置</p>
            <form class="" action="index.html" method="post">
              <ul>
                <li>
                  <label for="">波特率</label>
                  <select class="baud">
                      <option>110</option>
                      <option>300</option>
                      <option>600</option>
                      <option>1200</option>
                      <option>2400</option>
                      <option>4800</option>
                      <option>9600</option>
                      <option>14400</option>
                      <option>19200</option>
                      <option>38400</option>
                      <option>56000</option>
                      <option>57600</option>
                      <option selected = "selected">115200</option>
                  </select>
                </li>
                <li>
                  <label for="">数据位</label>
                  <select class="DataBit">
                      <option>6</option>
                      <option>7</option>
                      <option selected = "selected">8</option>
                  </select>
                </li>
                <li>
                  <label for="">校验位</label>
                  <select class="CheckBit">
                      <option selected = "selected" value="0">无</option>
                      <option value="1">奇校验</option>
                      <option value="2">偶校验</option>
                      <option value="3">Mark</option>
                      <option value="4">空格校验</option>
                  </select>
                </li>
                <li>
                  <label for="">停止位</label>
                  <select class="StopBit">
                      <option selected = "selected" value="10">1</option>
                      <option value="15">1.5</option>
                      <option value="20">2</option>
                  </select>
                </li>
              </ul>
              <button class="chuankouBC" type="button" name="button">保存</button>
            </form>
          </div>
          <div class="divActive modbusMode">
            <label for="">modbus模式命令</label><input class="cmd" type="text" name="" value="">
            <button class="modbusBC" type="button" name="button">保存</button>
          </div>
          <!-- <div class="divActive">
            <p>通讯状态</p>
            <form class="" action="index.html" method="post">
              <ul>
                <li>
                  <label for="">发送帧</label><input type="text" name="" value="">
                </li>
                <li>
                  <label for="">Mac</label><input type="text" name="" value="">
                </li>
                <li>
                  <label for="">Mac</label><input type="text" name="" value="">
                </li>
                <li>
                  <label for="">Mac</label><input type="text" name="" value="">
                </li>
                <li>
                  <label for="">Mac</label><input type="text" name="" value="">
                </li>
                <li>
                  <label for="">Mac</label><input type="text" name="" value="">
                </li>
                <li>
                  <label for="">Mac</label><input type="text" name="" value="">
                </li>
                <li>
                  <label for="">Mac</label><input type="text" name="" value="">
                </li>
                <li>
                  <label for="">Mac</label><input type="text" name="" value="">
                </li>
              </ul>
            </form>
          </div> -->
        </div>
        <!-- 系统设置 -->
        <div class="system">
          <div class="divActive">
            <ol class="leftUl">
              <!-- <li> <a href="#index1">用户验证</a> </li> -->
              <li><a href="#index2">基础配置</a></li>
              <!-- <li> <a href="#index3">广域网设置</a> </li>
              <li> <a href="#index4">局域网设置</a> </li>
              <li> <a href="#index5">无线网络连接</a> </li>
              <li> <a href="#index6">移动网络设置</a> </li>
              <li> <a href="#index7">Telnet设置</a> </li>
              <li> <a href="#index8">Web设置</a> </li>
              <li> <a href="#index9">NTP设置</a> </li>
              <li> <a href="#index10">端口映射</a> </li>
              <li> <a href="#index11">在线保持</a> </li>
              <li> <a href="#index12">流量统计</a> </li> -->
            </ol>
            <form>
                <div class="article">
                  <!-- <div class="dashedDiv">
                    <p id="index1">用户验证</p>
                    <ul>
                      <li>
                        <label for="">用户名</label><input type="text" name="" value="">
                      </li>
                      <li class="bottomMargin">
                        <label for="">密码</label><input type="text" name="" value="">
                      </li>
                    </ul>
                  </div> -->
                  <div class="dashedDiv">
                    <p id="index2">基础配置</p>

                    <?php
                      $link = mysql_connect('127.0.0.1', 'root', '123');
                      if (!$link) {
                      die('Not connected : ' . mysql_error());
                      }

                      // make foo the current db
                      $db_selected = mysql_select_db('mytest', $link);

                      $sql = mysql_query("select * from BaseConf");

                    ?>

                    <ul class="basic">

                      <?php while($row = mysql_fetch_assoc($sql)){ ?>
                        <li>
                          <label for="">网关的工作模式</label>
                          <select class="Mode" name="Mode">
                              <option value="1">主动上报模式</option>
                              <option value="2">轮询模式</option>
                              <option value="3">MODBUS模式</option>
                              <option value="4">混合模式</option>
                          </select>
                        </li>
                        <li>
                          <label for="">节点数量</label><input type="text" class="IdNum" name="IdNum" value="<?php echo $row['IdNum'] ?>">
                        </li>
                        <li>
                          <label for="">时隙</label><input type="text" class="Gap" name="Gap" value="<?php echo $row['Gap'] ?>">
                        </li>
                        <li>
                          <label for="">主动上报时间</label><input type="text" class="ReportTime" name="ReportTime" value="<?php echo $row['ReportTime'] ?>">
                        </li>
                        <li>
                          <label for="">轮询间隔</label><input type="text" class="PollingTime" name="PollingTime" value="<?php echo $row['PollingTime'] ?>">
                        </li>
                        <li class="bottomMargin">
                          <label for="">modbus间隔</label><input type="text" class="ModbusTime" name="ModbusTime" value="<?php echo $row['ModbusTime'] ?>">
                        </li>
                      <?php }?>
                    </ul>
                  </div>
                  <!-- <div class="dashedDiv">
                    <p id="index3">广域网设置</p>
                    <ul>
                      <li class="switch">
                        <label for="">DHCP</label><input type="checkbox" checked />
                      </li>
                      <li class="bottomMargin">
                        <label for="">DNS</label><input type="text" name="" value="">
                      </li>
                    </ul>
                  </div>
                  <div class="dashedDiv">
                    <p id="index4">局域网设置</p>
                    <ul>
                      <li>
                        <label for="">LAN IP</label><input type="text" name="" value="">
                      </li>
                      <li>
                        <label for="">子网掩码</label><input type="text" name="" value="">
                      </li>
                      <li>
                        <label for="">DHCP</label><button type="button" name="button">开关</button>
                      </li>
                      <li class="bottomMargin">
                        <label for="">以太网口模式</label>
                        <select id="sex" >
                            <option>WAN</option>
                            <option>WAN-LINE</option>
                        </select>
                      </li>
                    </ul>
                  </div>
                  <div class="dashedDiv">
                    <p id="index5">无线网络连接</p>
                    <ul>
                      <li>
                        <label for="">AP SSID</label><input type="text" name="" value="">
                      </li>
                      <li>
                        <label for="">AP 秘钥</label><input type="text" name="" value="">
                      </li>
                      <li class="bottomMargin">
                        <label for="">AP 信道</label>
                        <select id="sex" >
                            <option>AUTO</option>
                            <option>AUTO-LINE</option>
                        </select>
                      </li>
                    </ul>
                  </div>
                  <div class="dashedDiv">
                    <p id="index6">移动网络设置</p>
                    <ul>
                      <li>
                        <label for="">接入点名称(APN)</label><input type="text" name="" value="">
                      </li>
                      <li>
                        <label for="">ANT 账号</label><input type="text" name="" value="">
                      </li>
                      <li>
                        <label for="">APN密码</label><input type="password" name="" value="">
                      </li>
                      <li class="bottomMargin">
                        <label for="">扫码模式</label>
                        <select id="sex" >
                            <option>AUTO</option>
                            <option>AUTO-LINE</option>
                        </select>
                      </li>
                    </ul>
                  </div>
                  <div class="dashedDiv">
                    <p id="index7">Telnet设置</p>
                    <ul>
                      <li>
                        <label for="">开启</label><button type="button" name="button">开关</button>
                      </li>
                      <li>
                        <label for="">Telent 端口号</label><input type="text" name="" value="">
                      </li>
                      <li class="bottomMargin">
                        <label for="">回显</label><button type="button" name="button">开关</button>
                      </li>
                    </ul>
                  </div>
                  <div class="dashedDiv">
                    <p id="index8">Web设置</p>
                    <ul>
                      <li>
                        <label for="">开启</label><button type="button" name="button">开关</button>
                      </li>
                      <li class="bottomMargin">
                        <label for="">Web端口号</label><input type="text" name="" value="">
                      </li>
                    </ul>
                  </div>
                  <div class="dashedDiv">
                    <p id="index9">NTP设置</p>
                    <ul>
                      <li class="bottomMargin">
                        <label for="">开启</label><button type="button" name="button">开关</button>
                      </li>
                    </ul>
                  </div>
                  <div class="dashedDiv">
                    <p id="10">端口映射</p>
                    <ul>
                      <li class="bottomMargin">
                        <label for="">开启</label><button type="button" name="button">开关</button>
                      </li>
                    </ul>
                  </div>
                  <div class="dashedDiv">
                    <p id="index11">在线保持</p>
                    <ul>
                      <li class="bottomMargin">
                        <label for="">端口映射</label><button type="button" name="button">开关</button>
                      </li>
                    </ul>
                  </div>
                  <div class="dashedDiv">
                    <p id="index12">流量统计</p>
                    <ul>
                      <li>
                        <label for="">模式</label>
                        <select id="sex" >
                            <option>AUTO</option>
                            <option>AUTO-LINE</option>
                        </select>
                      </li>
                      <li>
                        <label for="">值(MB)</label><input type="text" name="" value="">
                      </li>
                      <li>
                        <label for="">动作</label>
                        <select id="sex" >
                            <option>AUTO</option>
                            <option>AUTO-LINE</option>
                        </select>
                      </li>
                    </ul>
                  </div> -->
                  <p class="footerBoo">
                    <button class="basicBaocun" type="button" name="button">保存</button>
                    <button class="basicChongzhi" type="button" name="button">重置</button>
                  </p>
                </div>
            </form>
          </div>
        </div>
        <!-- 串口设置 -->
        <!-- <div class="serialPort">
          <div class="divActive">
            <ol class="leftUl">
              <li> <a href="#1">基本设置</a> </li>
              <li> <a href="#2">缓存设置</a> </li>
              <li> <a href="#3">流量设置</a> </li>
              <li> <a href="#4">Cli设置</a> </li>
              <li> <a href="#5">协议设置</a> </li>
            </ol>
            <form>
                <div class="article">
                  <div class="dashedDiv">
                    <p id="1">基本设置</p>
                    <ul>
                      <li>
                        <label for="">串口设置</label>
                        <select id="sex" >
                            <option>WAN</option>
                            <option>WAN-LINE</option>
                        </select>
                      </li>
                      <li>
                        <label for="">波特率</label>
                        <select id="sex" >
                            <option>WAN</option>
                            <option>WAN-LINE</option>
                        </select>
                      </li>
                      <li>
                        <label for="">数据位</label>
                        <select id="sex" >
                            <option>WAN</option>
                            <option>WAN-LINE</option>
                        </select>
                      </li>
                      <li>
                        <label for="">停止位</label>
                        <select id="sex" >
                            <option>WAN</option>
                            <option>WAN-LINE</option>
                        </select>
                      </li>
                      <li class="bottomMargin">
                        <label for="">校验位</label>
                        <select id="sex" >
                            <option>WAN</option>
                            <option>WAN-LINE</option>
                        </select>
                      </li>
                    </ul>
                  </div>
                  <div class="dashedDiv">
                    <p id="2">缓存设置</p>
                    <ul>
                      <li>
                        <label for="">缓存大小</label><input type="text" name="" value="">
                      </li>
                      <li class="bottomMargin">
                        <label for="">间隔时间</label><input type="text" name="" value="">
                      </li>
                    </ul>
                  </div>
                  <div class="dashedDiv">
                    <p id="3">流量控制</p>
                    <ul>
                      <li class="bottomMargin">
                        <label for="">流控</label>
                        <select id="sex" >
                            <option>WAN</option>
                            <option>WAN-LINE</option>
                        </select>
                      </li>
                    </ul>
                  </div>
                  <div class="dashedDiv">
                    <p id="4">Cli设置</p>
                    <ul>
                      <li class="bottomMargin">
                        <label for="">Cli</label><button type="button" name="button">开关</button>
                      </li>
                    </ul>
                  </div>
                  <div class="dashedDiv">
                    <p id="5">协议设置</p>
                    <ul>
                      <li class="bottomMargin">
                        <label for="">协议</label>
                        <select id="sex" >
                            <option>AUTO</option>
                            <option>AUTO-LINE</option>
                        </select>
                      </li>
                    </ul>
                  </div>
                  <p class="footerBoo">
                    <button class="baocun" type="button" name="button">保存</button>
                    <button class="chongzhi" type="button" name="button">重置</button>
                  </p>
                </div>
            </form>
          </div>
        </div> -->
        <!-- 通讯设置 -->
        <!-- <div class="communicate">
          <div class="divActive">
            <ol class="leftUl">
              <li> <a href="#icate1">基本设置</a> </li>
              <li> <a href="#icate2">Socket 设置</a> </li>
              <li> <a href="#icate3">协议设置</a> </li>
              <li> <a href="#icate4">更多设置</a> </li>
            </ol>
            <form>
                <div class="article">
                  <div class="dashedDiv">
                    <p id="icate1">基本设置</p>
                    <ul>
                      <li>
                        <label for="">名称</label><input type="text" name="" value="">
                      </li>
                      <li class="bottomMargin">
                        <label for="">协议</label>
                        <select id="sex" >
                            <option>TCP Server</option>
                            <option>WAN-LINE</option>
                        </select>
                      </li>
                    </ul>
                  </div>
                  <div class="dashedDiv">
                    <p id="icate2">Socket设置</p>
                    <ul>
                      <li>
                        <label for="">本地端口号</label><input type="text" name="" value="">
                      </li>
                      <li>
                        <label for="">缓存大小</label><input type="text" name="" value="">
                      </li>
                      <li>
                        <label for="">心跳时间(s)</label><input type="text" name="" value="">
                      </li>
                      <li class="bottomMargin">
                        <label for="">超时时间(s)</label><input type="text" name="" value="">
                      </li>
                    </ul>
                  </div>
                  <div class="dashedDiv">
                    <p id="icate3">协议设置</p>
                    <ul>
                      <li class="bottomMargin">
                        <label for="">Max Accept</label><input type="text" name="" value="">
                      </li>
                    </ul>
                  </div>
                  <div class="dashedDiv">
                    <p id="icate4">更多设置</p>
                    <ul>
                      <li>
                        <label for="">加密类型</label>
                        <select id="sex" >
                            <option>DISABLE</option>
                            <option>AUTO-LINE</option>
                        </select>
                      </li>
                      <li class="bottomMargin">
                        <label for="">路由</label>
                        <select id="sex" >
                            <option>Uart 1</option>
                            <option>AUTO-LINE</option>
                        </select>
                      </li>
                    </ul>
                  </div>
                  <p class="footerBoo">
                    <button class="baocun" type="button" name="button">保存</button>
                    <button class="chongzhi" type="button" name="button">重置</button>
                  </p>
                </div>
            </form>
          </div>
        </div> -->
        <!-- 固件管理 -->
        <div class="firmware">
          <div class="divActive">
            <div class="chaxun">
              <p> <input type="text" name="" value="查询"> <img src="./img/sousuo.png" alt=""> </p>
            </div>
            <form class="" action="index.html" method="post">
              <ul class="checkList">
                <li>
                  <label for="">设备类型</label><input type="text" name="" value="">
                </li>
                <li>
                  <label for="">固件名</label><input type="text" name="" value="">
                </li>
                <li>
                  <label for="">类型</label><input type="text" name="" value="">
                </li>
                <li>
                  <label for="">版本</label><input type="text" name="" value="">
                </li>
                <li>
                  <label for="">状态</label><input type="text" name="" value="">
                </li>
              </ul>
            </form>
          </div>
          <div class="divActive">
            <div class="table-a">
              <table width="auto" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <th width="105">
                    <input type="checkbox" name="" value="">
                  </th>
                  <th width="181">序号</th>
                  <th width="112">固件名</th>
                  <th width="181">设备类型</th>
                  <th width="181">类型</th>
                  <th width="181">软件版本</th>
                  <th width="181">上传用户</th>
                  <th width="181">协议版本</th>
                  <th width="181">状态</th>
                  <th width="181">操作</th>
                </tr>
                <tr>
                  <td>
                    <input type="checkbox" name="" value="">
                  </td>
                  <td>1</td>
                  <td>aaa</td>
                  <td>bbb</td>
                  <td>ccc</td>
                  <td>1.1.1</td>
                  <td>admin</td>
                  <td>2.2.2</td>
                  <td>在线</td>
                  <td>
                    <button class="btnAdd" type="button" name="button">添加</button>
                    <button class="btnDelete" type="button" name="button">删除</button>
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- footer -->
      <div class="footer">
        <p>&copy;2017-2019 北京科瑞杰科技发展有限公司 版权所有</p>
      </div>
    </div>
  </body>
  <script type="text/javascript" src="./js/jquery.min.js"></script>
  <script src="http://cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="./js/sidebar-menu.js"></script>
  <script>
    $.sidebarMenu($('.sidebar-menu'))
  </script>
</html>
