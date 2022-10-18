
/* START::PREVENT COPY PASTE */

document.getElementById("password1").addEventListener('paste', e => e.preventDefault());
document.getElementById("password2").addEventListener('paste', e => e.preventDefault());

/* END::PREVENT COPY PASTE */

/* START::CREDENTIALS CHECK */

function setCookie(cname, cvalue, exdays) {
  const d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  let expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

/* END::CREDENTIALS CHECK */

window.addEventListener("blur",function(){window.location.replace("./php/logout.php")}); // Exit on loosing focus of window

/* START:: TOGGLE PASSWORD*/

const togglePassword1 = document.querySelector("#togglePassword1");
const togglePassword2 = document.querySelector("#togglePassword2");
const passwordeye1 = document.querySelector("#password1");
const passwordeye2 = document.querySelector("#password2");

togglePassword1.addEventListener("click", function () {
    const type1 = passwordeye1.getAttribute("type") === "password" ? "text" : "password";
    passwordeye1.setAttribute("type", type1);
    this.classList.toggle("bi-eye");
});

togglePassword2.addEventListener("click", function () {
  const type2 = passwordeye2.getAttribute("type") === "password" ? "text" : "password";
  passwordeye2.setAttribute("type", type2);
  this.classList.toggle("bi-eye");
});

/* END::TOGGLE PASSWORD */

/* START::MODAL */

var span = document.getElementsByClassName("close")[0];
  span.onclick = function() { // close modal
    $("#modal").css("display","none");
    window.location.href = "./login.php";
  }
  
  window.onclick = function(event) {
    if (event.target == modal) {
      $("#modal").css("display","none"); // close modal anywhere click
      window.location.href = "./login.php";
    }
  }
  
  document.getElementById("yes-button").onclick = function() { // yes-> redirect
    window.location.href = "./login.php";
  }
  
/* END::MODAL */ 


/* START:: RESET PASSWORD VALIDATION */

var password1 = $("#password1"); 
var password2 = $("#password2");
var csrfToken= $("#csrfToken");

function showError(message)
{     
    $(".error-message").css("display","block"); 
    $(".message").text(message); 
    setTimeout(function(){$(".message").text("");$(".error-message").css("display", "none");},2000); //remove error message
}

function preventBack()
{ 
    window.history.forward(); 
}  

setTimeout("preventBack()", 0);  
window.onunload = function () { null };

function sendApiReq() 
{
        $.post("./api/updateuser.php",
        { 
          _ps: password2.val(),
          _ct: csrfToken.val()
        },
        function(data,status)
        {     
              if(status == "success")
              {    
                  $("#loading").hide();
                  $("#resetpassword").show();

                  response = parseInt(data);

                  if(response === 0)
                  {   
                      showError("Failed to update password");
                      password1.val("");
                      password2.val(""); 
                  }
                  else if(response === 1)
                  {    
                       setCookie("5f7573726e6d","",-1); // clear saved credentials
                       setCookie("5f70737764","",-1);
                       password1.val("");
                       password2.val("");
                       $("#modal").css("display","block");
                       setTimeout(function(){window.location.replace("./login.php");},3000);
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

/* END:: RESET PASSWORD VALIDATION */

$(document).ready(function(){
    
  $("#resetpassword").show();
  $("#loading").hide();

    $("#resetpasswordbtn").click(function(){
  
        if(password1.val()=="") 
        {
          showError("Please enter new password"); 
        }
        else if(password2.val()=="") 
        {
          showError("Please confirm password"); 
        }
        else if(!(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,16}$/.test(password1.val()))) 
        {
          showError("New password invalid format");
          password1.val(""); 
        }
        else if(!(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,16}$/.test(password2.val()))) 
        {
          showError("Confirm password invalid format");
          password2.val("");  
        }
        else if(password1.val()!==password2.val())
        {
          showError("Both password do not macthes!");
          password1.val("");  
          password2.val("");  
        }
        else
        {
          $("#loading").show();
          $("#resetpassword").hide();
          sendApiReq();
         }
    });
});