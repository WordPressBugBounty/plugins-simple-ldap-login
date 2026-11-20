=== Simple LDAP Login ===
Contributors: clifgriffin
Tags: ldap, authentication, login, active directory
Requires at least: 6.5
Tested up to: 7.1
Requires PHP: 8.1
Stable tag: 2.0.1
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Connect WordPress accounts to Active Directory or OpenLDAP, with group access rules and automatic account creation.

== Description ==

= LDAP login for WordPress =

[Simple LDAP Login](https://simpleldaplogin.com/) lets staff sign in to WordPress with their existing Active Directory or OpenLDAP account. Simple LDAP Login checks directory credentials, applies group access rules, and can create a WordPress account after a valid login.

Use it for staff sites, company intranets, and other WordPress sites that share an LDAP directory. Free includes LDAP password login, encrypted connections, group restrictions, and local administrator recovery. No paid license or PaidCommunities account is required for these features.

> **Need backup servers or single sign-on?** [Simple LDAP Login Pro](https://checkout.paidcommunities.com/checkout/prd_9QyrKxQpvZGrcCW8?plan=plan_9R8xkMlq1nmCekmG) adds backup LDAP servers, server SSO, automatic LDAP field mapping, group role rules, and profile updates. [Enterprise](https://checkout.paidcommunities.com/checkout/prd_9R92jB1prxMfJR36?plan=plan_9R937DcDDy4wMH4x) adds scheduled account management, multisite membership rules, and audit history.

= Use the directory accounts you already have =

Connect to Active Directory or OpenLDAP. Authenticate existing WordPress users, or create accounts after their first valid directory login. Set the default WordPress role for new accounts and map standard profile fields to your directory attributes.

= Control access with LDAP groups =

Limit login to members of one or more LDAP groups. Active Directory checks include nested and primary groups. Keep account creation off when only existing WordPress users should have access.

= Protect directory connections =

Use StartTLS or LDAPS with a trusted server certificate. A failed TLS connection stops the login attempt. Plain LDAP requires an explicit setting. LDAP passwords are not stored as WordPress passwords.

= Keep a local way to recover access =

Choose local administrator accounts that can sign in with their WordPress passwords. Connection and login tests let you check the setup before you enable LDAP. These tests do not create users or login sessions.

= Free features =

* Active Directory and OpenLDAP password login.
* One LDAP server, with configurable port and connection timeout.
* StartTLS and LDAPS with certificate checks.
* Login restrictions based on LDAP groups.
* Nested and primary Active Directory group checks.
* Optional WordPress account creation and a default role.
* Directory attribute mapping for standard profile fields.
* The `sll_user_meta_data` filter for integration-supplied metadata.
* Local administrator recovery and LDAP-only login settings.
* Site settings and central network settings for WordPress multisite.
* Separate connection and login tests.
* Translations for 24 locales.

= Pro and Enterprise =

**Pro: USD 99 per year for one site.** Add backup LDAP servers, single sign-on from a trusted web server, automatic LDAP field mapping, group-to-role rules, and profile updates at login.

**Enterprise: USD 499 per year for one site.** Includes Pro plus scheduled account import, access and session removal, multisite membership rules, and audit history with retention and CSV export.

Both plans use the same paid plugin ZIP. Pro replaces Free; you do not run both plugins together. Your license selects the available features. Purchase links open each plan's checkout on PaidCommunities.

= Upgrading from version 1.x =

Back up the database and test the upgrade on a site copy. Version 2.0 requires WordPress 6.5 and PHP 8.1 or later.

**Backup LDAP servers, server SSO, and automatic LDAP-to-user-meta mapping require Pro or Enterprise in version 2.0.1.** If your 1.x site uses these features, install the Pro ZIP directly and activate a paid license. Free keeps the saved settings but does not run these paid features.

The `sll_user_meta_data` filter works in Free without a license. Integrations can supply custom metadata through this filter. Automatic LDAP attribute mappings require Pro or Enterprise.

Older settings are backed up before migration. Existing sites keep the legacy administrator recovery rule. If a saved search password cannot be read, enter it again.

= Support and contributions =

Read the [setup guide](https://simpleldaplogin.com/docs/quick-start/) and [plugin documentation](https://simpleldaplogin.com/docs/). Use the [WordPress.org support forum](https://wordpress.org/support/plugin/simple-ldap-login/) for help with Free. Report bugs or contribute code in the [GitHub repository](https://github.com/clifgriffin/simple-ldap-login). Do not include directory passwords, license keys, or other secrets in a public support request.

= External services =

LDAP requests go only to the directory servers that an administrator configures. Free LDAP login does not require an external license service.

The optional Go Pro tab links to [PaidCommunities](https://paidcommunities.com/) checkout. It does not load commerce scripts or send license requests. When you open a purchase link, PaidCommunities receives the product and plan IDs, your IP address, and browser details. It also receives the purchase and payment details that you enter during checkout.

The paid plugin uses PaidCommunities for license activation and updates. Activation sends the license key, site domain, plugin version, and product ID. Later checks use a site activation secret. Requests also include the server IP address and standard WordPress HTTP headers. LDAP settings, bind passwords, login passwords, and directory user records are not sent to PaidCommunities. Login uses saved license status and does not contact the service.

Free keeps WordPress.org updates. A purchase or license activation does not install the paid plugin automatically.

* [Simple LDAP Login privacy policy](https://simpleldaplogin.com/privacy/)
* [Simple LDAP Login terms and conditions](https://simpleldaplogin.com/terms/)
* [PaidCommunities service documentation](https://paidcommunities.com/documentation/sdks/wordpress-sdk/)
* [PaidCommunities checkout documentation](https://paidcommunities.com/documentation/checkout/)

== Installation ==

1. Install PHP 8.1 or later with the LDAP, OpenSSL, and iconv extensions.
2. Upload the release ZIP through Plugins > Add New Plugin, or use the WordPress plugin directory.
3. Activate Simple LDAP Login.
4. Open Settings > Simple LDAP Login. For network activation, use Network Admin > Settings.
5. Enter the directory connection details. Use StartTLS or LDAPS and a trusted server certificate.
6. Save the settings and run the connection and login tests.
7. Choose local recovery access on the Access tab. Keep your administrator session open, enable LDAP login, and test it in another browser.

A release ZIP includes its dependencies. Do not install an unbuilt source archive.

== Frequently Asked Questions ==

= Do I need Pro to use LDAP login? =

No. Free includes LDAP password login, group restrictions, account creation, TLS, and local recovery. Pro and Enterprise add the features listed above.

= Does Pro replace Free? =

Yes. Upload the Pro ZIP and choose to replace the installed plugin. Do not delete the old plugin first. Both versions use the same plugin folder, and your saved settings stay in place. Then activate your Pro or Enterprise license.

= Which PHP extensions are required? =

Use PHP 8.1 or later with LDAP, OpenSSL, and iconv enabled. Your WordPress server must be able to reach the LDAP server and trust its TLS certificate.

= Where are the advanced settings? =

The Advanced tab contains the timeout, LDAP login and group attributes, group search base, profile attributes, plain LDAP permission, and uninstall data setting. Full packages also show metadata suffixes there. Common connection and access settings stay on their main tabs. Saved values are kept when you save another tab.

= Will my existing settings work? =

Your saved settings stay in place. The plugin backs up older settings before migration. If your 1.x site uses backup LDAP servers, SSO, or automatic LDAP-to-user-meta mapping, install the Pro ZIP directly and activate a Pro or Enterprise license. Free supports LDAP password login but does not run these paid features.

Existing unencrypted connections continue to work with a warning. A failed TLS connection stops the login attempt. If the plugin cannot read a saved search password, enter it again.

= Are old features moving to Pro? =

Backup LDAP servers, single sign-on, and automatic LDAP-to-user-meta mapping require the Pro ZIP with an active Pro or Enterprise license, including on sites that upgrade from 1.x. The metadata filter, standard profile attributes, group restrictions, recovery access, and central network settings remain free.

= What happens if LDAP is unavailable? =

Local recovery access on the Access tab has three choices:

* Selected administrators: the chosen accounts use WordPress authentication directly. LDAP and server SSO cannot sign in as these accounts or update their directory metadata.
* All administrators (legacy): allow administrator WordPress passwords. On multisite, this applies to super administrators only.
* Off: remove the administrator exception. Every account follows the normal LDAP login policy.

New installations default to Selected administrators. Select at least one eligible local account, or explicitly choose Off, before enabling LDAP or server SSO. Site settings accept administrators of that site. Network settings accept only super administrators. Existing installations keep the legacy rule until an administrator changes it. Local recovery access is included in Free.

When LDAP-only mode is off, WordPress can check local passwords for other accounts. A denied group still blocks those accounts. LDAP-only mode also blocks their local application password fallback.

= How can I recover access? =

Set `define( 'SLL_DISABLE_LDAP', true );` in `wp-config.php` before WordPress loads, then use a local administrator password. Correct the settings and remove the constant. You can also rename the plugin folder to disable it.

= Does SSO trust a browser header? =

No. Pro uses REMOTE_USER set by a server authentication module. Do not copy client request headers into that variable. Block access paths that bypass server authentication. SSO also requires a valid read-only search account. DOMAIN\name logins must match the Windows domain setting. The Free package does not include server SSO.

= What happens when I delete the plugin? =

User accounts are always kept. Settings are kept unless you enable Delete settings when removing the plugin on the Advanced tab.

== Screenshots ==

1. Connect to OpenLDAP and choose the LDAP connection security.
2. Set group access rules, account creation, and local recovery accounts.
3. Set directory attributes, timeouts, and data retention.
4. Test the LDAP connection and a user login.

== Developer Hooks ==

Use WordPress `add_filter()` and `add_action()` in an integration plugin. Register callbacks before login. Set the accepted argument count when a callback needs more than one argument. Filters must return the value described below.

= Login and account filters =

* `sll_get_setting( $value, $key )`: Return a setting value. The old global settings object also uses this filter.
* `sll_force_ldap( $allow_recovery )`: Return `false` to require LDAP for administrators in legacy recovery mode. The inverted name is retained for compatibility. Selected recovery accounts and Off mode do not use this filter.
* `sll_remove_default_authentication_hook( $exclusive )`: Return `true` to block local password fallback, or `false` to allow normal fallback. The filter no longer removes WordPress authentication handlers. Group denial still blocks fallback for users without a recovery exception.
* `sll_ldap_auth( $bound )`: Receives a boolean bind result for password login and server SSO. Return `false` to reject it. A callback cannot make a failed bind or invalid directory identity valid.
* `sll_user_has_groups( $allowed )`: Return a boolean group access result. This filter also runs when no required groups are configured.
* `sll_user_data( $data )`: Return the array passed to `wp_insert_user()`. It runs only for new accounts. Fields include `user_login`, `user_nicename`, `user_pass`, `user_email`, `display_name`, `first_name`, `last_name`, `user_url`, and `role`. The local password is random, not the LDAP password.
* `sll_user_meta_data( $values )`: Return an array of metadata names and scalar values, or `false` to skip writes. This filter works in every edition without a license. Free supplies an empty array. Licensed Pro supplies values from its automatic LDAP mappings. Integrations can add values in either edition.
* `sll_account_verified( $user, $entry )`: Return the `WP_User` or a `WP_Error` to reject the directory account before account update actions. A new account can already have been created at this point.

Metadata names receive the saved LDAP and WordPress suffixes. For example, `department` writes `department_ldap` and `department_wp` with the default settings. Local edits remain until the callback's source value changes. Protected account keys and non-scalar values are rejected. Selected local recovery accounts do not receive these directory updates.

Example: supply a custom value without the Pro mapping feature:

    add_filter( 'sll_user_meta_data', function ( $values ) {
        $values['directory_source'] = 'staff';
        return $values;
    } );

= Directory and settings filters =

* `sll_ldap_hosts( $hosts, $settings )`: Return server addresses. Free supplies the primary server. The licensed paid module supplies backup servers.
* `sll_ldap_attributes( $attributes )`: Return LDAP attribute names to request. Invalid attribute names are removed.
* `sll_ldap_entry( $data, $connection, $entry, $username )`: Return the verified directory attribute array, or `WP_Error` to reject it. The connection and entry are the bundled LdapRecord objects. The array includes `dn`.
* `sll_mapped_user_meta_data( $values, $entry )`: Supplies initial metadata values before `sll_user_meta_data`. Pro uses this hook for licensed LDAP mappings. Integrations that only supply custom values should use `sll_user_meta_data`.
* `sll_settings_defaults( $defaults )`: Return the default settings array.
* `sll_validate_setting( $result, $key, $value, $settings )`: Return `null` to use built-in validation, a validated value to store it, or `WP_Error` to reject the save.
* `sll_settings_tabs( $tabs )`: Return an array of settings tab keys and labels.

= Actions =

* `sll_loaded( $settings, $auth )`: Shared settings and authentication services are ready.
* `sll_account_loaded( $user, $entry )`: The directory account resolved to a WordPress user and passed `sll_account_verified`. Account modules use this action to update data. It can also run during scheduled imports.
* `sll_auth_success( $user )`: An LDAP account passed the WordPress user check. It runs for new and existing accounts. Later authentication filters can still reject login; use WordPress `wp_login` for a completed login.
* `sll_auth_failure()`: A password login received an LDAP error. It does not report every WordPress login failure.
* `sll_settings_saved( $settings, $before, $after )`: A settings save succeeded. The arrays contain the previous and new settings.
* `sll_settings_notices()`: Add settings-page notices.
* `sll_access_settings( $admin )`, `sll_profile_settings( $admin )`, and `sll_advanced_settings( $admin )`: Add controls to the corresponding settings section.
* `sll_settings_page_{tab}( $admin )`: Render a custom page for a registered tab without the standard settings form.
* `sll_settings_tab_{tab}( $admin )`: Add controls for a registered tab inside the standard settings form.

Existing filter names and argument order are retained. Callbacks that use the removed `adLDAP` object or that permit failed LDAP binds must change. Do not send passwords or directory records to external services from a callback.

== Changelog ==

= 2.0.1 =

* Restore the public metadata filter in Free without requiring a paid license.
* Keep automatic LDAP metadata mappings in the paid plans.
* Restore the user_nicename field for account creation filters.
* Run the LDAP authentication filter for server SSO and failed binds.
* Document filter arguments, actions, and compatibility limits.

= 2.0.0 =

* Update the plugin for WordPress 6.5 and PHP 8.1 or later.
* Redesign the settings screens for desktop and mobile.
* Add separate connection and login tests to check settings before enabling LDAP.
* Add selected local administrator recovery accounts and an option to turn recovery access off.
* Back up existing settings before upgrades and preserve site settings, network settings, and recovery access.
* Improve TLS validation and protect user account data during login.
* Keep other WordPress authentication checks active during LDAP login.
* Add translations for 23 additional locales.

== Upgrade Notice ==

= 2.0.1 =
Restores integration filters and documents their behavior. The metadata filter works in Free. Automatic LDAP mappings remain paid. Failed binds remain blocked.

= 2.0.0 =
Requires PHP 8.1. Back up your site and test the upgrade on a copy. Existing recovery rules stay in place. For 1.x backup servers, SSO, or custom fields, install the Pro ZIP and activate a paid license. TLS failures stop login.
