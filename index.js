let next = document.querySelector(".next");
let prev = document.querySelector(".prev");
let menu = document.getElementById("burger-menu");
let logmenu = document.getElementById("logmenu");
let icon = document.getElementById("fa-chevron-down");
let signup = document.getElementById("signup");
let login = document.getElementById("login");
let logout = document.getElementById("logout");
let navbar = document.getElementById("navbar");
let username = document.getElementById("username");
let user_name = sessionStorage.getItem("username");

if (sessionStorage.getItem("logged") == "true") {
  signup.style.display = "none";
  login.style.display = "none";
} else {
  logout.style.display = "none";
}

logout.addEventListener("click", function () {
  sessionStorage.clear();
  window.location.reload();
});

username.innerHTML = user_name;

menu.addEventListener("click", function () {
  navbar.classList.toggle("active");
});

icon.addEventListener("click", function () {
  console.log(logmenu.classList);
  logmenu.classList.toggle("active");
});

// next.addEventListener('click', function () {
//   let items = document.querySelectorAll('.item')
//   document.querySelector('.slide').appendChild(items[0])
// })

// prev.addEventListener('click', function () {
//   let items = document.querySelectorAll('.item')
//   document.querySelector('.slide').prepend(items[items.length - 1]) // here the length of items = 6
// })

function scrollToSection(sectionId) {
  const section = document.getElementById(sectionId);
  if (section) {
    section.scrollIntoView({ behavior: "smooth" });
  }
}

getTours();

async function getTours() {
  const req = await fetch("./php/selecteTour.php");
  const res = await req.json();

  const cards = document.getElementById("cards");
  const sliderCards = document.getElementById("cards-slider-asass");
  cards.innerHTML = "";
  sliderCards.innerHTML = "";

  res.forEach((el) => {
    cards.innerHTML += `<div class="card" >
                <div class="img">
                  <img  src= ${el.images} />
                </div>
                <div class="local">
                    <p><i class="fa-solid fa-location-dot"></i>${el.localisation}</p>
                </div>
                <div class="descr">
                    <p>${el.description}</p>
                </div>
                <div class="price">
                    <p> Price<span>${el.price}</span> DH</p>
                </div>
                <div class="debut price">
                    <p> start-date <br><span>${el.depart}</span></p>
                    <p> end-date <br> <span>${el.arrivage}</span></p>
                </div>
                
                <div class="cardbtn">
                    <button data-tourId="${el.tours_id}" class="bookingBtn">Book</button>
                </div>
            </div>`;
    sliderCards.innerHTML =
      `<div class="card swiper-slide">
        <div class="image-content">
            <span class="overlay"></span>
            <div class="card-image">
                <img src="${el.images}" alt="" class="card-img">
            </div>
        </div>

        <div class="card-content">
            <h2 class="name"><i class="fa-solid fa-location-dot"></i>${el.localisation}</h2>
            <p class="description">${el.description}</p>
            <div class="price">
                <p>Price <span>${el.price}</span> DH</p>
            </div>
            <button data-tourId="${el.tours_id}" class="bookingBtn button">Booking</button>
        </div>
      </div>` + sliderCards.innerHTML;
  });
  BookingEevent();
}

function BookingEevent() {
  const btn = document.querySelectorAll(".bookingBtn");

  btn.forEach((el) => {
    el.addEventListener("click", (e) => {
      location.href = "./book/?tourId=" + e.target.getAttribute("data-tourId");
    });
  });
}
