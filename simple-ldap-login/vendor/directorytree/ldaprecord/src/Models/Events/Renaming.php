<?php

namespace SimpleLdapLoginVendor\LdapRecord\Models\Events;

use function SimpleLdapLoginVendor\collect;
use function SimpleLdapLoginVendor\data_fill;
use function SimpleLdapLoginVendor\data_get;
use function SimpleLdapLoginVendor\data_set;
use function SimpleLdapLoginVendor\data_forget;
use function SimpleLdapLoginVendor\head;
use function SimpleLdapLoginVendor\last;
use function SimpleLdapLoginVendor\value;

use SimpleLdapLoginVendor\LdapRecord\Models\Model;
class Renaming extends Event
{
    /**
     * The models RDN.
     */
    protected string $rdn;
    /**
     * The models new parent DN.
     */
    protected string $newParentDn;
    /**
     * Constructor.
     */
    public function __construct(Model $model, string $rdn, string $newParentDn)
    {
        parent::__construct($model);
        $this->rdn = $rdn;
        $this->newParentDn = $newParentDn;
    }
    /**
     * Get the models RDN.
     */
    public function getRdn(): string
    {
        return $this->rdn;
    }
    /**
     * Get the models parent DN.
     */
    public function getNewParentDn(): string
    {
        return $this->newParentDn;
    }
}
