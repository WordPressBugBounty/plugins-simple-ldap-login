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

class StringOrNullValidator extends Validator
{
    /**
     * The validation exception message.
     */
    protected string $message = 'Option [:option] must be a string or null.';
    /**
     * {@inheritdoc}
     */
    public function passes(): bool
    {
        return is_string($this->value) || is_null($this->value);
    }
}
