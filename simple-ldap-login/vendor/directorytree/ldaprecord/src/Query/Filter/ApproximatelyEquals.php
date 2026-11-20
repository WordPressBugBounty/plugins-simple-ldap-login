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

class ApproximatelyEquals implements ConditionFilter
{
    /**
     * Create a new approximately equals filter.
     */
    public function __construct(protected string $attribute, protected string $value)
    {
    }
    /**
     * {@inheritdoc}
     */
    public function getAttribute(): string
    {
        return $this->attribute;
    }
    /**
     * {@inheritdoc}
     */
    public function getOperator(): string
    {
        return '~=';
    }
    /**
     * {@inheritdoc}
     */
    public function getValue(): string
    {
        return $this->value;
    }
    /**
     * {@inheritdoc}
     */
    public function getRaw(): string
    {
        return "{$this->attribute}~={$this->value}";
    }
    /**
     * {@inheritdoc}
     */
    public function __toString(): string
    {
        return "({$this->getRaw()})";
    }
}
