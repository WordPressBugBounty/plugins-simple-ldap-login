<?php

namespace SimpleLdapLoginVendor\LdapRecord\Models\Relations;

use function SimpleLdapLoginVendor\collect;
use function SimpleLdapLoginVendor\data_fill;
use function SimpleLdapLoginVendor\data_get;
use function SimpleLdapLoginVendor\data_set;
use function SimpleLdapLoginVendor\data_forget;
use function SimpleLdapLoginVendor\head;
use function SimpleLdapLoginVendor\last;
use function SimpleLdapLoginVendor\value;

use SimpleLdapLoginVendor\LdapRecord\Models\Collection;
class HasManyIn extends OneToMany
{
    /**
     * Get the relationships results.
     */
    public function getRelationResults(): Collection
    {
        $results = $this->parent->newCollection();
        foreach ((array) $this->parent->getAttribute($this->relationKey) as $value) {
            if ($value && $foreign = $this->getForeignModelByValue($value)) {
                $results->push($foreign);
            }
        }
        return $this->transformResults($results);
    }
}
