<?php

namespace SimpleLdapLoginVendor\LdapRecord\Query;

use function SimpleLdapLoginVendor\collect;
use function SimpleLdapLoginVendor\data_fill;
use function SimpleLdapLoginVendor\data_get;
use function SimpleLdapLoginVendor\data_set;
use function SimpleLdapLoginVendor\data_forget;
use function SimpleLdapLoginVendor\head;
use function SimpleLdapLoginVendor\last;
use function SimpleLdapLoginVendor\value;

use SimpleLdapLoginVendor\LdapRecord\Query\Filter\BooleanGroup;
use SimpleLdapLoginVendor\LdapRecord\Query\Filter\Filter;
use SimpleLdapLoginVendor\LdapRecord\Query\Filter\GroupFilter;
trait ExtractsNestedFilters
{
    /**
     * Extract filters from a nested group filter for re-wrapping, preserving nested groups.
     *
     * @return array<Filter>
     */
    protected function extractNestedFilters(Filter $filter): array
    {
        if (!$filter instanceof BooleanGroup) {
            return [$filter];
        }
        if ($filter->isNested()) {
            return [$filter];
        }
        $children = $filter->getFilters();
        // If any child is a group, preserve the structure.
        foreach ($children as $child) {
            if ($child instanceof GroupFilter) {
                return $children;
            }
        }
        // All children are non-groups, it's safe to unwrap.
        return $children;
    }
}
