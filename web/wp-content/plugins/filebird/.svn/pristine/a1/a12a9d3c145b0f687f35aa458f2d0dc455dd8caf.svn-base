(function ($) {
  'use strict';

  function FileBirdGridInit(wp) {
    var Attachment = wp.media.view.Attachment.Library;

    var text_drag = filebird_translate.move_1_file;

    $("body").append('<div id="njt-filebird-attachment" data-id="">' + text_drag + '</div>');
    wp.media.view.Attachment.Library = wp.media.view.Attachment.Library.extend({
      initialize: function () {
        Attachment.prototype.initialize.apply(this, arguments);
        this.on("ready", function () {
          ntWMC.dragFile($(this.el));
        });
      }
    });

    if ($('body.wp-admin.upload-php').length) {
      ntWMC.dropFile();
    }

    setTimeout(function () {
      var curr_folder = localStorage.getItem('current_folder') || 'all';
      $('#menu-item-' + curr_folder + ' .jstree-anchor').trigger('click');
    }, 1000);

    $('.menu-item-bar').bind({

      mouseenter: function () {
        var $this = $(this);
        var parentWidth = $this.find('.item-title').innerWidth();
        var childWidth = $this.find('.menu-item-title').innerWidth();
        var title = $this.find('.menu-item-title').text();
        //console.log(parentWidth, childWidth)
        if (parentWidth < (childWidth + 10)) {

          $this.tooltip({
            title: title,
            placement: "bottom",
            //delay: { "show": 500, "hide": 100 }
          });
          $this.tooltip('show');
        }
      },
      mouseleave: function () {
        var $this = $(this);
        $this.tooltip('hide');
      }
    });
  }


  $(document).ready(function () {
    if (wp.media) {
      FileBirdGridInit(wp);
    }
  });//ready

})(jQuery);