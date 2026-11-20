<?php

namespace SimpleLdapLoginVendor\LdapRecord\Auth\Events;

use function SimpleLdapLoginVendor\collect;
use function SimpleLdapLoginVendor\data_fill;
use function SimpleLdapLoginVendor\data_get;
use function SimpleLdapLoginVendor\data_set;
use function SimpleLdapLoginVendor\data_forget;
use function SimpleLdapLoginVendor\head;
use function SimpleLdapLoginVendor\last;
use function SimpleLdapLoginVendor\value;

use Exception;
use SimpleLdapLoginVendor\LdapRecord\Auth\BindException;
use SimpleLdapLoginVendor\LdapRecord\LdapInterface;
use SensitiveParameter;
class Failed extends Event
{
    /**
     * The exception that was thrown during the bind attempt.
     */
    protected BindException $exception;
    /**
     * Constructor.
     */
    public function __construct(LdapInterface $connection, ?string $username, #[SensitiveParameter] ?string $password, BindException $exception)
    {
        parent::__construct($connection, $username, $password);
        $this->exception = $exception;
    }
    /**
     * Get the exception that was thrown during the bind attempt.
     */
    public function getException(): BindException
    {
        return $this->exception;
    }
}
