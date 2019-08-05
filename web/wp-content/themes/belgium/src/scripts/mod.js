//
// mod.js
// declare 

  (async ({
    $,
  }) => {
    $(document).ready(function() {
    // code
    $('.primary-menu .sub-menu-enabled').hover(
      function(e) {
        // console.log(this)
        let t = e.target
        console.log(this)
        if (t.classList.contains('dropdown-menu')) {
          $(t).find('.sub-menu-enabled').addClass('sub-menu-style')
        } else {
          $(t).addClass('sub-menu-style')
        }
      },
      function(e) {
        console.log(this)
        if ( !(e.target === this) && !(e.target.classList.contains('dropdown-menu')) ) {
          $('.primary-menu').find('.sub-menu-enabled').removeClass('sub-menu-style')
        }
      }
    )

      $('.carrousel').slick({
        dots: true,
        arrows: false,
      })

      $('.accordion-item').on('click', function() {
        $(this).find('.accordion-content').slideToggle('fast')
      })
    })

  })({
    // function defs
    $               : jQuery,
    // slctr           : s => document.querySelector(`${ s }`),
    // toggleBodyClass : c => document.body.classList.toggle(`${ c }`),
    // addBodyClass    : c => document.body.classList.add(`${ c }`),
    // removeBodyClass : c => document.body.classList.remove(`${ c }`),
  })
