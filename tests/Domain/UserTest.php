<?php

declare(strict_types=1);

namespace App\Tests\Domain;

use App\Domain\User\User;

class UserTest extends \App\Tests\ContainerTestCase
{
    public function userProvider(): array
    {
        return [
            ['bill.gates', 'xieM3yie', '2023-12-15'],
            ['steve.jobs', 'Ja3aph1e', '2026-03-18 23:49'],
            ['mark.zuckerberg', 'moo9rahH', '2026-05-17'],
            ['evan.spiegel', 'uTh8youh', '2027-11-30 04:01'],
            ['jack.dorsey', 'Roen3ahm', '2029-02-26 17:00'],
        ];
    }

    /**
     * @dataProvider userProvider
     * @param int    $id
     * @param string $username
     * @param string $firstName
     * @param string $lastName
     */
    public function testGetters(int $id, string $username, string $firstName, string $lastName)
    {
        $user = new User($id, $username, $firstName, $lastName);

        $this->assertEquals($id, $user->getId());
        $this->assertEquals($username, $user->getUsername());
        $this->assertEquals($firstName, $user->getFirstName());
        $this->assertEquals($lastName, $user->getLastName());
    }

    /**
     * @dataProvider userProvider
     * @param int    $id
     * @param string $username
     * @param string $firstName
     * @param string $lastName
     */
    public function testJsonSerialize(int $id, string $username, string $firstName, string $lastName)
    {
        $user = new User($id, $username, $firstName, $lastName);

        $expectedPayload = json_encode([
            'id' => $id,
            'username' => $username,
            'firstName' => $firstName,
            'lastName' => $lastName,
        ]);

        $this->assertEquals($expectedPayload, json_encode($user));
    }
}
