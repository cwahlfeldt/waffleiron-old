(function() {
  const dropdowns = document.querySelectorAll('.dropdown-menu')
  dropdowns.forEach(dropdown => {
    dropdown.onmouseenter = () => {
      this.style.visibility = "visible"
    }

    dropdown.onmouseleave = function(){
      this.style.visibility = "invisible"
    }; 
  })
})()
