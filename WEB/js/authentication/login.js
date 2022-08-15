
/* Validation for login */

$(document).ready(function(){
  
    function showError(message) //  for displaying error messages
    {     
        $("#error-message").css("display","block"); 
        $("#message").text(message); 
        setTimeout(function() {$("#message").text("");$("#error-message").css("display", "none");},3000); //remove error message
    }

    function userExists(email,password)
    {

      /* ajax code to validate user credentials */

    }

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
      else if(!(/^[a-zA-Z0-9._-]+@vnsgu.[a-zA-Z]{2,4}.[a-zA-Z]{2,4}$/.test(email.val()))) // check specified email regex
      {
        showError("Only institution email is allowed.");
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
            let result = userExists(email);

            result ="3"; // remove this 
            
            if(result === "-1")
            {
                showError("User not exist.");
            }
            else if(result=== "-2")
            {
                showError("User credentials unmatched.");
            }
            else
            {   
                document.getElementById('usertype').value = result;        
                document.getElementById("userlogin").submit();
            }
      }
    });
  });


  /* modal for forgot password */

