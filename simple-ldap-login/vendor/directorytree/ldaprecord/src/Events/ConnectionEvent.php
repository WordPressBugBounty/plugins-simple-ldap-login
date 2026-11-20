<?php

namespace SimpleLdapLoginVendor\LdapRecord\Events;

use function SimpleLdapLoginVendor\collect;
use function SimpleLdapLoginVendor\data_fill;
use function SimpleLdapLoginVendor\data_get;
use function SimpleLdapLoginVendor\data_set;
use function SimpleLdapLoginVendor\data_forget;
use function SimpleLdapLoginVendor\head;
use function SimpleLdapLoginVendor\last;
use function SimpleLdapLoginVendor\value;

use SimpleLdapLoginVendor\LdapRecord\Connection;
abstract class ConnectionEvent
{
    /**
     * The LDAP connection.
     */
    protected Connection $connection;
    /**
     * Constructor.
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }
    /**
     * Get the connection pertaining to the event.
     */
    public function getConnection(): Connection
    {
        return $this->connection;
    }
}
