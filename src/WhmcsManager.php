<?php

declare(strict_types=1);

namespace DarthSoup\Whmcs;

use Closure;
use DarthSoup\WhmcsApi\Client;
use Illuminate\Contracts\Config\Repository;
use InvalidArgumentException;

class WhmcsManager
{
    protected WhmcsFactory $factory;

    protected Repository $config;

    /**
     * @var array<string,object>
     */
    protected $connections = [];

    /**
     * @var array<string,callable>
     */
    protected $extensions = [];

    public function __construct(Repository $config, WhmcsFactory $factory)
    {
        $this->config = $config;
        $this->factory = $factory;
    }

    protected function createConnection(array $config): Client
    {
        return $this->factory->make($config);
    }

    public function getFactory(): WhmcsFactory
    {
        return $this->factory;
    }

    public function connection(string $name = null)
    {
        $name = $name ?: $this->getDefaultConnection();

        if (!isset($this->connections[$name])) {
            $this->connections[$name] = $this->makeConnection($name);
        }

        return $this->connections[$name];
    }

    public function reconnect(string $name = null)
    {
        $name = $name ?: $this->getDefaultConnection();

        $this->disconnect($name);

        return $this->connection($name);
    }

    public function disconnect(string $name = null): void
    {
        $name = $name ?: $this->getDefaultConnection();

        unset($this->connections[$name]);
    }

    protected function makeConnection(string $name): Client
    {
        $config = $this->getConnectionConfig($name);

        if (isset($this->extensions[$name])) {
            return $this->extensions[$name]($config);
        }

        if ($driver = Arr::get($config, 'driver')) {
            if (isset($this->extensions[$driver])) {
                return $this->extensions[$driver]($config);
            }
        }

        return $this->createConnection($config);
    }

    public function getConnectionConfig(string $name = null): array
    {
        $name = $name ?: $this->getDefaultConnection();

        return $this->getNamedConfig('connections', 'Connection', $name);
    }

    protected function getNamedConfig(string $type, string $desc, string $name): array
    {
        $data = $this->config->get($this->getConfigName().'.'.$type);

        if (!is_array($config = Arr::get($data, $name)) && !$config) {
            throw new InvalidArgumentException("$desc [$name] not configured.");
        }

        $config['name'] = $name;

        return $config;
    }

    public function getDefaultConnection(): string
    {
        return $this->config->get($this->getConfigName().'.default');
    }

    public function setDefaultConnection(string $name): void
    {
        $this->config->set($this->getConfigName().'.default', $name);
    }

    public function extend(string $name, callable $resolver): void
    {
        if ($resolver instanceof Closure) {
            $this->extensions[$name] = $resolver->bindTo($this, $this);
        } else {
            $this->extensions[$name] = $resolver;
        }
    }

    /**
     * @return array<string,object>
     */
    public function getConnections(): array
    {
        return $this->connections;
    }

    public function getConfig(): Repository
    {
        return $this->config;
    }

    protected function getConfigName(): string
    {
        return 'whmcs';
    }

    public function __call(string $method, array $parameters)
    {
        return $this->connection()->$method(...$parameters);
    }
}
