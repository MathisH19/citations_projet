<?php

namespace App\Entity;

use App\Repository\QuoteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: QuoteRepository::class)]
class Quote
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: 'Il faut mettre la citation, donne nous en un peu quoi !')]
    private ?string $content = null;

    #[ORM\Column(length: 75)]
    #[Assert\NotBlank(message: 'L\'auteur est obligatoire.')]
    #[Assert\Length(min: 2, max: 75, minMessage:'Il faut un nom pour l\'auteur')]
    private ?string $author = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $source = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(length: 25, nullable: true)]
    #[Assert\Length(min:2, max: 25, minMessage: 'Une petite date ?')]
    private ?string $century = null;

    #[ORM\Column(length: 20, nullable: true)]
    #[Assert\Length(min: 2, max:  20, minMessage: 'Une vrai langue stp')]
    private ?string $language = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $context = null;

    #[ORM\Column(nullable: true)]
    #[Assert\Range(min: -1000000, max: 1000000, notInRangeMessage: 'Il ne faut pas abuser des bonnes choses')]
    private ?int $aura = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): static
    {
        $this->author = $author;

        return $this;
    }

    public function getSource(): ?string
    {
        return $this->source;
    }

    public function setSource(?string $source): static
    {
        $this->source = $source;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCentury(): ?string
    {
        return $this->century;
    }

    public function setCentury(?string $century): static
    {
        $this->century = $century;

        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(?string $language): static
    {
        $this->language = $language;

        return $this;
    }

    public function getContext(): ?string
    {
        return $this->context;
    }

    public function setContext(?string $context): static
    {
        $this->context = $context;

        return $this;
    }

    public function getAura(): ?int
    {
        return $this->aura;
    }

    public function setAura(?int $aura): static
    {
        $this->aura = $aura;

        return $this;
    }






}
