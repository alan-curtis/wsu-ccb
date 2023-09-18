<?php
if(!class_exists('WPTL_Timeline_Infographics')){
	
	class WPTL_Timeline_Infographics {
		public function __construct() {
			add_action( 'wp_enqueue_scripts', array($this, 'frontend_scripts') );
			add_shortcode( 'wpex_timeline_infog', array( $this,'parse_timeline_infographics') );
			add_action( 'after_setup_theme', array( $this,'timeline_info_vc'),999 );
		}
		function frontend_scripts(){
			wp_enqueue_style('wpex-infgrapihcs', WPEX_TIMELINE.'css/style-infographics.css', array(), '1.0');
		}
		function parse_timeline_infographics($atts, $content){
			global $style,$ajax_load,$ID,$animations, $posttype,$show_media, $taxonomy,$full_content,$feature_label,$lightbox,$hide_img,$img_size,$hide_title,$back_p;
			$ajax_load = 0;
			$atts['SC'] = 'ifgr'; 
			$atts['ID'] = $ID = isset($atts['ID']) ? $atts['ID'] : rand(10,9999);
			$atts['style'] = $style = isset($atts['style']) && is_numeric($atts['style'])!='' ? $atts['style'] : '1';
			$atts['posttype'] = $posttype 		= isset($atts['posttype']) && $atts['posttype']!='' ? $atts['posttype'] : 'wp-timeline';
			$cat 		= isset($atts['cat']) ? $atts['cat'] : '';
			$tag 	= isset($atts['tag']) ? $atts['tag'] : '';
			$ids 		= isset($atts['ids']) ? $atts['ids'] : '';
			$count 		= isset($atts['count']) ? $atts['count'] : '9';
			$posts_per_page 		= isset($atts['posts_per_page']) ? $atts['posts_per_page'] : '6';
			$order 	= isset($atts['order']) ? $atts['order'] : '';
			$orderby 	= isset($atts['orderby']) ? $atts['orderby'] : '';
			$meta_key 	= isset($atts['meta_key']) ? $atts['meta_key'] : '';
			$meta_value 	= isset($atts['meta_value']) ? $atts['meta_value'] : '';
			$show_media 		= isset($atts['show_media']) ? $atts['show_media'] : '1';
			$feature_label 		= isset($atts['feature_label']) ? $atts['feature_label'] : '';
			$hide_title 		= isset($atts['hide_title']) ? $atts['hide_title'] : '';
			$hide_img 		= isset($atts['hide_thumb']) ? $atts['hide_thumb'] : '';
			$img_size 		= isset($atts['img_size']) ? $atts['img_size'] : '';
			$full_content 		= isset($atts['full_content']) ? $atts['full_content'] : '0';	
			$lightbox 		= isset($atts['lightbox']) ? $atts['lightbox'] : '0';
			$page_navi 		= isset($atts['page_navi']) ? $atts['page_navi'] : '0';
			$infinite 		=  $page_navi=='inf' ? '1' : '0';
			$filter_cat 		= isset($atts['filter_cat']) ? $atts['filter_cat'] : '';
			$active_filter   = isset($atts['active_filter']) ? $atts['active_filter'] : '';
			$start_label 		= isset($atts['start_label']) ? $atts['start_label'] : '';
			$end_label 		= isset($atts['end_label']) ? $atts['end_label'] : '';
			$animations 		= isset($atts['animations']) ? $atts['animations'] : '';
			$class 		= isset($atts['class']) ? $atts['class'] : '';
			$taxonomy 		= isset($atts['taxonomy']) ? $atts['taxonomy'] : '';
			$enable_back 		= isset($atts['enable_back']) ? $atts['enable_back'] : '';
			$show_history 		= isset($atts['show_history']) ? $atts['show_history'] : '';
			$back_p ='';
			if($enable_back=='yes'){
				global $wp_query; $page_idcr =  $wp_query->queried_object_id;
				$back_p 		= isset($atts['back_p']) ? $atts['back_p'] : $page_idcr;
				if(!isset($atts['back_p']) || $atts['back_p']==''){ $atts['back_p'] = $back_p;}
			}
			if($posts_per_page =="" || $posts_per_page > $count){$posts_per_page = $count;}
			$cat_ft = $cat;
			if(isset($active_filter) && $active_filter!=''){ $cat = $active_filter;}
			$args = wpex_timeline_query($posttype, $posts_per_page, $order, $orderby, $cat, $tag, $taxonomy, $meta_key, $ids,false,false, $meta_value);
			ob_start();
			if($page_navi=='pag'){
				$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
				$args['paged'] = $paged;
			}
			$the_query = new WP_Query( $args );
			$it = $the_query->found_posts;
			$css_class = '';
			if($it < $count || $count=='-1'){ $count = $it;}
			if($count  > $posts_per_page){
				$num_pg = ceil($count/$posts_per_page);
				$it_ep  = $count%$posts_per_page;
			}else{
				$num_pg = 1;
				$css_class .= ' no-more';
			}
			if($end_label==''){
				$css_class .= ' no-end';
			}
			if($class!=''){
				$css_class .= ' '.$class;
			}
			if($infinite == 1){ $css_class .= ' wpex-infinite';}
			$wpex_load_css = exwptl_get_option('exwptl_css_load','exwptl_js_css_file_options');
			$wpex_rtl_mode = exwptl_get_option('exwptl_enable_rtl','exwptl_js_css_file_options');
			if($wpex_load_css =='shortcode'){
				wp_enqueue_style('wpex-timeline-animate', WPEX_TIMELINE.'css/animate.css');
				wp_enqueue_style('wpex-timeline-css');
				wp_enqueue_style('wpex-timeline-sidebyside');
				wp_enqueue_style('wpex-timeline-dark-css');
				if($wpex_rtl_mode=='yes'){
					wp_enqueue_style('wpex-timeline-rtl-css', WPEX_TIMELINE.'css/rtl.css');
				}
			}
			if($full_content=='lightbox'){
				wp_enqueue_style('extl-lightbox', WPEX_TIMELINE .'css/glightbox.css','1.0');
				wp_enqueue_script( 'extl-lightbox', WPEX_TIMELINE .'js/glightbox.min.js', array( 'jquery' ),'1.0', true );
				$lightbox = 0;
			}
			if($lightbox==1){
				$css_class .= ' wptl-lightbox';
				wp_enqueue_style( 'wpex-ex_s_lick', WPEX_TIMELINE .'js/ex_s_lick/ex_s_lick.css');
				wp_enqueue_style( 'wpex-ex_s_lick-theme', WPEX_TIMELINE .'js/ex_s_lick/ex_s_lick-theme.css');
				wp_enqueue_style( 'wpex-lightbox', WPEX_TIMELINE .'js/ex_s_lick/slick-lightbox.css');
				wp_enqueue_script( 'wpex-ex_s_lick', WPEX_TIMELINE.'js/ex_s_lick/ex_s_lick.js', array( 'jquery' ) );
				wp_enqueue_script( 'wpex-lightbox', WPEX_TIMELINE.'js/ex_s_lick/slick-lightbox.js', array( 'jquery' ) );
			}
			wp_enqueue_script( 'wpex-timeline', WPEX_TIMELINE.'js/template.min.js', array( 'jquery' ),'3.5.7' );
			if($the_query->have_posts()){?>
		    	<div class="wpifgr-timeline ifgr-fline <?php echo esc_attr($css_class .' inf-stl-'.$style);?>" id="timeline-<?php echo esc_attr($ID);?>" data-animations="<?php echo esc_attr($animations);?>" data-rtl="<?php echo esc_attr($wpex_rtl_mode)?>">
		        	<div class="wpex-loading">
		                <div class="wpex-spinner">
		                    <div class="rect1"></div><div class="rect2"></div>
		                    <div class="rect3"></div><div class="rect4"></div>
		                    <div class="rect5"></div>
		                </div>
		            </div>
		        	<?php 
					if($filter_cat == '1'){

						echo '
						<div class="wpex-timeline-list">
						<input type="hidden"  name="param_query" value="'.esc_html(str_replace('\/', '/', json_encode($args))).'">
						<input type="hidden" name="param_shortcode" value="'.esc_html(str_replace('\/', '/', json_encode($atts))).'">
						<input type="hidden"  name="ajax_url" value="'.esc_url(admin_url( 'admin-ajax.php' )).'">
						';
						wpex_filterby_cat($taxonomy,$cat_ft,$ID,$active_filter);
						echo '</div>';
					}?>
					<?php if($start_label!=''){?>
		            	<div class="extl-info-start wpex-tltitle wpex-loadmore">
		            		<span><?php echo extl_dataes($start_label);?></span>
		            	</div>
		            <?php }
		            $nbp = $the_query->post_count;
		            $clss_p = '';
		            if($nbp%2 == 0){
		            	$clss_p = 'exif-nb-even';
		            }
		            ?>
		            <ul class="infogr-list <?php echo esc_attr($clss_p);?>">
						<?php 
						$ft_date ='';
						$i=0;
						while($the_query->have_posts()){ $the_query->the_post();
							$i++;
							$posttypes = exwptl_get_option('exwptl_posttype','exwptl_advanced_options');
							if($posttype == 'wp-timeline' || (is_array($posttypes) && in_array($posttype,$posttypes))){
								$wpex_date = wpex_date_tl();
							}else{
								$wpex_date = get_the_date( get_option( 'date_format' ) );
							}
							$date_inft = apply_filters( 'wptimeline_date_in_ft', $wpex_date, $posttype);
							if($i==1){
								if($date_inft!=''){
									$ft_date .='<span class="active" id="filter-'.$ID.'_'.get_the_ID().'">'.$date_inft.'</span>';
								}
							}else{
								if($date_inft!=''){
									$ft_date .='<span id="filter-'.$ID.'_'.get_the_ID().'">'.$date_inft.'</span>';
								}
							}
							wpex_template_plugin('content-infog-'.$style);
						}?>
		            </ul>
		            <?php 
					if($posts_per_page<$count){
						if($page_navi=='pag'){
							if($end_label!='' && $paged == $the_query->max_num_pages){
								echo '<div class="wpex-loadmore wpex-endlabel"><span>'.$end_label.'</span></div>';
							}
							wptl_timeline_pagenavi($the_query);
						}else{
							$loadtrsl = exwptl_get_option('exwptl_text_lm','exwptl_advanced_options')!='' ? exwptl_get_option('exwptl_text_lm','exwptl_advanced_options') : esc_html__('Load more','wp-timeline');
							$wpml_crr = '';
							if (class_exists('SitePress')){
								global $sitepress;
								$wpml_crr = $sitepress->get_current_language();
							}
							echo '
								<div class="exif-loadmore wpex-loadmore lbt">
									<input type="hidden"  name="id_grid" value="timeline-'.$ID.'">
									<input type="hidden"  name="num_page" value="'.$num_pg.'">
									<input type="hidden"  name="num_page_uu" value="1">
									<input type="hidden"  name="current_page" value="1">
									<input type="hidden"  name="ajax_url" value="'.esc_url(admin_url( 'admin-ajax.php' )).'">
									<input type="hidden"  name="param_query" value="'.esc_html(str_replace('\/', '/', json_encode($args))).'">
									<input type="hidden" id="param_shortcode" name="param_shortcode" value="'.esc_html(str_replace('\/', '/', json_encode($atts))).'">
									<input type="hidden"  name="tl_language" value="'.$wpml_crr.'">
									<a  href="javascript:void(0)" class="loadmore-timeline" data-id="timeline-'.$ID.'">
										<span class="load-tltext">'.$loadtrsl.'</span><span></span>&nbsp;<span></span>&nbsp;<span></span>
									</a>';
							echo'</div>';
						}
					}
					if($end_label!='' && $page_navi!='pag' || ($page_navi=='pag' && $posts_per_page >= $count) ){
						echo '<div class="extl-info-end wpex-loadmore wpex-endlabel"><span>'.$end_label.'</span></div>';
					}
					// History bar
					if($show_history == 1 && $ft_date!=''){
						echo '
						<div class="wpex-filter">
							<span class="fa fa-angle-double-left" data-id="timeline-'.$ID.'"></span>
							<div>'.$ft_date.'</div>
						</div>';
					}elseif($show_history == 2){
						echo '
						<input type="hidden"  name="param_query" value="'.esc_html(str_replace('\/', '/', json_encode($args))).'">
						<input type="hidden" name="param_shortcode" value="'.esc_html(str_replace('\/', '/', json_encode($atts))).'">
						<input type="hidden"  name="ajax_url" value="'.esc_url(admin_url( 'admin-ajax.php' )).'">
						';
						echo '
						<div class="wpex-filter year-ft">
							<span class="fa fa-angle-double-left" data-id="timeline-'.$ID.'"></span>
							<div>'.wpex_filterby_year($year,$ID).'</div>
						</div>';
					}
					?>
		        </div>
				<?php
			}
			wp_reset_postdata();
			$output_string = ob_get_contents();
			ob_end_clean();
			return $output_string;
		}

		function timeline_info_vc(){
			if(function_exists('vc_map')){
			vc_map( array(
			   "name" => esc_html__("WP Timeline Infographics", "wp-timeline"),
			   "base" => "wpex_timeline_infog",
			   "class" => "",
			   "icon" => "icon-timeline",
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
					 	esc_html__('1', 'wp-timeline') => '1',
						esc_html__('2', 'wp-timeline') => '2',
						esc_html__('3', 'wp-timeline') => '3',
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
					"heading" => esc_html__("Posts per page", "wp-timeline"),
					"param_name" => "posts_per_page",
					"value" => "",
					"description" => esc_html__("Number item per page", 'wp-timeline'),
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
					 "heading" => esc_html__("Order", "wp-timeline"),
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
					"heading" => esc_html__("Start label", "wp-timeline"),
					"param_name" => "start_label",
					"value" => "",
					"description" => '',
				  ),
				  array(
				  	"admin_label" => true,
					"type" => "textfield",
					"heading" => esc_html__("End label", "wp-timeline"),
					"param_name" => "end_label",
					"value" => "",
					"description" => '',
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
				  /*array(
				  	"admin_label" => true,
					 "type" => "dropdown",
					 "class" => "",
					 "heading" => esc_html__("Show history bar", "wp-timeline"),
					 "param_name" => "show_history",
					 "value" => array(
					 	esc_html__('No', 'wp-timeline') => '',
					 	esc_html__('Yes', 'wp-timeline') => '1',
					 ),
					 "description" => ''
				  ),*/
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
					 "heading" => esc_html__("Show Filter by category", "wp-timeline"),
					 "param_name" => "filter_cat",
					 "value" => array(
					 	esc_html__('No', 'wp-timeline') => '',
					 	esc_html__('Yes', 'wp-timeline') => '1',
					 ),
					 "description" => ''
				  ),
				  array(
				  	"admin_label" => true,
					"type" => "textfield",
					"heading" => esc_html__("Active filter", "wp-timeline"),
					"param_name" => "active_filter",
					"value" => "",
					"description" => esc_html__("Enter slug of category to active", "wp-timeline"),
				  ),
				  array(
				  	"admin_label" => true,
					 "type" => "dropdown",
					 "class" => "",
					 "heading" => esc_html__("Show Feature label", "wp-timeline"),
					 "param_name" => "feature_label",
					 "value" => array(
					 	esc_html__('No', 'wp-timeline') => '',
					 	esc_html__('Yes', 'wp-timeline') => '1',
					 ),
					 "description" => ''
				  ),
				  array(
				  	"admin_label" => true,
					 "type" => "dropdown",
					 "class" => "",
					 "heading" => esc_html__("Hide Title", "wp-timeline"),
					 "param_name" => "hide_title",
					 "value" => array(
					 	esc_html__('No', 'wp-timeline') => '',
					 	esc_html__('Yes', 'wp-timeline') => '1',
					 ),
					 "description" => ''
				  ),
				  array(
				  	"admin_label" => true,
					 "type" => "dropdown",
					 "class" => "",
					 "heading" => esc_html__("Hide Featured Image", "wp-timeline"),
					 "param_name" => "hide_thumb",
					 "value" => array(
					 	esc_html__('No', 'wp-timeline') => '',
					 	esc_html__('Yes', 'wp-timeline') => '1',
					 ),
					 "description" => ''
				  ),
				  array(
				  	 "admin_label" => false,
					 "type" => "dropdown",
					 "class" => "",
					 "heading" => esc_html__("Animations", 'wp-timeline'),
					 "param_name" => "animations",
					 "value" => array(
					 	esc_html__('None', 'wp-timeline') => '',
						esc_html__('bounce', 'wp-timeline') => 'bounce',
						esc_html__('flash', 'wp-timeline') => 'flash',
						esc_html__('pulse', 'wp-timeline') => 'pulse',
					 	esc_html__('rubberBand', 'wp-timeline') => 'rubberBand',
						esc_html__('shake', 'wp-timeline') => 'shake',
						esc_html__('headShake', 'wp-timeline') => 'headShake',
					 	esc_html__('swing', 'wp-timeline') => 'swing',
						esc_html__('tada', 'wp-timeline') => 'tada',
						esc_html__('wobble', 'wp-timeline') => 'wobble',
						esc_html__('jello', 'wp-timeline') => 'jello',
						esc_html__('bounceIn', 'wp-timeline') => 'bounceIn',
						esc_html__('bounceInDown', 'wp-timeline') => 'bounceInDown',
						esc_html__('bounceInLeft', 'wp-timeline') => 'bounceInLeft',
						esc_html__('bounceInRight', 'wp-timeline') => 'bounceInRight',
						esc_html__('bounceInUp', 'wp-timeline') => 'bounceInUp',
						esc_html__('fadeIn', 'wp-timeline') => 'fadeIn',
						esc_html__('fadeInDown', 'wp-timeline') => 'fadeInDown',
						esc_html__('fadeInDownBig', 'wp-timeline') => 'fadeInDownBig',
						esc_html__('fadeInLeft', 'wp-timeline') => 'fadeInLeft',
						esc_html__('fadeInLeftBig', 'wp-timeline') => 'fadeInLeftBig',
						esc_html__('fadeInRight', 'wp-timeline') => 'fadeInRight',
						esc_html__('fadeInRightBig', 'wp-timeline') => 'fadeInRightBig',
						esc_html__('fadeInUp', 'wp-timeline') => 'fadeInUp',
						esc_html__('fadeInUpBig', 'wp-timeline') => 'fadeInUpBig',
						esc_html__('flipInX', 'wp-timeline') => 'flipInX',
						esc_html__('flipInY', 'wp-timeline') => 'flipInY',
						esc_html__('lightSpeedIn', 'wp-timeline') => 'lightSpeedIn',
						esc_html__('rotateIn', 'wp-timeline') => 'rotateIn',
						esc_html__('rotateInDownLeft', 'wp-timeline') => 'rotateInDownLeft',
						esc_html__('rotateInDownRight', 'wp-timeline') => 'rotateInDownRight',
						esc_html__('rotateInUpLeft', 'wp-timeline') => 'rotateInUpLeft',
						esc_html__('rotateInUpRight', 'wp-timeline') => 'rotateInUpRight',
						esc_html__('bounceInRight', 'wp-timeline') => 'bounceInRight',
						esc_html__('rollIn', 'wp-timeline') => 'rollIn',
						esc_html__('zoomIn', 'wp-timeline') => 'zoomIn',
						esc_html__('zoomInDown', 'wp-timeline') => 'zoomInDown',
						esc_html__('zoomInLeft', 'wp-timeline') => 'zoomInLeft',
						esc_html__('zoomInRight', 'wp-timeline') => 'zoomInRight',
						esc_html__('zoomInUp', 'wp-timeline') => 'zoomInUp',
						esc_html__('slideIn', 'wp-timeline') => 'slideIn',
						esc_html__('slideInDown', 'wp-timeline') => 'slideInDown',
						esc_html__('slideInLeft', 'wp-timeline') => 'slideInLeft',
						esc_html__('slideInRight', 'wp-timeline') => 'slideInRight',
						esc_html__('bounceInRight', 'wp-timeline') => 'bounceInRight',
					 ),
					 "description" => ''
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
					 "heading" => esc_html__("Image size", "wp-timeline"),
					 "param_name" => "img_size",
					 "value" => array(
					 	esc_html__('Default', 'wp-timeline') => '',
					 	esc_html__('Full', 'wp-timeline') => 'full',
					 ),
					 "description" => ''
				  ),
				  array(
				  	"admin_label" => true,
					 "type" => "dropdown",
					 "class" => "",
					 "heading" => esc_html__("Enable image lightbox", "wp-timeline"),
					 "param_name" => "lightbox",
					 "value" => array(
					 	esc_html__('No', 'wp-timeline') => '',
					 	esc_html__('Yes', 'wp-timeline') => '1',
					 ),
					 "description" => ''
				  ),
				  array(
				  	"admin_label" => true,
					 "type" => "dropdown",
					 "class" => "",
					 "heading" => esc_html__("Page navigation", "wp-timeline"),
					 "param_name" => "page_navi",
					 "value" => array(
					 	esc_html__('Load more', 'wp-timeline') => '',
					 	esc_html__('Infinite Scroll', 'wp-timeline') => 'inf',
						esc_html__('Page links', 'wp-timeline') => 'pag',
					 ),
					 "description" => ''
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
			   )
			));
			}
		}
	}
}
new WPTL_Timeline_Infographics();

if(!function_exists('exifgr_custom_css')){
	function exifgr_custom_css($main_color,$fontfamily,$ctcolor,$fontsize,$hdcolor,$hfont,$hfontsize,$metafont,$matafontsize,$disable_link){
		ob_start();
		if($main_color!=''){?>
			.wpifgr-timeline.ifgr-fline .infogr-list > li:nth-child(even) .tlif-contai, .wpifgr-timeline.ifgr-fline .infogr-list > li:nth-child(even) .tlif-contai:before, .wpifgr-timeline.ifgr-fline .infogr-list > li:nth-child(odd) .tlif-contai, .wpifgr-timeline.ifgr-fline .infogr-list > li:nth-child(odd) .tlif-contai:after, .wpifgr-timeline.ifgr-fline .infogr-list > li .tlif-content:before, .wpifgr-timeline.ifgr-fline .infogr-list > li:nth-child(even) .tlif-contai:after, .wpifgr-timeline.ifgr-fline .infogr-list > li:last-child .tlif-content:after, .wpifgr-timeline.ifgr-fline .infogr-list > li:nth-child(odd) .tlif-contai:before,
			.wpifgr-timeline.inf-stl-1 .tlif-img,
			.wpifgr-timeline .infogr-list .tlif-readmore a,
			ul.infogr-list.exif-nb-even + .extl-info-end.wpex-loadmore span:after,
			ul.infogr-list.exif-nb-even + .hidden + .extl-info-end.wpex-loadmore span:after,
			ul.infogr-list.exif-nb-even + .exif-loadmore .loadmore-timeline:after,
			.wpifgr-timeline .infogr-list li:nth-child(even) .tlif-readmore a,
			.wpifgr-timeline.inf-stl-2 .infogr-list > li .tlif-img span.tlif-icon,
			.wpifgr-timeline.inf-stl-2 li .tlif-img > a,
			.wpifgr-timeline.inf-stl-2 li .tlif-img > .tlif-media,
			.wpifgr-timeline.inf-stl-3 .infogr-list a.tlif-img-link,
			.wpifgr-timeline.inf-stl-1 .infogr-list > li .tlif-content .tlif-media,
			.exif-loadmore.wpex-loadmore .loadmore-timeline:after, .extl-info-end.wpex-loadmore span:after, .extl-info-start.wpex-tltitle.wpex-loadmore span:after{ border-color: <?php echo esc_html($main_color);  ?>;}
			.wpifgr-timeline.inf-stl-1 .tlif-img,
			.wpifgr-timeline.inf-stl-3 span.tlif-icon, .wpifgr-timeline.inf-stl-1 span.tlif-icon{background: <?php echo esc_html($main_color);  ?>}
			.wpifgr-timeline.inf-stl-2 .infogr-list > li .tlif-img span.tlif-icon,
			.wpifgr-timeline .infogr-list > li .tlif-content .tlif-info span.tll-date{ color:<?php echo esc_html($main_color);  ?>}

			<?php
		}
		if($fontfamily!=''){?>
			.wpifgr-timeline{font-family: "<?php echo esc_html($fontfamily);?>", sans-serif;}
			<?php
		}
		if($ctcolor!=''){?>
			.wpifgr-timeline{color: <?php echo esc_html($ctcolor);?>;}
			<?php
		}
		if($fontsize!=''){?>
			.wpifgr-timeline{font-size: <?php echo esc_html($fontsize);?>;}
			<?php
		}
		if($hdcolor!=''){?>
			.wpifgr-timeline .tlif-title{color: <?php echo esc_html($hdcolor);?>;}
			<?php
		}
		if($hfont!=''){?>
			.wpifgr-timeline .tlif-title{font-family: <?php echo esc_html($hfont);?>;}
			<?php
		}
		if($hfontsize!=''){?>
			.wpifgr-timeline .tlif-title{font-size: <?php echo esc_html($hfontsize);?>;}
			<?php
		}

		if($metafont!=''){?>
			.wpifgr-timeline .tlif-readmore{font-family: <?php echo esc_html($metafont);?>;}
			<?php
		}
		if($matafontsize!=''){?>
			.wpifgr-timeline .tlif-readmore{font-size: <?php echo esc_html($matafontsize);?>;}
			<?php
		}
		if($disable_link=='yes'){?>
			.wpifgr-timeline .tlif-readmore{ display:none;}
			.wpifgr-timeline .infogr-list h2 a{pointer-events: none;}
			<?php 
		}
		$output_string = ob_get_contents();
		ob_end_clean();
		return $output_string;
	}
}