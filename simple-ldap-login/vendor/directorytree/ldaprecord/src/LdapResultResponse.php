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

class LdapResultResponse
{
    /**
     * Constructor.
     */
    public function __construct(public readonly int $errorCode = 0, public readonly ?string $matchedDn = null, public readonly ?string $errorMessage = null, public readonly ?array $referrals = null, public readonly ?array $controls = null)
    {
    }
    /**
     * Determine if the LDAP response indicates a successful status.
     */
    public function successful(): bool
    {
        return $this->errorCode === 0;
    }
    /**
     * Determine if the LDAP response indicates a failed status.
     */
    public function failed(): bool
    {
        return !$this->successful();
    }
}
