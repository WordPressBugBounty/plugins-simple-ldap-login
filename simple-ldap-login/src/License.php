<?php

/**
 * Use the SDK license with encrypted site or network storage.
 *
 * @package SimpleLdapLogin
 */
namespace SimpleLdapLogin;

use SimpleLdapLoginVendor\PaidCommunities\WordPress\Cache;
use SimpleLdapLoginVendor\PaidCommunities\WordPress\License as Sdk_License;
use SimpleLdapLoginVendor\PaidCommunities\WordPress\PluginConfig;
use WP_Error;
/** Keep feature access on the SDK's saved license status. */
final class License extends Sdk_License
{
    /** PaidCommunities parent product for activation and releases. */
    public const PARENT_PRODUCT = 'prd_9TSP2lBG2KzRAHhQ';
    /** PaidCommunities Pro product ID. */
    public const PRO_PRODUCT = 'prd_9QyrKxQpvZGrcCW8';
    /** PaidCommunities Enterprise product ID. */
    public const ENTERPRISE_PRODUCT = 'prd_9R92jB1prxMfJR36';
    /** Annual Pro billing plan. */
    public const PRO_PLAN = 'plan_9R8xkMlq1nmCekmG';
    /** Annual Enterprise billing plan. */
    public const ENTERPRISE_PLAN = 'plan_9R937DcDDy4wMH4x';
    /** Keep the existing option and settings scope. */
    public const OPTION = 'sll_pro_license';
    /**
     * Settings scope.
     *
     * @var Settings
     */
    private \SimpleLdapLogin\Settings $settings;
    /**
     * Read the SDK license without a service request.
     *
     * @param Settings $settings Settings scope.
     */
    public function __construct(\SimpleLdapLogin\Settings $settings)
    {
        $this->settings = $settings;
        parent::__construct(self::OPTION);
        $this->read();
    }
    /** Use the SDK status without a remote check during login. */
    public function is_active(): bool
    {
        $this->read();
        return $this->isActive();
    }
    /** Return the purchased plan only when its SDK license is active. */
    public function plan(): string
    {
        if (!$this->is_active()) {
            return '';
        }
        return $this->hasProductId(self::ENTERPRISE_PRODUCT) ? 'enterprise' : 'pro';
    }
    /** Require an active license for the Enterprise child product. */
    public function is_enterprise(): bool
    {
        return 'enterprise' === $this->plan();
    }
    /** Read the existing local record in the active settings scope. */
    public function data(): array
    {
        $data = $this->settings->is_network() ? get_site_option(self::OPTION, array()) : get_option(self::OPTION, array());
        return is_array($data) ? $data : array();
    }
    /** Load the SDK fields. A copied site or another product cannot reuse them. */
    public function read()
    {
        $data = $this->data();
        $product = $data['product_id'] ?? '';
        $id = $data['domain_id'] ?? '';
        $stored = $data['secret'] ?? '';
        $valid = is_string($id) && preg_match('/^dom_[a-zA-Z0-9]+$/D', $id) && is_string($stored) && ($data['site_url'] ?? '') === $this->site_url() && self::PARENT_PRODUCT === $product;
        $secret = $valid ? \SimpleLdapLogin\Secrets::decrypt($stored) : '';
        $valid = $valid && is_string($secret) && '' !== $secret;
        $this->setSecret($valid ? $secret : '');
        $this->setDomainId($valid ? $data['domain_id'] : '');
        $this->setDomain($valid ? wp_parse_url($this->site_url(), \PHP_URL_HOST) : '');
        $this->setLicenseKey($valid ? $data['license_key'] ?? '••••••••' : '');
        $products = $data['product_ids'] ?? array();
        $this->setProductIds($valid ? $products : array());
        $this->setStatus($valid && ($this->hasProductId(self::PRO_PRODUCT) || $this->hasProductId(self::ENTERPRISE_PRODUCT)) ? $data['status'] ?? self::INACTIVE : self::INACTIVE);
        $this->setCreatedAt($data['created_at'] ?? '');
        $this->setLastCheck($data['checked_at'] ?? '');
    }
    /**
     * Save the SDK fields without a second service request.
     *
     * @throws \RuntimeException When the scoped record cannot be saved.
     */
    public function save()
    {
        $id = $this->getDomainId();
        $secret = $this->getSecret();
        if (!is_string($id) || !preg_match('/^dom_[a-zA-Z0-9]+$/D', $id) || !is_string($secret) || '' === $secret) {
            throw new \RuntimeException('The license activation is invalid.');
        }
        $encrypted = \SimpleLdapLogin\Secrets::encrypt($secret);
        if (is_wp_error($encrypted)) {
            throw new \RuntimeException('Could not save the license.');
        }
        $data = array('domain_id' => $id, 'secret' => $encrypted, 'status' => $this->getStatus(), 'product_id' => self::PARENT_PRODUCT, 'product_ids' => $this->getProductIds(), 'site_url' => $this->site_url(), 'license_key' => $this->getLicenseKey(), 'created_at' => $this->getCreatedAt(), 'checked_at' => $this->getLastCheck(), 'error' => \false);
        $this->settings->is_network() ? update_site_option(self::OPTION, $data) : update_option(self::OPTION, $data, \false);
        if ($this->data() !== $data) {
            throw new \RuntimeException('Could not save the license.');
        }
        $this->read();
    }
    /** Retain the SDK's deletion behavior in the correct settings scope. */
    public function delete()
    {
        $this->settings->is_network() ? delete_site_option(self::OPTION) : delete_option(self::OPTION);
        $this->read();
    }
    /**
     * Run a manual check through the SDK's normal update controller.
     *
     * @return true|WP_Error SDK check result.
     */
    public function refresh()
    {
        $config = $GLOBALS['sll_paidcommunities'] ?? null;
        if (!$config instanceof PluginConfig || !$this->getSecret()) {
            return $this->error();
        }
        try {
            $cache = new Cache();
            $cache->delete($cache->generateKey('update_plugins', $config->getProductId(), \SLL_VERSION, (string) $this->getSecret()));
            $result = $config->getUpdateController()->checkPluginUpdates(\false, array('Version' => \SLL_VERSION), $config->getPluginBasename());
            $this->read();
            return is_array($result) && ($result['slug'] ?? '') === self::PARENT_PRODUCT ? \true : $this->error();
        } catch (\Throwable $error) {
            return $this->error();
        }
    }
    /** Bind the local record to the configured site address. */
    private function site_url(): string
    {
        return untrailingslashit($this->settings->is_network() ? network_home_url() : home_url());
    }
    /** Return a safe service error for the manual check control. */
    private function error(): WP_Error
    {
        return new WP_Error('sll_license_error', __('Could not verify the license. Check your key and connection, then try again.', 'simple-ldap-login'));
    }
}
