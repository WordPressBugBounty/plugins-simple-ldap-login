<?php

namespace SimpleLdapLoginVendor\LdapRecord\Models\Types;

use function SimpleLdapLoginVendor\collect;
use function SimpleLdapLoginVendor\data_fill;
use function SimpleLdapLoginVendor\data_get;
use function SimpleLdapLoginVendor\data_set;
use function SimpleLdapLoginVendor\data_forget;
use function SimpleLdapLoginVendor\head;
use function SimpleLdapLoginVendor\last;
use function SimpleLdapLoginVendor\value;

interface ActiveDirectory extends TypeInterface
{
    /**
     * Get the models object SID key.
     */
    public function getObjectSidKey(): string;
    /**
     * Get the model's hex object SID.
     *
     * @see https://msdn.microsoft.com/en-us/library/ms679024(v=vs.85).aspx
     */
    public function getObjectSid(): ?string;
    /**
     * Get the model's SID.
     */
    public function getConvertedSid(?string $sid = null): ?string;
    /**
     * Get the model's binary SID.
     */
    public function getBinarySid(?string $sid = null): ?string;
}
