let user_id = sessionStorage.getItem("id");

console.log(user_id);

if (user_id === null) {
  location.href = "../signup and login/login.html";
}

let submit = document.getElementById("submit");

const tourId = location.search.split("=");

submit.addEventListener("click", function () {
  //input values
  let phone_number = document.getElementById("phone_number").value;

  if (phone_number !== "") {
    let request = new XMLHttpRequest();
    request.open("POST", "./../php/book.php");
    request.setRequestHeader(
      "Content-type",
      "application/x-www-form-urlencoded"
    );
    request.send(
      "phone_number=" +
        phone_number +
        "&tour_id=" +
        tourId[1] +
        "&user_id=" +
        user_id
    );
    request.onload = () => {
      let response = JSON.parse(request.response);
      console.log(response);
    };
    document.getElementById("err").innerHTML = "You Are Booking Successfully";
    document.getElementById("err").style.color = "green";
  } else {
    document.getElementById("err").innerHTML = "please Enter phone number";
    document.getElementById("err").style.color = "red";
  }
});
