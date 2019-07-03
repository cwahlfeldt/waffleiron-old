var FileBird_Media = {
  init: function () {
    var html = jQuery("#filebird_sidebar").html();
    jQuery("#filebird_sidebar").remove();
    if (jQuery('.update-nag').length) {
      jQuery("#wp-media-grid").before('<div class="clear"></div>');
      jQuery("#wp-media-grid").css('margin-top', '10px');
    }

    jQuery("#wpbody .wrap").before(html);

    var tempStopResize = true;
    var njtMinWidth = 240;
    var njtMaxWidth = 800;

    jQuery(".panel-left").fileBirdResizable({
      handleSelector: ".njt-splitter",
      resizeHeight: false,
      onDrag: function (e, $el, newWidth, newHeight, opt) {
        // limit box size

        var x = e.pageX - $el.offset().left;

        if (newWidth < njtMinWidth) {

          if (x > njtMinWidth - 40) {

            return false;

          }

          $el.css('max-width', '0');

          $el.css('overflow', 'hidden');

          jQuery('.filebird_sidebar_fixed').css('max-width', '0');
          jQuery('.filebird_sidebar_fixed').css('overflow', 'hidden');
          var $wrapAll = jQuery('.wrap-all');
          jQuery(".njt-splitter").hide()
          $wrapAll.addClass('show-expand');
          if (!jQuery('.wrap-all >  span').length) {
            jQuery('.wrap-all').prepend("<span class='njt-expand'></span>");
          }
          setTimeout(function () {
            jQuery('.njt-expand').show();
          }, 600);


          jQuery('.njt-expand').on('click', function () {

            jQuery(this).hide();
            jQuery('.filebird_sidebar').css({
              'max-width': '800px',
              'width': njtMinWidth + 5 + 'px'
            });
            jQuery('.filebird_sidebar_fixed').css({
              'max-width': '800px',
              'width': njtMinWidth + 5 + 'px'
            });
            jQuery('.njt-splitter').show();
            $wrapAll.removeClass('show-expand');

          });

          return false;

        } else if (newWidth > njtMinWidth && $el.width > 0) {


          $el.css('overflow', 'initial');
        }

        if (newWidth >= njtMaxWidth) {

          return false;
        }
      }
    });

    jQuery("#wpbody .wrap").addClass("appended")
    jQuery('.filebird_sidebar, .njt-splitter, #wpbody .wrap').wrapAll('<div class="wrap-all"></div>');
    var data = {
      'action': 'filebird_ajax_get_folder_list'
    };
    DhTreeFolder.init();
  },

  // Vakata Jstree
  jstree: {
    init: function () {
      FileBird_Media.jstree.default();

      if (localStorage.getItem('current_folder') === 'all' || localStorage.getItem('current_folder') === 'undefined' || localStorage.getItem('current_folder') == null) {
        jQuery('#menu-item-all .menu-item-bar').trigger('click');

      }
    },
    // Init

    default: function () {
      if (jQuery("#njt-filebird-defaultTree").length) {

        jQuery("#njt-filebird-defaultTree").jstree({
          'core': {
            'themes': {
              'responsive': false,
              "icons": false
            }
          },
        });

        jQuery('#njt-filebird-defaultTree').on("changed.jstree", function (e, data) {


          if (data.node) {
            //only active selected node
            var catId = data.node.li_attr['data-id'];

            localStorage.setItem('current_folder', catId);
            jQuery(".jstree-anchor.jstree-clicked").removeClass('jstree-clicked');
            jQuery(".jstree-node.current-dir").removeClass('current-dir');
            jQuery(".jstree-node[data-id='" + catId + "']").addClass('current-dir');
            jQuery(".jstree-node[data-id='" + catId + "']").children('.jstree-anchor').addClass('jstree-clicked');

            if (jQuery('.jstree-anchor.need-refresh').length) {

              var $filebird_sidebar = jQuery('.filebird_sidebar');

              var backbone = ntWMC.ntWMCgetBackboneOfMedia($filebird_sidebar);

              if (backbone.browser.length > 0 && typeof backbone.view == "object") {
                // Refresh the backbone view
                try {
                  backbone.view.collection.props.set({
                    ignore: (+new Date())
                  });
                } catch (e) {
                  console.log(e);
                };
              } else {

                window.location.reload();
              }
              jQuery('.jstree-anchor.need-refresh').removeClass('need-refresh');

            }


            //trigger category on topbar
            jQuery('.wpmediacategory-filter').val(catId);
            jQuery('.wpmediacategory-filter').trigger('change');
          }

          if (jQuery('.menu-item.current_folder').length) {
            if (!jQuery('select[name="njt_filebird_folder"]').length) { //grid list
              jQuery('.menu-item.current_folder').removeClass('current_folder');
            }
          }

        });
      }
    },
    // Default      
  },
  //Jstree

  sweetAlert: {
    delete: function (node) {

      var id = 0;
      if (Array.isArray(node)) {
        id = node[0].data("id");;
      } else {
        id = node.data("id");;
      }


      var li = jQuery('menu-item-' + id);

      if (jQuery(li).next().find(".menu-item-data-parent-id").length && jQuery(li).next().find(".menu-item-data-parent-id").val() == id) {
        swal({
          title: filebird_translate.oops,
          text: filebird_translate.folder_are_sub_directories,
          type: "error"
        });
      } else {

        swal({
          title: filebird_translate.are_you_sure,
          text: filebird_translate.not_able_recover_folder,
          type: "warning",
          confirmButtonText: filebird_translate.yes_delete_it,
          showCancelButton: true,
          cancelButtonText: filebird_translate.cancel,
        }).then(function (result) {

          if (result.value) {

            njt_trigger_folder.delete(id);

            swal(filebird_translate.deleted + '!', filebird_translate.folder_deleted, "success");

          }
        });
      }
    }
  },
  //Sweet Alert

  toolbar: {
    init: function () {
      FileBird_Media.toolbar.create();
      FileBird_Media.toolbar.delete();
    },
    //Init

    create: function () {
      if (jQuery(".js__nt_create").length) {
        jQuery(".js__nt_create").on("click", function () {

          var ref = jQuery('#njt-filebird-folderTree').jstree(true),
            sel,
            type = jQuery(this).data("type");
          sel = ref.create_node(null, {
            "type": type
          });

          if (sel) {
            ref.edit(sel);
          }

        });
      }
    },
    //Create

    delete: function () {
      if (jQuery(".js__nt_delete").length) {
        jQuery(".js__nt_delete").on("click", function () {
          var ref = jQuery('#njt-filebird-folderTree .current_folder');

          if (!ref.length) {
            return false;
          }
          FileBird_Media.sweetAlert.delete(ref);
        });
      }
    },
    //Delete

  },
  //Toolbar

  // Tipped Plugin
  tooltip: {
    init: function () {
      if (jQuery(".js__nt_tipped").length) {
        Tipped.create(".js__nt_tipped", function (element) {
          return {
            title: jQuery(element).data("title"),
            content: jQuery(element).data("content"),
          };
        }, {
            skin: 'blue',
            maxWidth: 250,
          });
      }
    }
  },
  //Tooltip
}