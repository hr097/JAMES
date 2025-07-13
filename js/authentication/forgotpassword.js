
/* START::TOGGLE OTP- */

const togglePassword = document.querySelector("#togglePassword");
const otpcode = document.querySelector("#otpcode");
togglePassword.addEventListener("click", function () {
    const type = otpcode.getAttribute("type") === "password" ? "text" : "password";
    otpcode.setAttribute("type", type);
    this.classList.toggle("bi-eye");
});

/* END:::TOGGLE OTP */

/* START:: FORGOT_PASSWORD_VALIDATION */ 


var email = $("#txtemail"); 
var csrfToken = $("#csrfToken");
var code = $("#otpcode");
var attempts = 3;

function showError(message) 
{     
    $(".error-message").css("display","flex"); 
    $(".message").text(message); 
    setTimeout(function(){$(".message").text("");$(".error-message").css("display", "none");},2000); 
}

function preventBack()
{ 
    window.history.forward(); 
}  

function startMainTimer() //OTP entering time 
{
  var countDownDate1 = new Date().getTime()+500000; // 5 minute
  var x1 = setInterval(function(){
  var now1 = new Date().getTime();
  var distance1 = countDownDate1 - now1;
  if (distance1 < 0) {
    clearInterval(x1);
    window.location.replace("./index.php");
  }
}, 1000);
}

function startReqTimer() // rerequest otp timer 60 seconds 
{
  $("#resendotplink").css("pointer-events","none");
  var countDownDate = new Date().getTime()+61000; //61 second
  var x = setInterval(function(){
  var now = new Date().getTime();
  var distance = countDownDate - now;
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
  $("#resendotplink").text("You can rerequest code after "+seconds + " seconds");
  if (distance < 0) {
    clearInterval(x);
    $("#resendotplink").html("<span style='text-decoration:none;'>Rerequest Code?</span>");
    $("#resendotplink").css("pointer-events","auto");
  }
},1000);
}

function sendApiReq(apiNum)
{
    if(apiNum === 1)
    {
        $.post("./api/sendotp.php",
        {
          _un: email.val().toLowerCase().trim(),
          _ct: csrfToken.val(),
        },
        function(data,status)
        {     
              if(status == "success")
              {    
                  response = parseInt(data);
                  if(response === 0)
                  {   
                      $("#loading").hide();
                      $("#requestotp").show();
                      showError("User not exists");
                      email.val(""); 
                  }
                  else if(response===1)
                  {   
                      setTimeout("preventBack()", 0);  
                      window.onunload = function () { null };

                      $("#loading").hide();
                      $("#requestotp").hide();
                      $("#enterotp").show();
                      
                      startReqTimer(); 
                      startMainTimer();
                  }
                  else
                  {
                    $("#loading").hide();
                    $("#requestotp").show();
                    showError("Error occurred ! Try after some time");
                    setTimeout( function(){window.location.reload();},2500);
                  }
              }
              else
              { 
                $("#loading").hide();
                $("#requestotp").show();
                showError("Something went wrong!");
                setTimeout( function(){window.location.reload();},2500);
              }
        });
   }
   else if(apiNum===2)
   {    
        $.post("./api/validateotp.php",
        {
          _c: code.val().trim(),
          _ct: csrfToken.val(),
        },
        function(data,status)
        {     
              if(status == "success")
              {
                  response = parseInt(data);
                  if(response === -1)
                  {   
                      attempts -= 1;
                      if(attempts===0)
                      {
                        showError("Invalid code!");
                        code.val(""); 
                        setTimeout( function(){window.location.replace("./forgotpassword.php")},1000);
                      }
                      else if(attempts===1)
                      { 
                        showError("Invalid code! "+attempts+" attempt left");
                        code.val("");
                      }
                      else 
                      { 
                        showError("Invalid code! "+attempts+" attempts left");
                        code.val(""); 
                      }
                  }
                  else if(response === 1)
                  {   
                    window.location.replace("./resetpassword.php");
                  }
                  else
                  {
                    showError("Error occurred ! Try after some time");
                    setTimeout( function(){window.location.reload();},2500);
                  }
              }
              else
              { 
                showError("Something went wrong!");
                setTimeout( function(){window.location.reload();},2500);
              }
        });
   }
}

/* END :: FORGOT_PASSWORD_VALIDATION */ 

$(document).ready(function(){

    $("#loading").hide();
    $("#enterotp").hide();

    $("#requestotpbtn").click(function(){
      if(email.val()=="") 
      {
        showError("Please enter your email"); 
      }
      else if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.val().trim()))) 
      {
        showError("Invalid email format");
        email.val(""); 
      }
      else
      {
        $("#requestotp").hide();
        $("#loading").show();

        sendApiReq(1);
      }

      $("#resendotplink").click(function(){

        $("#loading").show();
        $("#enterotp").hide();
        $("#requestotp").hide();

        code.val(""); 
        sendApiReq(1);
        attempts = 3;

       });

       $("#submitotpbtn").click(function(){

        if(code.val()=="") 
        {
          showError("Please enter code"); 
        }
        else if(!(/^\d{6}$/.test(code.val().trim()))) 
        {
          showError("Only digits are allowed!");
          code.val(""); 
        }
        else
        { 
          sendApiReq(2);
        }
        
      });

    });

  });






