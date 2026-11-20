<?php

declare (strict_types=1);
namespace SimpleLdapLoginVendor\Carbon\Doctrine;

use SimpleLdapLoginVendor\Carbon\CarbonInterface;
use SimpleLdapLoginVendor\Doctrine\DBAL\Platforms\AbstractPlatform;
interface CarbonDoctrineType
{
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string;
    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): ?CarbonInterface;
    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): ?string;
}
