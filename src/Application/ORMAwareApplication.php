<?php

namespace AndyTruong\Salem\Application;

use Doctrine\Common\Cache\ArrayCache as Cache;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use RuntimeException;

trait ORMAwareApplication
{

    /**
     * @var EntityManagerInterface[]
     */
    protected $em;

    /**
     * @var string[] Entity directories.
     */
    protected $entity_dirs = [];

    /**
     * Setter for em property.
     *
     * @param EntityManagerInterface $em
     */
    public function setEntityManager($name, EntityManagerInterface $em)
    {
        $this->em[$name] = $em;
    }

    /**
     * Add entity directory.
     *
     * @param string $dir
     */
    public function addEntityDir($dir)
    {
        $this->entity_dirs[] = $dir;
    }

    /**
     * Doctrine ORM entities's path.
     *
     * @return string[]
     */
    protected function getEntityDirs()
    {
        return array_merge([dirname(__DIR__) . '/Entity/'], $this->entity_dirs);
    }

    /**
     * Getter for em property.
     *
     * @todo Implement me, configuration aware.
     * @return EntityManager
     */
    public function getEntitiyManager($name = 'default')
    {
        if (is_null($this->em[$name])) {
            $this->setEntityManager($name, $this->generateDefaultEntityManager($name));
        }

        return $this->em[$name];
    }

    /**
     * Default entity manager can be customised by override this method.
     *
     * @return EntityManagerInterface
     */
    public function generateDefaultEntityManager($name)
    {
        $config = new Configuration();
        $cache = new Cache();

        $config->setMetadataDriverImpl($config->newDefaultAnnotationDriver($this->getEntityDirs()));
        $config->setQueryCacheImpl($cache);
        $config->setMetadataCacheImpl($cache);
        $config->setProxyDir($this->app_root . '/files/tmp/entity_proxy');
        $config->setProxyNamespace('EntityProxy');
        $config->setAutoGenerateProxyClasses(true);

        // Connection information
        if ($connections = $this->variableGet('database')) {
            if (!isset($connections[$name])) {
                throw new RuntimeException(sprintf("Connection '%s' is not configured.", $name));
            }
            $connection = $connections[$name];
        }

        return EntityManager::create($connection, $config);
    }

}
