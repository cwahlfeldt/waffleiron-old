//
// mod.js

const selectit = s => document.querySelector(`${s}`)

const areas             = selectit(`.primary-menu #menu-link-areas-of-practice .menu-guide`)
const areasLink         = selectit(`.primary-menu #menu-link-areas-of-practice a`)
const areasGuide        = selectit(`.primary-menu #menu-link-areas-of-practice a .menu-guide`)
const areasDropdown     = selectit(`.primary-menu #dropdown-areas-of-practice`)

const attorneys         = selectit(`.primary-menu #menu-link-our-attorneys`)
const attorneysLink     = selectit(`.primary-menu #menu-link-our-attorneys a`)
const attorneysGuide    = selectit(`.primary-menu #menu-our-attorneys .menu-guide`)
const attorneysDropdown = selectit(`.primary-menu #dropdown-our-attorneys`)

let elements = [
  `[id*=dropdown-]`,
  `[id*=menu-link-] > a .menu-guide`,
  `[id*=menu-link-] > a`,
  `[id*=menu-link-]`,
]

areas.addEventListener('mouseenter', addBodyClass, true)
areasLink.addEventListener('mouseenter', addBodyClass, true)
areasDropdown.addEventListener('mouseenter', addBodyClass, true)
areas.addEventListener('mouseout', removeBodyClass, true)
areasLink.addEventListener('mouseout', removeBodyClass, true)
areasDropdown.addEventListener('mouseout', removeBodyClass, true)

attorneys.addEventListener('mouseenter', addBodyClass, true)
attorneysLink.addEventListener('mouseenter', addBodyClass, true)
attorneysDropdown.addEventListener('mouseenter', addBodyClass, true)
attorneys.addEventListener('mouseout', removeBodyClass, true)
attorneysLink.addEventListener('mouseout', removeBodyClass, true)
attorneysDropdown.addEventListener('mouseout', removeBodyClass, true)

const bodyClass = 'nav-open'
function addBodyClass(e) {
  console.log(this)
  // console.log('in', e.target)
  document.body.classList.add(bodyClass)
}

function removeBodyClass(e) {
  console.log(this)
  // console.log('out', e.target)
  document.body.classList.remove(bodyClass)
}

setTimeout(() => {
  document.html.style.marginTop = 0
}, 300)
