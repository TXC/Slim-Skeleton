<?php

declare(strict_types=1);

namespace App\Tests\Application\Handlers;

use App\Application\Handlers\DoctrineStorage;
use App\Repository\GuardRepository;
use App\Tests\ContainerTestCase;
use ArrayAccess;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineStorageTest extends ContainerTestCase
{
    public function keyProvider(): array
    {
        return [
            ['bill.gates', 'xieM3yie'],
            ['steve.jobs', 'Ja3aph1e'],
            ['mark.zuckerberg', 'moo9rahH'],
            ['evan.spiegel', 'uTh8youh'],
            ['jack.dorsey', 'Roen3ahm'],
        ];
    }

    /**
     * @dataProvider keyProvider
     * @param string $name
     * @param string $value
     * @throws \Exception
     */
    public function testArrayAccess(string $name, string $value)
    {
        $repository = $this->getContainer()->get(GuardRepository::class);
        $csrf = new DoctrineStorage($repository);
        $csrf[$name] = $value;

        $this->assertEquals($value, $csrf[$name]);
    }

    public function testIterator()
    {
        $repository = $this->getContainer()->get(GuardRepository::class);
        $csrf = new DoctrineStorage($repository);

        $keyData = $this->keyProvider();
        $testData = [];
        foreach ($keyData as $data) {
            $testData[$data[0]] = $data[1];
        }

        $csrf->rewind();
        while ($csrf->valid()) {
            $name = $csrf->key();
            $value = $csrf->current();

            $this->assertTrue(array_key_exists($name, $testData));
            $this->assertTrue(in_array($value, $testData));

            $csrf->next();
        }
        $csrf->rewind();
    }
}
