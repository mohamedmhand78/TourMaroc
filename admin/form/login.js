let submit = document.getElementById("submit");
if (sessionStorage.getItem("logged") == "true") {
  location.href = "../";
}

submit.addEventListener("click", function () {
  //input values
  let email = document.getElementById("email").value;
  let password = document.getElementById("password").value;
  let inputs = document.querySelectorAll(".inputs");

  //errors
  let emailerr = document.getElementById("emailerr");
  let passerr = document.getElementById("passerr");
  let errors = document.querySelectorAll(".error");
  let reserr = document.getElementById("reserr");

  let request = new XMLHttpRequest();
  request.open("POST", "login.php");
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  request.send("email=" + email + "&password=" + password);
  request.onload = () => {
    console.log(request.response);
    let response = JSON.parse(request.response);
    console.log(response);

    function clear() {
      errors.forEach((element) => {
        element.innerHTML = "";
        element.style.color = "red";
      });
    }

    if (response.error == "emailempty") {
      clear();
      emailerr.innerHTML = "please enter your username!";
    }

    if (response.error == "passempty") {
      clear();
      passerr.innerHTML = "please enter your password!";
    }

    if (response.error == "passwrong") {
      clear();
      passerr.innerHTML = "wrong password!";
    }

    if (response.error == "usernotexist") {
      clear();
      reserr.innerHTML = "user not found!";
    }

    if (response.error == "verified") {
      clear();
      reserr.style.color = "green";
      reserr.innerHTML = "you have logged in successfully!";
      sessionStorage.setItem("logged", "true");
      sessionStorage.setItem("id", response.id);
      sessionStorage.setItem("username", response.username);
      location.href = "./../";
      inputs.forEach((element) => {
        element.value = "";
      });
    }
  };
});
