<?php
function parse_wpex_timeline_slider_func($atts, $content){
	global $ID,$style,$posttype,$show_media,$show_label,$taxonomy,$full_content,$hide_thumb;
	$ID = isset($atts['ID']) ? $atts['ID'] : rand(10,9999);
	$style = isset($atts['style']) && $atts['style']!='' ? $atts['style'] : 'left';
	$layout 		= isset($atts['layout']) && $atts['layout']!='' ? $atts['layout'] : 'horizontal';
	$posttype 		= isset($atts['posttype']) && $atts['posttype']!='' ? $atts['posttype'] : 'wp-timeline';
	$cat 		=isset($atts['cat']) ? $atts['cat'] : '';
	$tag 	= isset($atts['tag']) ? $atts['tag'] : '';
	$taxonomy 		=isset($atts['taxonomy']) ? $atts['taxonomy'] : '';
	$ids 		= isset($atts['ids']) ? $atts['ids'] : '';
	$count 		= isset($atts['count']) ? $atts['count'] : '6';
	$slidesshow = isset($atts['slidesshow']) && $atts['slidesshow']!='' ? $atts['slidesshow'] : 5;
	$order 	= isset($atts['order']) ? $atts['order'] : '';
	$orderby 	= isset($atts['orderby']) ? $atts['orderby'] : '';
	$meta_key 	= isset($atts['meta_key']) ? $atts['meta_key'] : '';
	$meta_value 	= isset($atts['meta_value']) ? $atts['meta_value'] : '';
	$startit = isset($atts['position_start']) ? $atts['position_start'] : 1;
	$autoplay 		= isset($atts['autoplay']) && $atts['autoplay'] == 1 ? 1 : 0;
	$class 		= isset($atts['class']) && $atts['class'] !='' ? $atts['class'] : '';
	$show_media 		= isset($atts['show_media']) ? $atts['show_media'] : '1';
	$show_label 		= isset($atts['show_label']) ? $atts['show_label'] : '0';
	$full_content 		= isset($atts['full_content']) ? $atts['full_content'] : '0';
	$hide_thumb 		= isset($atts['hide_thumb']) ? $atts['hide_thumb'] : '0';
	$arrow_position 		= isset($atts['arrow_position']) ? $atts['arrow_position'] : '';
	$show_all 		= isset($atts['show_all']) ? $atts['show_all'] : '0';
	$header_align 		= isset($atts['header_align']) ? $atts['header_align'] : '';
	$content_align 		= isset($atts['content_align']) ? $atts['content_align'] : '1';
	$toolbar_position 		= isset($atts['toolbar_position']) ? $atts['toolbar_position'] : 'top';
	$autoplayspeed 		= isset($atts['autoplayspeed']) ? $atts['autoplayspeed'] : '';
	$start_on 		= isset($atts['start_on']) ? $atts['start_on'] : '';
	$enable_back 		= isset($atts['enable_back']) ? $atts['enable_back'] : '';
	$infinite 		= isset($atts['infinite']) ? $atts['infinite'] : '';
	$rtl_mode 		= isset($atts['rtl_mode']) ? $atts['rtl_mode'] : '';
	if($start_on=='' && isset($atts['strart_on']) && isset($atts['strart_on'])!=''){
		$start_on = $atts['strart_on'];
	}
	$loading_effect 		= isset($atts['loading_effect']) ? $atts['loading_effect'] : '';
	if($layout=='horizontal' || $layout=='hozsteps'){
		return do_shortcode('[wpex_timeline_horizontal style="'.$style.'" layout="'.$layout.'" posttype="'.$posttype.'" cat="'.$cat.'" tag="'.$tag.'" taxonomy="'.$taxonomy.'" ids="'.$ids.'" count="'.$count.'" order="'.$order.'" orderby="'.$orderby.'" meta_key="'.$meta_key.'" meta_value="'.$meta_value.'" autoplay="'.$autoplay.'" class="'.$class.'" show_media="'.$show_media.'" show_label="'.$show_label.'" full_content="'.$full_content.'" hide_thumb="'.$hide_thumb.'" arrow_position="'.$arrow_position.'" show_all="'.$show_all.'" header_align="'.$header_align.'" content_align="'.$content_align.'" toolbar_position="'.$toolbar_position.'" autoplayspeed="'.$autoplayspeed.'" start_on="'.$start_on.'" slidesshow="'.$slidesshow.'" loading_effect="'.$loading_effect.'" enable_back="'.$enable_back.'" infinite="'.$infinite.'" rtl_mode="'.$rtl_mode.'"]');
	}else{
		// removed in this version
	}

}
add_shortcode( 'wpex_timeline_slider', 'parse_wpex_timeline_slider_func' );
add_action( 'after_setup_theme', 'wpex_timeline_slider_vc' );
function wpex_timeline_slider_vc(){
	if(function_exists('vc_map')){
	vc_map( array(
	   "name" => esc_html__("WP Timeline Horizontal", "exthemes"),
	   "base" => "wpex_timeline_slider",
	   "class" => "",
	   "icon" => "icon-timeline-slider",
	   "controls" => "full",
	   "category" => esc_html__('content','wp-timeline'),
	   "params" => array(
		  array(
		  	"admin_label" => true,
			 "type" => "dropdown",
			 "class" => "",
			 "heading" => esc_html__("Style", 'wp-timeline'),
			 "param_name" => "style",
			 "value" => array(
			 	esc_html__('Left side', 'wp-timeline') => '',
				esc_html__('Full Width', 'wp-timeline') => 'full-width',
			 ),
			 "description" => ''
		  ),
		  array(
		  	"admin_label" => true,
			 "type" => "dropdown",
			 "class" => "",
			 "heading" => esc_html__("Layout", 'wp-timeline'),
			 "param_name" => "layout",
			 "value" => array(
			 	esc_html__('Horizontal', 'wp-timeline') => 'horizontal',
				esc_html__('Horizontal Steps', 'wp-timeline') => 'hozsteps',
			 ),
			 "description" => ''
		  ),
		  array(
		  	"admin_label" => true,
			 "type" => "posttypes",
			 "class" => "",
			 "heading" => esc_html__("Post types", 'wp-timeline'),
			 "param_name" => "posttype",
			 "value" => array(),
			 "description" => ''
		  ),
		  array(
		  	"admin_label" => true,
			"type" => "textfield",
			"heading" => esc_html__("IDs", "wp-timeline"),
			"param_name" => "ids",
			"value" => "",
			"description" => esc_html__("Specify post IDs to retrieve", "wp-timeline"),
		  ),
		  array(
		  	"admin_label" => true,
			"type" => "textfield",
			"heading" => esc_html__("Count", "wp-timeline"),
			"param_name" => "count",
			"value" => "",
			"description" => esc_html__("Number of posts", 'wp-timeline'),
		  ),
		  
		  
		  array(
		  	"admin_label" => true,
			"type" => "textfield",
			"heading" => esc_html__("Number item visible", "wp-timeline"),
			"param_name" => "slidesshow",
			"value" => "",
			"description" => esc_html__("Enter number", 'wp-timeline'),
		  ),
		  
		  array(
		  	"admin_label" => true,
			"type" => "textfield",
			"heading" => esc_html__("Category", "wp-timeline"),
			"param_name" => "cat",
			"value" => "",
			"description" => esc_html__("List of cat ID (or slug), separated by a comma", "wp-timeline"),
		  ),
		  array(
		  	"admin_label" => true,
			"type" => "textfield",
			"heading" => esc_html__("Tags", "wp-timeline"),
			"param_name" => "tag",
			"value" => "",
			"description" => esc_html__("List of tags, separated by a comma", "wp-timeline"),
		  ),
		  array(
		  	"admin_label" => true,
			"type" => "textfield",
			"heading" => esc_html__("Custom Taxonomy", "wp-timeline"),
			"param_name" => "taxonomy",
			"value" => "",
			"description" => esc_html__("Name of custom taxonomy", "wp-timeline"),
		  ),
		  array(
		  	"admin_label" => true,
			 "type" => "dropdown",
			 "class" => "",
			 "heading" => esc_html__("Order", 'wp-timeline'),
			 "param_name" => "order",
			 "value" => array(
			 	esc_html__('DESC', 'wp-timeline') => 'DESC',
				esc_html__('ASC', 'wp-timeline') => 'ASC',
			 ),
			 "description" => ''
		  ),
		  array(
		  	 "admin_label" => true,
			 "type" => "dropdown",
			 "class" => "",
			 "heading" => esc_html__("Order by", 'wp-timeline'),
			 "param_name" => "orderby",
			 "value" => array(
			 	esc_html__('Date', 'wp-timeline') => 'date',
				esc_html__('Timeline Date', 'wp-timeline') => 'timeline_date',
				esc_html__('ID', 'wp-timeline') => 'ID',
				esc_html__('Author', 'wp-timeline') => 'author',
			 	esc_html__('Title', 'wp-timeline') => 'title',
				esc_html__('Name', 'wp-timeline') => 'name',
				esc_html__('Modified', 'wp-timeline') => 'modified',
			 	esc_html__('Parent', 'wp-timeline') => 'parent',
				esc_html__('Random', 'wp-timeline') => 'rand',
				esc_html__('Comment count', 'wp-timeline') => 'comment_count',
				esc_html__('Menu order', 'wp-timeline') => 'menu_order',
				esc_html__('Meta value', 'wp-timeline') => 'meta_value',
				esc_html__('Meta value num', 'wp-timeline') => 'meta_value_num',
				esc_html__('Post__in', 'wp-timeline') => 'post__in',
				esc_html__('None', 'wp-timeline') => 'none',
			 ),
			 "description" => ''
		  ),
		  array(
		  	"admin_label" => true,
			"type" => "textfield",
			"heading" => esc_html__("Meta key", "wp-timeline"),
			"param_name" => "meta_key",
			"value" => "",
			"description" => esc_html__("Enter meta key to query", "wp-timeline"),
		  ),
		  array(
		  	"admin_label" => true,
			"type" => "textfield",
			"heading" => esc_html__("Meta Value", "wp-timeline"),
			"param_name" => "meta_value",
			"value" => "",
			"description" => esc_html__("Enter meta value to query", "wp-timeline"),
		  ),
		  array(
		  	"admin_label" => true,
			"type" => "textfield",
			"heading" => esc_html__("Slide to start on", "wp-timeline"),
			"param_name" => "start_on",
			"value" => "",
			"description" => esc_html__("Enter number, Default:0", "wp-timeline"),
		  ),
		  array(
		  	"admin_label" => true,
			 "type" => "dropdown",
			 "class" => "",
			 "heading" => esc_html__("Header alignment", "wp-timeline"),
			 "param_name" => "header_align",
			 "value" => array(
			 	esc_html__('Default', 'wp-timeline') => '',
				esc_html__('Center', 'wp-timeline') => 'center',
				esc_html__('Left', 'wp-timeline') => 'left',
			 ),
			 "description" => ''
		  ),
		  array(
		  	"admin_label" => true,
			 "type" => "dropdown",
			 "class" => "",
			 "heading" => esc_html__("Content alignment", "wp-timeline"),
			 "param_name" => "content_align",
			 "value" => array(
			 	esc_html__('Center', 'wp-timeline') => '',
				esc_html__('Left', 'wp-timeline') => 'left',
			 ),
			 "description" => ''
		  ),
		  array(
		  	"admin_label" => true,
			 "type" => "dropdown",
			 "class" => "",
			 "heading" => esc_html__("Arrow buttons position", "wp-timeline"),
			 "param_name" => "arrow_position",
			 "value" => array(
			 	esc_html__('Center', 'wp-timeline') => '',
			 	esc_html__('In timeline bar', 'wp-timeline') => 'top',
			 ),
			 "description" => ""
		  ),
		  array(
		  	"admin_label" => true,
			 "type" => "dropdown",
			 "class" => "",
			 "heading" => esc_html__("Timeline bar position", "wp-timeline"),
			 "param_name" => "toolbar_position",
			 "value" => array(
			 	esc_html__('Top', 'wp-timeline') => 'top',
				esc_html__('Bottom', 'wp-timeline') => 'bottom',
			 ),
			 
			 "description" => ""
		  ),

		  array(
		  	"admin_label" => true,
			 "type" => "dropdown",
			 "class" => "",
			 "heading" => esc_html__("Autoplay", 'wp-timeline'),
			 "param_name" => "autoplay",
			 "value" => array(
			 	esc_html__('No', 'wp-timeline') => '',
				esc_html__('Yes', 'wp-timeline') => '1',
			 ),
			 "description" => ''
		  ),
		  array(
		  	"admin_label" => true,
			 "type" => "textfield",
			 "class" => "",
			 "heading" => esc_html__("Autoplay Speed", "wp-timeline"),
			 "param_name" => "autoplayspeed",
			 "value" => "",
			 "dependency" 	=> array(
				'element' => 'autoplay',
				'value'   => array('1'),
			 ),
			 "description" => esc_html__("Autoplay Speed in milliseconds. Default:3000", "wp-timeline"),
		  ),
		  array(
		  	"admin_label" => true,
			 "type" => "dropdown",
			 "class" => "",
			 "heading" => esc_html__("Show media", "wp-timeline"),
			 "param_name" => "show_media",
			 "value" => array(
			 	esc_html__('Yes', 'wp-timeline') => '1',
				esc_html__('No', 'wp-timeline') => '0',
			 ),
			 "description" => ''
		  ),
		  array(
		  	"admin_label" => true,
			 "type" => "dropdown",
			 "class" => "",
			 "heading" => esc_html__("Show label", "wp-timeline"),
			 "param_name" => "show_label",
			 "value" => array(
			 	esc_html__('No', 'wp-timeline') => '',
			 	esc_html__('Yes', 'wp-timeline') => '1',
			 ),
			 "description" => esc_html__("Show label instead of date on timeline bar", "wp-timeline")
		  ),
		  array(
		  	"admin_label" => true,
			 "type" => "dropdown",
			 "class" => "",
			 "heading" => esc_html__("Show full Content", "wp-timeline"),
			 "param_name" => "full_content",
			 "value" => array(
			 	esc_html__('No', 'wp-timeline') => '',
			 	esc_html__('Instead of Excerpt', 'wp-timeline') => '1',
			 	esc_html__('In Lightbox', 'wp-timeline') => 'lightbox',
			 ),
			 "description" => esc_html__("Show full Content instead of Excerpt or in Lightbox", "wp-timeline")
		  ),
		  
		  array(
		  	"admin_label" => true,
			 "type" => "dropdown",
			 "class" => "",
			 "heading" => esc_html__("Show all items", "wp-timeline"),
			 "param_name" => "show_all",
			 "value" => array(
			 	esc_html__('No', 'wp-timeline') => '',
			 	esc_html__('Yes', 'wp-timeline') => '1',
			 ),
			 "description" => esc_html__("Show all items on timeline bar", "wp-timeline"),
		  ),
		  
		  array(
		  	"admin_label" => true,
			 "type" => "dropdown",
			 "class" => "",
			 "heading" => esc_html__("Hide thubnails", "wp-timeline"),
			 "param_name" => "hide_thumb",
			 "value" => array(
			 	esc_html__('No', 'wp-timeline') => '',
			 	esc_html__('Yes', 'wp-timeline') => '1',
			 ),
			 "description" => ""
		  ),
		  array(
		  	"admin_label" => false,
			"type" => "textfield",
			"heading" => esc_html__("Css Class", "wp-timeline"),
			"param_name" => "class",
			"value" => "",
			"description" => esc_html__("Add a class name and refer to it in custom CSS", "wp-timeline"),
		  ),
		  array(
		  	"admin_label" => true,
			 "type" => "dropdown",
			 "class" => "",
			 "heading" => esc_html__("Enable Loading effect", "wp-timeline"),
			 "param_name" => "loading_effect",
			 "value" => array(
			 	esc_html__('No', 'wp-timeline') => '',
			 	esc_html__('Yes', 'wp-timeline') => '1',
			 ),
			 "description" => ""
		  ),
		  array(
		  	"admin_label" => true,
			 "type" => "dropdown",
			 "class" => "",
			 "heading" => esc_html__("Enable Back to timeline page", "wp-timeline"),
			 "param_name" => "enable_back",
			 "value" => array(
			 	esc_html__('No', 'wp-timeline') => '',
			 	esc_html__('Yes', 'wp-timeline') => 'yes',
			 ),
			 "description" => esc_html__("Only work with timeline post type", "wp-timeline"),
		  ),
		  
		  array(
		  	"admin_label" => true,
			 "type" => "dropdown",
			 "class" => "",
			 "heading" => esc_html__("Infinite", "wp-timeline"),
			 "param_name" => "infinite",
			 "value" => array(
			 	esc_html__('No', 'wp-timeline') => '',
			 	esc_html__('Yes', 'wp-timeline') => 'yes',
			 ),
			 "description" => esc_html__("Infinite loop sliding ( go to first item when end loop)", "wp-timeline"),
		  ),
		  
	   )
	));
	}
}