<?php

namespace SimpleLdapLoginVendor\Illuminate\Contracts\Database\Eloquent;

use function SimpleLdapLoginVendor\collect;
use function SimpleLdapLoginVendor\data_fill;
use function SimpleLdapLoginVendor\data_get;
use function SimpleLdapLoginVendor\data_set;
use function SimpleLdapLoginVendor\data_forget;
use function SimpleLdapLoginVendor\head;
use function SimpleLdapLoginVendor\last;
use function SimpleLdapLoginVendor\value;

use SimpleLdapLoginVendor\Illuminate\Contracts\Database\Query\Builder as BaseContract;
/**
 * This interface is intentionally empty and exists to improve IDE support.
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
interface Builder extends BaseContract
{
}
