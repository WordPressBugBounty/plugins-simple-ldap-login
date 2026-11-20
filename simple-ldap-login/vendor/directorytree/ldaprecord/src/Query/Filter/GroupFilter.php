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

interface GroupFilter extends Filter
{
    /**
     * Get the group's operator.
     */
    public function getOperator(): string;
    /**
     * Get the raw filter string (without outer parentheses).
     */
    public function getRaw(): string;
}
