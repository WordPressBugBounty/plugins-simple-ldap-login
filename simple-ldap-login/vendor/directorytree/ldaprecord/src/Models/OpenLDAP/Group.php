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

use SimpleLdapLoginVendor\LdapRecord\Models\Relations\HasManyIn;
class Group extends Entry
{
    /**
     * The object classes of the LDAP model.
     */
    public static array $objectClasses = ['top', 'groupofuniquenames'];
    /**
     * The members relationship.
     */
    public function members(): HasManyIn
    {
        return $this->hasManyIn([static::class, User::class], 'uniquemember')->using($this, 'uniquemember');
    }
}
