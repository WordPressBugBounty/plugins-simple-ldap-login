<?php

namespace SimpleLdapLoginVendor\LdapRecord\Query\Pagination;

use function SimpleLdapLoginVendor\collect;
use function SimpleLdapLoginVendor\data_fill;
use function SimpleLdapLoginVendor\data_get;
use function SimpleLdapLoginVendor\data_set;
use function SimpleLdapLoginVendor\data_forget;
use function SimpleLdapLoginVendor\head;
use function SimpleLdapLoginVendor\last;
use function SimpleLdapLoginVendor\value;

use Generator;
use SimpleLdapLoginVendor\LdapRecord\LdapInterface;
class LazyPaginator extends Paginator
{
    /**
     * Execute the pagination request.
     */
    public function execute(LdapInterface $ldap): Generator
    {
        $this->prepareServerControls();
        try {
            do {
                $this->applyServerControls($ldap);
                if (!$resource = $this->query->run($this->filter)) {
                    break;
                }
                $this->updateServerControls($ldap, $resource);
                yield $this->query->parse($resource);
            } while ($this->shouldContinue());
        } finally {
            $this->resetServerControls($ldap);
        }
    }
}
