<?php

namespace App\Entity;

use App\Repository\CardRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CardRepository::class)
 */
class Card
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $img;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $img_minia;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $attribute;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $race;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255 , nullable=true)
     */
    private $archetype;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $set_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $set_code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $set_rarity;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $banlist_info;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $atkDefLvl = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $link_markers = [];

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $link_val;

    /**
     * @ORM\ManyToMany(targetEntity=deck::class)
     */
    private $deck;

    public function __construct()
    {
        $this->deck = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): self
    {
        $this->img = $img;

        return $this;
    }

    public function getImgMinia(): ?string
    {
        return $this->img_minia;
    }

    public function setImgMinia(string $img_minia): self
    {
        $this->img_minia = $img_minia;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getAttribute(): ?string
    {
        return $this->attribute;
    }

    public function setAttribute(string $attribute): self
    {
        $this->attribute = $attribute;

        return $this;
    }

    public function getRace(): ?string
    {
        return $this->race;
    }

    public function setRace(string $race): self
    {
        $this->race = $race;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getArchetype(): ?string
    {
        return $this->archetype;
    }

    public function setArchetype(string $archetype): self
    {
        $this->archetype = $archetype;

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

    public function getSetName(): ?string
    {
        return $this->set_name;
    }

    public function setSetName(string $set_name): self
    {
        $this->set_name = $set_name;

        return $this;
    }

    public function getSetCode(): ?string
    {
        return $this->set_code;
    }

    public function setSetCode(string $set_code): self
    {
        $this->set_code = $set_code;

        return $this;
    }

    public function getSetRarity(): ?string
    {
        return $this->set_rarity;
    }

    public function setSetRarity(string $set_rarity): self
    {
        $this->set_rarity = $set_rarity;

        return $this;
    }

    public function getBanlistInfo(): ?string
    {
        return $this->banlist_info;
    }

    public function setBanlistInfo(string $banlist_info): self
    {
        $this->banlist_info = $banlist_info;

        return $this;
    }

    public function getAtkDefLvl(): ?array
    {
        return $this->atkDefLvl;
    }

    public function setAtkDefLvl(?array $atkDefLvl): self
    {
        $this->atkDefLvl = $atkDefLvl;

        return $this;
    }

    public function getLinkMarkers(): ?array
    {
        return $this->link_markers;
    }

    public function setLinkMarkers(array $link_markers): self
    {
        $this->link_markers = $link_markers;

        return $this;
    }

    public function getLinkVal(): ?int
    {
        return $this->link_val;
    }

    public function setLinkVal(?int $link_val): self
    {
        $this->link_val = $link_val;

        return $this;
    }

    /**
     * @return Collection|deck[]
     */
    public function getDeck(): Collection
    {
        return $this->deck;
    }

    public function addDeck(deck $deck): self
    {
        if (!$this->deck->contains($deck)) {
            $this->deck[] = $deck;
        }

        return $this;
    }

    public function removeDeck(deck $deck): self
    {
        if ($this->deck->contains($deck)) {
            $this->deck->removeElement($deck);
        }

        return $this;
    }
}
