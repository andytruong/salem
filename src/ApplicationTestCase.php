<?php

namespace AndyTruong\Salem;

use Doctrine\ORM\Tools\SchemaTool;
use PHPUnit_Framework_TestCase;

// ---------------------
// Important objects for test cases
// ---------------------
class ApplicationTestCase extends PHPUnit_Framework_TestCase
{

    /** @var Application */
    static $app;

    /**
     * @return Application
     */
    public function getApplication()
    {
        if (null === self::$app) {
            self::$app = new Application(dirname(__DIR__), '/config/config.test.php');
            self::$app->addEntityDir(dirname(__DIR__) . '/tests/fixtures/Entity');
        }
        return self::$app;
    }

    public function getEntityManager()
    {
        static $ran = false;
        if (false === $ran) {
            $ran = true;
            $this->setupDB();
        }
        return $this->getApplication()->getEntitiyManager();
    }

    protected function setupDB()
    {
        // getting objects
        $em = $this->getApplication()->getEntitiyManager();
        $metadatas = $em->getMetadataFactory()->getAllMetadata();
        $schema_tool = new SchemaTool($em);

        // drop all schemas
        $schema_tool->dropSchema($metadatas);

        // recreate schemas
        $schema_tool->createSchema($metadatas);
    }

}
