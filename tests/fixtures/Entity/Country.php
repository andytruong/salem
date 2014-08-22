<?php

namespace AndyTruong\Salem\Fixtures\Entity;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;

/**
 * @Entity
 */
class Country
{

    /**
     * @Id
     * @GeneratedValue(strategy="AUTO")
     * @Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @Column(type="string", length=128, unique=true, nullable=false)
     * @var string
     */
    private $name;

    /**
     * @Column(type="string", length=8, unique=true, nullable=false)
     * @var string
     */
    private $shortName;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getShortName()
    {
        return $this->shortName;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setShortName($shortName)
    {
        $this->shortName = $shortName;
    }

}
