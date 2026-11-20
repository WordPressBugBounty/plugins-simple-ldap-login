<?php

namespace SimpleLdapLoginVendor\LdapRecord\Models\FreeIPA;

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
use SimpleLdapLoginVendor\LdapRecord\Models\Types\FreeIPA;
use SimpleLdapLoginVendor\LdapRecord\Query\Model\FreeIpaBuilder;
/** @mixin FreeIpaBuilder */
class Entry extends BaseEntry implements FreeIPA
{
    /**
     * The attribute key that contains the models object GUID.
     */
    protected string $guidKey = 'ipauniqueid';
    /**
     * The default attributes that should be mutated to dates.
     */
    protected array $defaultDates = ['krblastpwdchange' => 'ldap', 'krbpasswordexpiration' => 'ldap'];
    /**
     * Create a new query builder.
     */
    public function newQueryBuilder(Connection $connection): FreeIpaBuilder
    {
        return new FreeIpaBuilder($this, $connection->query());
    }
}
