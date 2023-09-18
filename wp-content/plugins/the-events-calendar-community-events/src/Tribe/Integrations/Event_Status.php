<?php

namespace Tribe\Events\Community\Integrations;

/**
 * Handle integration of Event Status add-on.
 *
 *
 * @see \Tribe__Events__Community__Integrations__Manager::load_event_status()
 *
 * @since 4.8.11
 */
class Event_Status {

	/**
	 * Setup the hooks for Event Status integration.
	 *
	 * @since 4.8.11
	 */
	public function hooks() {
		add_action( 'tribe_events_community_form_before_linked_posts', [ $this, 'render_meta_box' ] );
	}

	/**
	 * Handle rendering the event status meta box.
	 *
	 * @since 4.8.11
	 *
	 * @param int|WP_Post $event Event object or ID.
	 */
	public function render_meta_box( $event ) {
		$data = [
			'event' => $event,
		];

		tribe_get_template_part( 'community/modules/event_status', null, $data );
	}

}