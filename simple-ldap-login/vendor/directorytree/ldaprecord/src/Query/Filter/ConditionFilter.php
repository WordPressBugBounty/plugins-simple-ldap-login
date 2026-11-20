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

interface ConditionFilter extends Filter
{
    /**
     * Get the filter's attribute.
     */
    public function getAttribute(): string;
    /**
     * Get the filter's operator.
     */
    public function getOperator(): string;
    /**
     * Get the filter's value.
     */
    public function getValue(): ?string;
    /**
     * Get the raw filter string (without parentheses).
     */
    public function getRaw(): string;
}
