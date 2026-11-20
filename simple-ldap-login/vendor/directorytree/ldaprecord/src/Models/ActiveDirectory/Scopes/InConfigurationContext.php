<?php

namespace SimpleLdapLoginVendor\LdapRecord\Models\ActiveDirectory\Scopes;

use function SimpleLdapLoginVendor\collect;
use function SimpleLdapLoginVendor\data_fill;
use function SimpleLdapLoginVendor\data_get;
use function SimpleLdapLoginVendor\data_set;
use function SimpleLdapLoginVendor\data_forget;
use function SimpleLdapLoginVendor\head;
use function SimpleLdapLoginVendor\last;
use function SimpleLdapLoginVendor\value;

use SimpleLdapLoginVendor\LdapRecord\Models\ActiveDirectory\Entry;
use SimpleLdapLoginVendor\LdapRecord\Models\Model;
use SimpleLdapLoginVendor\LdapRecord\Models\ModelNotFoundException;
use SimpleLdapLoginVendor\LdapRecord\Models\Scope;
use SimpleLdapLoginVendor\LdapRecord\Query\Model\Builder;
class InConfigurationContext implements Scope
{
    /**
     * Refines the base dn to be inside the configuration context.
     *
     * @throws ModelNotFoundException
     */
    public function apply(Builder $query, Model $model): void
    {
        $query->in($this->getConfigurationNamingContext($model));
    }
    /**
     * Get the LDAP server configuration naming context distinguished name.
     *
     * @throws ModelNotFoundException
     */
    protected function getConfigurationNamingContext(Model $model): mixed
    {
        return Entry::getRootDse($model->getConnectionName())->getFirstAttribute('configurationNamingContext');
    }
}
