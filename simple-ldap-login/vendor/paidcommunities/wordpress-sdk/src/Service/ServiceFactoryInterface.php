<?php

namespace SimpleLdapLoginVendor\PaidCommunities\WordPress\Service;

interface ServiceFactoryInterface
{
    function getService($name, $clazz);
}
