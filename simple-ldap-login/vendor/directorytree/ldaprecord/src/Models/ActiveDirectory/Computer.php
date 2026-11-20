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

use SimpleLdapLoginVendor\LdapRecord\Models\ActiveDirectory\Concerns\HasAccountControl;
use SimpleLdapLoginVendor\LdapRecord\Models\ActiveDirectory\Concerns\HasPrimaryGroup;
use SimpleLdapLoginVendor\LdapRecord\Models\ActiveDirectory\Relations\HasOnePrimaryGroup;
use SimpleLdapLoginVendor\LdapRecord\Models\Relations\HasMany;
use SimpleLdapLoginVendor\LdapRecord\Models\Relations\HasOne;
class Computer extends Entry
{
    use HasAccountControl;
    use HasPrimaryGroup;
    /**
     * The object classes of the LDAP model.
     */
    public static array $objectClasses = ['top', 'person', 'organizationalperson', 'user', 'computer'];
    /**
     * The groups relationship.
     */
    public function groups(): HasMany
    {
        return $this->hasMany(Group::class, 'member')->with($this->primaryGroup());
    }
    /**
     * The primary group relationship.
     */
    public function primaryGroup(): HasOnePrimaryGroup
    {
        return $this->hasOnePrimaryGroup(Group::class, 'primarygroupid');
    }
    /**
     * The managed by relationship.
     */
    public function managedBy(): HasOne
    {
        return $this->hasOne([Contact::class, Group::class, User::class], 'managedby');
    }
}
