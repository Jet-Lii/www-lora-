

$("input").focus(function(){
  $('.tishi').animate({'top':'-6%' }, 500);
})

$('.help').click(function() {
  $('form').hide();
  $('.helpBox').show();
})

$('.userLogin').click(function () {
  $('form').show();
  $('.helpBox').hide();
})

// 登录
$('.login_button').click(function () {

  var name = $('.name').val();
  var password = $('.password').val();

  if (name == '' || password == '') {
    $('.tishi').animate({'top':'8%' }, 500);
    // alert('请输入用户名或密码!')
  } else {
    $.ajax({
      url: '../php/login.php',
      type: 'POST',
      data:{
        name:name,
        password:password
      },
      dataType: 'json',
      success:function(msg){
        console.log(msg);
        if(msg == "0"){
        // window.alert("用户名或密码不正确，请重新登录!");
        $('.tishi').html('用户名或密码不正确，请重新登录!')
        $('.tishi').animate({'top':'8%' }, 500);
        $('input').val('');
        } else {
          window.location.href="http://192.168.1.1:88/index.php";
        }
      }
    })
  }
})
