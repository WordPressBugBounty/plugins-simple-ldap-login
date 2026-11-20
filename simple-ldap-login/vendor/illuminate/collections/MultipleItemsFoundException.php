<?php

namespace SimpleLdapLoginVendor\Illuminate\Support;

use function SimpleLdapLoginVendor\collect;
use function SimpleLdapLoginVendor\data_fill;
use function SimpleLdapLoginVendor\data_get;
use function SimpleLdapLoginVendor\data_set;
use function SimpleLdapLoginVendor\data_forget;
use function SimpleLdapLoginVendor\head;
use function SimpleLdapLoginVendor\last;
use function SimpleLdapLoginVendor\value;

use RuntimeException;
class MultipleItemsFoundException extends RuntimeException
{
    /**
     * The number of items found.
     *
     * @var int
     */
    public $count;
    /**
     * Create a new exception instance.
     *
     * @param  int  $count
     * @param  int  $code
     * @param  \Throwable|null  $previous
     * @return void
     */
    public function __construct($count, $code = 0, $previous = null)
    {
        $this->count = $count;
        parent::__construct("{$count} items were found.", $code, $previous);
    }
    /**
     * Get the number of items found.
     *
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }
}
