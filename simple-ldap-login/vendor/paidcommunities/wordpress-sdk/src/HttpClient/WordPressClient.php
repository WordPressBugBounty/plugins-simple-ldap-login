<?php

namespace SimpleLdapLoginVendor\PaidCommunities\WordPress\HttpClient;

use SimpleLdapLoginVendor\PaidCommunities\WordPress\Exception\AuthenticationException;
use SimpleLdapLoginVendor\PaidCommunities\WordPress\Exception\AuthorizationException;
use SimpleLdapLoginVendor\PaidCommunities\WordPress\Exception\BadRequestException;
use SimpleLdapLoginVendor\PaidCommunities\WordPress\Exception\NotFoundException;
use SimpleLdapLoginVendor\PaidCommunities\WordPress\Model\BaseModelFactory;
use SimpleLdapLoginVendor\PaidCommunities\WordPress\Service\BaseServiceFactory;
use SimpleLdapLoginVendor\PaidCommunities\WordPress\Service\DomainService;
use SimpleLdapLoginVendor\PaidCommunities\WordPress\Service\PluginService;
/**
 * @property PluginService $plugins
 * @property DomainService $domains
 */
class WordPressClient extends AbstractClient
{
    private $http;
    public function __construct($environment = self::PRODUCTION, $secret = null)
    {
        parent::__construct($environment, $secret);
        $this->http = new \WP_Http();
    }
    public function __get($name)
    {
        if (!$this->serviceFactory) {
            $this->serviceFactory = new BaseServiceFactory($this, new BaseModelFactory());
        }
        return $this->serviceFactory->{$name};
    }
    /**
     * @param $method
     * @param $path
     * @param $body
     * @param $opts
     *
     * @return mixed
     * @throws AuthenticationException
     * @throws AuthorizationException
     * @throws BadRequestException
     * @throws NotFoundException
     */
    public function request($method, $path, $request = [], $opts = [])
    {
        $headers = $this->getHeaders();
        if (isset($opts['headers'])) {
            $headers = array_merge($headers, $opts['headers']);
        }
        $args = ['method' => strtoupper($method), 'headers' => $headers, 'timeout' => 30];
        if ($request) {
            if ($method !== 'get') {
                list(, $body) = $this->prepareRequest($request);
                $args = wp_parse_args(['body' => $body], $args);
            } else {
                $path = add_query_arg($request, $path);
            }
        }
        return $this->handleResponse($this->http->request($this->buildUrl($path), $args));
    }
    /**
     * @throws AuthenticationException
     * @throws NotFoundException
     * @throws AuthorizationException
     * @throws BadRequestException
     */
    private function handleResponse($response)
    {
        if (\is_wp_error($response)) {
            throw BadRequestException::factory(400, ['error' => ['message' => $response->get_error_message()]]);
        }
        $httpStatus = wp_remote_retrieve_response_code($response);
        $body = json_decode(wp_remote_retrieve_body($response), \true);
        $this->handleStatusCode($httpStatus, $body);
        return $body;
    }
}
