<?php

namespace App\Domain;

use App\Repository\GuardRepository;
use Doctrine\ORM\Mapping as ORM;

#[
    ORM\Entity(repositoryClass: GuardRepository::class),
    ORM\Index(columns: ['name'], name: 'name'),
]
class Guard
{
    #[
        ORM\Id,
        ORM\Column(options: ['unsigned' => true]),
        ORM\GeneratedValue(strategy: 'AUTO')
    ]
    private int $id = 0;

    #[ORM\Column(unique: true, nullable: false)]
    private string $name;

    #[ORM\Column(nullable: false)]
    private string $value;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }
}
