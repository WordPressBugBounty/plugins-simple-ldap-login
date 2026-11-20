<?php

namespace SimpleLdapLoginVendor\LdapRecord\Models\Concerns;

use function SimpleLdapLoginVendor\collect;
use function SimpleLdapLoginVendor\data_fill;
use function SimpleLdapLoginVendor\data_get;
use function SimpleLdapLoginVendor\data_set;
use function SimpleLdapLoginVendor\data_forget;
use function SimpleLdapLoginVendor\head;
use function SimpleLdapLoginVendor\last;
use function SimpleLdapLoginVendor\value;

use Closure;
use SimpleLdapLoginVendor\LdapRecord\Events\NullDispatcher;
use SimpleLdapLoginVendor\LdapRecord\Models\Events;
use SimpleLdapLoginVendor\LdapRecord\Models\Events\Event;
use SimpleLdapLoginVendor\LdapRecord\Models\Model;
use SimpleLdapLoginVendor\LdapRecord\Support\Arr;
/** @mixin Model */
trait HasEvents
{
    /**
     * Execute the callback without raising any events.
     */
    protected static function withoutEvents(Closure $callback): mixed
    {
        $container = static::getConnectionContainer();
        $dispatcher = $container->getDispatcher();
        if ($dispatcher) {
            $container->setDispatcher(new NullDispatcher($dispatcher));
        }
        try {
            return $callback();
        } finally {
            if ($dispatcher) {
                $container->setDispatcher($dispatcher);
            }
        }
    }
    /**
     * Dispatch the given model events.
     */
    protected function dispatch(array|string $events, array $args = []): void
    {
        foreach (Arr::wrap($events) as $name) {
            $this->fireCustomModelEvent($name, $args);
        }
    }
    /**
     * Fire a custom model event.
     */
    protected function fireCustomModelEvent(string $name, array $args = []): void
    {
        $event = implode('\\', [Events::class, ucfirst($name)]);
        $this->fireModelEvent(new $event($this, ...$args));
    }
    /**
     * Fire a model event.
     */
    protected function fireModelEvent(Event $event): void
    {
        static::getConnectionContainer()->getDispatcher()->fire($event);
    }
    /**
     * Listen to a model event.
     */
    protected function listenForModelEvent(string $event, Closure $listener): void
    {
        static::getConnectionContainer()->getDispatcher()->listen($event, $listener);
    }
}
