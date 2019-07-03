// var filebird_media_menu = $(".media-menu");

var FileBird_Popup = {
  init: function () {
    if (jQuery(".media-button-reverse").is(":visible")) {
      return;
    }

    if (jQuery("#filebird_sidebar").length) {
      setTimeout(() => {
        var selector = jQuery("div[id^='__wp-uploader-id-'].supports-drag-drop:visible");
        if (selector) {
          var id_append = jQuery(selector).attr("id");
          jQuery("#filebird_sidebar").appendTo("#" + id_append + " .media-menu");
          var curr_folder = localStorage.getItem('current_folder') || 'all';
          jQuery('#menu-item-' + curr_folder + ' .jstree-anchor').trigger('click');
          jQuery("#filebird_sidebar").show();
          jQuery('.fb-treeview-loading').hide();
        }
      }, 200);
    } else {
      jQuery.ajax({
        url: ajaxurl,
        type: "post",
        dataType: "text",
        data: {
          action: "filebird_ajax_treeview_folder"
        },
        success: function (res) {
          var selector = jQuery("div[id^='__wp-uploader-id-'].supports-drag-drop:visible");
          if (selector.length) {
            var id_append = jQuery(selector).attr("id");
            var mediaMenu = "#" + id_append + " .media-menu";
            jQuery(res).appendTo(mediaMenu);
            jQuery('.fb-treeview-loading').hide();

            DhTreeFolder.init();
            ntWMC.dropFile();

            var curr_folder = localStorage.getItem('current_folder') || 'all';
            jQuery('#menu-item-' + curr_folder + ' .jstree-anchor').trigger('click');

            jQuery("#filebird_sidebar").show();

            setTimeout(() => {
              jQuery('#filebird_sidebar').bind('remove', function () {
                // $(document).off('click', '.filebird_sidebar .jstree-anchor');
                // njt_trigger_folder.tree_view();
                FileBird_Popup.init();
              })
            }, 100);
            FileBird_Popup.jstree.init();

            var mediaMenuItem = mediaMenu + ' .media-menu-item:not(.fb-treeview-loading)'
            var countMenuItem = jQuery(mediaMenuItem).length
            jQuery("#njt-filebird-folderTree").mCustomScrollbar({
              autoHideScrollbar: true,
              setHeight: jQuery(mediaMenu).height() - (countMenuItem * 34) - 230
            });
            FileBird_Popup.toolbar.init();
          }
        }
      });
    }
  },

  // Vakata Jstree
  jstree: {
    init: function () {
      FileBird_Popup.jstree.default();

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
      FileBird_Popup.toolbar.create();
      FileBird_Popup.toolbar.delete();
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
          FileBird_Popup.sweetAlert.delete(ref);
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