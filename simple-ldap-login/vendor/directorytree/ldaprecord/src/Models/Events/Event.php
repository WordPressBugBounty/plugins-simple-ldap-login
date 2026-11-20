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
abstract class Event
{
    /**
     * The model that the event is being triggered on.
     */
    protected Model $model;
    /**
     * Constructor.
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    /**
     * Get the model that generated the event.
     */
    public function getModel(): Model
    {
        return $this->model;
    }
}
