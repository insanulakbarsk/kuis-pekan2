<?php
/**
 * Meta box
 * change values at page level
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'HT_CTC_MetaBox' ) ) :

class HT_CTC_MetaBox {

	// update from previous method
	function prev_meta() {
		do_action('ht_ctc_ah_previous_metabox');	
	}


	/**
	 * add meta box
	 */
	function meta_box() {
		
		add_meta_box(
			'ht_ctc_settings_meta_box',             // Id.
			'Click to Chat',                        // Title.
			array( $this, 'display_meta_box' ),     // Callback.
			'',                                  	// Post_type.
			'side',                                 // Context.
			'default'                               // Priority.
		);
	}

	/**
	 * render meta box content
	 */
	function display_meta_box( $current_post ) {

		wp_nonce_field( 'ht_ctc_page_meta_box', 'ht_ctc_page_meta_box_nonce' );

		$options = get_option( 'ht_ctc_main_options' );

		$ht_ctc_pagelevel = get_post_meta( $current_post->ID, 'ht_ctc_pagelevel', true );

		?>
			<div class="row">
				<p class="description">Change values at <a target="_blank" href="https://holithemes.com/plugins/click-to-chat/change-values-at-page-level">Page level</a></p>
			</div>
		<?php

		// if chat enabled
		if ( isset( $options['enable_chat'] ) ) {
			$number = ( isset($ht_ctc_pagelevel['number']) ) ? esc_attr($ht_ctc_pagelevel['number']) : '';
			$call_to_action = ( isset($ht_ctc_pagelevel['call_to_action']) ) ? esc_attr($ht_ctc_pagelevel['call_to_action']) : '';
			?>

			<!-- number -->
			<div class="row">
				<label for="number">Chat - WhatsApp Number</label><br>
				<input name="ht_ctc_pagelevel[number]" value="<?php echo $number ?>" id="number" type="text">
				<p class="description"><a style="text-decoration: none" target="_blank" href="https://holithemes.com/plugins/click-to-chat/whatsapp-number/">WhatsApp Number</a> with country code</p>
			</div>

			<!-- call to action -->
			<div class="row">
				<label for="call_to_action">Chat - Call to Action</label><br>
				<input name="ht_ctc_pagelevel[call_to_action]" value="<?php echo $call_to_action ?>" id="call_to_action" type="text">
			</div>

			<?php
			do_action('ht_ctc_ah_admin_chat_bottom_meta_box', $current_post );
		}
		


		// if group enabled
		if ( isset( $options['enable_group'] ) ) {
			$group_id = ( isset($ht_ctc_pagelevel['group_id']) ) ? esc_attr($ht_ctc_pagelevel['group_id']) : '';
			?>

			<!-- group id -->
			<div class="row">
				<label for="group_id">Group - Group ID</label><br>
				<input name="ht_ctc_pagelevel[group_id]" value="<?php echo $group_id ?>" id="group_id" type="text">
				<!-- <p class="description"><a style="text-decoration: none" target="_blank" href="https://holithemes.com/plugins/click-to-chat/whatsapp-number/">WhatsApp Number</a> with country code</p> -->
			</div>

			<?php
		}


	}


	/**
	 * save meta box
	 */
	function save_meta_box( $post_id ) {


		// Check if our nonce is set.
		if ( ! isset( $_POST['ht_ctc_page_meta_box_nonce'] ) ) {
			return;
		}

		$nonce = $_POST['ht_ctc_page_meta_box_nonce'];

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $nonce, 'ht_ctc_page_meta_box' ) ) {
			return;
		}

		// If this is an autosave
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		// Check the user's permissions.
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}

		if ( isset( $_POST['ht_ctc_pagelevel'] ) ) {
			
			$ht_ctc_pagelevel = array_filter( $_POST['ht_ctc_pagelevel'] );

			if ( !empty( $ht_ctc_pagelevel ) ) {

				// sanitize
				foreach ($ht_ctc_pagelevel as $key => $value) {
					if( isset( $ht_ctc_pagelevel[$key] ) ) {
						if ( 'pre_filled' == $key ) {
							$new[$key] = sanitize_textarea_field( $ht_ctc_pagelevel[$key] );
						} elseif ( 'call_to_action' == $key ) {
							$new[$key] = sanitize_text_field( $ht_ctc_pagelevel[$key] );
						} else {
							$new[$key] = sanitize_text_field( $ht_ctc_pagelevel[$key] );
						}
						$ht_ctc_pagelevel[$key] = $new[$key];
					}
				}

				update_post_meta( $post_id, 'ht_ctc_pagelevel', $ht_ctc_pagelevel );
			} else {
				delete_post_meta($post_id, 'ht_ctc_pagelevel', '' );
			}
		}

	}





}

$ht_ctc_metabox = new HT_CTC_MetaBox();

add_action( 'add_meta_boxes', array($ht_ctc_metabox, 'prev_meta') );
add_action( 'add_meta_boxes', array($ht_ctc_metabox, 'meta_box') );
add_action( 'save_post', array($ht_ctc_metabox, 'save_meta_box') );

endif; // END class_exists check