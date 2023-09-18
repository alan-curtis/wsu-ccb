<?php
include 'class-timeline-post-type.php';
include 'class-timeline-sc-buider.php';
// edit column admin 
add_filter( 'manage_wp-timeline_posts_columns', 'wpex_edit_columns',99 );
function wpex_edit_columns( $columns ) {
	global $wpdb;
	unset($columns['date']);
	$columns['wpex_date'] = esc_html__( 'Timeline Date' , 'wp-timeline' );
	$columns['wpex_ctdate'] = esc_html__( 'Custom Date' , 'wp-timeline' );
	$columns['wpex_order'] = esc_html__( 'Order' , 'wp-timeline' );
	$columns['wpex_color'] = esc_html__( 'Color' , 'wp-timeline' );
	$columns['wpex_icon_adm'] = esc_html__( 'Icon' , 'wp-timeline' );
	$columns['date'] = esc_html__( 'Publish date' , 'wp-timeline' );		
	return $columns;
}
add_action( 'manage_wp-timeline_posts_custom_column', 'wpex_custom_columns',12);
function wpex_custom_columns( $column ) {
	global $post;
	switch ( $column ) {
		case 'wpex_date':
			$wpex_date = wpex_safe_strtotime(get_post_meta( $post->ID, 'wpex_pkdate', true ),'');
			echo '<span>'.esc_attr($wpex_date).'</span>';
			break;
		case 'wpex_ctdate':
			$wpex_customdate = get_post_meta($post->ID, 'wpex_date', true);
			echo '<input type="text" data-id="' . $post->ID . '" name="wpex_timeline_date" value="'.esc_attr($wpex_customdate).'">';
			break;
		case 'wpex_order':
			$wpex_order = get_post_meta($post->ID, 'wpex_order', true);
			echo '<input type="text" data-id="' . $post->ID . '" name="wpex_timeline_sort" value="'.esc_attr($wpex_order).'">';
			break;
		case 'wpex_color':
			$we_eventcolor = get_post_meta($post->ID, 'we_eventcolor', true);
			echo '<span style=" background-color:'.esc_attr($we_eventcolor).'; width: 15px;
    height: 15px; border-radius: 50%; display: inline-block;"></span>';
			break;	
		case 'wpex_icon_adm':
			$wpex_icon = get_post_meta($post->ID, 'wpex_icon', true);
			$wpex_icon_img = get_post_meta( $post->ID, 'wpex_icon_img', true );
			if(!is_numeric($wpex_icon_img)){
				$wpex_icon_img = get_post_meta( $post->ID, 'wpex_icon_img_id', true );
			}
			if($wpex_icon!=''){
				if(exwptl_get_option('exwptl_icon_vers','exwptl_js_css_file_options')!='5'){
					wp_enqueue_style('wpex-font-awesome', WPEX_TIMELINE.'css/font-awesome/css/font-awesome.min.css');
				}else{
					wp_enqueue_style('wpex-font-awesome-5', WPEX_TIMELINE.'css/font-awesome-5/css/all.min.css');
					wp_enqueue_style('wpex-font-awesome-shims', WPEX_TIMELINE.'css/font-awesome-5/css/v4-shims.min.css');
				}
				echo '<span class="wpex-icon-img"><i class="fa '.esc_attr($wpex_icon).'"></i></span>';
			}else if($wpex_icon_img !=''){
				echo '<img class="wpex-icon-img" src="'.esc_url(wp_get_attachment_thumb_url( $wpex_icon_img )).'" style="max-width:80%; height:auto">';
			}
			break;		
	}
}
add_action('wp_ajax_wpex_change_timeline_sort', 'wpex_change_timeline_func' );
function wpex_change_timeline_func(){
	$post_id = $_POST['post_id'];
	$value = $_POST['value'];
	if(isset($post_id) && $post_id != 0)
	{
		update_post_meta($post_id, 'wpex_order', esc_attr(str_replace(' ', '', $value)));
	}
	die;
}
add_action('wp_ajax_wpex_change_timeline_date', 'wpex_change_date_timeline_func' );
function wpex_change_date_timeline_func(){
	$post_id = $_POST['post_id'];
	$value = $_POST['value'];
	if(isset($post_id) && $post_id != 0)
	{
		update_post_meta($post_id, 'wpex_date', $value);
	}
	die;
}
// category custom color column
add_action( 'manage_wpex_category_custom_column', 'extl_category_ct_column',10,3);
function extl_category_ct_column($content,$column_name,$term_id){
	switch ( $column_name ) {
		case '_color':
			$color = get_term_meta($term_id,'extl_cat_color',true);
			echo '<span style=" background-color:'.esc_attr($color).'; width: 15px;
    height: 15px; border-radius: 50%; display: inline-block;"></span>';
			break;	
	}
}
add_filter( 'manage_edit-wpex_category_columns', 'extl_add_cat_columns');
function extl_add_cat_columns($columns){
	$columns['_color'] = esc_html__( 'Color' , 'wp-timeline' );	
	return $columns;
}

add_action( 'init', 'wptl_update_order_new_update' );
if(!function_exists('wptl_update_order_new_update')){
	function wptl_update_order_new_update() {
		 if( isset( $_GET['update_order'] ) && $_GET['update_order'] == 1) {
			 if ( is_user_logged_in() && current_user_can( 'manage_options' )){
				$my_posts = get_posts( array('post_type' => 'wp-timeline', 'numberposts' => -1 ) );
				foreach ( $my_posts as $post ):
					$wpex_pkdate = get_post_meta($post->ID,'wpex_pkdate', true );
					$order_mtk = explode("/",$wpex_pkdate);
					update_post_meta( $post->ID, 'wptl_orderdate', $order_mtk[2].$order_mtk[0].$order_mtk[1] );
				endforeach;
			 }
		 }
	}
}
// update new metadata
add_action( 'init', 'wptl_update_database' );
if(!function_exists('wptl_update_database')){
	function wptl_update_database() {
		if (get_option('wpextl_option_new')!='yes' && is_user_logged_in() && current_user_can( 'manage_options' )){
			// update option page
			$new_option = array(
				'exwptl_color' => get_option( 'wptl_main_color' ),
				'exwptl_font_family' => get_option( 'wptl_fontfamily' ),
				'exwptl_font_size' => get_option( 'wptl_fontsize' ),
				'exwptl_headingfont_family' => get_option( 'wpex_hfont' ),
				'exwptl_headingfont_size' => get_option( 'wpex_hfontsize' ),
				'exwptl_metafont_family' => get_option( 'wpex_metafont' ),
				'exwptl_metafont_size' => get_option( 'wpex_matafontsize' ),
				'exwptl_single_slug' => get_option( 'wpex_timeline_slug' ),
			);
			update_option( 'exwptl_options', $new_option );
			$adv_option = array(
				'exwptl_posttype' => get_option( 'wpex_posttypes' ),
				'exwptl_text_ct' => get_option( 'wpex_text_conread' ),
				'exwptl_text_lm' => get_option( 'wpex_text_loadm' ),
				'exwptl_text_na' => get_option( 'wpex_text_next' ),
				'exwptl_text_pa' => get_option( 'wpex_text_prev' ),
				'exwptl_disable_single' => get_option( 'wpex_disable_link' ),
				'exwptl_disable_social' => get_option( 'wpex_disable_social' ),
				'exwptl_disable_nepre' => get_option( 'wpex_navi' ),
				'exwptl_np_order' => get_option( 'wpex_navi_order' ),
			);
			update_option( 'exwptl_advanced_options', $adv_option );

			$ctcode_option = array(
				'exwptl_custom_css' => get_option( 'wpex_custom_css' ),
				'exwptl_custom_js' => get_option( 'wpex_custom_code' ),
			);
			update_option( 'exwptl_custom_code_options', $ctcode_option );

			$file_option = array(
				'exwptl_css_load' => get_option( 'wpex_load_css' ),
				'exwptl_disable_awesome' => get_option( 'wpex_fontawesome' ),
				'exwptl_icon_vers' => get_option( 'wpex_fontawesome_ver' ),
				'exwptl_disable_ggfont' => get_option( 'wpex_ggfonts' ),
				'exwptl_css_sbs' => get_option( 'wpex_style_sbs' ),
				'exwptl_css_hoz' => get_option( 'wpex_style_hoz' ),
				'exwptl_enable_rtl' => get_option( 'wpex_rtl_mode' ),
			);
			update_option( 'exwptl_js_css_file_options', $file_option );
			//echo '<pre>';print_r($adv_option);exit;
			// update metadata
			$my_posts = get_posts( array('post_type' => 'wp-timeline', 'numberposts' => -1 ) );
			foreach ( $my_posts as $post ):
				// update metadata
				$wpex_custom_metadata = get_post_meta( $post->ID, 'wpex_custom_metadata', false );
				//
				if(isset($wpex_custom_metadata[0]) && !is_array($wpex_custom_metadata[0])){
					delete_post_meta($post->ID, 'wpex_custom_metadata');
					update_post_meta( $post->ID, 'wpex_custom_metadata', $wpex_custom_metadata );
				}
				// update icon
				$old_icon = get_post_meta( $post->ID, 'wpex_icon_img',true );
				if(is_numeric($old_icon)){
					update_post_meta( $post->ID, 'wpex_icon_img', wp_get_attachment_thumb_url( $old_icon ) );
					update_post_meta( $post->ID, 'wpex_icon_img_id', $old_icon );
				}

			endforeach;
			update_option( 'wpextl_option_new', 'yes' );
		}
	}
}


add_action( 'init', 'wptl_convert_from_rlep' );
if(!function_exists('wptl_convert_from_rlep')){
	function wptl_convert_from_rlep() {
		if( isset( $_GET['cv_tlep'] ) && $_GET['cv_tlep'] == 1) {
			if (is_user_logged_in() && current_user_can( 'manage_options' )){
				
				$my_posts = get_posts( array('post_type' => 'te_announcements', 'numberposts' => -1 ) );
				foreach ( $my_posts as $post ):
					set_post_type( $post->ID, 'wp-timeline'  );
					// update metadata
					$date = get_post_meta( $post->ID, 'announcement_date',true );
					if($date!=''){
						update_post_meta( $post->ID, 'wpex_pkdate', date('m/d/Y',$date) );
						update_post_meta( $post->ID, 'wptl_orderdate', date('Ymd',$date) );
					}
					$img_id = get_post_meta( $post->ID, 'announcement_image_id',true );
					if($img_id!=''){
						set_post_thumbnail( $post->ID, $img_id );
					}
					$color = get_post_meta( $post->ID, 'announcement_color',true );
					if($color!=''){
						update_post_meta( $post->ID, 'we_eventcolor', $color );
					}
					$icon = get_post_meta( $post->ID, 'announcement_icon',true );
					if($icon!=''){
						update_post_meta( $post->ID, 'wpex_icon', $icon );
					}
					// update icon
				endforeach;
			}
		}
		if(is_user_logged_in() && current_user_can( 'manage_options' ) && isset($_GET['page']) && $_GET['page']=='exwptl_verify_options' && isset($_GET['delete_license']) && $_GET['delete_license']=='yes' ){
			$_name = exwptl_get_option('exwptl_evt_name','exwptl_verify_options');
			$_pcode = exwptl_get_option('exwptl_evt_pcode','exwptl_verify_options');
			$site = get_site_url();
			$url = 'https://exthemes.net/verify-purchase-code/';
			$data = array('buyer' => $_name, 'code' => $_pcode, 'item_id' =>'17664690', 'site' => $site, 'delete'=>'yes');
			$options = array(
			        'http' => array(
			        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			        'method'  => 'POST',
			        'content' => http_build_query($data),
			    )
			);

			$context  = stream_context_create($options);
			$res = @file_get_contents($url, false, $context);
			delete_option( 'exwptl_verify_options');
			delete_option( 'exwptl_ckforupdate');
			delete_option( 'exwptl_li_mes');
			delete_option( 'exwptl_license');
			delete_option( 'exwptl_cupdate');
			wp_redirect( ( admin_url( '?page=exwptl_verify_options' ) ) );
			die;
		}
	}
}


if(!function_exists('exwptl_check_purchase_code') && is_admin()){
	function exwptl_check_purchase_code() {
		$class = 'notice notice-error';
		$message =  'You are using an unregistered version of WP Timeline, please <a href="'.esc_url(admin_url('admin.php?page=exwptl_verify_options')).'">active your license</a> of WP Timeline to receive support and update';
	
		printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message ); 
	}
	function exwptl_invalid_pr_code() {
		$class = 'notice notice-error';
		$get_mes = get_option( 'exwptl_li_mes');
		$get_mes = $get_mes!='' ? explode('|', $get_mes) : '';
		if(is_array($get_mes) && !empty($get_mes)){
			$message =  'Invalid purchase code for WP Timeline plugin, This license has registered for: '. $get_mes[0] .' - '. $get_mes[1] ;
		}else{
			$message =  'Invalid purchase code for WP Timeline plugin, please find check how to find your purchase code <a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-">here </a>';
		}
	
		printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message ); 
	}
	$scd_ck = get_option( 'exwptl_ckforupdate');
	$crt = strtotime('now');
	$_name = exwptl_get_option('exwptl_evt_name','exwptl_verify_options');
	$_pcode = exwptl_get_option('exwptl_evt_pcode','exwptl_verify_options');
	if($_name=='' || $_pcode==''){
		add_action( 'admin_notices', 'exwptl_check_purchase_code' );
		delete_option( 'exwptl_ckforupdate');
	}
	if($scd_ck=='' || $crt > $scd_ck ){
		$check_version = '';
		global $pagenow;
		if((isset($_GET['page']) && ($_GET['page'] =='exwptl_options' || $_GET['page'] =='exwptl_verify_options' )) || (isset($_GET['post_type']) && $_GET['post_type']=='wp-timeline') || $pagenow == 'plugins.php' ){

			$site = get_site_url();
			$url = 'https://exthemes.net/verify-purchase-code/';
			$myvars = 'buyer=' . $_name . '&code=' . $_pcode. '&site='.$site.'&item_id=17664690';
			$res = '';
			if(function_exists('stream_context_create')){
				$data = array('buyer' => $_name, 'code' => $_pcode, 'item_id' =>'17664690', 'site' => $site);
				$options = array(
				        'http' => array(
				        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				        'method'  => 'POST',
				        'content' => http_build_query($data),
				    )
				);
				$context  = stream_context_create($options);
				$res = @file_get_contents($url, false, $context);
			}
			if($res!=''){
				$res = json_decode($res);
			}else{
				$ch = curl_init( $url );
				curl_setopt( $ch, CURLOPT_POST, 1);
				curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
				curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
				curl_setopt( $ch, CURLOPT_HEADER, 0);
				curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0); 
				curl_setopt($ch, CURLOPT_TIMEOUT, 2);
				$res=json_decode(curl_exec($ch),true);
				curl_close($ch);
			}
			$check_version = isset($res[5]) ? $res[5] : '';
			update_option( 'exwptl_version', $check_version );
			if(isset($res[0]) && $res[0] == 'error' && $_name!='' && $_pcode!=''){
				if(isset($res[2]) && isset($res[2][0]) && $res[2][0] == 'invalid'){
					update_option( 'exwptl_li_mes', $res[2][1][0] );
				}
				update_option( 'exwptl_ckforupdate', strtotime('+5 day'));
				update_option( 'exwptl_license', 'invalid');
			}else if(isset($res[0]) && $res[0] == 'success'){
				update_option( 'exwptl_ckforupdate', strtotime('+15 day') );
				delete_option( 'exwptl_li_mes');
				delete_option( 'exwptl_license');
			}else{
				update_option( 'exwptl_ckforupdate', strtotime('+5 day') );
			}
		}
	}
	if(get_option('exwptl_license') =='invalid'){
		add_action( 'admin_notices', 'exwptl_invalid_pr_code' );
	}
	// update infot
	if( ! function_exists('get_plugin_data') ){
        require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    }
    if (file_exists( WP_PLUGIN_DIR.'/wp-timeline/timeline.php' ) ) {
	    $plugin_data = get_plugin_data( WP_PLUGIN_DIR  . '/wp-timeline/timeline.php' );
	}else{
		$plugin_data = get_plugin_data( WP_PLUGIN_DIR  . '/wp-timelines/timeline.php' );
	}
    $plugin_version = str_replace('.', '',$plugin_data['Version']);
    $check_version = get_option( 'exwptl_version');
    $check_version = $check_version !='' ? str_replace('.', '',$check_version) : '';
    if(strlen($check_version) > strlen($plugin_version)){
    	$plugin_version = is_numeric($plugin_version) ?  $plugin_version *10 : '';
    }else if(strlen($check_version) < strlen($plugin_version)){
    	$check_version = is_numeric($check_version) ?  $check_version *10 : '';
    }
 	if($check_version!='' && $check_version > $plugin_version){
 		add_filter('wp_get_update_data','exwptl_up_count_pl',10);
 		function exwptl_up_count_pl($update_data){
 			$update_data['counts']['plugins'] =  $update_data['counts']['plugins'] + 1;
 			return $update_data;
 		}
 		if (file_exists( WP_PLUGIN_DIR.'/wp-timeline/timeline.php' ) ) {
			add_action( 'after_plugin_row_wp-timeline/timeline.php', 'exwptl_show_purchase_notice_under_plugin', 10 );
		}else{
			add_action( 'after_plugin_row_teampress/wp-timelines.php', 'exwptl_show_purchase_notice_under_plugin', 10 );
		}
		function exwptl_show_purchase_notice_under_plugin(){
			$text = sprintf(
				esc_html__( 'There is a new version of WP Timeline available. %1$s View details %2$s and please check how to update plugin %3$s here%4$s.', 'teampress' ),
					'<a href="https://codecanyon.net/item/wp-timeline-responsive-vertical-and-horizontal-timeline-plugin/17664690#item-description__changelog" target="_blank">',
					'</a>', 
					'<a href="https://exthemes.net/wp-timeline/doc/#install-file" target="_blank">',
					'</a>'
				);
			echo '
			<style>[data-slug="wp-timelines"].active td,[data-slug="wp-timelines"].active th { box-shadow: none;}</style>
			<tr class="plugin-update-tr active">
				<td colspan="4" class="plugin-update">
					<div class="update-message notice inline notice-alt"><p>'.$text.'</p></div>
				</td>
			</tr>';
		}
	}
}

function exwptl_license_infomation(){
	$scd_ck = get_option( 'exwptl_cupdate');
	$crt = strtotime('now');
	$res = '';
	if($scd_ck=='' || $crt > $scd_ck ){
		$_name = exwptl_get_option('exwptl_evt_name','exwptl_verify_options');
		$_pcode = exwptl_get_option('exwptl_evt_pcode','exwptl_verify_options');
		if($_name=='' || $_pcode==''){
			return array('error');
		}
		$site = get_site_url();
		$url = 'https://exthemes.net/verify-purchase-code/';
		$myvars = 'buyer=' . $_name . '&code=' . $_pcode. '&site='.$site.'&item_id=17664690';
		$res = '';
		if(function_exists('stream_context_create')){
			$data = array('buyer' => $_name, 'code' => $_pcode, 'item_id' =>'17664690', 'site' => $site);
			$options = array(
			        'http' => array(
			        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			        'method'  => 'POST',
			        'content' => http_build_query($data),
			    )
			);

			$context  = stream_context_create($options);
			$res = @file_get_contents($url, false, $context);
			if($res=== false){
				$res!='';
			}
		}
		if($res!=''){
			$res = json_decode($res);
		}else{
			$ch = curl_init( $url );
			curl_setopt( $ch, CURLOPT_POST, 1);
			curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
			curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt( $ch, CURLOPT_HEADER, 0);
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0); 
			curl_setopt($ch, CURLOPT_TIMEOUT, 2);
			$res=json_decode(curl_exec($ch),true);
			curl_close($ch);
		}
		//print_r( $res) ;exit;
		if(isset($res[0]) && $res[0] == 'error'){
			update_option( 'exwptl_cupdate', '' );
		}else if(isset($res[0]) && $res[0] == 'success'){
			update_option( 'exwptl_cupdate', strtotime('+10 day') );
		}else{
			update_option( 'exwptl_cupdate', strtotime('+3 day') );
		}
	}
	return $res;
}