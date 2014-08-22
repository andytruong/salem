<?php

namespace AndyTruong\Salem\Fixtures\Entity\Type;

use AndyTruong\Salem\Fixtures\Entity\Country;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class CountryCodeType extends StringType
{

    public function getName()
    {
        return 'country_code';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        parent::convertToPHPValue($value, $platform);
        $country = new Country();
        $country->setShortName($value);
        $country->setName('Viet Nam');
        return $country;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if ($value instanceof Country) {
            $value = $value->getShortName();
        }
        return $value;
    }

}
