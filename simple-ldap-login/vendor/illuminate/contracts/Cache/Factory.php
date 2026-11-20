<?php

namespace SimpleLdapLoginVendor\Illuminate\Contracts\Cache;

use function SimpleLdapLoginVendor\collect;
use function SimpleLdapLoginVendor\data_fill;
use function SimpleLdapLoginVendor\data_get;
use function SimpleLdapLoginVendor\data_set;
use function SimpleLdapLoginVendor\data_forget;
use function SimpleLdapLoginVendor\head;
use function SimpleLdapLoginVendor\last;
use function SimpleLdapLoginVendor\value;

interface Factory
{
    /**
     * Get a cache store instance by name.
     *
     * @param  string|null  $name
     * @return \Illuminate\Contracts\Cache\Repository
     */
    public function store($name = null);
}
