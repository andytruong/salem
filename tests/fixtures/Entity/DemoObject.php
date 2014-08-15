<?php

namespace AndyTruong\Salem\Fixtures\Entity;

/**
 * @Entity
 */
class DemoOBject
{

    /**
     * @Id
     * @GeneratedValue(strategy="AUTO")
     * @Column(type="integer")
     */
    private $id;

    /**
     * @Column(type="string", length=255, unique=false, nullable=false)
     * @var string
     */
    private $name;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

}
