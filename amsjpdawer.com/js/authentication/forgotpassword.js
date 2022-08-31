
/* Validation for forget password */


var email = $("#txtemail"); 
var csrfToken = $("#csrfToken");
var code = $("#password");
var response = "";

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

function startTimer() // timer for otp
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

function sendApiReq() // send api request for code  on email
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
              else if(typeof response==="number")
              {   
                
                  setTimeout("preventBack()", 0);  
                  window.onunload = function () { null };
                  
                  $("#loading").hide();
                  $("#requestotp").hide();
                  $("#enterotp").show();
                  
                  startTimer(); 

                  response = response.toString();
              }
              else
              {
                $("#loading").hide();
                $("#requestotp").show();
                showError("Something went wrong!");
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
        sendApiReq();

       }
       
       $("#resendotplink").click(function(){

        $("#loading").show();
        $("#enterotp").hide();
        $("#requestotp").hide();
        code.val(""); 
        
        sendApiReq();

       });

       $("#submitotpbtn").click(function(){
        
        console.log(response);

        if(code.val()=="") 
        {
          showError("Please enter code"); 
        }
        else if(response!==code.val()) // validate otp 
        {
          showError("Invalid code!");
          code.val(""); 
        }
        else
        {
          code.val(""); 
          //proceed further to reset
        }

      });
    });
  });



