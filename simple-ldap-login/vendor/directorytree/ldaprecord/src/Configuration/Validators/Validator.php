<?php

namespace SimpleLdapLoginVendor\LdapRecord\Configuration\Validators;

use function SimpleLdapLoginVendor\collect;
use function SimpleLdapLoginVendor\data_fill;
use function SimpleLdapLoginVendor\data_get;
use function SimpleLdapLoginVendor\data_set;
use function SimpleLdapLoginVendor\data_forget;
use function SimpleLdapLoginVendor\head;
use function SimpleLdapLoginVendor\last;
use function SimpleLdapLoginVendor\value;

use SimpleLdapLoginVendor\LdapRecord\Configuration\ConfigurationException;
abstract class Validator
{
    /**
     * The configuration key under validation.
     */
    protected string $key;
    /**
     * The configuration value under validation.
     */
    protected mixed $value;
    /**
     * The validation exception message.
     */
    protected string $message;
    /**
     * Constructor.
     */
    public function __construct(string $key, mixed $value)
    {
        $this->key = $key;
        $this->value = $value;
    }
    /**
     * Determine if the validation rule passes.
     */
    abstract public function passes(): bool;
    /**
     * Validate the configuration value.
     *
     * @throws ConfigurationException
     */
    public function validate(): bool
    {
        if (!$this->passes()) {
            $this->fail();
        }
        return \true;
    }
    /**
     * Throw a configuration exception.
     *
     * @throws ConfigurationException
     */
    protected function fail(): void
    {
        throw new ConfigurationException(str_replace(':option', $this->key, $this->message));
    }
}
