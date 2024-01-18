var anm = function () {
  //if gsap exists
  if (typeof gsap !== "undefined") {
    //create scroll trigger instance

    gsap.config({
      nullTargetWarn: false,
    });
    gsap.registerPlugin(ScrollTrigger);

    //split text
    const title = document.querySelectorAll(".title");
    title.forEach((title) => {
      const splitTitle = new SplitText(title, { type: "words,chars" });
      gsap.set(title, { perspective: 400, opacity: 1 });
      gsap.from(splitTitle.words, {
        y: 80,
        duration: 1,
        opacity: 0,
        stagger: 0.04,
        delay: 0.3,
        ease: "circ.out",
        onComplete: () => {
          splitTitle.revert();
        },
        scrollTrigger: {
          trigger: title,
          start: "top bottom",
          end: "bottom top",
          toggleActions: "restart none none none",
        },
      });
      //revert the animation after it's done
    });

    gsap.to(".card--animation", { y: 30, opacity: 0 });
    ScrollTrigger.batch(".card--animation", {
      scrub: 1,
      start: "top 90%",
      onEnter: (batch) =>
        gsap.to(batch, {
          duration: 1.2,
          autoAlpha: 1.5,
          stagger: 0.1,
          ease: "power4.out",
          y: 0,
          opacity: 1,
        }),
    });

    const texts = document.querySelectorAll(".about__conetent__text");

    const hero = document.querySelectorAll(".hero__animation");
    hero.forEach((hero) => {
      ScrollTrigger.create({
        trigger: hero,
        start: "top 80%",
        toggleActions: "play none none none",
        onEnter: () => {
          //add class to the element
          hero.classList.add("hero__animated");
        },
      });
    });

    //Image masks
    let masks = document.querySelectorAll(".attorney__img__area");

    masks.forEach((mask) => {
      let image = mask.querySelector("img");

      let tl = gsap.timeline({
        ease: "power3.out",
        scrollTrigger: {
          start: "top 70%",
          trigger: mask,
          toggleActions: "play none none none",
        },
      });

      tl.set(image, { autoAlpha: 1 });

      tl.fromTo(
        image,
        {
          clipPath: "polygon(0 0, 0 0, 0 100%, 0% 100%)",
          webkitClipPath: "polygon(0 0, 0 0, 0 100%, 0% 100%)",
        },
        {
          clipPath: "polygon(0 0, 100% 0, 100% 100%, 0 100%)",
          webkitClipPath: "polygon(0 0, 100% 0, 100% 100%, 0 100%)",

          duration: 1,
          ease: "power3.out",
        }
      );
      tl.from(image, 4, {
        scale: 1.4,
        ease: "power3.out",
        delay: -1,
      });
    });
    let aboutImageArea = document.querySelectorAll(".about__img__area");

    aboutImageArea.forEach((mask) => {
      let image = mask.querySelector("img");

      let tl = gsap.timeline({
        ease: "power3.out",
        scrollTrigger: {
          start: "top 90%",
          trigger: mask,
          toggleActions: "play none none none",
        },
      });

      tl.set(image, { autoAlpha: 1 });

      tl.fromTo(
        image,
        {
          clipPath: "polygon(0 0,100% 0,100% 0,0 0)",
          webkitClipPath: "polygon(0 0,100% 0,100% 0,0 0",
        },
        {
          clipPath: "polygon(0 0,100% 0,100% 100%,0 100%)",
          webkitClipPath: "polygon(0 0,100% 0,100% 100%,0 100%)",

          duration: 1,
          ease: "power3.out",
        }
      );
      tl.from(image, 4, {
        scale: 1.4,
        ease: "power3.out",
        delay: -1,
      });
    });

    
  }
};

window.addEventListener("load", (event) => {
  anm();
});