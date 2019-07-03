//create hidden select to filter
window.wp = window.wp || {};

(function ($) {
  'use strict';
  var media = wp.media;

  media.view.AttachmentFilters.Taxonomy = media.view.AttachmentFilters.extend({

    tagName: 'select',

    createFilters: function () {

      var filters = {};

      _.each(filebird_taxonomies.folder.term_list || {}, function (term, key) {
        var term_id = term['term_id'];
        var term_name = $("<div/>").html(term['term_name']).text();
        filters[term_id] = {
          text: term_name,
          priority: key + 2
        };
        filters[term_id]['props'] = {};
        filters[term_id]['props'][filebird_folder] = term_id;
      });

      filters.all = {
        text: filebird_taxonomies.folder.list_title,
        priority: 1
      };
      filters['all']['props'] = {};
      filters['all']['props'][filebird_folder] = null;

      this.filters = filters;
    }
  });

  var curAttachmentsBrowser = media.view.AttachmentsBrowser;

  media.view.AttachmentsBrowser = media.view.AttachmentsBrowser.extend({
    createToolbar: function () {

      //set backbone for attachment container
      var treeLoaded = jQuery.Deferred();
      this.$el.data("backboneView", this);

      this._treeLoaded = treeLoaded;
      //end set backbon for attachment container

      curAttachmentsBrowser.prototype.createToolbar.apply(this, arguments);

      var that = this;
      var myNewFilter = new wp.media.view.AttachmentFilters.Taxonomy({
        className: 'wpmediacategory-filter attachment-filters',
        controller: that.controller,
        model: that.collection.props,
        priority: -75
      }).render();

      setTimeout(() => {
        if (!$('body.wp-admin.upload-php').length) {
          var _slicedToArray = (function () { function sliceIterator(arr, i) { var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"]) _i["return"](); } finally { if (_d) throw _e; } } return _arr; } return function (arr, i) { if (Array.isArray(arr)) { return arr; } else if (Symbol.iterator in Object(arr)) { return sliceIterator(arr, i); } else { throw new TypeError("Invalid attempt to destructure non-iterable instance"); } }; })();
          var _this = this;
          var parent = _this.views.parent,
            views = parent.views,
            mediaFrameMenu = views.get('.media-frame-menu'),
            mediaMenuGet = _slicedToArray(mediaFrameMenu, 1),
            mediaMenu = mediaMenuGet[0];
          if (!parent.$el.find('.fb-treeview-loading').length) {
            mediaMenu.views.add(new wp.media.View({
              className: 'fb-treeview',
              el: '<a href="#" class="fb-treeview-loading media-menu-item">Filebird is loading <span class="spinner"></span></a>'
            }));
          }
          var modalID = $(parent.$el).attr('id');
          if ($("#" + modalID).find("#filebird_sidebar").length) {
            $('.fb-treeview-loading').hide();
          }
          parent.$el.addClass('filebird-treeview').removeClass('hide-menu not-show');
        }
      }, 50);

      this.toolbar.set('folder-filter', myNewFilter);
      myNewFilter.initialize();
    }
  });

  media.view.UploaderInline = media.view.UploaderInline.extend({
    prepare: function () {
      setTimeout(() => {
        if (!$('body.wp-admin.upload-php').length) {
          var _this = this;
          var parent = _this.views.parent
          parent.$el.addClass('filebird-treeview not-show').removeClass('hide-menu');
        }
      }, 50);
    }
  });

})(jQuery);