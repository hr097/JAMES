/* START::MODAL */

var modal = document.getElementById("modal");
var forgetPasswordBtn = document.getElementById("forgotpassword");

var span = document.getElementsByClassName("close")[0]; //close modal

span.onclick = function () {
  //close modal
  modal.style.display = "none";
};
window.onclick = function (event) {
  //close modal anywhere click
  if (event.target == modal) {
    modal.style.display = "none";
    window.location.href = "../index.php";
  }
};

document.getElementById("yes-button").onclick = function () {
  // yes-> redirect
  window.location.href = "./profile.php";
};

/* END::MODAL */

/* START::CREDENTIALS CHECK */

function setCookie(cname, cvalue, exdays) {
  const d = new Date();
  d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
  let expires = "expires=" + d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

/* END::CREDENTIALS CHECK */

//Email-edit
$(document).ready(function () {
  $("#edit_icon").click(function () {
    $("#para_email").replaceWith(
      '<input type="text" maxlength="250" minlength="13" style="padding:8px 10px;border-radius:2px" name="newusername" id="email_edit" class="email_edit info-data" placeholder="Enter new email" >'
    );

    $("#email_edit").blur(function () {
      $("#email_edit").css("border", "1px solid rgb(91, 90, 90,0.2)");
    });

    $("#email_edit").on('input',function () {
      let updatebtn = '<button type="button" id="updateemail" style="padding-bottom:5px;margin:10px;margin-top:-30px;height:30px;" class="btn btn-primary float-right edit_btn">Update</button>';
      let cancelbtn = `<button type="button" onclick={window.location.reload();} id="cancelbtn" style="padding-bottom:5px;margin:10px;margin-top:-30px;height:30px;" class="btn btn-primary float-right edit_btn">Cancel</button>`
      let editicon = '<i class="ti-pencil email_edit_icon d-flex justify-content-end" style="position:relative;bottom:15px;" id="edit_icon"></i>';

      // if ($(this).val().trim() == "") {
      //   $(this).css("border", "none");
      // } else
      if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{1,3})+$/.test($(this).val().trim())
      ) {
        $(this).css("border", "2px solid green");
        $("#mode").html(updatebtn);

        $("#updateemail").click(function () {
          if ($("#email_edit").val() == "") {
            $("#email_edit").css("border", "2px solid red");
          } else {
            let newusername = $("#email_edit");
            let csrfToken = $("#csrfToken");

            $.post(
              "./updateusrname.php",
              {
                _nun: newusername.val().toLowerCase().trim(),
                _ct: csrfToken.val()
              },
              function (data, status) {
                if (status == "success") {
                  response = parseInt(data);

                  $("#modal").css("display", "block");

                  if (response === 0) {
                    $("#modalmsg").text("Your email couldn't be updated.");
                    $("#yes-button").text("Okay");
                  } else if (response === 1) {
                    setCookie("5f7573726e6d", "", -1); // clear saved credentials
                    setCookie("5f70737764", "", -1);
                    $("#modalmsg").text(
                      "Your email has been updated successfully."
                    );
                    $("#yes-button").text("Login");
                  } else if (response === -1) {
                    $("#modalmsg").text(
                      "Sorry, This email belongs to another user."
                    );
                    $("#yes-button").text("Okay");
                  } else {
                    $("#modalmsg").text(
                      "Try again later! Some unknown error occured."
                    );
                    $("#yes-button").text("Okay");
                  }
                } else {
                  $("#modalmsg").text(
                    "Try again later! Some unknown error occured."
                  );
                  $("#yes-button").text("Okay");
                }
              }
            );
          }
        });
      } else {
        $(this).css("border", "2px solid red");
        $("#mode").html(cancelbtn);
      }
    });
  });

  //Card flip
  var card = document.querySelector(".flip-card");
  card.addEventListener("click", function () {
    card.classList.toggle("is-flipped");
  });
});