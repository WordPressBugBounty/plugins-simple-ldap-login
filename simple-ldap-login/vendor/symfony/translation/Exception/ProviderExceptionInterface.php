<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace SimpleLdapLoginVendor\Symfony\Component\Translation\Exception;

use function SimpleLdapLoginVendor\trigger_deprecation;

/**
 * @author Fabien Potencier <fabien@symfony.com>
 */
interface ProviderExceptionInterface extends ExceptionInterface
{
    /*
     * Returns debug info coming from the Symfony\Contracts\HttpClient\ResponseInterface
     */
    public function getDebug(): string;
}
