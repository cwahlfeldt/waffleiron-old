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
