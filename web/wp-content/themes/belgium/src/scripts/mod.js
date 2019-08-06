//
// mod.js
// declare 

  (async ({
    $,
  }) => {
    $(document).ready(function() {

      let $subMenu = false
      let $dropdown = false

      $(window).hover(
        ({ target }) => {
            if ($(target).is('.sub-menu-enabled')) {
              console.log( $(target).parent().next() )

              $dropdown = $(target).parent().next()
              $subMenu = $(target)

              $subMenu.addClass('sub-menu-style')
              $dropdown.slideDown('fast')
              return
            }
          return
        },
        ({ target }) => {
          console.log($subMenu)
          console.log($dropdown)
          if ($subMenu || $dropdown) {
            if (!($(target).is('.dropdown-menu *')) && !($(target).is('.dropdown-menu')) && !($(target).is('.sub-menu-enabled'))) {
              $('.sub-menu-enabled').removeClass('sub-menu-style')
              $('.dropdown-menu').slideUp('fast')
              return
            }

          return
          }
        }
      )

//       // code
//       $('.primary-menu .menu-link').mouseover(
//         function() {
//           subMenu = $(this).find('.sub-menu-enabled')
//           dropdown = subMenu.parent().next('.dropdown-menu')

//           subMenu.toggleClass('sub-menu-style')
//           dropdown.slideDown('fast')

//           // console.log(`mouseover: `, subMenu)
//           // console.log(`mouseover: `, dropdown)
//         }
//       )

//       $('.dropdown-menu').hover(
//         function() {
//           // let subMenu = $(this).prev().find('.sub-menu-enabled')
//           // let dropdown = $(this)

//           dropdown.css({display: 'flex !important'})
//           dropdown.toggleClass('vis')
//           subMenu.addClass('sub-menu-style')

//           // console.log(`dropdown - mouseover: `, subMenu)
//           // console.log(`dropdown - mouseover: `, dropdown)
//         },
//         function() {
//           // let subMenu = $(this).prev().find('.sub-menu-enabled')
//           // let dropdown = $(this)

//           // dropdown.css('vis')
//           dropdown.css({display: ''})
//           subMenu.removeClass('sub-menu-style')
//           dropdown.toggleClass('vis')
//           // dropdown.slideUp('fast')

//           // console.log(`dropdown - mouseout: `, subMenu , '\n')
//           // console.log(`dropdown - mouseout: `, dropdown , '\n')
//         }
//       )

//       $('.primary-menu .menu-link').mouseout(
//         function() {
//           // let subMenu = $(this).find('.sub-menu-enabled')
//           // let dropdown = subMenu.parent().next('.dropdown-menu')

//           subMenu.removeClass('sub-menu-style')

//           // console.log(`mouseout: `, subMenu , '\n')
//           // console.log(`mouseout: `, dropdown , '\n')

//           if ( !(dropdown.hasClass('vis')) ) {
//             dropdown.slideUp('fast')
//           }
//         }
//       )

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


      // $('.primary-menu .menu-link').mouseout(
      //   function() {
      //     let subMenu = $(this).find('.sub-menu-enabled')
      //     let dropdown = $(this).find('.sub-menu-enabled').parent().next('.dropdown-menu')
      //     if ($(this).find('.sub-menu-enabled')) {
      //       dropdown.slideDown('fast')
      //     }
      //   }
      // )

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

      // $('.primary-menu .sub-menu-enabled').hover(
      //   function() {},
      //   function() {}
      // )
