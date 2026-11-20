<?php

declare (strict_types=1);
namespace SimpleLdapLoginVendor\Carbon\Doctrine;

use SimpleLdapLoginVendor\Carbon\Carbon;
use DateTime;
use SimpleLdapLoginVendor\Doctrine\DBAL\Platforms\AbstractPlatform;
use SimpleLdapLoginVendor\Doctrine\DBAL\Types\VarDateTimeType;
class DateTimeType extends VarDateTimeType implements CarbonDoctrineType
{
    /** @use CarbonTypeConverter<Carbon> */
    use CarbonTypeConverter;
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): ?Carbon
    {
        return $this->doConvertToPHPValue($value);
    }
}
