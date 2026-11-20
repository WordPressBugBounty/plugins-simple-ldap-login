<?php

namespace SimpleLdapLoginVendor\LdapRecord\Exceptions;

use function SimpleLdapLoginVendor\collect;
use function SimpleLdapLoginVendor\data_fill;
use function SimpleLdapLoginVendor\data_get;
use function SimpleLdapLoginVendor\data_set;
use function SimpleLdapLoginVendor\data_forget;
use function SimpleLdapLoginVendor\head;
use function SimpleLdapLoginVendor\last;
use function SimpleLdapLoginVendor\value;

use SimpleLdapLoginVendor\LdapRecord\DetectsErrors;
use SimpleLdapLoginVendor\LdapRecord\LdapRecordException;
class ConstraintViolationException extends LdapRecordException
{
    use DetectsErrors;
    /**
     * Determine if the exception was generated due to the password policy.
     */
    public function causedByPasswordPolicy(): bool
    {
        return isset($this->detailedError) && $this->errorContainsMessage($this->detailedError->getDiagnosticMessage(), '0000052D');
    }
    /**
     * Determine if the exception was generated due to an incorrect password.
     */
    public function causedByIncorrectPassword(): bool
    {
        return isset($this->detailedError) && $this->errorContainsMessage($this->detailedError->getDiagnosticMessage(), '00000056');
    }
}
