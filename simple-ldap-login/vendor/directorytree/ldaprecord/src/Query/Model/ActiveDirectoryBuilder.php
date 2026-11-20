<?php

namespace SimpleLdapLoginVendor\LdapRecord\Query\Model;

use function SimpleLdapLoginVendor\collect;
use function SimpleLdapLoginVendor\data_fill;
use function SimpleLdapLoginVendor\data_get;
use function SimpleLdapLoginVendor\data_set;
use function SimpleLdapLoginVendor\data_forget;
use function SimpleLdapLoginVendor\head;
use function SimpleLdapLoginVendor\last;
use function SimpleLdapLoginVendor\value;

use Closure;
use SimpleLdapLoginVendor\LdapRecord\LdapInterface;
use SimpleLdapLoginVendor\LdapRecord\Models\Attributes\AccountControl;
use SimpleLdapLoginVendor\LdapRecord\Models\Model;
use SimpleLdapLoginVendor\LdapRecord\Models\ModelNotFoundException;
class ActiveDirectoryBuilder extends Builder
{
    /**
     * Finds a record by its Object SID.
     */
    public function findBySid(string $sid, array|string $selects = ['*']): ?Model
    {
        try {
            return $this->findBySidOrFail($sid, $selects);
        } catch (ModelNotFoundException) {
            return null;
        }
    }
    /**
     * Finds a record by its Object SID.
     *
     * Fails upon no records returned.
     *
     * @throws ModelNotFoundException
     */
    public function findBySidOrFail(string $sid, array $selects = ['*']): Model
    {
        return $this->findByOrFail('objectsid', $sid, $selects);
    }
    /**
     * Adds a enabled filter to the current query.
     */
    public function whereEnabled(): static
    {
        return $this->notFilter(fn(self $query) => $query->whereDisabled());
    }
    /**
     * Adds a disabled filter to the current query.
     */
    public function whereDisabled(): static
    {
        return $this->rawFilter((new AccountControl())->setAccountIsDisabled()->filter());
    }
    /**
     * Adds a 'where member' filter to the current query.
     */
    public function whereMember(string $dn, bool $nested = \false): static
    {
        return $this->nestedMatchQuery(fn(string $attribute) => $this->whereEquals($attribute, $this->substituteBaseDn($dn)), 'member', $nested);
    }
    /**
     * Adds an 'or where member' filter to the current query.
     */
    public function orWhereMember(string $dn, bool $nested = \false): static
    {
        return $this->nestedMatchQuery(fn(string $attribute) => $this->orWhereEquals($attribute, $this->substituteBaseDn($dn)), 'member', $nested);
    }
    /**
     * Adds a 'where member of' filter to the current query.
     */
    public function whereMemberOf(string $dn, bool $nested = \false): static
    {
        return $this->nestedMatchQuery(fn(string $attribute) => $this->whereEquals($attribute, $this->substituteBaseDn($dn)), 'memberof', $nested);
    }
    /**
     * Adds a 'where not member of' filter to the current query.
     */
    public function whereNotMemberof(string $dn, bool $nested = \false): static
    {
        return $this->nestedMatchQuery(fn(string $attribute) => $this->whereNotEquals($attribute, $this->substituteBaseDn($dn)), 'memberof', $nested);
    }
    /**
     * Adds an 'or where member of' filter to the current query.
     */
    public function orWhereMemberOf(string $dn, bool $nested = \false): static
    {
        return $this->nestedMatchQuery(fn(string $attribute) => $this->orWhereEquals($attribute, $this->substituteBaseDn($dn)), 'memberof', $nested);
    }
    /**
     * Adds a 'or where not member of' filter to the current query.
     */
    public function orWhereNotMemberof(string $dn, bool $nested = \false): static
    {
        return $this->nestedMatchQuery(fn(string $attribute) => $this->orWhereNotEquals($attribute, $this->substituteBaseDn($dn)), 'memberof', $nested);
    }
    /**
     * Adds a 'where manager' filter to the current query.
     */
    public function whereManager(string $dn, bool $nested = \false): static
    {
        return $this->nestedMatchQuery(fn(string $attribute) => $this->whereEquals($attribute, $this->substituteBaseDn($dn)), 'manager', $nested);
    }
    /**
     * Adds a 'where not manager' filter to the current query.
     */
    public function whereNotManager(string $dn, bool $nested = \false): static
    {
        return $this->nestedMatchQuery(fn(string $attribute) => $this->whereNotEquals($attribute, $this->substituteBaseDn($dn)), 'manager', $nested);
    }
    /**
     * Adds an 'or where manager' filter to the current query.
     */
    public function orWhereManager(string $dn, bool $nested = \false): static
    {
        return $this->nestedMatchQuery(fn(string $attribute) => $this->orWhereEquals($attribute, $this->substituteBaseDn($dn)), 'manager', $nested);
    }
    /**
     * Adds an 'or where not manager' filter to the current query.
     */
    public function orWhereNotManager(string $dn, bool $nested = \false): static
    {
        return $this->nestedMatchQuery(fn(string $attribute) => $this->orWhereNotEquals($attribute, $this->substituteBaseDn($dn)), 'manager', $nested);
    }
    /**
     * Execute the callback with a nested match attribute.
     */
    protected function nestedMatchQuery(Closure $callback, string $attribute, bool $nested = \false): static
    {
        return $callback($nested ? $this->makeNestedMatchAttribute($attribute) : $attribute);
    }
    /**
     * Make a "nested match" filter attribute for querying descendants.
     */
    protected function makeNestedMatchAttribute(string $attribute): string
    {
        return sprintf('%s:%s:', $attribute, LdapInterface::OID_MATCHING_RULE_IN_CHAIN);
    }
}
