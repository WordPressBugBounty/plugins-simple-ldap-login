<?php

namespace SimpleLdapLoginVendor\LdapRecord\Models;

use function SimpleLdapLoginVendor\collect;
use function SimpleLdapLoginVendor\data_fill;
use function SimpleLdapLoginVendor\data_get;
use function SimpleLdapLoginVendor\data_set;
use function SimpleLdapLoginVendor\data_forget;
use function SimpleLdapLoginVendor\head;
use function SimpleLdapLoginVendor\last;
use function SimpleLdapLoginVendor\value;

use SimpleLdapLoginVendor\LdapRecord\LdapRecordException;
class ModelDoesNotExistException extends LdapRecordException
{
    /**
     * The instance of the model that does not exist.
     */
    protected Model $model;
    /**
     * Create a new exception for the given model.
     */
    public static function forModel(Model $model): static
    {
        return (new static())->setModel($model);
    }
    /**
     * Set the model instance that does not exist.
     */
    public function setModel(Model $model): static
    {
        $this->model = $model;
        $class = get_class($model);
        $this->message = "Model [{$class}] does not exist.";
        return $this;
    }
    /**
     * Get the instance of the model that does not exist.
     */
    public function getModel(): Model
    {
        return $this->model;
    }
}
