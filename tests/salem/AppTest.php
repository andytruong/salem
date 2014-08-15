<?php

namespace AndyTruong\Salem\Testcases;

use AndyTruong\Salem\ApplicationTestCase;
use AndyTruong\Salem\Fixtures\Entity\DemoOBject;

class AppTest extends ApplicationTestCase
{

    public function testInit()
    {
        $app = $this->getApplication();
        $this->assertInstanceOf('AndyTruong\Salem\Application', $app);
    }

    public function testORM()
    {
        $em = $this->getEntityManager();

        $obj = new DemoOBject();
        $obj->setName('PHP 5.4');

        $em->persist($obj);
        $em->flush();

        $this->assertGreaterThan(0, $obj->getId());
    }

}
