(function ($) {
  "use strict";
  var ev = new $.Event('remove'),
    orig = $.fn.remove;
  $.fn.remove = function () {
    $(this).trigger(ev);
    return orig.apply(this, arguments);
  }

  function init_file_bird_media_popup() {
    FileBird_Popup.init();
  }

  jQuery(document).ready(function () {
    if (!$('body.wp-admin.upload-php').length && wp.media) {
      wp.media.view.Modal.prototype.on("close", function (event) {
        $("#filebird_sidebar").appendTo("body");
        $("#filebird_sidebar").hide();
      });

      wp.media.view.Modal.prototype.on("open", function (event) {
        $('.fb-treeview-loading').show();
        init_file_bird_media_popup();
      });
    }
  });
})(jQuery);
