import Swiper from "swiper";
import camelcaseKeys from "camelcase-keys";

export default {
  init() {
    $(".open-mobile-menu").click(e => {
      e.preventDefault();
      $(".open-mobile-menu").toggleClass("is-active");
      $(".mobile-menu").toggleClass("visible invisible");
      $(".mobile-menu").toggleClass("opacity-100 opacity-0");
    });
  },
  finalize() {
    const swipers = document.querySelectorAll(".swiper-carousel");
    for (let i = 0; i < swipers.length; i++) {
      const id = swipers[i].id;
      const data = camelcaseKeys($(swipers[i]).data()); // needs jquery
      new Swiper(`#${id}`, {
        ...data,
        navigation: {
          nextEl: `#${id} .swiper-button-next`,
          prevEl: `#${id} .swiper-button-prev`
        },
        pagination: {
          el: '.swiper-pagination',
          type: 'bullets',
        },
        breakpoints: {
          720: {
            slidesPerView: 1
          }
        }
      });
    }

    $(".modal-toggle").on("click", function() {
      $(document.body)
        .find(".modal")
        .toggleClass("invisible visible");
      $(document.body).toggleClass("modal-open");
    });

    $(".menu-item-has-children").click(function(e) {
      e.preventDefault();
    });
  }
};
