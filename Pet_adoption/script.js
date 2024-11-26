const fullname = document.getElementById("name");
const email = document.getElementById("email");
const password = document.getElementById("password");
const repeatpassword = document.getElementById("repeat_password");

const submit = document.getElementById("submit");

// Clear previous error messages
function clearErrors() {
    document.getElementById("error_full_name").innerHTML = "";
    document.getElementById("error_email").innerHTML = "";
    document.getElementById("error_password").innerHTML = "";
    document.getElementById("error_repeat_password").innerHTML = "";
}

submit.addEventListener("click", (event) => {
    event.preventDefault();
    clearErrors();//clears previous error messages

    let isValid = true;

//validating first name 
if(fullname.value.trim() == ""){
    console.log("Please enter full name");
    // alert("Please enter first name");
    document.getElementById("error_full_name").innerHTML = "Please enter full name";
    isValid = false;
}

//validating email
if(email.value.trim() == ""){
    console.log("Please enter email");
    // alert("Please enter email");
    document.getElementById("error_email").innerHTML = "Please enter email";
    isValid = false;
}

//validating password
if(password.value.trim() == ""){
    console.log("Please enter password");
    // alert("Please enter password");
    document.getElementById("error_password").innerHTML = "Please enter password";
    isValid = false;
}

//validating repeat password    
if(repeatpassword.value.trim() == ""){
    console.log("Please enter repeat password");
    // alert("Please enter repeat password");
    document.getElementById("error_repeat_password").innerHTML = "Please re-enter password";
    isValid = false;
}else if (repeatpassword.value !== password.value) {
    console.log("Passwords do not match");
    document.getElementById("error_repeat_password").innerHTML = "Passwords do not match";
    isValid = false; // Set flag to false
}

if(isValid){
    alert("Form submitted successfully");
    // console.log("Form submitted successfully");
    window.location.href = "login.php";
}
});

//jquey validator