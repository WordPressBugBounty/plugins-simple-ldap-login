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
use SimpleLdapLoginVendor\LdapRecord\Models\Model;
class HasOne extends Relation
{
    /**
     * Get the results of the relationship.
     */
    public function getResults(): Collection
    {
        $relationValue = $this->getFirstAttributeValue($this->parent, $this->relationKey);
        $model = $relationValue ? $this->getForeignModelByValue($relationValue) : null;
        $results = $this->transformResults($this->parent->newCollection($model ? [$model] : null));
        return $this->filterRelatedResults($results);
    }
    /**
     * Attach a model instance to the parent model.
     */
    public function attach(Model|string $model): void
    {
        $foreign = $model instanceof Model ? $this->getForeignValueFromModel($model) : $model;
        $this->parent->setAttribute($this->relationKey, $foreign)->save();
    }
    /**
     * Detach the related model from the parent.
     */
    public function detach(): void
    {
        $this->parent->setAttribute($this->relationKey, null)->save();
    }
}
