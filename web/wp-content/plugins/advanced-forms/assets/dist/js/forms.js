var af;!function(c){"undefined"!=typeof acf?((af={forms:{},setup_form:function(e){var a=e.attr("data-key"),t={$el:e,key:a};this.pages.initialize(t),this.forms[a]=t,"doAction"in acf?acf.doAction("af/form/setup",t):acf.do_action("af/form/setup",t)}}).pages={initialize:function(r){var a=this;if($page_fields=r.$el.find(".acf-field-page"),$page_fields.exists()){r.pages=[],r.current_page=0,r.max_page=0,r.show_numbering=!0,r.$page_wrap=c('<div class="af-page-wrap">'),r.$page_wrap.insertBefore($page_fields.first()),r.$previous_button=$page_fields.first().find(".af-previous-button"),r.$next_button=$page_fields.first().find(".af-next-button"),r.show_numbering="true"===$page_fields.first().find(".af-page-button").attr("data-show-numbering"),r.$previous_button.click(function(e){e.preventDefault(),a.previousPage(r)}),r.$next_button.click(function(e){e.preventDefault(),a.nextPage(r)});var e=r.$el.find(".af-submit");e.prepend(r.$next_button),e.prepend(r.$previous_button),r.$submit_button=e.find(".af-submit-button"),$page_fields.each(function(a,e){var t=c(e),n=t.find(".af-page-button").attr("data-index",a);n.click(function(e){e.preventDefault(),af.pages.navigateToPage(a,r)}),r.show_numbering&&($index=c('<span class="index">').html(a+1),n.prepend($index)),r.$page_wrap.append(n),t.hide();var i=t.nextUntil(".acf-field-page",".acf-field");r.pages.push({$field:t,$fields:i,$button:n})}),this.refresh(r)}},refresh:function(n){c.each(n.pages,function(e,a){var t=e==n.current_page;a.$button.toggleClass("enabled",e<=n.max_page),a.$button.toggleClass("current",t),a.$fields.each(function(){c(this).toggle(t)})});var e=this.isFirstPage(n),a=this.isLastPage(n);n.$previous_button.attr("disabled",!!e||null),n.$next_button.toggle(!a),n.$submit_button.toggle(a)},nextPage:function(e){if(!this.isLastPage(e)){var a=this;this.validatePage(e,e.current_page,function(){a.changePage(e.current_page+1,e)})}},previousPage:function(e){this.isFirstPage(e)||this.changePage(e.current_page-1,e)},navigateToPage:function(e,a){if(!(e<0||e>a.max_page)){var t=this;this.validatePage(a,a.current_page,function(){t.changePage(e,a)})}},changePage:function(e,a){var t=a.current_page;a.current_page=e,a.max_page<=a.current_page&&(a.max_page=a.current_page),this.refresh(a),"doAction"in acf?acf.doAction("af/form/page_changed",e,t,a):acf.do_action("af/form/page_changed",e,t,a)},isFirstPage:function(e){return 0==e.current_page},isLastPage:function(e){return e.current_page==e.pages.length-1},validatePage:function(a,e,t){var n=a.pages[e],i=c("<div>");i.append(a.$el.find("#acf-form-data").clone()),i.append(a.$el.find(".acf-hidden").clone());var r=n.$fields.detach();i.append(r);var f=acf.serialize(i);if(r.detach().insertAfter(n.$field),f.action="acf/validate_save_post",f=acf.prepare_for_ajax(f),void 0!==acf.validation.lockForm){function o(){return f}acf.addFilter("prepare_for_ajax",o),acf.validation.fetch({form:a.$el,lock:!1,reset:!0,success:function(){t()}}),acf.removeFilter("prepare_for_ajax",o)}else{acf.validation.toggle(a.$el,"lock"),(f=acf.serialize(n.$fields.clone())).action="acf/validate_save_post",f=acf.prepare_for_ajax(f),c.ajax({url:acf.get("ajaxurl"),data:f,type:"post",dataType:"json",success:function(e){acf.validation.toggle(a.$el,"unlock"),acf.is_ajax_success(e)&&acf.validation.fetch_success(a.$el,e.data)},complete:function(){acf.validation.valid&&(acf.remove_el(a.$el.children(".acf-error-message")),t())}})}}},c(document).ready(function(){c(".af-form").each(function(){af.setup_form(c(this))})})):console.error("acf-input.js not found. AF requires ACF to work.")}(jQuery);