<?php

namespace SimpleLdapLoginVendor\LdapRecord;

use function SimpleLdapLoginVendor\collect;
use function SimpleLdapLoginVendor\data_fill;
use function SimpleLdapLoginVendor\data_get;
use function SimpleLdapLoginVendor\data_set;
use function SimpleLdapLoginVendor\data_forget;
use function SimpleLdapLoginVendor\head;
use function SimpleLdapLoginVendor\last;
use function SimpleLdapLoginVendor\value;

use SimpleLdapLoginVendor\LdapRecord\Events\Dispatcher;
use SimpleLdapLoginVendor\LdapRecord\Events\DispatcherInterface;
use SimpleLdapLoginVendor\LdapRecord\Events\Logger;
use SimpleLdapLoginVendor\Psr\Log\LoggerInterface;
class ConnectionManager
{
    /**
     * The added LDAP connections.
     *
     * @var Connection[]
     */
    protected array $connections = [];
    /**
     * The name of the default connection.
     */
    protected string $default = 'default';
    /**
     * The events to register listeners for during initialization.
     */
    protected array $listen = ['SimpleLdapLoginVendor\LdapRecord\Auth\Events\*', 'SimpleLdapLoginVendor\LdapRecord\Query\Events\*', 'SimpleLdapLoginVendor\LdapRecord\Models\Events\*'];
    /**
     * The logger instance.
     */
    protected ?LoggerInterface $logger = null;
    /**
     * The event dispatcher instance.
     */
    protected ?DispatcherInterface $dispatcher = null;
    /**
     * Constructor.
     */
    public function __construct($dispatcher = new Dispatcher())
    {
        $this->dispatcher = $dispatcher;
    }
    /**
     * Add a new connection.
     */
    public function addConnection(Connection $connection, ?string $name = null): void
    {
        $this->connections[$name ?? $this->default] = $connection;
        if ($this->dispatcher) {
            $connection->setDispatcher($this->dispatcher);
        }
    }
    /**
     * Remove a connection by its name.
     */
    public function removeConnection(string $name): void
    {
        unset($this->connections[$name]);
    }
    /**
     * Get all the registered connections.
     *
     * @return Connection[]
     */
    public function getConnections(): array
    {
        return $this->connections;
    }
    /**
     * Get a connection by its name or return the default.
     *
     * @throws ContainerException If the given connection does not exist.
     */
    public function getConnection(?string $name = null): Connection
    {
        if ($this->hasConnection($name = $name ?? $this->default)) {
            return $this->connections[$name];
        }
        throw new ContainerException("The LDAP connection [{$name}] does not exist.");
    }
    /**
     * Get the default connection.
     */
    public function getDefaultConnection(): Connection
    {
        return $this->getConnection($this->default);
    }
    /**
     * Set the default connection by its name.
     */
    public function setDefaultConnection(string $name): void
    {
        $this->default = $name;
    }
    /**
     * Get the default connection name.
     */
    public function getDefaultConnectionName(): string
    {
        return $this->default;
    }
    /**
     * Determine if a connection exists.
     */
    public function hasConnection(string $name): bool
    {
        return array_key_exists($name, $this->connections);
    }
    /**
     * Flush the manager of all instances and connections.
     */
    public function flush(): void
    {
        $this->logger = null;
        $this->connections = [];
        $this->dispatcher->forgetAll();
    }
    /**
     * Get the logger instance.
     */
    public function getLogger(): ?LoggerInterface
    {
        return $this->logger;
    }
    /**
     * Set the event logger to use.
     */
    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
        $this->initEventLogger();
    }
    /**
     * Initialize the event logger.
     */
    protected function initEventLogger(): void
    {
        $logger = $this->newEventLogger();
        foreach ($this->listen as $event) {
            $this->dispatcher->listen($event, function ($eventName, $events) use ($logger) {
                foreach ($events as $event) {
                    $logger->log($event);
                }
            });
        }
    }
    /**
     * Make a new event logger instance.
     */
    protected function newEventLogger(): Logger
    {
        return new Logger($this->logger);
    }
    /**
     * Unset the logger instance.
     */
    public function unsetLogger(): void
    {
        $this->logger = null;
    }
    /**
     * Get the event dispatcher.
     */
    public function getDispatcher(): ?DispatcherInterface
    {
        return $this->dispatcher;
    }
    /**
     * Set the event dispatcher.
     */
    public function setDispatcher(DispatcherInterface $dispatcher): void
    {
        $this->dispatcher = $dispatcher;
    }
    /**
     * Unset the event dispatcher.
     */
    public function unsetDispatcher(): void
    {
        $this->dispatcher = null;
    }
}
