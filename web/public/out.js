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
const env = {
  id : `dope`,
}


(async ({
  state,
  actions,
}) => {

  // do stuff here
  const link = actions.slctr(`.menu-link`)
  console.log(link)

})({

  // state
  state             : {
    name            : `waffles is ${ dope }`,
    state           : `illinois`,
  },
  
  // actions
  actions           : {
    slctr           : s => document.querySelector(`${ s }`),
    toggleBodyClass : c => document.body.classList.toggle(`${ c }`),
  },

})
}()}
  Pax.main = file_$2fUsers$2fwaffles$2f$2edotfiles$2fCode$2fWeb$2fwaffleiron$2fweb$2fwp$2dcontent$2fthemes$2fbelgium$2fsrc$2fscripts$2fmod$2ejs; Pax.makeRequire(null)()
  if (typeof module !== 'undefined') module.exports = Pax.main.module && Pax.main.module.exports
}(typeof global !== "undefined" ? global : typeof window !== "undefined" ? window : this)
//# sourceMappingURL=out.js.map
