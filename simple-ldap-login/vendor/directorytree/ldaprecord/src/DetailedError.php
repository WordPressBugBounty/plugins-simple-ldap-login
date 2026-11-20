<?php

namespace SimpleLdapLoginVendor\LdapRecord;

use function SimpleLdapLoginVendor\collect;
use function SimpleLdapLoginVendor\data_fill;
use function SimpleLdapLoginVendor\data_get;
use function SimpleLdapLoginVendor\data_set;
use function SimpleLdapLoginVendor\data_forget;
use function SimpleLdapLoginVendor\head;
use function SimpleLdapLoginVendor\last;
use function SimpleLdapLoginVendor\value;

class DetailedError
{
    /**
     * Constructor.
     */
    public function __construct(protected int $errorCode, protected string $errorMessage, protected ?string $diagnosticMessage)
    {
    }
    /**
     * Get the LDAP error code.
     */
    public function getErrorCode(): int
    {
        return $this->errorCode;
    }
    /**
     * Get the LDAP error message.
     */
    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }
    /**
     * Get the LDAP diagnostic message.
     */
    public function getDiagnosticMessage(): ?string
    {
        return $this->diagnosticMessage;
    }
}
