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
class Group extends Entry
{
    /**
     * The object classes of the LDAP model.
     */
    public static array $objectClasses = ['top', 'group'];
    /**
     * The groups relationship.
     *
     * Retrieves groups that the current group is a part of.
     */
    public function groups(): HasMany
    {
        return $this->hasMany(static::class, 'member');
    }
    /**
     * The members relationship.
     */
    public function members(): HasMany
    {
        return $this->hasMany([static::class, User::class, Contact::class, Computer::class], 'memberof')->using($this, 'member')->with($this->primaryGroupMembers());
    }
    /**
     * The primary group members relationship.
     */
    public function primaryGroupMembers(): HasMany
    {
        return $this->hasMany([static::class, User::class, Contact::class, Computer::class], 'primarygroupid', 'rid');
    }
    /**
     * Get the RID of the group.
     */
    public function getRidAttribute(): array
    {
        return array_filter([last(explode('-', (string) $this->getConvertedSid()))]);
    }
}
