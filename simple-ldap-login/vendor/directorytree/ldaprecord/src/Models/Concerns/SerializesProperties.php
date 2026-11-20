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

use ReflectionClass;
use ReflectionProperty;
trait SerializesProperties
{
    use SerializesAndRestoresPropertyValues;
    /**
     * Prepare the attributes for serialization.
     */
    public function __sleep(): array
    {
        $properties = (new ReflectionClass($this))->getProperties();
        foreach ($properties as $property) {
            $property->setValue($this, $this->getSerializedPropertyValue($property->getName(), $this->getPropertyValue($property)));
        }
        return array_values(array_filter(array_map(fn($p) => $p->isStatic() ? null : $p->getName(), $properties)));
    }
    /**
     * Restore the attributes after serialization.
     */
    public function __wakeup(): void
    {
        foreach ((new ReflectionClass($this))->getProperties() as $property) {
            if ($property->isStatic()) {
                continue;
            }
            $property->setValue($this, $this->getUnserializedPropertyValue($property->getName(), $this->getPropertyValue($property)));
        }
    }
    /**
     * Prepare the model for serialization.
     */
    public function __serialize(): array
    {
        $values = [];
        $properties = (new ReflectionClass($this))->getProperties();
        $class = get_class($this);
        foreach ($properties as $property) {
            if ($property->isStatic()) {
                continue;
            }
            if (!$property->isInitialized($this)) {
                continue;
            }
            $name = $property->getName();
            if ($property->isPrivate()) {
                $name = "\x00{$class}\x00{$name}";
            } elseif ($property->isProtected()) {
                $name = "\x00*\x00{$name}";
            }
            $values[$name] = $this->getSerializedPropertyValue($property->getName(), $this->getPropertyValue($property));
        }
        return $values;
    }
    /**
     * Restore the model after serialization.
     */
    public function __unserialize(array $values): void
    {
        $properties = (new ReflectionClass($this))->getProperties();
        $class = get_class($this);
        foreach ($properties as $property) {
            if ($property->isStatic()) {
                continue;
            }
            $name = $property->getName();
            if ($property->isPrivate()) {
                $name = "\x00{$class}\x00{$name}";
            } elseif ($property->isProtected()) {
                $name = "\x00*\x00{$name}";
            }
            if (!array_key_exists($name, $values)) {
                continue;
            }
            $property->setValue($this, $this->getUnserializedPropertyValue($property->getName(), $values[$name]));
        }
    }
    /**
     * Get the property value for the given property.
     */
    protected function getPropertyValue(ReflectionProperty $property): mixed
    {
        return $property->getValue($this);
    }
}
