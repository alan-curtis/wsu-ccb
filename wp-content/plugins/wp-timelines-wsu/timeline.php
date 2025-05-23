<?php
/*
Plugin Name: WP Timeline
Plugin URI: http://exthemes.net
Description: Responsive Vertical and horizontal timeline plugin
Version: 3.6
Package: Ex 1.0
Author: ExThemes
Author URI: http://exthemes.net
License: Commercial
*/
// Disable Free version when active Pro version
if(!function_exists('wptl_check_liteversion_exists')){
	function wptl_check_liteversion_exists() {
		$class = 'notice notice-error';
		$message = esc_html__( 'You have already installed WP Timeline Pro version, WP Timeline lite version will auto deactivate', 'wp-timeline' );
		printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message ); 
	}
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if (is_plugin_active( 'wp-timeline-lite/timeline.php' ) || class_exists('WPEX_Timeline_Lite')) {
		add_action( 'admin_notices', 'wptl_check_liteversion_exists' );
		deactivate_plugins( '/wp-timeline-lite/timeline.php', true );
		return;
	}
}

define( 'WPEX_TIMELINE', plugin_dir_url( __FILE__ ) );

// Make sure we don't expose any info if called directly
if ( !defined('WPEX_TIMELINE') ){
	die('-1');
}
if(!function_exists('wpex_get_plugin_url')){
	function wpex_get_plugin_url(){
		return plugin_dir_path(__FILE__);
	}
}

function exwptl_get_option( $key = '', $tab=false, $default = false ) {
	if(isset($tab) && $tab!=''){
		$option_key = $tab;
	}else{
		$option_key = 'exwptl_options';
	}
	if ( function_exists( 'cmb2_get_option' ) ) {
		// Use cmb2_get_option as it passes through some key filters.
		return cmb2_get_option( $option_key, $key, $default );
	}
	// Fallback to get_option if CMB2 is not loaded yet.
	$opts = get_option( $option_key, $default );
	$val = $default;
	if ( 'all' == $key ) {
		$val = $opts;
	} elseif ( is_array( $opts ) && array_key_exists( $key, $opts ) && false !== $opts[ $key ] ) {
		$val = $opts[ $key ];
	}
	return $val;
}

class WPEX_Timeline{
	public $template_url;
	public $plugin_path;
	public function __construct()
    {
		$this->includes();
		add_action( 'after_setup_theme', array(&$this, 'calthumb_register') );
		add_action( 'after_setup_theme', array(&$this, 'register_bt') );
		add_action( 'admin_enqueue_scripts', array($this, 'admin_css') );
		add_action( 'wp_enqueue_scripts', array($this, 'frontend_scripts') );
		add_filter( 'template_include', array( $this, 'template_loader' ),999 );
		add_action( 'wp_footer', array( $this,'custom_code'),99 );
		add_action( 'widgets_init', array( $this,'widgets_init') );
		add_action('plugins_loaded',array( $this, 'load_textdomain'));
    }
    // load text domain
    function load_textdomain() {
		$textdomain = 'wp-timeline';
		$locale = '';
		if ( empty( $locale ) ) {
			if ( is_textdomain_loaded( $textdomain ) ) {
				return true;
			} else {
				return load_plugin_textdomain( $textdomain, false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
			}
		} else {
			return load_textdomain( $textdomain, plugin_basename( dirname( __FILE__ ) ) . '/wp-timeline/' . $textdomain . '-' . $locale . '.mo' );
		}
	}
	function widgets_init() {
		register_sidebar( array(
			'name' => esc_html__('WP Timeline','wp-timeline'),
			'id' => 'wptimeline-sidebar',
			'description' => esc_html__('Sidebar for single timeline','wp-timeline'),
			'before_widget' => '<div id="%1$s" class="wptimeline-sidebar widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
	}
	function register_bt(){
		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
	    	return;
		}
		if ( get_user_option('rich_editing') == 'true' ) {
			add_filter( 'mce_external_plugins', array(&$this, 'reg_plugin'));
			add_filter( 'mce_buttons', array(&$this, 'reg_btn') );
		}
	}
	function reg_btn($buttons)
	{
		array_push($buttons, 'wpex_timeline');
		array_push($buttons, 'wpex_timeline_slider');
		return $buttons;
	}

	function reg_plugin($plgs)
	{
		$plgs['wpex_timeline'] 		= WPEX_TIMELINE . 'js/classic-button-timeline.js';
		$plgs['wpex_timeline_slider'] 		= WPEX_TIMELINE . 'js/classic-button-slider.js';
		return $plgs;
	}
	function template_loader($template){
		$find = array('single-timeline.php');
		if(is_singular('wp-timeline')){
			$wpex_disable_link = exwptl_get_option('exwptl_disable_single','exwptl_advanced_options');
			if($wpex_disable_link=='yes'){
				wp_redirect( get_template_part( '404' ) ); exit;
			}
			$file = 'wp-timeline/single-timeline.php';
			$find[] = $file;
			$find[] = $this->template_url . $file;
			if ( $file ) {
				$template = locate_template( $find );
				
				if ( ! $template ) $template = wpex_get_plugin_url() . '/templates/single-timeline.php';
			}
		}
		if(is_post_type_archive( 'wp-timeline' ) || is_tax('wpex_category')){
			wp_redirect( get_template_part( '404' ) ); exit;
		}
		return $template;		
	}
	//thumbnails register
	function calthumb_register(){
		add_image_size('wptl-600x450',600,450, true);
		add_image_size('wptl-320x220',320,220, true);
		add_image_size('wptl-100x100',100,100, true);
	}
	//inculde
	function includes(){
		include_once wpex_get_plugin_url().'inc/admin/functions.php';
		include_once wpex_get_plugin_url().'inc/functions.php';
		include_once wpex_get_plugin_url().'inc/functions-tag.php';
		include wpex_get_plugin_url().'shortcode/timeline.php';
		include wpex_get_plugin_url().'shortcode/timeline-slider.php';
		include wpex_get_plugin_url().'shortcode/timeline-hozizontal.php';
		include wpex_get_plugin_url().'shortcode/timeline-hozizontal-multi.php';
		//$exwptl_infog = exwptl_get_option('exwptl_infog','exwptl_advanced_options');
		$exwptl_infog = get_option('exwptl_advanced_options');
		if(isset($exwptl_infog['exwptl_infog']) && $exwptl_infog['exwptl_infog']=='yes'){
			include wpex_get_plugin_url().'shortcode/timeline-infographics.php';
		}
		/*--Elementor regiter--*/
		if (is_plugin_active( 'elementor/elementor.php' )){
			include_once wpex_get_plugin_url().'inc/class-elementor.php';
		}
		/*--SiteOrigin regiter--*/
		if (is_plugin_active( 'siteorigin-panels/siteorigin-panels.php' )){
			include_once wpex_get_plugin_url().'inc/siteorigin/siteorigin-widget.php';
		}
	}
	/*
	 * Load js and css
	 */
	function admin_css(){
		$js_params = array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) );
		wp_localize_script( 'jquery', 'wpex_timeline', $js_params  );
		// CSS for button styling
		wp_enqueue_style("wpex-admin", WPEX_TIMELINE . 'assets/css/style.css','','3.5');
		wp_enqueue_style( 'wpex-date', WPEX_TIMELINE . 'inc/admin/jquery-timepicker/bootstrap-datepicker.css');
		wp_enqueue_script( 'wpex-date-js', WPEX_TIMELINE . 'inc/admin/jquery-timepicker/bootstrap-datepicker.js', array( 'jquery' ) );		
		wp_enqueue_script( 'wpex-admin', WPEX_TIMELINE . 'assets/js/admin.js', array( 'jquery' ),'3.4.3' );
	}
	function frontend_scripts(){
		$wpex_fontawesome = exwptl_get_option('exwptl_disable_awesome','exwptl_js_css_file_options');
		if($wpex_fontawesome!='on'){
			if(exwptl_get_option('exwptl_icon_vers','exwptl_js_css_file_options')=='5'){
				wp_enqueue_style('wpex-font-awesome-5', WPEX_TIMELINE.'css/font-awesome-5/css/all.min.css');
				wp_enqueue_style('wpex-font-awesome-shims', WPEX_TIMELINE.'css/font-awesome-5/css/v4-shims.min.css');
			}else{
				wp_enqueue_style('wpex-font-awesome', WPEX_TIMELINE.'css/font-awesome/css/font-awesome.min.css');
			}
		}
		
		$main_font_default='Source Sans Pro';
		$g_fonts = array($main_font_default);
		$wptl_fontfamily = exwptl_get_option('exwptl_font_family');
		if($wptl_fontfamily!=''){
			$wptl_fontfamily = wptlex_get_google_font_name($wptl_fontfamily);
			array_push($g_fonts, $wptl_fontfamily);
		}
		$wpex_hfont = exwptl_get_option('exwptl_headingfont_family');
		if($wpex_hfont!=''){
			$wpex_hfont = wptlex_get_google_font_name($wpex_hfont);
			array_push($g_fonts, $wpex_hfont);
		}
		$wpex_ggfonts = exwptl_get_option('exwptl_disable_ggfont','exwptl_js_css_file_options');
		if($wpex_ggfonts!='on'){
			wp_enqueue_style( 'wpex-google-fonts', wptlex_get_google_fonts_url($g_fonts), array(), '1.0.0' );
		}
		wp_register_style('wpex-timeline-css', WPEX_TIMELINE.'css/style.css');
		if(exwptl_get_option('exwptl_css_sbs','exwptl_js_css_file_options')!='on'){
			wp_register_style('wpex-timeline-sidebyside', WPEX_TIMELINE.'css/style-sidebyside.css');
		}
		if(exwptl_get_option('exwptl_css_hoz','exwptl_js_css_file_options')!='on'){
			wp_register_style('wpex-horiz-css', WPEX_TIMELINE.'css/horiz-style.css', array(), '3.2');
		}
		wp_register_style('wpex-single-css', WPEX_TIMELINE.'css/single-timeline.css');
		wp_register_style('wpex-timeline-dark-css', WPEX_TIMELINE.'css/dark.css');
		/*--Custom Css--*/
		ob_start();
		require wpex_get_plugin_url(). '/css/custom.css.php';
		$custom_css = ob_get_contents();
		ob_end_clean();
		wp_add_inline_style( 'wpex-timeline-dark-css', $custom_css );
		/*--End Custom Css--*/
		$wpex_load_css = exwptl_get_option('exwptl_css_load','exwptl_js_css_file_options');
		$wpex_rtl_mode = exwptl_get_option('exwptl_enable_rtl','exwptl_js_css_file_options');
		if(is_singular('wp-timeline')){
			wp_enqueue_style('wpex-single-css');
			wp_add_inline_style( 'wpex-single-css', $custom_css );
		}
		$load_sppages = exwptl_get_option('exwptl_css_load_pages','exwptl_js_css_file_options');
		$load_sppages = $load_sppages!='' ? explode(",",$load_sppages) : array();
		global $post;
		if($wpex_load_css =='page'){
			if(has_shortcode( $post->post_content, 'wpex_timeline')){
				wp_enqueue_style('wpex-timeline-animate', WPEX_TIMELINE.'css/animate.css');
				wp_enqueue_style('wpex-timeline-css');
				wp_enqueue_style('wpex-timeline-sidebyside');
				wp_enqueue_style('wpex-horiz-css');
				wp_enqueue_style('wpex-timeline-dark-css');
				if($wpex_rtl_mode=='yes'){
					wp_enqueue_style('wpex-timeline-rtl-css', WPEX_TIMELINE.'css/rtl.css');
				}
			}
			if(has_shortcode( $post->post_content, 'wpex_timeline_horizontal') || has_shortcode( $post->post_content, 'wpex_timeline_slider')){
				wp_enqueue_style( 'wpex-ex_s_lick', WPEX_TIMELINE .'js/ex_s_lick/ex_s_lick.css');
				wp_enqueue_style( 'wpex-ex_s_lick-theme', WPEX_TIMELINE .'js/ex_s_lick/ex_s_lick-theme.css');
				wp_enqueue_style('wpex-timeline-css');
				wp_enqueue_style('wpex-horiz-css');
				wp_enqueue_style('wpex-timeline-dark-css');
				if($wpex_rtl_mode=='yes'){
					wp_enqueue_style('wpex-timeline-rtl-css', WPEX_TIMELINE.'css/rtl.css');
				}
			}
			if(has_shortcode( $post->post_content, 'wpex_timeline_infog')){
				wp_enqueue_style('wpex-timeline-animate', WPEX_TIMELINE.'css/animate.css');
				wp_enqueue_style('wpex-timeline-css');
				wp_enqueue_style('wpex-timeline-sidebyside');
				wp_enqueue_style('wpex-timeline-dark-css');
				if($wpex_rtl_mode=='yes'){
					wp_enqueue_style('wpex-timeline-rtl-css', WPEX_TIMELINE.'css/rtl.css');
				}
			}
		}elseif($wpex_load_css =='' || ($wpex_load_css =='special_pages' && !empty($load_sppages) && in_array($post->ID, $load_sppages))){
			wp_enqueue_style( 'wpex-ex_s_lick', WPEX_TIMELINE .'js/ex_s_lick/ex_s_lick.css');
			wp_enqueue_style( 'wpex-ex_s_lick-theme', WPEX_TIMELINE .'js/ex_s_lick/ex_s_lick-theme.css');
			wp_enqueue_style('wpex-timeline-animate', WPEX_TIMELINE.'css/animate.css');
			wp_enqueue_style('wpex-timeline-css');
			wp_enqueue_style('wpex-timeline-sidebyside');
			wp_enqueue_style('wpex-horiz-css');
			wp_enqueue_style('wpex-timeline-dark-css');
			if($wpex_rtl_mode=='yes'){
				wp_enqueue_style('wpex-timeline-rtl-css', WPEX_TIMELINE.'css/rtl.css');
			}
		}
	}
	function custom_code() {
		$wpex_custom_code = exwptl_get_option('exwptl_custom_js','exwptl_custom_code_options');
		if($wpex_custom_code!=''){
			echo '<script>'.$wpex_custom_code.'</script>';
		}
	}
}

$WPEX_Timeline = new WPEX_Timeline();