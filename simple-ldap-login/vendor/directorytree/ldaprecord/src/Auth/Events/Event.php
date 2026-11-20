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

use SimpleLdapLoginVendor\LdapRecord\LdapInterface;
use SensitiveParameter;
abstract class Event
{
    /**
     * The connection that the username and password is being bound on.
     */
    protected LdapInterface $connection;
    /**
     * The username that is being used for binding.
     */
    protected ?string $username;
    /**
     * The password that is being used for binding.
     */
    protected ?string $password;
    /**
     * Constructor.
     */
    public function __construct(LdapInterface $connection, ?string $username = null, #[SensitiveParameter] ?string $password = null)
    {
        $this->connection = $connection;
        $this->username = $username;
        $this->password = $password;
    }
    /**
     * Get the event's connection.
     */
    public function getConnection(): LdapInterface
    {
        return $this->connection;
    }
    /**
     * Get the authentication event's username.
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }
    /**
     * Get the authentication event's password.
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }
}
