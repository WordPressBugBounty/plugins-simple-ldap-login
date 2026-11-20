<?php

namespace SimpleLdapLoginVendor\LdapRecord\Models\Scopes;

use function SimpleLdapLoginVendor\collect;
use function SimpleLdapLoginVendor\data_fill;
use function SimpleLdapLoginVendor\data_get;
use function SimpleLdapLoginVendor\data_set;
use function SimpleLdapLoginVendor\data_forget;
use function SimpleLdapLoginVendor\head;
use function SimpleLdapLoginVendor\last;
use function SimpleLdapLoginVendor\value;

use SimpleLdapLoginVendor\LdapRecord\Models\Model;
use SimpleLdapLoginVendor\LdapRecord\Models\Scope;
use SimpleLdapLoginVendor\LdapRecord\Query\Model\Builder;
class HasObjectClasses implements Scope
{
    /**
     * Restrict the query to the model's object classes.
     */
    public function apply(Builder $query, Model $model): void
    {
        foreach ($model::$objectClasses as $objectClass) {
            $query->where('objectclass', '=', $objectClass);
        }
    }
}
