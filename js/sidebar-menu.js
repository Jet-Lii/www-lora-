
// 控制输入框两数字之间有空格
$('.cmd').on('keyup mouseout input',function(){
   var $this = $(this),
    v = $this.val();
   /\S{3}/.test(v) && $this.val(v.replace(/\s/g,'').replace(/(.{2})/g, "$1 "));
  });

  $('.delPng').click(function () {
    location.replace('http://192.168.1.1:88/login.html');
  })

// 基础配置保存按钮点击
$('.basicBaocun').click(function () {
  // 获取到当前行的id
  var Mode = $('.Mode').val();
  var IdNum = $('.IdNum').val();
  var Gap = $('.Gap').val();
  var ReportTime = $('.ReportTime').val();
  var PollingTime = $('.PollingTime').val();
  var ModbusTime = $('.ModbusTime').val();
  // 发送请求
    $.ajax({
      url: './php/xiugaiBaseConf.php',
      type: 'POST',
      data:{
        Mode:Mode,
        IdNum:IdNum,
        Gap:Gap,
        ReportTime:ReportTime,
        PollingTime:PollingTime,
        ModbusTime:ModbusTime
      },
      dataType: 'json',
      success:function(msg){
        //console.log(msg);
        if(msg == "1"){
        window.alert("修改成功");
        location.reload();
        }else if(msg == "2"){
        window.alert("修改失败");
        }
      }
    })
})


// 设备列表串口配置保存点击
$('.chuankouBC').click(function () {
  var baud = $('.baud').val();
  var DataBit = $('.DataBit').val();
  var CheckBit = $('.CheckBit').val();
  var StopBit = $('.StopBit').val();
  var usrid = $('.sheibeiID').text();
  // 发送请求
    $.ajax({
      url: './php/xiugaiDevice.php',
      type: 'POST',
      data:{
        baud:baud,
        DataBit:DataBit,
        CheckBit:CheckBit,
        StopBit:StopBit,
        usrid:usrid
      },
      dataType: 'json',
      success:function(msg){
        //console.log(msg);
        if(msg == "1"){
        window.alert("修改成功");
        // location.reload();
        }else if(msg == "2"){
        window.alert("修改失败");
        }
      }
    })
})

// 设备列表modbus模式命令保存点击
$('.modbusBC').click(function () {
  var cmd = $('.cmd').val();
  var usrid = $('.sheibeiID').text();
  // 发送请求
    $.ajax({
      url: './php/insertModbus.php',
      type: 'POST',
      data:{
        cmd:cmd,
        usrid:usrid
      },
      dataType: 'json',
      success:function(msg){
        // console.log(msg);
        if(msg == "1"){
          window.alert("添加成功");
          // location.reload();
        } else if(msg == "2"){
          window.alert("添加失败");
        } else if (msg == "3") {
          window.alert("修改成功");
        } else if (msg == "4") {
          window.alert("修改失败");
        }
      }
    })
})


// 添加设备点击提交
$('.weatherSub').click(function () {
  // 获取当前行的id
  var weatherId =   $('.weatherId').val()
  var weatherSele = $('.show-tick').val()
  var gongzuoMode = $('.gongzuoMode').val()

  // 发送请求
  $.ajax({
    url: '../php/station_addUser.php',
    type: 'POST',
    data:{
      usrid:weatherId,
      type:weatherSele,
      mode:gongzuoMode
    },
    dataType: 'json',
    success:function(msg){
      if(msg == "1"){
        window.alert("设备已被添加，无须重复添加！");
        location.reload();
      }else if(msg == "2"){
        window.alert("添加成功！");
        location.reload();
      }
    }
  })
})


// 设备列表删除设备
$('.del').click(function(){
  // 获取到当前行的id
  var usrid = $(this).attr("data-id");
  //console.log(usrid);
  // 发送请求
    $.ajax({
      url: '../php/shebeiList_delData.php',
      type: 'POST',
      data:{
        usrid:usrid
      },
      dataType: 'json',
      success:function(msg){
        //console.log(msg);
        if(msg == "1"){
        window.alert("删除数据成功");
        location.reload();
        }else if(msg == "2"){
        window.alert("删除数据失败");
        }
      }
    })
  })


// 点击设备列表配置显示配置页
$('.btnAdd').click(function () {

  var usrid = $(this).attr("data-id");
  var mode = $(this).attr("data-mode");

  // console.log(mode);

  if (mode == 3) {
    $('.modbusMode').show();
  } else {
    $('.modbusMode').hide();
  }


  // 查询该设备的配置信息
  // 发送请求
    $.ajax({
      url: '../php/chaxunModbus.php',
      type: 'POST',
      data:{
        usrid:usrid
      },
      dataType: 'json',
      success:function(msg){
        // console.log(msg.name);
        $('.cmd').val(msg.name);
      }
    })

    $.ajax({
      url: '../php/chaxunCK.php',
      type: 'POST',
      data:{
        usrid:usrid
      },
      dataType: 'json',
      success:function(data){
        // console.log(data);
        $('.baud').val(data.baud);
        $('.DataBit').val(data.DataBit);
        $('.CheckBit').val(data.CheckBit);
        $('.StopBit').val(data.StopBit);
      }
    })


  $('.sheibeiID').html(usrid);

  $('.equipmentList').hide();
  $('.status').show();
})

// 点击导航返回设备列表页
$('.status .goBank').click(function functionName() {
  $('.status').hide();
  $('.equipmentList').show();
})

$.sidebarMenu = function(menu) {
  var animationSpeed = 300;

  $(menu).on('click', 'li a', function(e) {
    var $this = $(this);
    console.log($this);
   // console.log($('.divActive input').val());
    // $(this).css('color','#fff').parent().siblings().find('a').css('color','#8aa4af')
    var mmsseg = $this.text();

    // tab切换
    if (mmsseg == '系统设置') {
      $('.system').css('display','block').siblings('div').css('display','none');
    }  else if (mmsseg == '设备列表') {
      $('.equipmentList').css('display','block').siblings('div').css('display','none');
    }

    var checkElement = $this.next();

    if (checkElement.is('.treeview-menu') && checkElement.is(':visible')) {
      checkElement.slideUp(animationSpeed, function() {
        checkElement.removeClass('menu-open');
      });
      checkElement.parent("li").removeClass("active");
    }

    //If the menu is not visible
    else if ((checkElement.is('.treeview-menu')) && (!checkElement.is(':visible'))) {
      //Get the parent menu
      var parent = $this.parents('ul').first();
      //Close all open menus within the parent
      var ul = parent.find('ul:visible').slideUp(animationSpeed);
      //Remove the menu-open class from the parent
      ul.removeClass('menu-open');
      //Get the parent li
      var parent_li = $this.parent("li");

      //Open the target menu and add the menu-open class
      checkElement.slideDown(animationSpeed, function() {
        //Add the class active to the parent li
        checkElement.addClass('menu-open');
        parent.find('li.active').removeClass('active');
        parent_li.addClass('active');
      });
    }
    //if this isn't a link, prevent the page from being redirected
    if (checkElement.is('.treeview-menu')) {
      e.preventDefault();
    }
  });
}
