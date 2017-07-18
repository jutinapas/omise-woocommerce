<?php
defined( 'ABSPATH' ) or die( "No direct script access allowed." );

if ( ! class_exists( 'Omise_Messenger_Bot_User_Service' ) ) {
	class Omise_Messenger_Bot_User_Service {		
		private function __construct() {
			// Hide the constructor
		}

		public static function get_user( $sender_id ) {
			$user = get_user_by( 'login', $sender_id );

			if ($user) {
				return $user->data;
			}

			$fb_profile = self::get_fb_profile( $sender_id );
			if ( ! $fb_profile ) 
				return NULL;

			$wp_user = self::create_wp_user( $fb_profile );
			if ( ! $wp_user )
				return NULL;

			return $wp_user; 
		}

		public static function get_fb_profile( $sender_id ) {
			$fb_graph_url = "https://graph.facebook.com/v2.6/<USER_ID>?fields=first_name, last_name, profile_pic, locale, timezone, gender&access_token=<PAGE_ACCESS_TOKEN>";

			$settings = Omise_Util::get_settings();
      if ( ! isset( $settings ) )
        return;

			if ( ! isset( $settings['facebook_page_verify_token'] ) ) {
				error_log( "Can't get user profile from facebook because facebook page access token is null" );
				return NULL;
			}

			$facebook_page_access_token = $settings['facebook_page_access_token'];

			$url = str_replace( array( '<USER_ID>', '<PAGE_ACCESS_TOKEN>' ), array( $sender_id, $facebook_page_access_token ), $fb_graph_url );

			$fb_profile = wp_remote_get( $url );

			if ( is_wp_error( $fb_profile ) || $fb_profile['response']['code'] !== 200 ) {
				error_log( print_r( $fb_profile->error, true ) );
				return NULL;
			} 

			$fb_profile = json_decode( $fb_profile['body'], true );
			$fb_profile['username'] = $sender_id;
			return $fb_profile;
		}

		protected static function create_wp_user( $fb_profile ) {
			$wp_username_exists = username_exists( $fb_profile['username'] );

			if( $wp_username_exists ) {
				return get_user_by( 'login', $fb_profile['username'] );
			}

			$random_password = wp_generate_password( $length = 12, $include_standard_special_chars = true );

			$wp_user = array(
				"user_pass" => $random_password,
				"user_login" => $fb_profile['username'],
				"first_name" => $fb_profile['first_name'],
				"last_name" => $fb_profile['last_name'],
			);

			$user_id = wp_insert_user( $wp_user );

			if ( is_wp_error( $user_id ) ) {
				error_log( print_r( $user_id->error, true ) );
				return NULL;
			}

			add_user_meta( $user_id, 'omise_bot_subscriber', true );
			add_user_meta( $user_id, 'omise_bot_user', true );

			$user = get_user_by( 'login', $wp_user['user_login'] );

			return $user;
		}

	}
}