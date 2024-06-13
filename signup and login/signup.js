let submit = document.getElementById("submit");

submit.addEventListener("click", function () {
  //input values
  let fullname = document.getElementById("fullname").value;
  let username = document.getElementById("username").value;
  let email = document.getElementById("email").value;
  let password = document.getElementById("password").value;
  let cpassword = document.getElementById("cpassword").value;
  let inputs = document.querySelectorAll(".inputs");

  //errors
  let namerr = document.getElementById("namerr");
  let usererr = document.getElementById("usererr");
  let emailerr = document.getElementById("emailerr");
  let passerr = document.getElementById("passerr");
  let cpasserr = document.getElementById("cpasserr");
  let reserr = document.getElementById("reserr");
  let errors = document.querySelectorAll(".error");

  let request = new XMLHttpRequest();
  request.open("POST", "signup.php");
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  request.send(
    "username=" +
    username +
    "&fullname=" +
    fullname +
    "&email=" +
    email +
    "&password=" +
    password +
    "&cpassword=" +
    cpassword
  );
  request.onload = () => {
    let response = request.response;
    console.log(response);

    function clear() {
      errors.forEach((element) => {
        element.innerHTML = "";
        element.style.color = "red";
      });
    }

    if (response == "namempty") {
      clear();
      namerr.innerHTML = "fullname is required!";
    }
    if (response == "userempty") {
      clear();
      usererr.innerHTML = "username is required!";
    }
    if (response == "emailempty") {
      clear();
      emailerr.innerHTML = "email is required!";
    }
    if (response == "passhort") {
      clear();
      passerr.innerHTML = "password must be at least 8 characters long!";
    }
    if (response == "notmatch") {
      clear();
      cpasserr.innerHTML = "passwords do not match!";
    }
    if (response == "userexist") {
      clear();
      reserr.innerHTML = "username or email already in use!";
    }
    if (response == "verified") {
      clear();
      reserr.style.color = "green";
      reserr.innerHTML = "account has been created successfully!";
      inputs.forEach((element) => {
        element.value = "";
      });
      location.href = "login.html";
    }
  };
});