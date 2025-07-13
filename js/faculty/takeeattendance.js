

/* START::MODAL 1*/

var modal = document.getElementById("modal");
var span = document.getElementsByClassName("close")[0]; //close modal
var submit_flag = false;

span.onclick = function () {
  //close modal
  modal.style.display = "none";
};
window.onclick = function (event) {
  //close modal anywhere click
  if (event.target == modal) {
    modal.style.display = "none";
  }
};

document.getElementById("yes-button").onclick = function () {
  // yes-> redirect to deletion api request

  if (submit_flag==true) {
    let i = 0;
    const stud_len = $(".studbtn").length;
    const students_list1 = [];
    const students_list2 = [];

    for (i = 0; i < stud_len; i++) {
      if ($($(".studbtn")[i]).attr("data")==1){
        students_list1.push($($(".studbtn")[i]).attr("id"));
      } else {
        students_list2.push($($(".studbtn")[i]).attr("id"));
      }
    }

    if (students_list1.length >= 1 || students_list2.length >= 1) {
      let csrfToken = $("#csrfToken").val();
      let classroomid = $("#classroomid").val();
      let fid = $("#fid").val();

      if (students_list1.length < 1) {
        students_list1.push(" ");
      }

      if (students_list2.length < 1) {
        students_list2.push(" ");
      }

      console.log(students_list1);
      console.log(students_list2);

      $.post(
        "api/submitattendance.php",
        {
          _prstudls: students_list1,
          _abstudls: students_list2,
          _fid: fid,
          _cid: classroomid,
          _ct: csrfToken
        },
        function (data, status) {
          if (status == "success") {
            if ((data == 11) | (data == 1)) {
              $("#modalmsg").text("Student attendance submitted successfully.");
             $("#modal").css("display", "flex");
              submit_flag = false;
            } else {
              $("#modalmsg").text(
                "Student attendance couldn't be submitted! Try again later."
              );
             $("#modal").css("display", "flex");
              submit_flag = false;
            }
          }
        }
      );
    }
  } else {
    window.location.href="takeeattendance.php";
  }

};

document.getElementById("no-button").onclick = function () {
  // no-> same page
  
    if(submit_flag==false) {
      window.location.href="takeeattendance.php";
    }
    else
    {
    modal.style.display = "none";
    }
};

/* END::MODAL 1 */


$(document).ready(function () {
    
    /* START::QR CODE GENERATOR */
    
    // let qr_code_element = document.querySelector(".qr-code");
    // let btn = document.querySelector(".button");
    
    // generate("https://ams.vnsguit.org");


    $("#classcode_selection").change(
      function() 
      {
        $classcode=$("#classcode_selection").val();
        window.location.href = `takeeattendance.php?classroomid=${$classcode}`;
      }
    )

    $(".studbtn").click(function(){
      if($(this).attr("data")==1)
      {
        let inc = parseInt($("#absent_msg").text());
        inc++;
        $(this).attr("data","0");
        $(this).css("background-color","red");
        $("#absent_msg").text(inc);

        inc = parseInt($("#present_msg").text());
        inc--;
        $("#present_msg").text(inc);

      }
      else
      {
        let inc = parseInt($("#present_msg").text());
        inc++;
        $(this).attr("data","1");
        $(this).css("background-color","green");
        $("#present_msg").text(inc);

        inc = parseInt($("#absent_msg").text());
        inc--;
        $("#absent_msg").text(inc);
      }
    });

    $("#submitAttendance").click(function(){
      submit_flag = true;
        $("#modalmsg").html(
          "Are you sure about this? Attendances cannot be reverted once submitted.<br><br>Do you confirm it?"
        );
      $("#modal").css("display", "flex");
    });
    

      // if($("#classcode_selection").val()!=0)
      // {
      //     // let user_input = `https://ams.vnsguit.org/api/eattendancefill.php?classroomid=
          // ${$("#classcode_selection").val()}
          // `;
        
          // if (user_input.value != "") {
          //   if (qr_code_element.childElementCount == 0) {
          //     generate(user_input);
          //   } else {
          //     qr_code_element.innerHTML = "";
          //     generate(user_input);
          //   }
          // } else {
          //   console.log("not valid input");
          //   qr_code_element.style = "display: none";
          // }

         
    
    
    // function generate(user_input) {
    
    //     qr_code_element.style = "";
      
    //     var qrcode = new QRCode(qr_code_element, {
    //       text: `${user_input}`,
    //       width: 200, //128
    //       height: 200,
    //       colorDark: "#000000",
    //       colorLight: "#ffffff",
    //       correctLevel: QRCode.CorrectLevel.H
    //   });
    
    //   }
      
    
      /* END::QR CODE GENERATOR */
    
    });