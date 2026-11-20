<?php

namespace SimpleLdapLoginVendor\LdapRecord\Query\Events;

use function SimpleLdapLoginVendor\collect;
use function SimpleLdapLoginVendor\data_fill;
use function SimpleLdapLoginVendor\data_get;
use function SimpleLdapLoginVendor\data_set;
use function SimpleLdapLoginVendor\data_forget;
use function SimpleLdapLoginVendor\head;
use function SimpleLdapLoginVendor\last;
use function SimpleLdapLoginVendor\value;

use SimpleLdapLoginVendor\LdapRecord\Query\Builder;
class QueryExecuted
{
    /**
     * The LDAP filter that was used for the query.
     */
    protected Builder $query;
    /**
     * The number of milliseconds it took to execute the query.
     */
    protected ?float $time;
    /**
     * Constructor.
     */
    public function __construct(Builder $query, ?float $time = null)
    {
        $this->query = $query;
        $this->time = $time;
    }
    /**
     * Get the LDAP filter that was used for the query.
     */
    public function getQuery(): Builder
    {
        return $this->query;
    }
    /**
     * Get the number of milliseconds it took to execute the query.
     */
    public function getTime(): ?float
    {
        return $this->time;
    }
}
