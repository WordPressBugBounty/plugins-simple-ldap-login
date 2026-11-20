<?php

namespace SimpleLdapLoginVendor\LdapRecord\Query;

use function SimpleLdapLoginVendor\collect;
use function SimpleLdapLoginVendor\data_fill;
use function SimpleLdapLoginVendor\data_get;
use function SimpleLdapLoginVendor\data_set;
use function SimpleLdapLoginVendor\data_forget;
use function SimpleLdapLoginVendor\head;
use function SimpleLdapLoginVendor\last;
use function SimpleLdapLoginVendor\value;

use SimpleLdapLoginVendor\Illuminate\Support\Collection as BaseCollection;
use SimpleLdapLoginVendor\LdapRecord\Models\Model;
class Collection extends BaseCollection
{
    /**
     * {@inheritdoc}
     */
    protected function valueRetriever(mixed $value): callable
    {
        if ($this->useAsCallable($value)) {
            /** @var callable $value */
            return $value;
        }
        return fn($item) => $item instanceof Model ? $item->getFirstAttribute($value) : data_get($item, $value);
    }
}
