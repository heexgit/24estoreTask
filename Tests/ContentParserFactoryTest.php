<?php
require_once 'PHPUnit/Framework/TestCase.php';

use TwentyTwoEstore\Libs\ContentParserFactory;

/**
 * ContentParserFactory test case.
 */
class ContentParserFactoryTest extends PHPUnit_Framework_TestCase
{
	/**
	 * Constructs the test case.
	 */
	public function __construct()
	{
		require_once 'bootstrap.php';
	}

	/**
	 * Tests ContentParserFactory::produce()
	 */
	public function testProduce_Unsupported()
	{
		try{
			ContentParserFactory::produce('csv');
		} catch (\Exception $ex){
			$this->assertInstanceOf('\TwentyTwoEstore\Libs\ExecuteException', $ex);
			$this->assertEquals("Unsupported format 'csv'", $ex->getMessage());
		}
	}

	/**
	 * Tests ContentParserFactory::produce()
	 */
	public function testProduce_Json()
	{
		$result = ContentParserFactory::produce('json');
		$this->assertInstanceOf('\TwentyTwoEstore\Libs\JsonContentParser', $result);
	}

	/**
	 * Tests ContentParserFactory::produce()
	 */
	public function testProduce_Xml()
	{
		$result = ContentParserFactory::produce('xml');
		$this->assertInstanceOf('\TwentyTwoEstore\Libs\XmlContentParser', $result);
	}
}