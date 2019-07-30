(function($) {
  console.log('yo mom')
  $('.menu-link').hover(function() {
    console.log($(this).parent().parent().find('.dropdown-menu'))
  }, function() {
  
  })
})(jQuery)
