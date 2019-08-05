//
// mod.js
// declare 

  (async ({
    $,
  }) => {
    $(document).ready(function() {

      let sentinal = false
    // code
      $('.primary-menu .menu-link').hover(
        function(e) {
          if ($(this).find('.sub-menu-enabled')) {
            $(this).find('.sub-menu-enabled').parent().next('.dropdown-menu').slideDown('fast')
          }
        },
        function(e) {
          // $(this).find('.sub-menu-enabled').parent().next('.dropdown-menu').slideUp('fast')
          dropdown = $(this).find('.sub-menu-enabled').parent().next('.dropdown-menu')
          dropdown.hover(
            function() {
              sentinal = true
              $(this).prev().find('.sub-menu-enabled').toggleClass('sub-menu-style')
              // $(this).slideDown('fast')
            },
            function() {
              sentinal = false
              $('.dropdown-menu').slideUp('fast')
              $(this).prev().find('.sub-menu-enabled').toggleClass('sub-menu-style')
            }
          )
          if (sentinal) {
            $('.sub-menu-enabled').toggleClass('sub-menu-style')
            $('.dropdown-menu').slideUp('fast')
          }
        }
      )



      // $('.primary-menu .dropdown-menu').hover(
      //   function(e) {
      //     // $(this).parent().addClass('sub-menu-style')
      //     $(this).parent().prev('.sub-menu-enabled').toggleClass('sub-menu-style')
      //   },
      //   function(e) {
      //     $(this).parent().prev('.sub-menu-enabled').toggleClass('sub-menu-style')
      //     $(this).slideToggle()
      //     // $(this).parent().next('.dropdown-menu').slideToggle('fast')
      //   }
      // )

      $('.primary-menu .sub-menu-enabled').hover(
        function() {},
        function() {}
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
