<?php

namespace SimpleLdapLoginVendor\PaidCommunities\WordPress\Model;

interface ModelFactoryInterface
{
    function buildModel($clazz, $response);
}
