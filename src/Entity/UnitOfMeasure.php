<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     iri="http://schema.org/materialExtent",
 *     itemOperations={
 *         "get", "put", "patch"
 *     },
 *     collectionOperations={
 *         "get", "post"
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\UnitOfMeasureRepository")
 */
class UnitOfMeasure
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $shortcut;

    /**
     * @ORM\OneToMany(targetEntity="Material", mappedBy="unitOfMeasure")
     */
    private $materials;

    public function __construct()
    {
        $this->materials = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getShortcut(): ?string
    {
        return $this->shortcut;
    }

    /**
     * @param string $shortcut
     * @return $this
     */
    public function setShortcut(string $shortcut): self
    {
        $this->shortcut = $shortcut;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getMaterials(): Collection
    {
        return $this->materials;
    }

    /**
     * @param Collection $materials
     * @return UnitOfMeasure
     */
    public function setMaterials(ArrayCollection $materials): UnitOfMeasure
    {
        $this->materials = $materials;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getName();
    }
}
