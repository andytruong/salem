<?php

namespace AndyTruong\Salem\Fixtures\Entity;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;

/**
 * @Entity
 */
class Person
{

    /**
     * @Id
     * @GeneratedValue(strategy="AUTO")
     * @Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @Column(type="string", length=128, unique=false, nullable=false)
     * @var type
     */
    private $name;

    /**
     * @Column(type="country_code")
     * @var Country
     */
    private $country;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setCountry(Country $country)
    {
        $this->country = $country;
    }

    public function getCountry()
    {
        return $this->country;
    }

}
