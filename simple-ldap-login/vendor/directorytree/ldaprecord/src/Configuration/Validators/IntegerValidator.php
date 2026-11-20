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

class IntegerValidator extends Validator
{
    /**
     * The validation exception message.
     */
    protected string $message = 'Option [:option] must be an integer.';
    /**
     * {@inheritdoc}
     */
    public function passes(): bool
    {
        return is_numeric($this->value);
    }
}
