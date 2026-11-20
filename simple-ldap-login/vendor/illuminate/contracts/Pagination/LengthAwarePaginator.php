<?php

namespace SimpleLdapLoginVendor\Illuminate\Contracts\Pagination;

use function SimpleLdapLoginVendor\collect;
use function SimpleLdapLoginVendor\data_fill;
use function SimpleLdapLoginVendor\data_get;
use function SimpleLdapLoginVendor\data_set;
use function SimpleLdapLoginVendor\data_forget;
use function SimpleLdapLoginVendor\head;
use function SimpleLdapLoginVendor\last;
use function SimpleLdapLoginVendor\value;

interface LengthAwarePaginator extends Paginator
{
    /**
     * Create a range of pagination URLs.
     *
     * @param  int  $start
     * @param  int  $end
     * @return array
     */
    public function getUrlRange($start, $end);
    /**
     * Determine the total number of items in the data store.
     *
     * @return int
     */
    public function total();
    /**
     * Get the page number of the last available page.
     *
     * @return int
     */
    public function lastPage();
}
