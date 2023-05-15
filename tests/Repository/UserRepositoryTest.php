<?php

declare(strict_types=1);

namespace App\Tests\Repository;

use App\Domain\User\User;
use App\Repository\UserRepository;
use TXC\Box\Exception\EntityNotFound;
use TXC\Box\Testing\TestCase;

class UserRepositoryTest extends TestCase
{
    public function testFindAll()
    {
        $user = new User(1, 'bill.gates', 'Bill', 'Gates');

        $userRepository = new UserRepository([1 => $user]);

        $this->assertEquals([$user], $userRepository->findAll());
    }

    public function testFindAllUsersByDefault()
    {
        $users = [
            1 => new User(1, 'bill.gates', 'Bill', 'Gates'),
            2 => new User(2, 'steve.jobs', 'Steve', 'Jobs'),
            3 => new User(3, 'mark.zuckerberg', 'Mark', 'Zuckerberg'),
            4 => new User(4, 'evan.spiegel', 'Evan', 'Spiegel'),
            5 => new User(5, 'jack.dorsey', 'Jack', 'Dorsey'),
        ];

        $userRepository = new UserRepository();

        $this->assertEquals(array_values($users), $userRepository->findAll());
    }

    public function testFindUserOfId()
    {
        $user = new User(1, 'bill.gates', 'Bill', 'Gates');

        $userRepository = new UserRepository([1 => $user]);

        $this->assertEquals($user, $userRepository->find(1));
    }

    public function testFindUserOfIdThrowsNotFoundException()
    {
        $userRepository = new UserRepository([]);
        $this->expectException(EntityNotFound::class);
        $userRepository->find(1);
    }
}
