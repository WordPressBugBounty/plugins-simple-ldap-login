<?php
/**
 * Apply the public metadata filter and write safe user metadata.
 *
 * @package SimpleLdapLogin
 */

namespace SimpleLdapLogin;

use WP_User;

/** Keep local edits until the source LDAP value changes. */
final class Metadata {

	/**
	 * Settings in the active scope.
	 *
	 * @var Settings
	 */
	private Settings $settings;

	/**
	 * Set the settings source.
	 *
	 * @param Settings $settings Shared settings.
	 */
	public function __construct( Settings $settings ) {
		$this->settings = $settings;
	}

	/** Register account updates in every edition. */
	public function register(): void {
		add_action( 'sll_account_loaded', array( $this, 'sync' ), 10, 2 );
	}

	/**
	 * Keep the two legacy keys without changing protected account data.
	 *
	 * @param WP_User $user  WordPress account.
	 * @param array   $entry Verified directory entry.
	 */
	public function sync( WP_User $user, array $entry ): void {
		if ( $this->settings->is_recovery_account( $user ) ) {
			return;
		}
		// Pro supplies mapped values before the public integration filter runs.
		$values      = apply_filters( 'sll_mapped_user_meta_data', array(), $entry );
		$values      = apply_filters( 'sll_user_meta_data', $values );
		$ldap_suffix = $this->settings->get( 'meta_data_suffix_ldap' );
		$wp_suffix   = $this->settings->get( 'meta_data_suffix_wp' );
		if ( ! is_array( $values ) || ! is_string( $ldap_suffix ) || ! is_string( $wp_suffix ) ) {
			return;
		}
		foreach ( $values as $key => $value ) {
			$ldap_key = $key . '_' . $ldap_suffix;
			$wp_key   = $key . '_' . $wp_suffix;
			if ( ! Settings::safe_meta_key( $ldap_key ) || ! Settings::safe_meta_key( $wp_key ) || ! is_scalar( $value ) ) {
				continue;
			}
			if ( ! metadata_exists( 'user', $user->ID, $ldap_key ) || get_user_meta( $user->ID, $ldap_key, true ) !== (string) $value ) {
				update_user_meta( $user->ID, $ldap_key, (string) $value );
				update_user_meta( $user->ID, $wp_key, (string) $value );
			}
		}
	}
}
