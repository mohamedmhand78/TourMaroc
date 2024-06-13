let next = document.querySelector(".next");
let prev = document.querySelector(".prev");
let menu = document.getElementById("burger-menu");
let navbar = document.getElementById("navbar");
const slide = document.getElementById("slide");

let request = new XMLHttpRequest();
request.open("POST", "gallery.php");
request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
request.send();
request.onload = () => {
  console.log(slide);
  let response = JSON.parse(request.response);
  response.forEach((el) => {
    console.log(el);
    slide.innerHTML += `<div class="item" style="background-image: url(${el.images});">
                <div class="content">
                    <div class="name">${el.name}</div>
                    <div class="des">${el.description}</div>
                </div>
            </div>`;
  });
};

menu.addEventListener("click", function () {
  navbar.classList.toggle("active");
});

next.addEventListener("click", function () {
  let items = document.querySelectorAll(".item");
  document.querySelector(".slide").appendChild(items[0]);
});

prev.addEventListener("click", function () {
  let items = document.querySelectorAll(".item");
  document.querySelector(".slide").prepend(items[items.length - 1]); // here the length of items = 6
});

prev.addEventListener("click", function () {
  let items = document.querySelectorAll(".item");
  document.querySelector(".slide").prepend(items[items.length - 1]); // here the length of items = 6
});

function scrollToSection(sectionId) {
  const section = document.getElementById(sectionId);
  if (section) {
    section.scrollIntoView({ behavior: "smooth" });
  }
}
