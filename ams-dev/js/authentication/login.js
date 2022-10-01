/* START::MODAL */

var modal = document.getElementById("modal");
var forgetPasswordBtn = document.getElementById("forgotpassword");

var span = document.getElementsByClassName("close")[0]; //close modal
forgetPasswordBtn.onclick = function() { // open modal
  modal.style.display = "block";
}
span.onclick = function() {  //close modal
  modal.style.display = "none";
}
window.onclick = function(event) {//close modal anywhere click
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

document.getElementById("yes-button").onclick = function() { // yes-> redirect
    window.location.href = "forgotpassword.php";
}

document.getElementById("no-button").onclick = function() { // no-> same page
  modal.style.display = "none";
}

/* END::MODAL */


/* START::TOGGLE PASSWORD */

const togglePassword = document.querySelector("#togglePassword");
const password_t = document.querySelector("#password");
togglePassword.addEventListener("click", function () {
    const type = password_t.getAttribute("type") === "password" ? "text" : "password";
    password_t.setAttribute("type", type);
    this.classList.toggle("bi-eye");
});

/* END:::TOGGLE PASSWORD */

/* START::CREDENTIALS CHECK */

function setCookie(cname, cvalue, exdays) {
  const d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  let expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(';');
  for(let i = 0; i <ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

var encryptCred = (str) => { return (CryptoJS.AES.encrypt(str,"ams.vnsguit.org")); }        
var decryptCred = (str) => { return ( CryptoJS.AES.decrypt(str, "ams.vnsguit.org").toString(CryptoJS.enc.Utf8) ); }        

/* END::CREDENTIALS CHECK */

/* START::LOGIN_VALIDATION */

function showError(message)
{     
    $("#error-message").css("display","block"); 
    $("#message").text(message); 
    setTimeout(function(){$("#message").text("");$("#error-message").css("display", "none");},2000); 
}


$(document).ready(function(){
    
   $("#username").val(decryptCred(getCookie("5f7573726e6d")));
   $("#password").val(decryptCred(getCookie("5f70737764")));

   $('#remember-me').prop('checked',true); // by default remember me checked

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
      else if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(username.val().trim()))) 
      {
        showError("Invalid username format");
        username.val(""); 
      }
      else if(password.val()=="")
      {
        showError("Please enter your password");
        password.val("");
      }
      else if(!(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,16}$/.test(password.val()))) 
      {
        showError("Invalid password format");
        password.val("");
      }
      else
      {
        $.post("./api/validateuser.php",
        {
          _un: username.val().toLowerCase().trim(),
          _ps: password.val(),
          _ct: csrfToken.val(),
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
                    password.val(""); 
                }
                else if(users.includes(response)===true)
                {    
                  if(rememberMe==1)
                  {
                  setCookie("5f7573726e6d",encryptCred(username.val().trim()),7); // 7 days 
                  setCookie("5f70737764",encryptCred(password.val()),7);
                  }
                  else
                  {
                    setCookie("5f7573726e6d","",-1);
                    setCookie("5f70737764","",-1);
                  }

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
    });
  });


/* END::LOGIN_VALIDATION */




