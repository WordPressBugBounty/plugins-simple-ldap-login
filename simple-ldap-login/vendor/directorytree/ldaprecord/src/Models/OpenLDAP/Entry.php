<?php

namespace SimpleLdapLoginVendor\LdapRecord\Models\OpenLDAP;

use function SimpleLdapLoginVendor\collect;
use function SimpleLdapLoginVendor\data_fill;
use function SimpleLdapLoginVendor\data_get;
use function SimpleLdapLoginVendor\data_set;
use function SimpleLdapLoginVendor\data_forget;
use function SimpleLdapLoginVendor\head;
use function SimpleLdapLoginVendor\last;
use function SimpleLdapLoginVendor\value;

use SimpleLdapLoginVendor\LdapRecord\Connection;
use SimpleLdapLoginVendor\LdapRecord\Models\Entry as BaseEntry;
use SimpleLdapLoginVendor\LdapRecord\Models\Types\OpenLDAP;
use SimpleLdapLoginVendor\LdapRecord\Query\Model\OpenLdapBuilder;
/** @mixin OpenLdapBuilder */
class Entry extends BaseEntry implements OpenLDAP
{
    /**
     * The attribute key that contains the models object GUID.
     */
    protected string $guidKey = 'entryuuid';
    /**
     * Create a new query builder.
     */
    public function newQueryBuilder(Connection $connection): OpenLdapBuilder
    {
        return new OpenLdapBuilder($this, $connection->query());
    }
}
