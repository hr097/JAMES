
$(document).ready(function () {
    
/* START::QR CODE GENERATOR */

let qr_code_element = document.querySelector(".qr-code");
let btn = document.querySelector(".button");

var spid = $("#spid").val();

generate("https://ams.vnsguit.org");
  
btn.addEventListener("click", () => {
  let user_input = `https://ams.vnsguit.org/temp/qrtest.php?classroomid=
  ${$("#input_text").val()}
  &spid=${spid}
  `;
  if (user_input.value != "") {
    if (qr_code_element.childElementCount == 0) {
      generate(user_input);
    } else {
      qr_code_element.innerHTML = "";
      generate(user_input);
    }
  } else {
    console.log("not valid input");
    qr_code_element.style = "display: none";
  }
});


function generate(user_input) {

    qr_code_element.style = "";
  
    var qrcode = new QRCode(qr_code_element, {
      text: `${user_input}`,
      width: 200, //128
      height: 200,
      colorDark: "#000000",
      colorLight: "#ffffff",
      correctLevel: QRCode.CorrectLevel.H
  });

  }
  
 
  
  /* END::QR CODE GENERATOR */

});