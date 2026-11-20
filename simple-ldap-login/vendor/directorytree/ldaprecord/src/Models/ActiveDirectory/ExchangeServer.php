<?php

namespace SimpleLdapLoginVendor\LdapRecord\Models\ActiveDirectory;

use function SimpleLdapLoginVendor\collect;
use function SimpleLdapLoginVendor\data_fill;
use function SimpleLdapLoginVendor\data_get;
use function SimpleLdapLoginVendor\data_set;
use function SimpleLdapLoginVendor\data_forget;
use function SimpleLdapLoginVendor\head;
use function SimpleLdapLoginVendor\last;
use function SimpleLdapLoginVendor\value;

class ExchangeServer extends Entry
{
    /**
     * {@inheritdoc}
     */
    public static array $objectClasses = ['msExchExchangeServer'];
    /**
     * {@inheritdoc}
     */
    public static function boot(): void
    {
        parent::boot();
        static::addGlobalScope(new Scopes\HasServerRoleAttribute());
        static::addGlobalScope(new Scopes\InConfigurationContext());
    }
}
