
/* Validation for forget password */

var password1 = $("#password1"); 
var password2 = $("#password2");
var csrfToken= $("#csrfToken");


/* START: prevent copy paste on password for security reasons */

document.getElementById("password1").addEventListener('paste', e => e.preventDefault());
document.getElementById("password2").addEventListener('paste', e => e.preventDefault());


/* END : prevent copy paste on password for security reasons */


window.addEventListener("blur",function(){window.location.replace("./logout.php")});

/* START:to hide and show password */

const togglePassword1 = document.querySelector("#togglePassword1");
const togglePassword2 = document.querySelector("#togglePassword2");

const passwordeye1 = document.querySelector("#password1");
const passwordeye2 = document.querySelector("#password2");

togglePassword1.addEventListener("click", function () {
    
  // toggle the type attribute
    const type1 = passwordeye1.getAttribute("type") === "password" ? "text" : "password";
    passwordeye1.setAttribute("type", type1);

    // toggle the icon
    this.classList.toggle("bi-eye");
});

togglePassword2.addEventListener("click", function () {
 
  // toggle the type attribute
  const type2 = passwordeye2.getAttribute("type") === "password" ? "text" : "password";
  passwordeye2.setAttribute("type", type2);
  
  // toggle the icon
  this.classList.toggle("bi-eye");
});

/* END: to hide and show password */


/* START:modal code */

var modal = $("#modal");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// click on <span> (x), close the modal
  span.onclick = function() {
    modal.css("display","none");
    window.location.href = "./index.php";
  }
  
  // click anywhere outside of the modal close modal
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.css("display","none");
      window.location.href = "./index.php";
    }
  }
  
  // Redirect when button with id "yes-button" is clicked
  
  document.getElementById("yes-button").onclick = function() {
    window.location.href = "./index.php";
  }
  
/* END: modal code */  

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

setTimeout("preventBack()", 0);  
window.onunload = function () { null };

function sendApiReq() // send api request for updating password
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
                       password1.val("");
                       password2.val("");
                       modal.css("display","block");
                       setTimeout(function(){window.location.replace("./index.php");},3000);
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

// MAIN CALL

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
        else if(!(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,16}$/.test(password1.val()))) // check normal password pattern
        {
          showError("New password invalid format");
          password1.val(""); 
        }
        else if(!(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,16}$/.test(password2.val()))) // check normal password pattern
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