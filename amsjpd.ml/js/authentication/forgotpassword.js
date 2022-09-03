
/* Validation for forget password */

var email = $("#txtemail"); 
var csrfToken = $("#csrfToken");
var code = $("#password");

var attempts = 3;

function showError(message) //  for displaying error messages
{     
    $(".error-message").css("display","block"); 
    $(".message").text(message); 
    setTimeout(function(){$(".message").text("");$(".error-message").css("display", "none");},2000); //remove error message
}


function preventBack()
{ 
    window.history.forward(); 
}  

function startMainTimer() //!OTP entering time  Almost 3.30 minute
{

  var countDownDate1 = new Date().getTime()+350000; // Set the date we're counting down to 
  // Update the count down every 1 second
  var x1 = setInterval(function(){

  // Get today's date and time
  var now1 = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance1 = countDownDate1 - now1;
    
  // If the count down is over, write some text 
  if (distance1 < 0) {
    clearInterval(x1);
    window.location.replace("./index.php");
  }
}, 1000);

}

function startReqTimer() // timer for otp  //!OTP rerequesting time 1 minute 
{
  $("#resendotplink").css("pointer-events","none");
  var countDownDate = new Date().getTime()+61000; // Set the date we're counting down to
  // Update the count down every 1 second
  var x = setInterval(function(){

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  $("#resendotplink").text("You can rerequest code after "+seconds + " seconds");
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    $("#resendotplink").text("Rerequest Code?");
    $("#resendotplink").css("pointer-events","auto");
  }
}, 1000);

}

function sendApiReq(apiNum) // send api request for code  on email
{
    if(apiNum === 1)
    {

        $.post("./api/verifyuser.php",
        {
          _un: email.val(),
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
                      password.val(""); 
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
        $.post("./api/verifyuserotp.php",
        {
          _c: code.val(),
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
                        setTimeout( function(){window.location.replace("./index.php")},1000);
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



// MAIN CALL

$(document).ready(function(){

    $("#loading").hide();
    $("#enterotp").hide();

    $("#requestotpbtn").click(function(){
  
      if(email.val()=="") 
      {
        showError("Please enter your email"); 
      }
      else if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.val()))) // check normal regex
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
        else if(!(/^\d{6}$/.test(code.val()))) // validate code
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



