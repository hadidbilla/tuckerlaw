//location section animation
let locationClose = document.querySelectorAll(".location__close");
let hiddenShow = document.querySelector(".location__hidden");
let locationSec = document.querySelector(".location__sec");

locationClose.forEach((item) => {
  item.addEventListener("mouseover", () => {
    hiddenShow.classList.remove("location__hidden--show");
    locationSec.classList.remove("location__sec--show");
  });
});


// single service accordion

const accordionItemHeaders = document.querySelectorAll(
  ".single-serve__service"
);
accordionItemHeaders.forEach((accordionItemHeader) => {
  accordionItemHeader.addEventListener("click", (event) => {
    const currentlyActiveAccordionItemHeader = document.querySelector(
      ".single-serve__service.active"
    );
    if (
      currentlyActiveAccordionItemHeader &&
      currentlyActiveAccordionItemHeader !== accordionItemHeader
    ) {
      currentlyActiveAccordionItemHeader.classList.toggle("active");
      currentlyActiveAccordionItemHeader.nextElementSibling.style.maxHeight = 0;
    }

    accordionItemHeader.classList.toggle("active");
    const accordionItemBody = accordionItemHeader.nextElementSibling;
    if (accordionItemHeader.classList.contains("active")) {
      accordionItemBody.style.maxHeight = accordionItemBody.scrollHeight + "px";
    } else {
      accordionItemBody.style.maxHeight = 0;
    }
  });
});

//counter
const numberCounter = document.querySelector(".counter");
if (numberCounter) {
  const options = {
    root: null,
    rootMargin: "-150px",
    threshold: 0,
  };

  let projects = document.getElementById("count1");
  if (projects) {
    projects = parseInt(projects.innerHTML);
  }

  let investment = document.getElementById("count2");
  if (investment) {
    investment = parseInt(investment.innerHTML);
  }

  let totalDownloads = document.getElementById("count3");
  if (totalDownloads) {
    totalDownloads = parseInt(totalDownloads.innerHTML);
  }

  const observer = new IntersectionObserver(function (entries, observer) {
    entries.forEach((entry) => {
      if (!entry.isIntersecting) {
        return;
      } else {
        function counter(id, start, end, duration) {
          let obj = document.getElementById(id),
            current = start,
            range = end - start,
            increment = end > start ? 1 : -1,
            step = Math.abs(Math.floor(duration / range)),
            timer = setInterval(() => {
              current += increment;
              obj.textContent = current;
              if (current == end) {
                clearInterval(timer);
              }
            }, step);
        }
        counter("count1", 50, projects, 2000);
        counter("count2", 0, investment, 2000);
        counter("count3", 20, totalDownloads, 2000);

        observer.unobserve(entry.target);
      }
    });
  }, options);

  if (numberCounter) {
    observer.observe(numberCounter);
  }
}

/**
 * navigation mega menu active first child
 */

 const nav = document.querySelector(".nav__menu__item--grdChild");
 const staticMenu = document.querySelector(".nav__menu__static");
 const body = document.querySelector(".nav__rgt__top");
 const wapperDiv = document.querySelector(".nav__menu__child__wrp");

 if (nav) {
  const divToAddClass = nav?.childNodes[2]?.childNodes[1];
  const ancors = nav?.childNodes[1];
  const hoverDivToRemoveClass = nav?.childNodes[2]?.childNodes;
   // divToAddClass.classList.add("initial__active");
 
   ancors.addEventListener("mouseover", () => {
     divToAddClass.classList.add("initial__active");
     console.log("a")
   });
 
   hoverDivToRemoveClass?.forEach((elem) => {
     // console.log(elem);
     // skip the first element
     if (elem === hoverDivToRemoveClass[0]) {
       staticMenu.addEventListener("mouseover", () => {
         console.log("hovered");
         divToAddClass.classList.add("initial__active");
         });
   } else {
     elem.addEventListener("mouseover", () => {
       // console.log("fgh",divToAddClass);
       divToAddClass.classList.remove("initial__active");
       // console.log("fgh",divToAddClass.classList);
     });
   }
   });
   body.addEventListener("mouseover", () => {
    divToAddClass.classList.remove("initial__active");
  });
 }
 
 




//Bookmarks page
const rudr_favorite = (a) => {
  var b = window.location,
    c = document.title;
  try {
    // Internet Explorer
    window.external.AddFavorite(b, c);
  } catch (e) {
    try {
      // Mozilla
      window.sidebar.addPanel(c, b, "");
    } catch (e) {
      // Opera
      if (typeof opera == "object" || window.opera) {
        a.rel = "sidebar";
        a.title = c;
        a.url = b;
        return true;
      } else {
        // Unknown
        alert(
          "Add this page to your bookmarks by pressing " +
            (navigator.userAgent.toLowerCase().indexOf("mac") != -1
              ? "Cmd"
              : "Ctrl") +
            "+D on your keyboard."
        );
      }
    }
  }
  return false;
};




/*---- Work History Load More btn ----*/
const loadMore = document.getElementById('loadmore');
const hid = [...document.querySelectorAll('.achievement__card.hidden')];
// const loadingSpin = document.querySelector('.loading-spin');

if(loadMore) {
hid.splice(0, 6).forEach(
  elem => elem.classList.remove('hidden')
);




loadmore.addEventListener('click', function(e) {
  // loadingSpin.style.visibility = 'visible';
  loadMore.classList.add("button--loading");
  e.preventDefault();

  setTimeout(() => {
    // loadingSpin.style.visibility = 'hidden';
    loadMore.classList.remove("button--loading");
    hid.splice(0, 8).forEach(
      elem => elem.classList.remove('hidden')
    )



    if (hid.length == 0) {
      loadMore.classList.add('hidden');
    }
  }, 1000)

});
}
//help Card div height


var helpCard = document.querySelectorAll(".help__card__content");

// let helpCardContent = document.querySelector(".help__card__content__btm");
helpCard.forEach(element => {
  let helpCardContent = element.querySelector(".help__card__content__btm");
  let helpCardContentHeight = helpCardContent.offsetHeight;
  element.style.bottom = "-" + helpCardContentHeight + "px";
})


//section-bar responsive

var sectionBar = document.querySelector(".section-bar__wrap")
var sectionLinks = document.querySelectorAll(".section-bar__sec-link");
if(sectionBar) {
  var sectionBarHeight = sectionBar.offsetHeight;
  var sectionBarHeightOrigin = sectionBar.offsetHeight;
  
  function sectionBarResponsive() {
    sectionBarHeight = sectionBar.offsetHeight;
    if(sectionBarHeight > sectionBarHeightOrigin) {
      sectionBar.style.backgroundColor = "transparent";
      sectionBar.style.padding = "0";
      sectionLinks.forEach(link => {
        link.style.backgroundColor = "#0E3A68";
      })
    }
  }
  
  document.addEventListener("DOMContentLoaded", function (event) {
    sectionBarResponsive()
  
    window.addEventListener("resize", function (e) {
      sectionBarResponsive()
    });
  });
}



//sidebar-navigation

function showSidebar (sidebar) {
  var navBar = document.querySelector(".nav-res");
  var hamburger = document.querySelector(".nav__hambrg");
  var close = document.querySelector(".nav__close");
  navBar.classList.add("nav-res-active");
  hamburger.classList.add("nav__hambrg-inactive");
  close.classList.add("nav__close-active")

  if (navBar.classList.contains("nav-res-active")) {
    // body.style.overflowY = "hidden";
    document.body.style.overflow = 'hidden';
  }
  else {
    document.body.style.overflow = 'auto';
    // body.style.overflowY = "auto";
  }

}

function closeSidebar (sidebar) {
  var navBar = document.querySelector(".nav-res");
  var hamburger = document.querySelector(".nav__hambrg");
  var close = document.querySelector(".nav__close");
  navBar.classList.remove("nav-res-active");
  hamburger.classList.remove("nav__hambrg-inactive");
  close.classList.remove("nav__close-active")

  if (navBar.classList.contains("nav-res-active")) {
    // body.style.overflowY = "hidden";
    document.body.style.position = 'fixed';
  }
  else {
    document.body.style.overflowY = 'auto';
    body.style.overflowY = "auto";
  }

}


function navShowChild(e) {
  e.stopPropagation();
  let navIcon = document.querySelectorAll(".nav-res__childlink");
  let parentNavicon = document.querySelectorAll(".nav-res__link");
  let grandchildLink = document.querySelectorAll(".nav-res__grandchildlink-sec");
  let childLink = document.querySelectorAll(".nav-res__childlink-sec");
  let childShow = e.target?.childNodes[1];
  var ase =false;

  if (childShow.classList.contains("nav-res__childlink-sec-active")) {
      ase = true;
  }

  if(e.target?.childNodes[1]?.classList[0]=="nav-res__childlink-sec") {
  childLink.forEach((singleChild)=>{
  
    parentNavicon.forEach(icon => {
        if(icon.classList.contains("nav-res__icon-active")) {
          icon.classList.remove("nav-res__icon-active");
        }
      })
    if (singleChild.classList.contains("nav-res__childlink-sec-active")) {
      singleChild.classList.remove("nav-res__childlink-sec-active");
    }
  
  })

  grandchildLink.forEach((singleChild)=>{
    
    navIcon.forEach(icon => {
      if(icon.classList.contains("nav-res__icon-active")) {
        icon.classList.remove("nav-res__icon-active");
      }
    })
  if (singleChild.classList.contains("nav-res__childlink-sec-active")) {
    singleChild.classList.remove("nav-res__childlink-sec-active");
  }

})
  }

  if(e.target?.childNodes[1]?.classList[0]=="nav-res__grandchildlink-sec") {
    grandchildLink.forEach((singleChild)=>{
    
        navIcon.forEach(icon => {
          if(icon.classList.contains("nav-res__icon-active")) {
            icon.classList.remove("nav-res__icon-active");
          }
        })
      if (singleChild.classList.contains("nav-res__childlink-sec-active")) {
        singleChild.classList.remove("nav-res__childlink-sec-active");
      }
    
    })
    }

  if (ase) {
    childShow.classList.remove("nav-res__childlink-sec-active")
    e.target.classList.remove("nav-res__icon-active")
  }

  else {
    childShow.classList.add("nav-res__childlink-sec-active")
    if(e.target.classList.contains("nav-res__icon")) {
      e.target.classList.add("nav-res__icon-active")
    }
  }

  
}

function navShowGrandChild(e) {
console.log(e.target);
const item = e.target;
//item 2nd child 
const item2 = item.querySelector(".nav-res__grandgrandchildlink-sec");
item2.classList.toggle("nav-res__grandchildlink-active");
  
}


function dataDropDown(data){
  // get the data from the data attribute
  // console.log(data)
  let value = data.getAttribute("btn-year-data");
  const allBtn = document.querySelectorAll(".index__filter__icon");

  // get all the elements
  // find elements with the same data attribute year-data
  let allElements = document.querySelectorAll(`[year-data]`);
  //clear class active
  //if data not contain active class 
  if (!data.classList.contains("index__icon__rotate")) {
    allElements.forEach((element)=>{
      element.classList.remove("index__show__child");
    })
  
    allBtn.forEach((btn)=>{
      btn.classList.remove("index__icon__rotate");
    })
  }
  


  // console.log(allElements);
  let elements = document.querySelectorAll(`[year-data="${value}"]`);

  //elements add class active
  elements.forEach(element => {
    //add class active to the clicked element
    //element toggle class active
    element.classList.toggle("index__show__child");

    data.classList.toggle("index__icon__rotate");
  }
  )
}


//have admin bar
const adminBar = document.getElementById("wpadminbar");
if (adminBar) {
  const nav = document.querySelector(".nav");
  //add clss nav__adminbar
  nav.classList.add("nav__adminbar");
}

// seemore 

const seemoreid = document.getElementById("seemore");
// console.log(seemoreid);
const hideid = document.querySelectorAll(".active__tag-hide");

if (seemoreid) {
  seemoreid.addEventListener("click", (e)=>{
    console.log("clicked",hideid);
    for (const element of hideid) {
      element.classList.remove("active__tag-hide");
      seemoreid.classList.add("active__tag");
    }
    //seemoreid add display none
    seemoreid.style.display = "none";
  })
}

document.addEventListener("DOMContentLoaded", function() {
    // Find the submit button
    var submitButton = document.getElementById('sub-form-submit');
    if (submitButton) {
        // Add custom attributes to the submit button
        submitButton.setAttribute("data-acsb-clickable", "true");
        submitButton.setAttribute("data-acsb-navigable", "true");
        submitButton.setAttribute("data-acsb-now-navigable", "true");
        submitButton.setAttribute("role", "button");
        submitButton.setAttribute("aria-label", "submit");
    }
    
    var emailButton = document.getElementById('sub-form-email');

    if (emailButton) {
        // Add custom attributes to the email button
        emailButton.setAttribute("aria-invalid", "true");
        emailButton.setAttribute("aria-required", "true");
        emailButton.setAttribute("data-acsb-navigable", "true");
        emailButton.setAttribute("data-acsb-now-navigable", "true");
        emailButton.setAttribute("data-acsb-validation-uuid", "ad3js8gnu0ph");
        emailButton.setAttribute("data-acsb-validation-hidden", "false");
        emailButton.setAttribute("aria-hidden", "false");
        emailButton.setAttribute("data-acsb-field-visible", "true");
        emailButton.setAttribute("role", "button");
        emailButton.setAttribute("aria-label", "Enter your email address");
        emailButton.setAttribute("data-acsb-tooltip", "Enter your email address | Required field");
    }

    var divElement = document.querySelector('.acsb-trigger.acsb-widget');
    if (divElement) {
      // Add the desired attributes and values
      divElement.setAttribute('role', 'button');
      divElement.setAttribute('data-acsb-clickable', 'true');
      divElement.setAttribute('data-acsb-navigable', 'true');
      divElement.setAttribute('data-acsb-now-navigable', 'false');
      divElement.setAttribute('aria-hidden', 'true');
      divElement.setAttribute('data-acsb-hidden', 'true');
    }

    var navRes = document.querySelector('.nav-res');
    if(navRes){
        navRes.setAttribute('aria-hidden', 'true');
        navRes.setAttribute('data-acsb-hidden', 'true');
    }
    var flickityIcons = document.querySelectorAll('.flickity-button-icon');

    if(flickityIcons){
      flickityIcons.forEach(function(flickityItem) {
        flickityItem.setAttribute('data-acsb-force-hidden', 'true');
        flickityItem.setAttribute('aria-hidden', 'true');
      });
    }

    var elements = document.querySelectorAll('access-widget-ui');
      // Check if the element exists
      if (elements) {

      // Loop through each element and add the data-acsb attribute
      elements.forEach(function(element) {
        element.setAttribute('data-acsb', 'skipLinks');
      });
      }

      // Create a new iframe element
var iframeElement = document.createElement('iframe');

// Set the attributes for the iframe
iframeElement.setAttribute('owner', 'archetype');
iframeElement.setAttribute('title', 'archetype');
iframeElement.style.display = 'none';
iframeElement.style.visibility = 'hidden';
iframeElement.setAttribute('srcdoc', '<html lang="en"></html>');

// Append the iframe to the desired location in the DOM
// For example, you can append it to the body element
document.body.appendChild(iframeElement);

let subcScreenResponse = document.querySelector(".wpcf7 .screen-reader-response")
if(subcScreenResponse){
  subcScreenResponse.setAttribute('data-acsb-overflower','true')
  subcScreenResponse.setAttribute('aria-hidden','true')
  subcScreenResponse.setAttribute('dataacsb-hidden','true')
}

let sucFormInit = document.getElementById("wpcf7-f22121-o1").children[1]
if(sucFormInit.children[0]){
  sucFormInit?.children[0]?.setAttribute('aria-hidden','true')
  sucFormInit?.children[0]?.setAttribute('data-acsb-hidden','true')
}

let subcBtnArea = document.querySelector(".subc__submit__btn__area").children[2]
if(subcBtnArea){
  subcBtnArea?.setAttribute('aria-hidden','true')
  subcBtnArea?.setAttribute('data-acsb-hidden','true')
  subcBtnArea?.setAttribute('data-acsb-forcehidden','true')
}
let responseOutput = document.querySelector(" .wpcf7-response-output")
if(responseOutput){
responseOutput?.setAttribute('aria-hidden','true')
  responseOutput?.setAttribute('data-acsb-hidden','true')
}
});