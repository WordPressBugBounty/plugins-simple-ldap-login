<?php

namespace SimpleLdapLoginVendor\LdapRecord\Models\ActiveDirectory\Concerns;

use function SimpleLdapLoginVendor\collect;
use function SimpleLdapLoginVendor\data_fill;
use function SimpleLdapLoginVendor\data_get;
use function SimpleLdapLoginVendor\data_set;
use function SimpleLdapLoginVendor\data_forget;
use function SimpleLdapLoginVendor\head;
use function SimpleLdapLoginVendor\last;
use function SimpleLdapLoginVendor\value;

use SimpleLdapLoginVendor\LdapRecord\Models\ActiveDirectory\Relations\HasOnePrimaryGroup;
trait HasPrimaryGroup
{
    /**
     * Returns a new has one primary group relationship.
     */
    public function hasOnePrimaryGroup(string $related, string $relationKey, string $foreignKey = 'primarygroupid'): HasOnePrimaryGroup
    {
        return new HasOnePrimaryGroup($this->newQuery(), $this, $related, $relationKey, $foreignKey);
    }
}
