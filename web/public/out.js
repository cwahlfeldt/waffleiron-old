~function(global) {
  const Pax = {}
  Pax.baseRequire = typeof require !== "undefined" ? require : n => {
    throw new Error(`Could not resolve module name: ${n}`)
  }
  Pax.modules = {}
  Pax.files = {}
  Pax.mains = {}
  Pax.resolve = (base, then) => {
    base = base.split('/')
    base.shift()
    for (const p of then.split('/')) {
      if (p === '..') base.pop()
      else if (p !== '.') base.push(p)
    }
    return '/' + base.join('/')
  }
  Pax.Module = function Module(filename, parent) {
    this.filename = filename
    this.id = filename
    this.loaded = false
    this.parent = parent
    this.children = []
    this.exports = {}
  }
  Pax.makeRequire = self => {
    const require = m => require._module(m).exports
    require._deps = {}
    require.main = self

    require._esModule = m => {
      const mod = require._module(m)
      return mod.exports.__esModule ? mod.exports : {
        get default() {return mod.exports},
      }
    }
    require._module = m => {
      let fn = self ? require._deps[m] : Pax.main
      if (fn == null) {
        const module = {exports: Pax.baseRequire(m)}
        require._deps[m] = {module: module}
        return module
      }
      if (fn.module) return fn.module
      const module = new Pax.Module(fn.filename, self)
      fn.module = module
      module.require = Pax.makeRequire(module)
      module.require._deps = fn.deps
      module.require.main = self ? self.require.main : module
      if (self) self.children.push(module)
      fn(module, module.exports, module.require, fn.filename, fn.filename.split('/').slice(0, -1).join('/'), {url: 'file://' + (fn.filename.charAt(0) === '/' ? '' : '/') + fn.filename})
      module.loaded = true
      return module
    }
    return require
  }

  Pax.files["/Users/waffles/.dotfiles/Code/Web/waffleiron/web/wp-content/themes/belgium/src/scripts/mod.js"] = file_$2fUsers$2fwaffles$2f$2edotfiles$2fCode$2fWeb$2fwaffleiron$2fweb$2fwp$2dcontent$2fthemes$2fbelgium$2fsrc$2fscripts$2fmod$2ejs; file_$2fUsers$2fwaffles$2f$2edotfiles$2fCode$2fWeb$2fwaffleiron$2fweb$2fwp$2dcontent$2fthemes$2fbelgium$2fsrc$2fscripts$2fmod$2ejs.deps = {}; file_$2fUsers$2fwaffles$2f$2edotfiles$2fCode$2fWeb$2fwaffleiron$2fweb$2fwp$2dcontent$2fthemes$2fbelgium$2fsrc$2fscripts$2fmod$2ejs.filename = "/Users/waffles/.dotfiles/Code/Web/waffleiron/web/wp-content/themes/belgium/src/scripts/mod.js"; function file_$2fUsers$2fwaffles$2f$2edotfiles$2fCode$2fWeb$2fwaffleiron$2fweb$2fwp$2dcontent$2fthemes$2fbelgium$2fsrc$2fscripts$2fmod$2ejs(module, exports, require, __filename, __dirname, __import_meta) {
~function() {
//
// mod.js
// declare 

  (async ({
    $,
  }) => {
    $(document).ready(function() {

      let subMenu = false
      let dropdown = false

      // code
      $('.primary-menu .menu-link').mouseover(
        function() {
          subMenu = $(this).find('.sub-menu-enabled')
          dropdown = subMenu.parent().next('.dropdown-menu')

          subMenu.toggleClass('sub-menu-style')
          dropdown.slideDown('fast')

          // console.log(`mouseover: `, subMenu)
          // console.log(`mouseover: `, dropdown)
        }
      )

      $('.dropdown-menu').hover(
        function() {
          // let subMenu = $(this).prev().find('.sub-menu-enabled')
          // let dropdown = $(this)

          dropdown.css({display: 'flex !important'})
          dropdown.toggleClass('vis')
          subMenu.addClass('sub-menu-style')

          // console.log(`dropdown - mouseover: `, subMenu)
          // console.log(`dropdown - mouseover: `, dropdown)
        },
        function() {
          // let subMenu = $(this).prev().find('.sub-menu-enabled')
          // let dropdown = $(this)

          // dropdown.css('vis')
          dropdown.css({display: ''})
          subMenu.removeClass('sub-menu-style')
          dropdown.toggleClass('vis')
          // dropdown.slideUp('fast')

          // console.log(`dropdown - mouseout: `, subMenu , '\n')
          // console.log(`dropdown - mouseout: `, dropdown , '\n')
        }
      )

      $('.primary-menu .menu-link').mouseout(
        function() {
          // let subMenu = $(this).find('.sub-menu-enabled')
          // let dropdown = subMenu.parent().next('.dropdown-menu')

          subMenu.removeClass('sub-menu-style')

          // console.log(`mouseout: `, subMenu , '\n')
          // console.log(`mouseout: `, dropdown , '\n')

          if ( !(dropdown.hasClass('vis')) ) {
            dropdown.slideUp('fast')
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
}()}
  Pax.main = file_$2fUsers$2fwaffles$2f$2edotfiles$2fCode$2fWeb$2fwaffleiron$2fweb$2fwp$2dcontent$2fthemes$2fbelgium$2fsrc$2fscripts$2fmod$2ejs; Pax.makeRequire(null)()
  if (typeof module !== 'undefined') module.exports = Pax.main.module && Pax.main.module.exports
}(typeof global !== "undefined" ? global : typeof window !== "undefined" ? window : this)
//# sourceMappingURL=out.js.map
