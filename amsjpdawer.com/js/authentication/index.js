
/* Validation for login */

function showError(message) //  for displaying error messages
{     
    $("#error-message").css("display","block"); 
    $("#message").text(message); 
    setTimeout(function(){$("#message").text("");$("#error-message").css("display", "none");},2000); //remove error message
}


$(document).ready(function(){
  
    $("#login").click(function(){

      const users = [1,2,3,4];
      let username = $("#username"); 
      let password = $("#password");
      let csrfToken = $("#csrfToken");
      let rememberMe = ($('#remember-me').prop('checked') == true)?1:0;


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
          _ps: password.val(),
          _ct: csrfToken.val(),
          _rm: rememberMe
        },
        function(data,status)
        {  
            if(status == "success")
            {
                response = parseInt(data);

                if(response === 0)
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
                else if (users.includes(response)===true)
                {    
                  function preventBack()
                  { 
                      window.history.forward(); 
                  }  
                  setTimeout("preventBack()", 0);  
                  window.onunload = function () { null };  
                  if(response===1)
                  {
                    window.location.replace("./student/dashboard.php");
                  }
                  else if(response===2)
                  {
                    window.location.replace("./faculty/dashboard.php")
                  }
                  else if(response===3)
                  {
                    window.location.replace("./management/dashboard.php");
                  }
                  else if(response===4)
                  {
                    window.location.replace("./admin/dashboard.php");
                  }
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



