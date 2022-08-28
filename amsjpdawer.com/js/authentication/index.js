
/* Validation for login */

function showError(message) //  for displaying error messages
{     
    $("#error-message").css("display","block"); 
    $("#message").text(message); 
    setTimeout(function(){$("#message").text("");$("#error-message").css("display", "none");},3000); //remove error message
}

$(document).ready(function(){
  
    $("#login").click(function(){

      let email = $("#username"); 
      let password = $("#password");

      if(email.val()=="") 
      {
        showError("Please enter your email address"); 
      }
      else if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.val()))) // check normal regex
      {
        showError("Invalid email format.");
        email.val(""); 
      }
      else if(password.val()=="")
      {
        showError("Please enter your password");
        password.val("");
      }
      else if(!(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,16}$/.test(password.val()))) //check regex pattern of password
      {
        showError("Invalid password format.");
        password.val("");
      }
      else
      {
      
        $.post("./api/validateuser.php",
        {
          _un: email.val(),
          _ps: password.val()
        },
        function(data,status){
          
            alert("Data: " + data + "\nStatus: " + status);

            result  = parseInt(data);
            console.log(typeof result);

            if(result === 0)
            {
                showError("User not exists.");
            }
            else if(result === -1)
            {
                showError("User credentials doesn't matches.");
            }
            else if(result === 1 )
            {          
                document.getElementById("userlogin").submit();
            }
            else
            {
              alert("Something went wrong !");
              window.location.reload();
            }
          });
       }
    });
  });


  /* modal for forgot password */

  /* --------------------------*/

