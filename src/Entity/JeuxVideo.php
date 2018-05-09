<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * JeuxVideo
 *
 * @ORM\Table(name="jeux_video", indexes={@ORM\Index(name="ID", columns={"ID"})})
 * @ORM\Entity
 *
 */
class JeuxVideo
{
    /**
     * @var int
     *
     * @ORM\Column(name="uid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     * * @Serializer\Groups({"list"})
     */
    private $uid;

    /**
     * @var int
     *
     * @ORM\Column(name="ID", type="integer", nullable=false, options={"unsigned"=true})
     *
     */
    private $id;

    /**
     * @Serializer\Groups({"detail", "list"})
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="possesseur", type="string", length=255, nullable=false)
     *
     * @Serializer\Groups({"detail", "list"})
     */
    private $possesseur;

    /**
     * @var string
     *
     * @ORM\Column(name="console", type="string", length=255, nullable=false)
     *
     * @Serializer\Groups({"detail", "list"})
     */
    private $console;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=false)
     *
     * @Serializer\Groups({"detail", "list"})
     */
    private $prix;

    /**
     * @var int
     *
     * @ORM\Column(name="nbre_joueurs_max", type="integer", nullable=false)
     *
     * @Serializer\Groups({"detail", "list"})
     */
    private $nbreJoueursMax;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaires", type="text", length=65535, nullable=false)
     *
     * @Serializer\Groups({"detail", "list"})
     */
    private $commentaires;

    public function getUid(): ?int
    {
        return $this->uid;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPossesseur(): ?string
    {
        return $this->possesseur;
    }

    public function setPossesseur(string $possesseur): self
    {
        $this->possesseur = $possesseur;

        return $this;
    }

    public function getConsole(): ?string
    {
        return $this->console;
    }

    public function setConsole(string $console): self
    {
        $this->console = $console;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getNbreJoueursMax(): ?int
    {
        return $this->nbreJoueursMax;
    }

    public function setNbreJoueursMax(int $nbreJoueursMax): self
    {
        $this->nbreJoueursMax = $nbreJoueursMax;

        return $this;
    }

    public function getCommentaires(): ?string
    {
        return $this->commentaires;
    }

    public function setCommentaires(string $commentaires): self
    {
        $this->commentaires = $commentaires;

        return $this;
    }


}
