<?php

namespace SimpleLdapLoginVendor\Illuminate\Contracts\Process;

use function SimpleLdapLoginVendor\collect;
use function SimpleLdapLoginVendor\data_fill;
use function SimpleLdapLoginVendor\data_get;
use function SimpleLdapLoginVendor\data_set;
use function SimpleLdapLoginVendor\data_forget;
use function SimpleLdapLoginVendor\head;
use function SimpleLdapLoginVendor\last;
use function SimpleLdapLoginVendor\value;

interface ProcessResult
{
    /**
     * Get the original command executed by the process.
     *
     * @return string
     */
    public function command();
    /**
     * Determine if the process was successful.
     *
     * @return bool
     */
    public function successful();
    /**
     * Determine if the process failed.
     *
     * @return bool
     */
    public function failed();
    /**
     * Get the exit code of the process.
     *
     * @return int|null
     */
    public function exitCode();
    /**
     * Get the standard output of the process.
     *
     * @return string
     */
    public function output();
    /**
     * Get the error output of the process.
     *
     * @return string
     */
    public function errorOutput();
    /**
     * Throw an exception if the process failed.
     *
     * @param  callable|null  $callback
     * @return $this
     */
    public function throw(?callable $callback = null);
    /**
     * Throw an exception if the process failed and the given condition is true.
     *
     * @param  bool  $condition
     * @param  callable|null  $callback
     * @return $this
     */
    public function throwIf(bool $condition, ?callable $callback = null);
}
