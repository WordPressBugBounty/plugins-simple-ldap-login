<?php

namespace SimpleLdapLoginVendor\LdapRecord\Query\Filter;

use function SimpleLdapLoginVendor\collect;
use function SimpleLdapLoginVendor\data_fill;
use function SimpleLdapLoginVendor\data_get;
use function SimpleLdapLoginVendor\data_set;
use function SimpleLdapLoginVendor\data_forget;
use function SimpleLdapLoginVendor\head;
use function SimpleLdapLoginVendor\last;
use function SimpleLdapLoginVendor\value;

use Stringable;
interface Filter extends Stringable
{
    /**
     * Compile the filter to its LDAP string representation.
     */
    public function __toString(): string;
}
