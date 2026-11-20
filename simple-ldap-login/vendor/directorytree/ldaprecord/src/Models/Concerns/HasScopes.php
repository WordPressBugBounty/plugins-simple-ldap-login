<?php

namespace SimpleLdapLoginVendor\LdapRecord\Models\Concerns;

use function SimpleLdapLoginVendor\collect;
use function SimpleLdapLoginVendor\data_fill;
use function SimpleLdapLoginVendor\data_get;
use function SimpleLdapLoginVendor\data_set;
use function SimpleLdapLoginVendor\data_forget;
use function SimpleLdapLoginVendor\head;
use function SimpleLdapLoginVendor\last;
use function SimpleLdapLoginVendor\value;

use SimpleLdapLoginVendor\LdapRecord\Models\Model;
use SimpleLdapLoginVendor\LdapRecord\Query\Model\Builder;
/** @mixin Model */
trait HasScopes
{
    /**
     * Begin querying the direct descendants of the model.
     */
    public function descendants(): Builder
    {
        return $this->in($this->getDn())->list();
    }
    /**
     * Begin querying the direct ancestors of the model.
     */
    public function ancestors(): Builder
    {
        $parent = $this->getParentDn($this->getDn());
        return $this->in($this->getParentDn($parent))->list();
    }
    /**
     * Begin querying the direct siblings of the model.
     */
    public function siblings(): Builder
    {
        return $this->in($this->getParentDn($this->getDn()))->list();
    }
}
