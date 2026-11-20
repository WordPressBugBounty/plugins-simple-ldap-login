<?php

namespace SimpleLdapLoginVendor\LdapRecord\Models;

use function SimpleLdapLoginVendor\collect;
use function SimpleLdapLoginVendor\data_fill;
use function SimpleLdapLoginVendor\data_get;
use function SimpleLdapLoginVendor\data_set;
use function SimpleLdapLoginVendor\data_forget;
use function SimpleLdapLoginVendor\head;
use function SimpleLdapLoginVendor\last;
use function SimpleLdapLoginVendor\value;

trait DetectsResetIntegers
{
    /**
     * Determine if the given value is an LDAP reset integer.
     *
     * The integer values '0' and '-1' can be used on certain
     * LDAP attributes to instruct the server to reset the
     * value to an 'unset' or 'cleared' state.
     */
    protected function valueIsResetInteger(mixed $value): bool
    {
        return in_array($value, [0, -1], \true);
    }
}
