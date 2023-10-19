var myIndex = 0;
carousel();
M_carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("Product_Slides");
  var dots = document.getElementsByClassName("Dots");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" dot_white", "");
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}
  x[myIndex-1].style.display = "block";
  dots[myIndex-1].className += " dot_white";
  setTimeout(carousel, 5000); // Change image every 5 seconds
}

function M_carousel() {
  var i;
  var x = document.getElementsByClassName("M_Product_Slides");
  var dots = document.getElementsByClassName("M_Dots");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" dot_white", "");
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}
  x[myIndex-1].style.display = "block";
  dots[myIndex-1].className += " dot_white";
  setTimeout(carousel, 5000); // Change image every 5 seconds
}

var slideIndex = 1;
showDivs(slideIndex);
M_showDivs(slideIndex);


function currentDiv(n) {
  showDivs(slideIndex = n);
  M_showDivs(slideIndex = n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("Product_Slides");
  var dots = document.getElementsByClassName("Dots");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" dot_white", "");
  }
  x[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " dot_white";
}

function M_showDivs(n) {
  var i;
  var x = document.getElementsByClassName("M_Product_Slides");
  var dots = document.getElementsByClassName("M_Dots");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" dot_white", "");
  }
  x[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " dot_white";
}
