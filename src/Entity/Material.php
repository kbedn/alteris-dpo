<?php

namespace App\Entity;

use App\Validator as AppAssert;
use ApiPlatform\Core\Annotation\{
    ApiResource,
    ApiProperty,
    ApiSubresource
};
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Swagger\Annotations as SWG;

/**
 * @ApiResource(
 *     iri="http://schema.org/material",
 *      itemOperations={
 *         "get", "put", "patch"
 *     },
 *     collectionOperations={
 *         "get", "post"
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\MaterialRepository")
 *
 */
class Material
{
    /**
     * @var int The unique identifier of the material.
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @SWG\Property(description="The unique identifier of the material.")
     */
    private int $id;

    /**
     * @var string|null The name of the material.
     *
     * @ORM\Column(type="string", length=32)
     * @SWG\Property(type="string", maxLength=32)
     * @ApiProperty(iri="http://schema.org/name")
     * @Assert\NotBlank()
     */
    protected ?string $name;

    /**
     * @var string Shortcode represents this material
     *
     * @ORM\Column(type="string", length=32)
     * @SWG\Property(type="string", maxLength=32)
     * @ApiProperty(iri="http://schema.org/codeValue")
     * @ApiSubresource()
     * @Assert\NotBlank()
     */
    protected string $code;

    /**
     * @var UnitOfMeasure Unit of measure describing this material.
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\UnitOfMeasure", inversedBy="materials")
     * @ORM\JoinColumn(name="material_id", referencedColumnName="id")
     * @ApiSubresource()
     * @Assert\NotBlank()
     */
    protected UnitOfMeasure $unitOfMeasure;

    /**
     * @var MaterialGroup Material group without children
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\MaterialGroup", inversedBy="materials")
     * @Assert\NotBlank()
     * @AppAssert\NodeWithNoChildren()
     */
    protected MaterialGroup $group;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param null|string name
     * @return Material
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param null|string $code
     * @return Material
     */
    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return UnitOfMeasure|null
     */
    public function getUnitOfMeasure(): ?UnitOfMeasure
    {
        return $this->unitOfMeasure;
    }

    /**
     * @param UnitOfMeasure $unitOfMeasure
     * @return Material
     */
    public function setUnitOfMeasure(UnitOfMeasure $unitOfMeasure): self
    {
        $this->unitOfMeasure = $unitOfMeasure;

        return $this;
    }

    /**
     * @return MaterialGroup|null
     */
    public function getGroup(): ?MaterialGroup
    {
        return $this->group;
    }

    /**
     * @param MaterialGroup $group
     * @return Material
     */
    public function setGroup(MaterialGroup $group): Material
    {
        $this->group = $group;

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
