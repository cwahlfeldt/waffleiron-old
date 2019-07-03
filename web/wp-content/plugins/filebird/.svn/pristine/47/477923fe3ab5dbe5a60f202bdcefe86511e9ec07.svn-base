(function ($) {
  'use strict';
  $(document).ready(function () {
    if ($('body.wp-admin.upload-php').length > 0) {
      FileBird_Media.init();
      FileBird_Media.jstree.init();
      $('#njt-filebird-folderTree').mCustomScrollbar({
        autoHideScrollbar: true,
        setHeight: $(window).height() - 300,
      });
    }
  });

  $(window).bind("load", function () {
    if ($('body.wp-admin.upload-php').length > 0) {
      FileBird_Media.toolbar.init();
    }
  });
})(jQuery);