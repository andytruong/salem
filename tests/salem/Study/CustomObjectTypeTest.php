<?php

namespace AndyTruong\Salem\Testcases\Study;

use AndyTruong\Salem\ApplicationTestCase;
use AndyTruong\Salem\Fixtures\Entity\Country;
use AndyTruong\Salem\Fixtures\Entity\Person;
use Doctrine\DBAL\Types\Type;

/**
 * @group study
 */
class CustomObjectTypeTest extends ApplicationTestCase
{

    public function testCRUD()
    {
        Type::addType('country_code', 'AndyTruong\\Salem\\Fixtures\\Entity\\Type\\CountryCodeType');
        $em = $this->getEntityManager();
        $em->getConnection()->getDatabasePlatform()->registerDoctrineTypeMapping('country_code', 'country_code');

        $country = new Country();
        $country->setName('Vietnam');
        $country->setShortName('vn');

        $person = new Person();
        $person->setName('Andy');
        $person->setCountry($country);

        // $em->persist($country);
        $em->persist($person);
        $em->flush();

        $saved_person = $em->getRepository('AndyTruong\Salem\Fixtures\Entity\Person')->find(1);
        $this->assertInstanceOf('AndyTruong\Salem\Fixtures\Entity\Country', $saved_person->getCountry());
    }

}
