<?php

namespace SimpleLdapLoginVendor\LdapRecord\Models\DirectoryServer;

use function SimpleLdapLoginVendor\collect;
use function SimpleLdapLoginVendor\data_fill;
use function SimpleLdapLoginVendor\data_get;
use function SimpleLdapLoginVendor\data_set;
use function SimpleLdapLoginVendor\data_forget;
use function SimpleLdapLoginVendor\head;
use function SimpleLdapLoginVendor\last;
use function SimpleLdapLoginVendor\value;

class User extends Entry
{
    /**
     * The object classes of the LDAP model.
     */
    public static array $objectClasses = ['top', 'nsPerson', 'nsAccount', 'nsOrgPerson', 'posixAccount'];
}
