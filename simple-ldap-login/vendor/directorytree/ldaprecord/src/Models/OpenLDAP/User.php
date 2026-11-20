<?php

namespace SimpleLdapLoginVendor\LdapRecord\Models\OpenLDAP;

use function SimpleLdapLoginVendor\collect;
use function SimpleLdapLoginVendor\data_fill;
use function SimpleLdapLoginVendor\data_get;
use function SimpleLdapLoginVendor\data_set;
use function SimpleLdapLoginVendor\data_forget;
use function SimpleLdapLoginVendor\head;
use function SimpleLdapLoginVendor\last;
use function SimpleLdapLoginVendor\value;

use SimpleLdapLoginVendor\Illuminate\Contracts\Auth\Authenticatable;
use SimpleLdapLoginVendor\LdapRecord\LdapRecordException;
use SimpleLdapLoginVendor\LdapRecord\Models\Concerns\CanAuthenticate;
use SimpleLdapLoginVendor\LdapRecord\Models\Concerns\HasPassword;
use SimpleLdapLoginVendor\LdapRecord\Models\Relations\HasMany;
use SensitiveParameter;
class User extends Entry implements Authenticatable
{
    use CanAuthenticate;
    use HasPassword;
    /**
     * The password's attribute name.
     */
    protected string $passwordAttribute = 'userpassword';
    /**
     * The password's hash method.
     */
    protected string $passwordHashMethod = 'ssha';
    /**
     * The object classes of the LDAP model.
     */
    public static array $objectClasses = ['top', 'person', 'organizationalperson', 'inetorgperson'];
    /**
     * Change the user's password.
     *
     * @throws LdapRecordException
     */
    public function changePassword(#[SensitiveParameter] string $oldPassword, #[SensitiveParameter] string $newPassword): void
    {
        $this->assertSecureConnection();
        if (!$this->exists || !$this->getDn()) {
            throw new LdapRecordException('A password change requires an existing model with a distinguished name.');
        }
        if ($oldPassword === '' || $newPassword === '') {
            throw new LdapRecordException('The current and new passwords must not be empty.');
        }
        $this->getConnection()->changePassword($this->getDn(), $oldPassword, $newPassword);
    }
    /**
     * Get the unique identifier for the user.
     */
    public function getAuthIdentifier(): string
    {
        return $this->getFirstAttribute($this->guidKey);
    }
    /**
     * The groups relationship.
     */
    public function groups(): HasMany
    {
        return $this->hasMany(Group::class, 'uniquemember');
    }
}
