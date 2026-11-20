<?php

namespace SimpleLdapLoginVendor\LdapRecord\Models\ActiveDirectory;

use function SimpleLdapLoginVendor\collect;
use function SimpleLdapLoginVendor\data_fill;
use function SimpleLdapLoginVendor\data_get;
use function SimpleLdapLoginVendor\data_set;
use function SimpleLdapLoginVendor\data_forget;
use function SimpleLdapLoginVendor\head;
use function SimpleLdapLoginVendor\last;
use function SimpleLdapLoginVendor\value;

use SimpleLdapLoginVendor\LdapRecord\Models\Relations\HasMany;
class Contact extends Entry
{
    /**
     * The object classes of the LDAP model.
     */
    public static array $objectClasses = ['top', 'person', 'organizationalperson', 'contact'];
    /**
     * The groups relationship.
     */
    public function groups(): HasMany
    {
        return $this->hasMany(Group::class, 'member');
    }
}
