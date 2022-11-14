function displayData() {
    // document.getElementById('sdata').innerHTML = "<?php echo $sort; ?>";
}

function displayMail() {
    document.getElementById('mailblock').hidden = false;
    document.getElementById('fidblock').hidden = true;
}

function displayfId() {
    document.getElementById('fidblock').hidden = false;
    document.getElementById('mailblock').hidden = true;
}

// function searchMail() {
//     document.getElementById('maildata').innerHTML = "<?php echo $searchbymail; ?>";
// }

function searchfId() {
    // document.getElementById('fiddata').innerHTML = "";
}

function clearfield(){
    document.getElementById('email_input').textContent = "";
}
function clearfield2(){
    document.getElementById('feedback_input').textContent = "";
}