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
class User extends Entry
{
    /**
     * The object classes of the LDAP model.
     */
    public static array $objectClasses = ['top', 'person', 'inetorgperson', 'organizationalperson'];
    /**
     * Retrieve groups that the current user is a part of.
     */
    public function groups(): HasMany
    {
        return $this->hasMany(Group::class, 'member');
    }
}
