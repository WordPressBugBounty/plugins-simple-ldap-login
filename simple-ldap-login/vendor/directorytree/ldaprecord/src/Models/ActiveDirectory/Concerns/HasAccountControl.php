<?php

namespace SimpleLdapLoginVendor\LdapRecord\Models\ActiveDirectory\Concerns;

use function SimpleLdapLoginVendor\collect;
use function SimpleLdapLoginVendor\data_fill;
use function SimpleLdapLoginVendor\data_get;
use function SimpleLdapLoginVendor\data_set;
use function SimpleLdapLoginVendor\data_forget;
use function SimpleLdapLoginVendor\head;
use function SimpleLdapLoginVendor\last;
use function SimpleLdapLoginVendor\value;

use SimpleLdapLoginVendor\LdapRecord\Models\Attributes\AccountControl;
trait HasAccountControl
{
    /**
     * Determine if the user's account is enabled.
     */
    public function isEnabled(): bool
    {
        return !$this->isDisabled();
    }
    /**
     * Determine if the user's account is disabled.
     */
    public function isDisabled(): bool
    {
        return $this->accountControl()->hasFlag(AccountControl::ACCOUNTDISABLE);
    }
    /**
     * Get the user's account control.
     */
    public function accountControl(): AccountControl
    {
        return new AccountControl($this->getFirstAttribute('userAccountControl'));
    }
    /**
     * Set the user's account control attribute.
     */
    public function setUserAccountControlAttribute(mixed $value): void
    {
        if ($value instanceof AccountControl) {
            $value = $value->getValue();
        }
        $this->attributes['useraccountcontrol'] = [(int) $value];
    }
}
