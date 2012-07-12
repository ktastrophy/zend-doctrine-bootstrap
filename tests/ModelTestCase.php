<?php
/**
 * @author Ken Thompson <ken@digitalm.co>
 */
class ModelTestCase
	extends PHPUnit_Framework_TestCase
{
	/**
	 * [setUp description]
	 * @var \Bisna\Application\Container\DoctrineContainer
	 */
	protected $doctrineContainer;

	/**
	 * Read files in $path for Entities and get their metadata
	 * @param  string $path
	 * @param  string $namespace
	 * @return array            Array of metadata for each entity
	 */
	public function getClassMetas($path, $namespace)
	{
		$metas = array();
		if ($handle = opendir($path))
		{
			while (false !== ($file = readdir($handle)))
			{
				if (strstr($file, '.php'))
				{
					list($class) = explode('.', $file);
					$metas[] = $this->doctrineContainer->getEntityManager()->getClassMetadata($namespace . $class);
				}
			}
		}
		return $metas;
	}

	public function setUp()
    {
        // Assign and instantiate in one step:
        $application = new Zend_Application(
            'testing',
            APPLICATION_PATH . '/configs/application.ini'
        );
        $application->bootstrap();
        $this->doctrineContainer = Zend_Registry::get('doctrine');
        $tool = new \Doctrine\ORM\Tools\SchemaTool($this->doctrineContainer->getEntityManager());
        $tool->dropSchema(self::getClassMetas(APPLICATION_PATH . '/../library/Application/Entity', 'Application\Entity\\'));
        $tool->createSchema(self::getClassMetas(APPLICATION_PATH . '/../library/Application/Entity', 'Application\Entity\\'));

        parent::setUp();
    }

    public function tearDown()
    {
    	//$tool = new \Doctrine\ORM\Tools\SchemaTool($this->doctrineContainer->getEntityManager());
        //$tool->dropSchema(self::getClassMetas(APPLICATION_PATH . '/../library/Application/Entity', 'Application\Entity\\'));
    	parent::tearDown();
    }

}