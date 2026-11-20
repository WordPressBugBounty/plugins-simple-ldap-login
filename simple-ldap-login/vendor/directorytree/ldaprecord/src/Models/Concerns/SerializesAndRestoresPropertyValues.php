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

/** @mixin HasAttributes */
trait SerializesAndRestoresPropertyValues
{
    /**
     * Get the property value prepared for serialization.
     */
    protected function getSerializedPropertyValue(string $property, mixed $value): mixed
    {
        if ($property === 'original') {
            return $this->originalToArray();
        }
        if ($property === 'attributes') {
            return $this->attributesToArray();
        }
        return $value;
    }
    /**
     * Get the unserialized property value after deserialization.
     */
    protected function getUnserializedPropertyValue(string $property, mixed $value): mixed
    {
        if ($property === 'original') {
            return $this->arrayToOriginal($value);
        }
        if ($property === 'attributes') {
            return $this->arrayToAttributes($value);
        }
        return $value;
    }
}
