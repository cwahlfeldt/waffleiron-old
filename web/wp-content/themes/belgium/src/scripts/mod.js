//
// mod.js
// declare 

(async ({
  $,
}) => {
  $(document).ready(function() {

    let $subMenu = false
    let $dropdown = false

    $(document).hover(
      ({ target }) => {
          if ($(target).is('.sub-menu-enabled')) {
            console.log( $(target).parent().next() )

            $dropdown = $(target).parent().next()
            $subMenu = $(target)

            $subMenu.addClass('sub-menu-style')
            $dropdown.slideDown('fast')
          }
      },
      ({ target }) => {
        // console.log($subMenu)
        // console.log($dropdown)
        if ($subMenu || $dropdown) {
          if (!($(target).is('.dropdown-menu *')) && !($(target).is('.dropdown-menu')) && !($(target).is('.sub-menu-enabled'))) {
            $('.sub-menu-enabled').removeClass('sub-menu-style')
            $('.dropdown-menu').slideUp('fast')
          }

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
