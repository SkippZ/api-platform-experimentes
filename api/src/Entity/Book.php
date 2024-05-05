<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Link;
use App\Repository\BookRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookRepository::class)]
#[ApiResource]
#[ApiResource(
    uriTemplate: '/bookshelves/{id}/books',
    uriVariables: [
        'id' => new Link(
            fromClass: Book::class,
            fromProperty: 'bookshelf'
        )
    ],
    operations: [new Get()]
)]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $pages = null;

    #[ORM\ManyToOne(inversedBy: 'books')]
    private ?Bookshelf $bookshelf = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPages(): ?int
    {
        return $this->pages;
    }

    public function setPages(int $pages): static
    {
        $this->pages = $pages;

        return $this;
    }

    public function getBookshelf(): ?Bookshelf
    {
        return $this->bookshelf;
    }

    public function setBookshelf(?Bookshelf $bookshelf): static
    {
        $this->bookshelf = $bookshelf;

        return $this;
    }
}
