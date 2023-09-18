<?php

/**
 * Handle integration with the Virtual Events add-on.
 *
 * @since4.8.0
 */

use Tribe\Events\Virtual\Assets;
use Tribe\Events\Virtual\Meetings\Zoom_Provider;

/**
 * Handle integration of Community Events and the Virtual Events add-on.
 *
 * Does not run unless Virtual Events add-on is active.
 *
 * @see \Tribe__Events__Community__Integrations__Manager::load_virtual_events_integration()
 *
 * @since4.8.0
 */
class Tribe__Events__Community__Integrations__Virtual_Events {

	/**
	 * Setup the hooks for Virtual Events integration.
	 *
	 * @since4.8.0
	 */
	public function hooks() {
		add_filter( 'tribe_events_virtual_link_allow_generation', [ $this, 'maybe_allow_meeting_link_generation' ] );
		add_action( 'tribe_community_events_enqueue_resources', [ $this, 'enqueue_assets' ] );
		add_action( 'tribe_events_community_form_before_linked_posts', [ $this, 'render_meta_box' ] );
	}

	/**
	 * Maybe allow meeting link generation.
	 *
	 * @since4.8.0
	 *
	 * @param boolean $allow_generation Whether to allow meeting link generation.
	 *
	 * @return boolean Whether to allow meeting link generation.
	 */
	public function maybe_allow_meeting_link_generation( $allow_generation ) {
		if ( false === $allow_generation ) {
			return $allow_generation;
		}

		// Don't allow meeting link generation from the frontend or if they are not a site admin.
		if ( ! is_admin() || ( ! is_super_admin() && ! current_user_can( 'manage_options' ) ) ) {
			return false;
		}

		return $allow_generation;
	}

	/**
	 * Method to determine whether or not Virtual Event assets need to be enqueued.
	 *
	 * @since 4.8.9
	 * @return boolean
	 */
	private function should_enqueue_assets() {
		// If on the CE event page, return true.
		if ( tribe_is_community_edit_event_page() ) {
			return true;
		}

		// If current page is not a page or post, return false.
		$post = get_queried_object();
		if ( ! $post instanceof WP_Post ) {
			return false;
		}

		// Return if current page/post has the [tribe_community_events] shortcode.
		return has_shortcode( $post->post_content, 'tribe_community_events' );
	}

	/**
	 * Handle enqueuing the assets for Virtual Events.
	 *
	 * @since 4.8.0
	 * @since 4.8.3 Enqueue Zoom Admin CSS and JS, if appropriate.
	 */
	public function enqueue_assets() {
		if ( ! $this->should_enqueue_assets() ) {
			return;
		}

		// VE's 'admin' CSS and JS are required for CE's front-end.
		$assets_to_enqueue = [
			'tribe-events-virtual-admin-css',
			'tribe-events-virtual-admin-js',
		];

		/** @var Zoom_Provider $zoom */
		$zoom = tribe( Zoom_Provider::class );

		/**
		 * @see \Tribe\Events\Virtual\Meetings\Zoom_Provider::register() Replicate that logic.
		 */
		if ( $zoom->is_enabled() ) {
			$assets_to_enqueue[] = 'tribe-events-virtual-zoom-admin-style';
			$assets_to_enqueue[] = 'tribe-events-virtual-zoom-admin-js';
		}

		tribe_asset_enqueue( $assets_to_enqueue );

		tribe_asset_enqueue_group( Assets::$group_key );
	}

	/**
	 * Handle rendering the Virtual Events meta box.
	 *
	 * @since4.8.0
	 *
	 * @param int|WP_Post $event Event object or ID.
	 */
	public function render_meta_box( $event ) {
		$data = [
			'event' => $event,
		];

		tribe_get_template_part( 'community/modules/virtual', null, $data );
	}
}
