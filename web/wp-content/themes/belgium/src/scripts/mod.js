//
// mod.js
// declare 

(async ({
  $,
}) => {


  // code
  $('.primary-menu .sub-menu-enabled').hover(function(e) {
    // console.log(this)
    let t = e.target
    console.log('in', t)
    if (t.classList.contains('dropdown-menu')) {
      $(t).find('.sub-menu-enabled').addClass('sub-menu-style')
      return
    }
    $(t).addClass('sub-menu-style')
    // console.log(e.target)
  }, function(e) {
    // console.log(e.target)
    let t = e.target
    if ( t.classList.contains('sub-menu-enabled') && t.classList.contains('sub-menu-style') && !(t.classList.contains('dropdown-menu')) ) {
      $('.primary-menu').find('.sub-menu-enabled').removeClass('sub-menu-style')
    }
  })
  // slctr(`.primary-navigation`)
  //   .addEventListener(`mouseenter`, e => {
  //     if (e.target.classList.contains(`sub-menu-enabled`) || e.target.classList.contains(`dropdown-menu`)) {
  //       addBodyClass(`nav-open`);
  //     }
  //     if (e.target.classList.contains(`sub-menu-enabled`)) {
  //       target = e.target
  //       target.classList.add(`sub-menu-style`)
  //     }
  //   }, true)

  // slctr(`.primary-navigation`)
  //   .addEventListener(`mouseover`, () => {
  //     if (target.classList.contains(`sub-menu-style`) || target.classList.contains(`dropdown-menu`)) {
  //       target.classList.remove(`sub-menu-style`)
  //       removeBodyClass(`nav-open`)
  //     }
  //   }, false)

  // slctr(`.primary-navigation .sub-menu-enabled`)
  //   .addEventListener(`mouseover`, () => {
  //     toggleBodyClass(`nav-open`)
  //   }, true)
  // link.addEventListener(`mouseout`, () => actions.toggleBodyClass(`nav-open`))
  // dropdown.addEventListener(`mouseenter`, () => actions.toggleBodyClass(`nav-open`))
  // dropdown.addEventListener(`mouseout`, () => actions.toggleBodyClass(`nav-open`))

  // console.log(state.name)

})({

  // function defs
  $ : jQuery,
  slctr           : s => document.querySelector(`${ s }`),
  toggleBodyClass : c => document.body.classList.toggle(`${ c }`),
  addBodyClass : c => document.body.classList.add(`${ c }`),
  removeBodyClass : c => document.body.classList.remove(`${ c }`),

})
