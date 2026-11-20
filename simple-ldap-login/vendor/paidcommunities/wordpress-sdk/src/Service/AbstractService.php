<?php

namespace SimpleLdapLoginVendor\PaidCommunities\WordPress\Service;

use SimpleLdapLoginVendor\PaidCommunities\WordPress\Exception\ApiErrorException;
use SimpleLdapLoginVendor\PaidCommunities\WordPress\HttpClient\ClientInterface;
use SimpleLdapLoginVendor\PaidCommunities\WordPress\Model\ModelFactoryInterface;
use SimpleLdapLoginVendor\PaidCommunities\WordPress\Util\GeneralUtils;
/**
 *
 */
class AbstractService implements ServiceInterface
{
    protected $client;
    private $models;
    protected $path = '';
    public function __construct(ClientInterface $client, ModelFactoryInterface $models)
    {
        $this->client = $client;
        $this->models = $models;
    }
    /**
     * @param $method
     * @param $path
     * @param $request
     * @param $model
     * @param $opts
     *
     * @return mixed
     * @throws ApiErrorException
     */
    public function request($method, $path, $request = [], $model = null, $opts = [])
    {
        $response = $this->client->request($method, $path, $request, $opts);
        if ($response) {
            return $this->models->buildModel($model, $response);
        }
        return $response;
    }
    public function retrieve($id)
    {
        return $this->request('get', $this->buildPath(''));
    }
    public function post($path, $request, $model = null)
    {
        return $this->request('post', $path, $request, $model);
    }
    public function get($path, $request = [], $model = null)
    {
        return $this->request('get', $path, $request, $model);
    }
    public function put($path, $request, $model = null)
    {
        return $this->request('put', $path, $request, $model);
    }
    protected function buildPath($path = '', ...$args)
    {
        if ($path) {
            $path = '/' . GeneralUtils::trimPath($path);
        }
        if ($this->path) {
            $path = '/' . GeneralUtils::trimPath($this->path) . $path;
        }
        return sprintf($path, ...array_map('\urlencode', $args));
    }
}
