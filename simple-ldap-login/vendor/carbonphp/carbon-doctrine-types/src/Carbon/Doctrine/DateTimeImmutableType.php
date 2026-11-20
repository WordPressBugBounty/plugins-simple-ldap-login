<?php

declare (strict_types=1);
namespace SimpleLdapLoginVendor\Carbon\Doctrine;

use SimpleLdapLoginVendor\Carbon\CarbonImmutable;
use DateTimeImmutable;
use SimpleLdapLoginVendor\Doctrine\DBAL\Platforms\AbstractPlatform;
use SimpleLdapLoginVendor\Doctrine\DBAL\Types\VarDateTimeImmutableType;
class DateTimeImmutableType extends VarDateTimeImmutableType implements CarbonDoctrineType
{
    /** @use CarbonTypeConverter<CarbonImmutable> */
    use CarbonTypeConverter;
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): ?CarbonImmutable
    {
        return $this->doConvertToPHPValue($value);
    }
    /**
     * @return class-string<CarbonImmutable>
     */
    protected function getCarbonClassName(): string
    {
        return CarbonImmutable::class;
    }
}
