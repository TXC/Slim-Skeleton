<?php

declare(strict_types=1);

namespace App\Application\Handlers;

use ArrayAccess;
use Countable;
use Iterator;
use Redis;

class RedisStorage implements ArrayAccess, Countable, Iterator
{
    public function __construct(private readonly Redis $redis)
    {
    }

    public function offsetExists(mixed $offset)
    {
        $keys = $this->redis->keys($offset);
        return count($keys) == 1;
    }

    public function offsetGet(mixed $offset)
    {
        $keys = $this->redis->keys($offset);
        $key = current($keys);
        return $this->redis->get($key);
    }

    public function offsetSet(mixed $offset, mixed $value)
    {
        $this->redis->set($offset, $value);
    }

    public function offsetUnset(mixed $offset)
    {
        $this->redis->del($offset);
    }

    public function count()
    {
        $keys = $this->redis->keys('*');
        return count($keys);
    }

    public function current()
    {
        // TODO: Implement current() method.
    }

    public function next()
    {
        // TODO: Implement next() method.
    }

    public function key()
    {
        // TODO: Implement key() method.
    }

    public function valid()
    {
        // TODO: Implement valid() method.
    }

    public function rewind()
    {
        // TODO: Implement rewind() method.
    }
}
