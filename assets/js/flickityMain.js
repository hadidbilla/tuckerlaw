//after load dom
//Current Route
var allSlider = function () {
const currentLoc = window.location.pathname;
const locationPath = currentLoc.split("/");
let pageName = locationPath[locationPath.length - 2];
//Awards Slider
let isAchievement = pageName === "achievements";
let options = {
  cellAlign: "left",
  autoPlay: false,
  wrapAround: true,
  accessibility: false,
  contain: true,
  prevNextButtons: true,
  pageDots: false,
  adaptiveHeight: true
};
const awardsSlider = document.querySelector(".awards__slider");
if (awardsSlider) {
  let flkty = new Flickity(awardsSlider, options);
  flkty.resize();
}

const awardSliderFoot = document.querySelector(".awards__slider-footer");
if (awardSliderFoot) {
  let flktyFoot = new Flickity(awardSliderFoot, options);
  flktyFoot.resize();
}

const testimonialSlider = document.querySelector(".testimonial__slider");
if (testimonialSlider) {
  let flktyTest = new Flickity(testimonialSlider, options);
  flktyTest.resize();
}
};

window.addEventListener("load", (event) => {
  allSlider();
});