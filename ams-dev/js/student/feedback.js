/* START::MODAL */

var modal = document.getElementById("modal");
var span = document.getElementsByClassName("close")[0]; //close modal

span.onclick = function () {
  //close modal
  modal.style.display = "none";
};
window.onclick = function (event) {
  //close modal anywhere click
  if (event.target == modal) {
    modal.style.display = "none";
    window.location.href = "./feedback.php";
  }
};

document.getElementById("yes-button").onclick = function () {
  // yes-> redirect
  window.location.href = "./feedback.php";
};

/* END::MODAL */

$(document).ready(function () {
    
          var csrfToken = $("#csrfToken");
          var fbTxt = $("#feedbacktxt");

          $("#submitfeedback").click(function () {

              $.post(
                "../api/submitfeedback.php",
                {
                  _fb: fbTxt.val(),
                  _rt: $(".forms-sample input[name='rating']:checked").val(),
                  _ct: csrfToken.val()
                },
                function (data, status) {
                
                  if(status == "success")
                  {
                    response = parseInt(data);
  
                    $("#modal").css("display","block");
                    $("#yes-button").text("Okay");
  
                    if(response === 0)
                    {
                      $("#modalmsg").text("Sorry,Feedback can't be submitted!");
                    }
                    else if (response === 1)
                    {
                      $("#modalmsg").text("Your feedback has been submitted successfully.");
                    }
                    else
                    {
                        $("#modalmsg").text(
                            "Try again later! Some unknown error occured."
                        );
                    }

                  }
                  else
                  { 
                    $("#modal").css("display", "block");
                    $("#modalmsg").text(
                      "Try again later! Some unknown error occured."
                    );
                    $("#yes-button").text("Okay");
                  }
        });

    });
});

     