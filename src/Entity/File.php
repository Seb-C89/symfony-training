<?php

namespace App\Entity;

use App\Repository\FileRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FileRepository::class)]
class File
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::ASCII_STRING)]
    private $name;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\OneToOne(inversedBy: 'file', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Post $post = null;

    #[ORM\Column(type: Types::ASCII_STRING, nullable: true)]
    private $client_name = null;

    #[ORM\Column(type: Types::ASCII_STRING, nullable: true)]
    private $client_ext = null;

    /**
     * @param $name
     * @param null $client_ext
     * @param null $client_name
     * @param Post|null $post
     */
    public function __construct($name, null $client_ext, null $client_name, ?Post $post)
    {
        $this->date = new \DateTimeImmutable();
        $this->name = $name;
        $this->client_ext = $client_ext;
        $this->client_name = $client_name;
        $this->post = $post;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(?Post $post): static
    {
        $this->post = $post;

        return $this;
    }

    public function getClientName()
    {
        return $this->client_name;
    }

    public function setClientName($client_name): static
    {
        $this->client_name = $client_name;

        return $this;
    }

    public function getClientExt()
    {
        return $this->client_ext;
    }

    public function setClientExt($client_ext): static
    {
        $this->client_ext = $client_ext;

        return $this;
    }
}
