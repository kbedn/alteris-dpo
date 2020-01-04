<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Swagger\Annotations as SWG;

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
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @SWG\Property(description="The unique identifier of the unit of measure.")
     */
    private int $id;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=255)
     * @ApiProperty(iri="http://schema.org/name")
     * @Assert\NotBlank()
     */
    private ?string $name;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private ?string $shortcut;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="Material", mappedBy="unitOfMeasure")
     */
    private Collection $materials;

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
     * @return string
     */
    public function getShortcut(): string
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
     * @return ArrayCollection
     */
    public function getMaterials(): ArrayCollection
    {
        return $this->materials;
    }

    /**
     * @param ArrayCollection $materials
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
        return (string) $this->getName();
    }
}
