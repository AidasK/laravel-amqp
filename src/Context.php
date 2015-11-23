<?php namespace Bschmitt\Amqp;

use Illuminate\Config\Repository;
use PhpAmqpLib\Connection\AMQPStreamConnection;

/**
 * @author Björn Schmitt <code@bjoern.io>
 */
abstract class Context
{

    /**
     * @var array
     */
    protected $properties = [];

    /**
     * Context constructor.
     *
     * @param Repository $config
     */
    public function __construct(Repository $config)
    {
        $this->extractProperties($config);
    }

    /**
     * @param Repository $config
     */
    protected function extractProperties(Repository $config)
    {
        $this->properties = $config['amqp']['properties'][$config['amqp']['use']];
    }

    /**
     * @param array $properties
     * @return $this
     */
    public function mergeProperties(array $properties)
    {
        $this->properties = array_merge($this->properties, $properties);
        return $this;
    }

    /**
     * @return array
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function getProperty($key)
    {
        return array_key_exists($key, $this->properties) ? $this->properties[$key] : NULL;
    }

    /**
     * @return mixed
     */
    abstract function setup();

}
 