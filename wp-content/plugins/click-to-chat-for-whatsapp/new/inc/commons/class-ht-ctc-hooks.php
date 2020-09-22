<?php
/**
 * Hooks
 * @since 2.8
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'HT_CTC_Hooks' ) ) :

class HT_CTC_Hooks {

    public $version = HT_CTC_VERSION;

    public $main_options = '';
    public $other_options = '';

    public function __construct() {
        $this->hooks();
        $this->main_options = get_option('ht_ctc_main_options');
        $this->other_options = get_option('ht_ctc_othersettings');
    }

    private function hooks() {
        // ## Action Hooks ##
        add_action( 'ht_ctc_ah_before_fixed_position', array($this, 'comment') );

        // ## Filter Hooks ##
        add_filter( 'ht_ctc_fh_chat', array($this, 'ht_ctc_chat') );
        add_filter( 'ht_ctc_fh_is_ga_enable', array($this, 'is_ga_enable') );
        add_filter( 'ht_ctc_fh_is_fb_pixel', array($this, 'is_fb_pixel') );
        add_filter( 'ht_ctc_fh_is_fb_an_enable', array($this, 'is_fb_an_enable') );
        add_filter( 'ht_ctc_fh_load_app_js_bottom', array($this, 'load_app_js_bottom') );
        
        // previous metaboxes to new
        add_action( 'ht_ctc_ah_previous_metabox', array($this, 'previous_metabox') );
        
    }

    /**
     * Action Hooks
     */
    
    // comment before floting styles
    function comment() {
        $comment = "<!-- Click to Chat - https://holithemes.com/plugins/click-to-chat/  v$this->version -->";
        echo $comment;
    }


    /**
     * Filter Hooks
     */

     // number format
    function ht_ctc_chat( $ht_ctc_chat ) {

        // Number format
        // if random number feature, this have to modify (ltrim, preg_replace)
        // $ht_ctc_chat['number'] = preg_replace('/[^0-9,\s]/', '', $ht_ctc_chat['number'] );
        if( isset($ht_ctc_chat['number']) ) {
            $ht_ctc_chat['number'] = preg_replace('/\D/', '', $ht_ctc_chat['number'] );
            $ht_ctc_chat['number'] = ltrim( $ht_ctc_chat['number'], '0' );
        }

        return $ht_ctc_chat;
    }


    // is_ga_enable
    function is_ga_enable( $is_ga_enable ) {
        return (isset( $this->main_options['google_analytics'] )) ? 'yes' : $is_ga_enable;
    }

    // is_fb_pixel
    function is_fb_pixel( $is_fb_pixel ) {
        return (isset( $this->main_options['fb_pixel'] )) ? 'yes' : $is_fb_pixel;
    }

    // is_fb_an_enable
    function is_fb_an_enable( $is_fb_an_enable ) {
        return (isset( $this->other_options['fb_analytics'] )) ? 'yes' : $is_fb_an_enable;
    }

    function load_app_js_bottom( $load_app_js_bottom ) {
        
        // compatibility
        // autoptimize cache plugin
        if( class_exists('autoptimizeCache') && method_exists( 'autoptimizeCache', 'clearall') ) {
            $load_app_js_bottom = false;
        }
        return $load_app_js_bottom;
    }


    // update from previous method
	function previous_metabox() {
        
		$post_id = get_the_ID();
		$ht_ctc_pagelevel = get_post_meta( $post_id, 'ht_ctc_pagelevel', true );

		if ( !isset($ht_ctc_pagelevel) || empty($ht_ctc_pagelevel) ) {
			$prev_number = esc_attr( get_post_meta( $post_id, 'ht_ctc_page_number', true ) );
			$prev_number = (isset($prev_number)) ? $prev_number : '';
			$prev_call_to_action = esc_attr( get_post_meta( $post_id, 'ht_ctc_page_call_to_action', true ) );
			$prev_call_to_action = (isset($prev_call_to_action)) ? $prev_call_to_action : '';
			$prev_group_id = esc_attr( get_post_meta( $post_id, 'ht_ctc_page_group_id', true ) );
			$prev_group_id = (isset($prev_group_id)) ? $prev_group_id : '';

			$prev_ht_ctc_pagelevel = array();
			if ( '' !== $prev_number ) {
				$prev_ht_ctc_pagelevel['number'] = $prev_number;
			}
			if ( '' !== $prev_call_to_action ) {
				$prev_ht_ctc_pagelevel['call_to_action'] = $prev_call_to_action;
			}
			if ( '' !== $prev_group_id ) {
				$prev_ht_ctc_pagelevel['group_id'] = $prev_group_id;
			}
			$prev_ht_ctc_pagelevel = array_filter( $prev_ht_ctc_pagelevel );
			if ( !empty( $prev_ht_ctc_pagelevel ) ) {
				update_post_meta( $post_id, 'ht_ctc_pagelevel', $prev_ht_ctc_pagelevel );
			}

			delete_post_meta($post_id, 'ht_ctc_page_number', '' );
			delete_post_meta($post_id, 'ht_ctc_page_call_to_action', '' );
			delete_post_meta($post_id, 'ht_ctc_page_group_id', '' );
		}
    }
    


}

new HT_CTC_Hooks();

endif; // END class_exists check