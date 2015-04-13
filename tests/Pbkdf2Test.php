<?php
/**
 * Created by PhpStorm.
 * User: robert
 * Date: 13.04.2015
 * Time: 20:55
 */
use Illuminate\Filesystem\Filesystem;
use Mockery as m;
use ReflectionClass;
use Vjroby\LaravelPbkdf2\Pbkdf2;

class Pbkdf2Test extends Illuminate\Foundation\Testing\TestCase
{

    /**
     * @var Pbkdf2
     */
    private $pbkdf2Test;

    /**
     * @var ReflectionClass
     */
    private $reflection;

    public function testDefaultValues()
    {
        $this->assertEquals('sha256', $this->getProperty("hashAlgorithm"));
        $this->assertEquals('1000', $this->getProperty("iterations"));
        $this->assertEquals('32', $this->getProperty("saltBytes"));
        $this->assertEquals('64', $this->getProperty("hashBytes"));
    }

    /**
     * @expectedException RuntimeException
     */
    public function testInvalidHashAlgorithm()
    {
        $pbkdf2 = new Pbkdf2(['hash_algorithm' => 'invalid']);

        $pbkdf2->createHash('password', 'salt');
    }

    /**
     * Creates the application.
     *
     * Needs to be implemented by subclasses.
     *
     * @return \Symfony\Component\HttpKernel\HttpKernelInterface
     */
    public function createApplication()
    {
        $unitTesting = true;

        $testEnvironment = 'testing';

        $app = require __DIR__ . '/bootstrap/start.php';

        $app->register('Vjroby\LaravelPbkdf2\LaravelPbkdf2ServiceProvider');


        return $app;
    }

    public function setUp()
    {
        $this->pbkdf2Test = new Pbkdf2();
        $this->reflection = new ReflectionClass($this->pbkdf2Test);
        parent::setUp();

    }

    public function getProperty($property)
    {
        $property = $this->reflection->getProperty($property);
        $property->setAccessible(true);

        return $property->getValue($this->pbkdf2Test);
    }

}