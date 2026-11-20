<?php

namespace SimpleLdapLoginVendor\PaidCommunities\WordPress\Service;

use SimpleLdapLoginVendor\PaidCommunities\WordPress\Model\PluginInfoResponse;
use SimpleLdapLoginVendor\PaidCommunities\WordPress\Model\PluginUpdateResponse;
class PluginService extends AuthenticatedService
{
    protected $path = '/plugins';
    /**
     * @param $request
     *
     * @return PluginUpdateResponse
     * @throws \PaidCommunities\WordPress\Exception\ApiErrorException
     *
     */
    public function updateCheck($request)
    {
        return $this->post($this->buildPath('/update_check'), $request, PluginUpdateResponse::class);
    }
    /**
     * @param $request
     *
     * @return PluginInfoResponse
     * @throws \PaidCommunities\WordPress\Exception\ApiErrorException
     */
    public function getInfo($request)
    {
        return $this->get($this->buildPath('/info'), $request, PluginInfoResponse::class);
    }
}
