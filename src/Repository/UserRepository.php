<?php

declare(strict_types=1);

namespace App\Repository;

use App\Domain\User\User;
use TXC\Box\Repository\MemoryRepository;

class UserRepository extends MemoryRepository
{
    /**
     * @param User[]|null $users
     */
    public function __construct(array $users = null)
    {
        $users = $users ?? [
            1 => new User(1, 'bill.gates', 'Bill', 'Gates'),
            2 => new User(2, 'steve.jobs', 'Steve', 'Jobs'),
            3 => new User(3, 'mark.zuckerberg', 'Mark', 'Zuckerberg'),
            4 => new User(4, 'evan.spiegel', 'Evan', 'Spiegel'),
            5 => new User(5, 'jack.dorsey', 'Jack', 'Dorsey'),
        ];
        parent::__construct($users);
    }
}
