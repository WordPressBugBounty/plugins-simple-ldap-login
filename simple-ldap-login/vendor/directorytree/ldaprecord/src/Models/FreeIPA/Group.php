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

use SimpleLdapLoginVendor\LdapRecord\Models\Relations\HasMany;
class Group extends Entry
{
    /**
     * The object classes of the LDAP model.
     */
    public static array $objectClasses = ['top', 'groupofnames', 'nestedgroup', 'ipausergroup', 'posixgroup'];
    /**
     * The groups relationship.
     *
     * Retrieves groups that the current group is a part of.
     */
    public function groups(): HasMany
    {
        return $this->hasMany(self::class, 'member');
    }
    /**
     * Retrieve the members of the group.
     */
    public function members(): HasMany
    {
        return $this->hasMany(User::class, 'memberof')->using($this, 'member');
    }
}
