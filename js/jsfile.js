$(function()
{

//all error in html hide them
$(".user-first-name-error").hide();
$(".user-last-name-error").hide();
$(".user-email-error").hide();
$(".user-login-email-error").hide();
$(".confirm-pass-error").hide();

//first name input field blur events trigger
$(".user-first-name").blur(function ()
{
    checkUserFirstName();

});

//email input field blur events trigger
$(".user-email").blur(function ()
{
    checkUserEmail();

});

//login email name input field blur events trigger
$(".user-login-email").blur(function ()
{
    checkUserLogineMail();

});


//last  name input field blur events trigger
$(".user-last-name").blur(function ()
{
    checkUserLastName();

});

//event for reset password matching both input fields

$('.confirm-password-value').on('blur', function()
{

   matchPasswordValue();
});


//for checking white spaces of first name filed
function checkUserFirstName()
{
  var user_first_name_value=$(".user-first-name").val();

  if((user_first_name_value.indexOf(" ") !== -1) ||
   (user_first_name_value.length < 5))
  {
   $(".user-first-name-error").show();
    return true;
  }
  else
  {
    $(".user-first-name-error").hide();
  }
}


//for checking white spaces
function checkUserLastName()
{
  var user_last_name_value=$(".user-last-name").val();

  if( user_last_name_value.indexOf(" ") !== -1 )
  {
    
    $(".user-last-name-error").show();
    return true;
  }
  else
  {
    $(".user-last-name-error").hide();
  }
}



  
 //email validation checking
 function checkUserEmail ()
 {
   var user_email_value=$(".user-email").val();
   var pattern_check_email=new RegExp(/^[a-zA-Z0-9]+\.?[a-z0-9]+@[a-zA-Z]+\.[a-z]{2,3}$/);
   if(pattern_check_email.test(user_email_value))
   {
    $(".user-email-error").hide();
   }
   else
   {
    $(".user-email-error").show();
    return true;
   }
 }


//for checking email validation
   function  checkUserLogineMail()
    {
       var user_email_value=$(".user-login-email").val();
       var pattern_check_email=new RegExp(/^[a-zA-Z0-9]+\.?[a-z0-9]+@[a-zA-Z]+\.[a-z]{2,3}$/);
       if(pattern_check_email.test(user_email_value))
       {
        $(".user-login-email-error").hide();
       }
       else
       {
        $(".user-login-email-error").show();
        return true;
       }
    }

//when user register form submit 
$("#reg_form").submit( function(e) 
 {
   var check_user_first_name=checkUserFirstName();
  var check_user_last_name=checkUserLastName();
  var check_user_email=checkUserEmail();
  if( (check_user_first_name == true) || (check_user_email == true) || (check_user_last_name == true))
  {
     
    e.preventDefault();
    return false;
  }
  else
  {
      
    return true;

  }
 });

//when user form submit 
$("#login_form").submit( function(e) 
 {
  var check_user_email=checkUserLogineMail();

  if(check_user_email == true)
  {
     
    e.preventDefault();
    return false;
  }
  else
  {
      
    return true;

  }
 });


//for check  password fields match or not
function   matchPasswordValue()
{
  var get_new_pass_value = $(".password-value");
  var get_conf_pass_value = $('.confirm-password-value');
  var get_change_pass_button = $("button[id='reset-pass-button']");
  if(get_new_pass_value.val() !== get_conf_pass_value.val())
  {
    $(".confirm-pass-error").show();
    get_change_pass_button.prop('disabled', true);
    return false;

  }else
  {
    get_change_pass_button.prop('disabled', false);
    $(".confirm-pass-error").hide();

  }
}
});