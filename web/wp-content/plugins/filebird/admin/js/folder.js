var DhTreeFolder,oldCurrentFolder=null,njt_filebird_free=!1;jQuery(document).ready(function(){njt_filebird_free="11"!==window.njtFBV});var api,njt_filebird_pro_link="https://1.envato.market/GoFileBird";api=DhTreeFolder={options:{menuItemDepthPerLevel:30,globalMaxDepth:11,sortableItems:"> *",targetTolerance:0},menuList:void 0,menusChanged:!1,isRTL:!("undefined"==typeof isRtl||!isRtl),negateIfRTL:"undefined"!=typeof isRtl&&isRtl?-1:1,menus:{moveUp:"Move up one",moveDown:"Move down one",moveToTop:"Move to the top",moveUnder:"Move under %s",moveOutFrom:"Move out from under %s",under:"Under %s",outFrom:"Out from under %s",menuFocus:"%1$s. Menu item %2$d of %3$d.",subMenuFocus:"%1$s. Sub item number %2$d under %3$s."},current_folder:localStorage.getItem("current_folder")||"all",current_parent:null,old_parent:null,state:localStorage.getItem("tree_state")?localStorage.getItem("tree_state").split(","):[],init:function(){api.menuList=jQuery("#folders-to-edit"),this.jQueryExtensions(),api.menuList.length&&this.initSortables(),this.setIcons(),this.newBehavior()},njt_filebird_upgrade_options:function(){return{title:filebird_translate.notice,html:filebird_translate.limit_folder,type:"warning",showCancelButton:!0,confirmButtonText:filebird_translate.ok,cancelButtonText:filebird_translate.no_thank,confirmButtonClass:"bnt-upgrade",cancelButtonClass:"btn-text"}},setIcons:function(){var e=api.menuList.find("li.menu-item");jQuery.each(e,function(e,t){var r=jQuery(t).menuItemDepth(),n=jQuery(t).next();n.hasClass("menu-item")&&(n.menuItemDepth()>r&&(api.state.indexOf(jQuery(t).data("id").toString())<0?(jQuery(t).childMenuItems().wrapAll('<li class="new-wrapper children_of_'+jQuery(t).attr("id")+'"><ul></ul></li>'),jQuery(t).find(".dh-tree-icon").addClass("has_children").addClass("close")):(jQuery(t).find(".dh-tree-icon").addClass("has_children").addClass("open"),jQuery(t).find(".menu-item-bar.jstree-anchor").addClass("has_children").addClass("open-folder"))))}),jQuery(document).off("click",".dh-tree-icon.has_children").on("click",".dh-tree-icon.has_children",function(e){e.preventDefault();var t=jQuery(this),r=t.closest("li.menu-item"),n=r.data("id");if(t.hasClass("open"))r.childMenuItems().wrapAll('<li class="new-wrapper children_of_'+r.attr("id")+'"><ul></ul></li>'),t.removeClass("open").addClass("close"),t.parent().find(".menu-item-bar.jstree-anchor").removeClass("open-folder"),api.state.splice(api.state.indexOf(n.toString()),1),localStorage.setItem("tree_state",api.state);else if(t.hasClass("close")){jQuery(".children_of_"+r.attr("id")+" >ul>li.menu-item").unwrap().unwrap(),t.removeClass("close").addClass("open"),t.parent().find(".menu-item-bar.jstree-anchor").addClass("open-folder"),api.state.indexOf(n.toString())<0&&(api.state.push(n),localStorage.setItem("tree_state",api.state))}oldCurrentFolder=localStorage.getItem("current_folder"),localStorage.setItem("current_folder",n),r.find(".jstree-anchor").trigger("click")})},newBehavior:function(){jQuery(document).on("click",".menu-item-bar",function(e){e.preventDefault();var t=jQuery(this);api.doSetCurrentFolder(t)}),jQuery.contextMenu({selector:".menu-item-bar",animation:{duration:200,show:"fadeIn",hide:"fadeOut"},zIndex:999999,events:{show:function(e){jQuery(this).parent().css({background:"rgba(0, 0, 0, 0.03)",border:"1px dashed"}),window.onscroll=function(t){e.$menu.trigger("contextmenu:hide")}},hide:function(){jQuery(this).parent().css({background:"",border:""})}},callback:function(e,t){if("new"==e){if(jQuery("#folders-to-edit li").length>=11&&njt_filebird_free)return swal(api.njt_filebird_upgrade_options()).then(e=>{switch(e.value){case!0:window.open(njt_filebird_pro_link,"_blank")}}),!1;api.doSetCurrentFolder(t.$trigger),api.doInsertFolder()}else if("rename"==e){if(jQuery(".folder-input").length)return jQuery(".folder-input").focus(),void(r=jQuery(".folder-input")).putCursorAtEnd().on("focus",function(){r.putCursorAtEnd()});var r,n=(o=t.$trigger.closest(".menu-item")).find(".menu-item-data-db-id").val(),i=o.find(".menu-item-title").text(),a=o.menuItemDepth(),l=api.editFolderFormTemplate(n,i,"menu-item-depth-"+a);jQuery(l).insertAfter(o),(r=jQuery(".edit-folder-name")).putCursorAtEnd().on("focus",function(){r.putCursorAtEnd()}),o.hide()}else if("delete"==e){n=(o=t.$trigger.closest(".menu-item")).find(".menu-item-data-db-id").val();jQuery(o).next().find(".menu-item-data-parent-id").length&&jQuery(o).next().find(".menu-item-data-parent-id").val()==n?swal({title:filebird_translate.oops,text:filebird_translate.folder_are_sub_directories,type:"error"}):swal({title:filebird_translate.are_you_sure,text:filebird_translate.not_able_recover_folder,type:"warning",confirmButtonText:filebird_translate.yes_delete_it,showCancelButton:!0,cancelButtonText:filebird_translate.cancel}).then(function(e){e.value&&(njt_trigger_folder.delete(n),FileBird_Media.message.show("success",filebird_translate.folder_deleted))})}else if("refresh"==e){var o;n=(o=t.$trigger.closest(".menu-item")).find(".menu-item-data-db-id").val();api.doRefreshFolder(n)}},items:{new:{name:filebird_translate.new_folder,icon:"context-menu-icon context-menu-icon-new"},sep1:"---------",refresh:{name:filebird_translate.refresh,icon:"context-menu-icon context-menu-icon-refresh"},rename:{name:filebird_translate.rename,icon:"context-menu-icon context-menu-icon-rename"},delete:{name:filebird_translate.delete,icon:"context-menu-icon context-menu-icon-delete"}}}),jQuery(document).on("click",".edit-folder-cancel",function(e){e.preventDefault();var t=jQuery(this);jQuery("#menu-item-"+t.closest(".edit-folder-wrap").data("id")).show(),jQuery(".edit-folder-wrap").remove()}),jQuery(document).on("click",".edit-folder-now",function(e){e.preventDefault();var t=jQuery(this),r=jQuery(".edit-folder-name").val();if(""==r)return alert("Please enter your folder name."),!1;var n=t.closest(".edit-folder-wrap").data("id"),i=jQuery("#menu-item-"+n);i.find(".menu-item-title").text(r),i.show(),jQuery(".edit-folder-wrap").remove(),njt_trigger_folder.rename(n,r),jQuery.event.trigger({type:"DhTreeFolder_renamed",id:n,new_name:r})}),jQuery(document).on("keypress",".edit-folder-name",function(e){13==e.which&&(e.preventDefault(),jQuery(".edit-folder-now").trigger("click"))}),jQuery(document).on("keypress",".add-new-folder-name",function(e){13==e.which&&(e.preventDefault(),jQuery(".add-new-folder-now").trigger("click"))}),jQuery(document).on("click",".add-new-folder-now",function(e){if(e.preventDefault(),jQuery("#folders-to-edit li").length>=11&&njt_filebird_free)return swal(api.njt_filebird_upgrade_options()).then(e=>{switch(e.value){case!0:window.open(njt_filebird_pro_link,"_blank")}}),!1;var t=jQuery(".add-new-folder-name").val();if(""==t)alert("Please enter folder name!");else{var r=0,n=0,i=jQuery("#menu-item-"+r),a=0;null!=api.current_folder&&(r=api.current_folder,i=jQuery("#menu-item-"+r),n=i.menuItemDepth(),a=n,n=parseInt(n)+1),ntWMC.filebird_begin_loading();var l={action:"filebird_ajax_update_folder_list",new_name:t,parent:r,folder_type:"default",type:"new",nonce:window.njt_fb_nonce};jQuery.post(ajaxurl,l,function(e){"error"==e&&swal({title:filebird_translate.error,text:filebird_translate.error_occurred,type:"error"}).then(function(){location.reload()})}).fail(function(){swal({title:filebird_translate.error,text:filebird_translate.error_occurred,type:"error"}).then(function(){location.reload()})}).success(function(e){var t=api.newFolderTemplate(e.data.term_id,e.data.term_name,r,n);if(jQuery(".new-folder-wrap").remove(),null==api.current_folder)jQuery("#folders-to-edit").append(t);else if(0==jQuery('[class="menu-item-data-parent-id"][value="'+api.current_folder+'"]').length)jQuery(t).insertAfter(jQuery("#menu-item-"+api.current_folder)),jQuery("#menu-item-"+api.current_folder).find(".dh-tree-icon").addClass("has_children open"),jQuery("#menu-item-"+api.current_folder).find(".menu-item-bar").addClass("open-folder");else{var i=jQuery("#menu-item-"+api.current_folder).nextAll();jQuery.each(i,function(e,r){if(jQuery(r).menuItemDepth()<=a)return jQuery(t).insertAfter(jQuery(r).prev()),!1;e==i.length-1&&jQuery(t).insertAfter(jQuery(r))})}filebird_taxonomies.folder.term_list.push({term_id:e.data.term_id,term_name:"new tmp folder"});var l=jQuery(".filebird_sidebar"),o=ntWMC.ntWMCgetBackboneOfMedia(l);if("object"==typeof o.view){var d=o.view.toolbar.get("folder-filter");"object"==typeof o.view&&d.createFilters()}var u=jQuery("<option></option>").attr("value",e.data.term_id).text("new tmp folder");jQuery(".wpmediacategory-filter").append(u),jQuery(".jstree-anchor.jstree-clicked").removeClass("jstree-clicked"),njt_trigger_folder.update_folder_position(),r&&api.state.indexOf(r.toString())<0&&(api.state.push(r),localStorage.setItem("tree_state",api.state)),ntWMC.dropFile(),ntWMC.filebird_finish_loading()})}}),jQuery(document).on("click",".add-new-folder-cancel",function(e){e.preventDefault(),jQuery(".new-folder-wrap").remove()}),jQuery(".new-folder").click(function(e){if(jQuery("#folders-to-edit li").length>=11&&njt_filebird_free)return swal(api.njt_filebird_upgrade_options()).then(e=>{switch(e.value){case!0:window.open(njt_filebird_pro_link,"_blank")}}),!1;api.doInsertFolder()}),jQuery(document).on("click","#njt-filebird-defaultTree .jstree-anchor",function(e){e.preventDefault(),api.doSetCurrentFolder()}),jQuery("#njt-filebird-folderTree .jstree-anchor").dblclick(function(e){e.preventDefault(),setTimeout(function(){jQuery(".js__nt_rename").trigger("click")},100)})},doSetCurrentFolder:function(e){if(null==e)api.menuList.find("li.menu-item").removeClass("current_folder"),api.current_folder=null;else{api.menuList.find("li.menu-item").removeClass("current_folder"),e.closest(".menu-item").addClass("current_folder"),jQuery(".jstree-anchor.jstree-clicked").removeClass("jstree-clicked"),jQuery(".jstree-container-ul .menu-item").removeClass("current-dir"),api.current_folder=e.closest(".menu-item").find(".menu-item-data-db-id").val(),localStorage.setItem("current_folder",api.current_folder);var t=".wp-admin.upload-php .media-toolbar.wp-filter .media-toolbar-secondary";jQuery(t+" .media-button.delete-selected-button").hasClass("hidden")||jQuery(t+" .media-button.select-mode-toggle-button").trigger("click")}},doRefreshFolder:function(e){if(jQuery.trim(e)){var t={action:"filebird_ajax_refresh_folder",current_folder:e,nonce:window.njt_fb_nonce};ntWMC.filebird_begin_loading(),jQuery.post(ajaxurl,t,function(e){}).success(function(t){if(1==t.success){var r=jQuery("#menu-item-"+e);if(jQuery(r).length){var n=jQuery(r).data("number"),i=t.data.rowChanged;n>=i&&jQuery(r).attr("data-number",n-i)}ntWMC.filebird_finish_loading()}else console.log("Error: "+t)})}},doInsertFolder:function(){if(jQuery(".folder-input").length){jQuery(".folder-input").focus();var e=jQuery(".folder-input");return e.putCursorAtEnd().on("focus",function(){e.putCursorAtEnd()}),!1}if(jQuery("#menu-item-"+api.current_folder).length||(api.current_folder=null,localStorage.removeItem("current_folder")),null==api.current_folder)jQuery("#folders-to-edit").append(api.newFolderFormTemplate());else{var t=jQuery("#menu-item-"+api.current_folder).menuItemDepth(),r=t;if((t=parseInt(t)+1)>=api.options.globalMaxDepth+1)alert("The max Depth is: "+api.options.globalMaxDepth);else{var n=jQuery("#menu-item-"+api.current_folder).find(".dh-tree-icon");if(n.hasClass("close")&&n.trigger("click"),0==jQuery('[class="menu-item-data-parent-id"][value="'+api.current_folder+'"]').length)jQuery(api.newFolderFormTemplate("menu-item-depth-"+t)).insertAfter(jQuery("#menu-item-"+api.current_folder));else{var i=jQuery("#menu-item-"+api.current_folder).nextAll();jQuery.each(i,function(e,n){return jQuery(n).menuItemDepth()<=r?(jQuery(api.newFolderFormTemplate("menu-item-depth-"+t)).insertAfter(jQuery(n).prev()),!1):e==i.length-1?(jQuery(api.newFolderFormTemplate("menu-item-depth-"+t)).insertAfter(jQuery(n)),!1):void 0})}}}jQuery(".add-new-folder-name").focus()},newFolderFormTemplate:function(e){return void 0===e&&(e=""),'<li class="new-folder-wrap '+e+'"><input type="text" name="add-new-folder-name" value="" class="folder-input add-new-folder-name" id="" autocomplete="off" /><div class="action"><span class="add-new-folder-cancel button button-default button-small">Cancel</span>&nbsp<span class="add-new-folder-now button button-primary button-small">Ok</span></div></li>'},editFolderFormTemplate:function(e,t,r){return void 0===r&&(r=""),void 0===t&&(t=""),'<li data-id="'+e+'" class="edit-folder-wrap '+r+'"><input type="text" name="edit-folder-name" value="'+t+'" class="folder-input edit-folder-name" id="" autocomplete="off" /><div class="action"><span class="edit-folder-cancel  button button-default button-small">Cancel</span>&nbsp;<span class="edit-folder-now  button button-primary button-small">Ok</span></div></li>'},newFolderTemplate:function(e,t,r,n){return'<li id="menu-item-'+e+'" data-id= "'+e+'" class="menu-item menu-item-depth-'+n+'"><i class="dh-tree-icon"></i><div class="menu-item-bar jstree-anchor"><div class="menu-item-handle ui-sortable-handle"><span class="item-title"><span class="menu-item-title">'+t+'</span></span></div></div><ul class="menu-item-transport"></ul><input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id['+e+']" value="'+e+'"><input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id['+e+']" value="'+r+'"></li>'},jQueryExtensions:function(){jQuery.fn.extend({menuItemDepth:function(){var e=api.isRTL?this.eq(0).css("margin-right"):this.eq(0).css("margin-left");return api.pxToDepth(e&&-1!=e.indexOf("px")?e.slice(0,-2):0)},updateDepthClass:function(e,t){return this.each(function(){var r=jQuery(this);t=t||r.menuItemDepth(),jQuery(this).removeClass("menu-item-depth-"+t).addClass("menu-item-depth-"+e)})},shiftDepthClass:function(e){return this.each(function(){var t=jQuery(this),r=t.menuItemDepth(),n=r+e;t.removeClass("menu-item-depth-"+r).addClass("menu-item-depth-"+n),0===n&&t.find(".is-submenu").hide()})},childMenuItems_bk:function(){var e=jQuery();return this.each(function(){for(var t=jQuery(this),r=t.menuItemDepth(),n=t.next(".menu-item");n.length&&n.menuItemDepth()>r;)e=e.add(n),n=n.next(".menu-item")}),e},childMenuItems:function(){var e=jQuery();return this.each(function(){for(var t=jQuery(this),r=t.menuItemDepth(),n=t.next("li");n.length&&n.menuItemDepth()>r||n.hasClass("new-wrapper");)e=e.add(n),n=n.next("li")}),e},updateParentMenuItemDBId:function(){return this.each(function(){var e=jQuery(this),t=e.find(".menu-item-data-parent-id"),r=parseInt(e.menuItemDepth(),10),n=r-1,i=e.prevAll(".menu-item-depth-"+n).first(),a=0;0!==r&&(a=i.find(".menu-item-data-db-id").val()),t.val(a),a!=api.current_parent&&(jQuery.event.trigger({type:"DhTreeFolder_parent_changed",new_parent:a,id:e.find(".menu-item-data-db-id").val()}),console.log("parent changed"),api.state.push(a),localStorage.setItem("tree_state",api.state)),api.current_parent=null})},putCursorAtEnd:function(){return this.each(function(){var e=jQuery(this),t=this;if(e.is(":focus")||e.focus(),t.setSelectionRange){var r=2*e.val().length;setTimeout(function(){t.setSelectionRange(r,r)},1)}else e.val(e.val());this.scrollTop=999999})}})},initSortables:function(){var e,t,r,n,i,a,l,o,d,u,s=0,m=api.menuList.offset().left,c=jQuery("body"),p=function(){if(!c[0].className)return 0;var e=c[0].className.match(/menu-max-depth-(\d+)/);return e&&e[1]?parseInt(e[1],10):0}();function f(e){var o;n=e.placeholder.prev(".menu-item"),i=e.placeholder.next(".menu-item"),n[0]==e.item[0]&&(n=n.prev(".menu-item")),i[0]==e.item[0]&&(i=i.next(".menu-item")),a=n.length?n.offset().top+n.height():0,l=i.length?i.offset().top+i.height()/3:0,t=i.length?i.menuItemDepth():0,r=n.length?(o=n.menuItemDepth()+1)>api.options.globalMaxDepth?api.options.globalMaxDepth:o:0}function h(e,t){e.placeholder.updateDepthClass(t,s),s=t}0!==jQuery("#folders-to-edit li").length&&jQuery(".drag-instructions").show(),m+=api.isRTL?api.menuList.width():0,api.menuList.sortable({handle:".menu-item-handle",placeholder:"sortable-placeholder",items:api.options.sortableItems,start:function(t,r){var n,i,a,l;api.isRTL&&(r.item[0].style.right="auto"),d=r.item.children(".menu-item-transport"),e=r.item.menuItemDepth(),h(r,e),a=(r.item.next()[0]==r.placeholder[0]?r.item.next():r.item).childMenuItems(),d.append(a),n=d.outerHeight(),n+=n>0?1*r.placeholder.css("margin-top").slice(0,-2):0,n+=r.helper.outerHeight(),o=n,n-=2,r.placeholder.height(n),u=e,a.each(function(){var e=jQuery(this).menuItemDepth();u=e>u?e:u}),i=r.helper.find(".menu-item-handle").outerWidth(),i+=api.depthToPx(u-e),i-=2,r.placeholder.width(i),(l=r.placeholder.next(".menu-item")).css("margin-top",o+"px"),r.placeholder.detach(),jQuery(this).sortable("refresh"),r.item.after(r.placeholder),l.css("margin-top",0),f(r),api.current_parent=r.item.find(".menu-item-data-parent-id").val(),api.old_parent=r.item.prev()},stop:function(t,r){var n,i,a=s-e;jQuery(".children_of_"+r.item.attr("id")).length?jQuery(".children_of_"+r.item.attr("id")).insertAfter(r.item):n=d.children().insertAfter(r.item),jQuery.each(jQuery(".new-wrapper"),function(e,t){jQuery(t).insertAfter("#menu-item-"+jQuery(t).attr("class").match(/children_of_menu-item-(\d)+/)[1])}),i=r.item.find(".item-title .is-submenu"),0<s?i.show():i.hide(),0!==a&&(r.item.updateDepthClass(s),jQuery(".children_of_"+r.item.attr("id")).length?(n=jQuery(".children_of_"+r.item.attr("id")).find(".menu-item")).shiftDepthClass(a):n.shiftDepthClass(a),function(e){var t,r=p;if(0===e)return;if(e>0)(t=u+e)>p&&(r=t);else if(e<0&&u==p)for(;!jQuery(".menu-item-depth-"+r,api.menuList).length&&r>0;)r--;c.removeClass("menu-max-depth-"+p).addClass("menu-max-depth-"+r),p=r}(a)),api.registerChange(),r.item.updateParentMenuItemDBId(),r.item[0].style.top=0,api.isRTL&&(r.item[0].style.left="auto",r.item[0].style.right=0),0==api.old_parent.childMenuItems().length?(api.old_parent.find(".dh-tree-icon").removeClass("has_children open"),api.old_parent.find(".menu-item-bar").removeClass("open-folder")):(api.old_parent.find(".dh-tree-icon").addClass("has_children open"),api.old_parent.find(".menu-item-bar").addClass("open-folder"));var l=jQuery("#menu-item-"+r.item.find(".menu-item-data-parent-id").val());l.childMenuItems().length>0&&(l.find(".dh-tree-icon").addClass("has_children open"),l.find(".menu-item-bar").addClass("open-folder")),l.find(".dh-tree-icon").hasClass("close")&&l.find(".dh-tree-icon").trigger("click"),r.item.move_folder()},change:function(e,t){t.placeholder.parent().hasClass("menu")||(n.length?n.after(t.placeholder):api.menuList.prepend(t.placeholder)),f(t)},sort:function(e,n){var d=n.helper.offset(),u=api.isRTL?d.left+n.helper.width():d.left,c=api.negateIfRTL*api.pxToDepth(u-m);c>r||d.top<a-api.options.targetTolerance?c=r:c<t&&(c=t),c!=s&&h(n,c),l&&d.top+o>l&&(i.after(n.placeholder),f(n),jQuery(this).sortable("refreshPositions"))}})},registerChange:function(){api.menusChanged=!0},depthToPx:function(e){return e*api.options.menuItemDepthPerLevel},pxToDepth:function(e){return Math.floor(e/api.options.menuItemDepthPerLevel)}};