;(function($){
	"use strict";
	$(document).ready(function() {
		$("#toplevel_page_exwptl_options").appendTo("#menu-posts-wp-timeline > ul");
		$("#toplevel_page_exwptl_options").removeClass('menu-top');
		$("#toplevel_page_exwptl_options a").removeClass('menu-top');
		if($("#toplevel_page_exwptl_options > a").hasClass('current') || $("#toplevel_page_exwptl_advanced_options > a").hasClass('current') || $("#toplevel_page_exwptl_custom_code_options > a").hasClass('current') || $("#toplevel_page_exwptl_js_css_file_options > a").hasClass('current') ){
			$("#adminmenu > li#menu-posts-wp-timeline").addClass('wp-has-current-submenu');
			$("#toplevel_page_exwptl_options").addClass('current');
		}
		/*-Remove schema-*/
		if(jQuery(".post-type-wp-timeline #review_metabox").length>0){
			jQuery('.post-type-wp-timeline #review_metabox').remove();
		}
		
		if(jQuery("#wpex_pkdate input[type=text], input#wpex_pkdate").length>0){
			var fm = $('input#wpex_pkdate').attr('data-format');
			if(fm=='dmy'){
				var date_fm = "dd/mm/yyyy";
			}else{
				var date_fm = "mm/dd/yyyy";
			}
			jQuery("#wpex_pkdate input[type=text], input#wpex_pkdate").extl_datepicker({
					"todayHighlight" : true,
					"startDate": "01/01/1000",
					"autoclose": true,
					"format":date_fm
			});
		}
		
		/*-ajax save meta-*/
		jQuery('input[name="wpex_timeline_sort"]').change(function() {
			var $this = $(this);
			var post_id = $this.attr('data-id');
			var valu = $this.val();
           	var param = {
	   			action: 'wpex_change_timeline_sort',
	   			post_id: post_id,
				value: valu
	   		};
	   		$.ajax({
	   			type: "post",
	   			url: wpex_timeline.ajaxurl,
	   			dataType: 'html',
	   			data: (param),
	   			success: function(data){
	   				return true;
	   			}	
	   		});
		});
		/*-ajax save meta-*/
		jQuery('input[name="wpex_timeline_date"]').change(function() {
			var $this = $(this);
			var post_id = $this.attr('data-id');
			var valu = $this.val();
           	var param = {
	   			action: 'wpex_change_timeline_date',
	   			post_id: post_id,
				value: valu
	   		};
	   		$.ajax({
	   			type: "post",
	   			url: wpex_timeline.ajaxurl,
	   			dataType: 'html',
	   			data: (param),
	   			success: function(data){
	   				return true;
	   			}	
	   		});
		});
		/*-- Timeline shortcode builder --*/
		if(jQuery('.post-type-wptl_scbd .cmb2-metabox select[name="sc_type"]').length>0){
			var $val = jQuery('.post-type-wptl_scbd .cmb2-metabox select[name="sc_type"]').val();
			if($val==''){$val ='list';}
			if($val =='list'){
				jQuery('.post-type-wptl_scbd select#style option').removeAttr("disabled");
				jQuery('.post-type-wptl_scbd select#style option[value="1"], .post-type-wptl_scbd select#style option[value="2"], .post-type-wptl_scbd select#style option[value="3"], .post-type-wptl_scbd select#style option[value="4"], .post-type-wptl_scbd select#style option[value="5"], .post-type-wptl_scbd select#style option[value="6"], .post-type-wptl_scbd select#style option[value="7"], .post-type-wptl_scbd select#style option[value="left"], .post-type-wptl_scbd select#style option[value="full-width"]').attr('disabled','disabled');
			}else if($val =='hoz'){
				jQuery('.post-type-wptl_scbd select#style option').attr('disabled','disabled');
				jQuery('.post-type-wptl_scbd select#style option[value="left"], .post-type-wptl_scbd select#style option[value="full-width"]').removeAttr("disabled");
			}else if($val =='infog'){
				jQuery('.post-type-wptl_scbd select#style option').attr('disabled','disabled');
				jQuery('.post-type-wptl_scbd select#style option[value="1"], .post-type-wptl_scbd select#style option[value="2"], .post-type-wptl_scbd select#style option[value="3"]').removeAttr("disabled");
			}else{
				jQuery('.post-type-wptl_scbd select#style option').attr('disabled','disabled');
				jQuery('.post-type-wptl_scbd select#style option[value="1"], .post-type-wptl_scbd select#style option[value="2"], .post-type-wptl_scbd select#style option[value="3"], .post-type-wptl_scbd select#style option[value="4"], .post-type-wptl_scbd select#style option[value="5"], .post-type-wptl_scbd select#style option[value="6"], .post-type-wptl_scbd select#style option[value="7"]').removeAttr("disabled");
			}
			$('body').removeClass (function (index, className) {
				return (className.match (/(^|\s)extl-layout\S+/g) || []).join(' ');
			});
			$('body').addClass('extl-layout-'+$val);
		};
		jQuery('.post-type-wptl_scbd .cmb2-metabox select[name="sc_type"]').on('change',function() {
			var $this = $(this);
			var $val = $this.val();
			if($val==''){$val ='list';}
			if($val =='list'){
				jQuery('.post-type-wptl_scbd select#style option').removeAttr("disabled");
				jQuery('.post-type-wptl_scbd select#style option[value="1"], .post-type-wptl_scbd select#style option[value="2"], .post-type-wptl_scbd select#style option[value="3"], .post-type-wptl_scbd select#style option[value="4"], .post-type-wptl_scbd select#style option[value="5"], .post-type-wptl_scbd select#style option[value="6"], .post-type-wptl_scbd select#style option[value="left"], .post-type-wptl_scbd select#style option[value="full-width"]').attr('disabled','disabled');
			}else if($val =='hoz'){
				jQuery('.post-type-wptl_scbd select#style option').attr('disabled','disabled');
				jQuery('.post-type-wptl_scbd select#style option[value="left"], .post-type-wptl_scbd select#style option[value="full-width"]').removeAttr("disabled");
			}else if($val =='infog'){
				jQuery('.post-type-wptl_scbd select#style option').attr('disabled','disabled');
				jQuery('.post-type-wptl_scbd select#style option[value="1"], .post-type-wptl_scbd select#style option[value="2"], .post-type-wptl_scbd select#style option[value="3"]').removeAttr("disabled");
			}else{
				jQuery('.post-type-wptl_scbd select#style option').attr('disabled','disabled');
				jQuery('.post-type-wptl_scbd select#style option[value="1"], .post-type-wptl_scbd select#style option[value="2"], .post-type-wptl_scbd select#style option[value="3"], .post-type-wptl_scbd select#style option[value="4"], .post-type-wptl_scbd select#style option[value="5"], .post-type-wptl_scbd select#style option[value="6"]').removeAttr("disabled");
			}
			$('body').removeClass (function (index, className) {
				return (className.match (/(^|\s)extl-layout\S+/g) || []).join(' ');
			});
			$('body').addClass('extl-layout-'+$val);
		});
	});
}(jQuery));