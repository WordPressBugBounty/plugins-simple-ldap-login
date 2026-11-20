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

use Exception;
class LdapRecordException extends Exception
{
    /**
     * The detailed LDAP error (if available).
     */
    protected ?DetailedError $detailedError = null;
    /**
     * Create a new Bind Exception with a detailed connection error.
     */
    public static function withDetailedError(Exception $e, ?DetailedError $error = null): static
    {
        return (new static($e->getMessage(), $e->getCode(), $e))->setDetailedError($error);
    }
    /**
     * Set the detailed error.
     */
    public function setDetailedError(?DetailedError $error = null): static
    {
        $this->detailedError = $error;
        return $this;
    }
    /**
     * Get the detailed error.
     */
    public function getDetailedError(): ?DetailedError
    {
        return $this->detailedError;
    }
}
