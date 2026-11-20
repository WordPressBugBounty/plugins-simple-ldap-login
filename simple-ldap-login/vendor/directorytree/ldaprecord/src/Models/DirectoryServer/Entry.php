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

use SimpleLdapLoginVendor\LdapRecord\Models\Model;
use SimpleLdapLoginVendor\LdapRecord\Models\Types\DirectoryServer;
class Entry extends Model implements DirectoryServer
{
    /**
     * The attribute key that contains the models object GUID.
     */
    protected string $guidKey = 'gidNumber';
}
