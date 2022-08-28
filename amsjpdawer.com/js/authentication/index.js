
/* Validation for login */

function showError(message) //  for displaying error messages
{     
    $("#error-message").css("display","block"); 
    $("#message").text(message); 
    setTimeout(function(){$("#message").text("");$("#error-message").css("display", "none");},2000); //remove error message
}

$(document).ready(function(){
  
    $("#login").click(function(){

      let username = $("#username"); 
      let password = $("#password");

      if(username.val()=="") 
      {
        showError("Please enter your username"); 
      }
      else if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(username.val()))) // check normal regex
      {
        showError("Invalid username format");
        username.val(""); 
      }
      else if(password.val()=="")
      {
        showError("Please enter your password");
        password.val("");
      }
      else if(!(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,16}$/.test(password.val()))) //check regex pattern of password
      {
        showError("Invalid password format");
        password.val("");
      }
      else
      {
      
        $.post("./api/validateuser.php",
        {
          _un: username.val(),
          _ps: password.val()
        },
        function(data,status)
        {
          
            if(status == "success")
            {
                response = parseInt(data);

                if(response=== 0)
                {
                    showError("User not exists");
                    username.val("");
                    password.val(""); 
                }
                else if(response=== -1)
                {
                    showError("Invalid credentials");
                    username.val(""); 
                    password.val("");
                }
                else if(response=== 1 )
                {          
                    document.getElementById("userlogin").submit();
                }
                else
                {
                  showError("Something went wrong!");
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
    });
  });


  /* modal for forgot password */

  /* --------------------------*/

