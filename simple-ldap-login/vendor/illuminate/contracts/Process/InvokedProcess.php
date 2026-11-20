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

interface InvokedProcess
{
    /**
     * Get the process ID if the process is still running.
     *
     * @return int|null
     */
    public function id();
    /**
     * Send a signal to the process.
     *
     * @param  int  $signal
     * @return $this
     */
    public function signal(int $signal);
    /**
     * Determine if the process is still running.
     *
     * @return bool
     */
    public function running();
    /**
     * Get the standard output for the process.
     *
     * @return string
     */
    public function output();
    /**
     * Get the error output for the process.
     *
     * @return string
     */
    public function errorOutput();
    /**
     * Get the latest standard output for the process.
     *
     * @return string
     */
    public function latestOutput();
    /**
     * Get the latest error output for the process.
     *
     * @return string
     */
    public function latestErrorOutput();
    /**
     * Wait for the process to finish.
     *
     * @param  callable|null  $output
     * @return \Illuminate\Console\Process\ProcessResult
     */
    public function wait(?callable $output = null);
}
