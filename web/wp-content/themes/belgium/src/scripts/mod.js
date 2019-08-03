//
// mod.js

// wrap it cause im lazy
const selectit = s => document.querySelector(`${s}`)

const 

const bodyClass = 'nav-open'
function addBodyClass() {
  console.log(this)
  // console.log('in', e.target)
  document.body.classList.add(bodyClass)
}

function removeBodyClass() {
  console.log(this)
  // console.log('out', e.target)
  document.body.classList.remove(bodyClass)
}

setTimeout(() => {
  document.html.style.marginTop = '0 !important'
}, 300)
