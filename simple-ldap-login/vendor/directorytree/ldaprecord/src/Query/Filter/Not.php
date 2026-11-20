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

class Not implements GroupFilter
{
    /**
     * Create a new NOT filter.
     */
    public function __construct(protected Filter $filter)
    {
    }
    /**
     * Get the wrapped filter.
     */
    public function getFilter(): Filter
    {
        return $this->filter;
    }
    /**
     * {@inheritdoc}
     */
    public function getOperator(): string
    {
        return '!';
    }
    /**
     * {@inheritdoc}
     */
    public function getRaw(): string
    {
        return '!' . $this->filter;
    }
    /**
     * {@inheritdoc}
     */
    public function __toString(): string
    {
        return '(' . $this->getRaw() . ')';
    }
}
