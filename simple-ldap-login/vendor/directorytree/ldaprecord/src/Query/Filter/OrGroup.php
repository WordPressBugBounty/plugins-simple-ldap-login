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

class OrGroup extends BooleanGroup
{
    /**
     * {@inheritdoc}
     */
    public function getOperator(): string
    {
        return '|';
    }
}
