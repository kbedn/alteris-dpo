<?php

namespace App\Entity;

use App\Validator as AppAssert;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Component\Validator\Constraints as Assert;
use Swagger\Annotations as SWG;

/**
 * @ApiResource(
 *     iri="http://schema.org/material",
 *     collectionOperations={"get"={"method"="GET"}},
 *     itemOperations={"get"={"method"="GET"}}
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
    private $id;

    /**
     * @var string|null the name of the item
     *
     * @ORM\Column(type="string", length=32)
     * @SWG\Property(type="string", maxLength=32)
     * @ApiProperty(iri="http://schema.org/name")
     * @Assert\NotBlank()
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=32)
     * @SWG\Property(type="string", maxLength=32, description="Shortcode represents this material")
     * @ApiProperty(iri="http://schema.org/codeValue")
     * @Assert\NotBlank()
     */
    protected $code;

    /**
     * @var UnitOfMeasure
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\UnitOfMeasure", inversedBy="materials")
     * @ORM\JoinColumn(name="material_id", referencedColumnName="id")
     */
    protected $unitOfMeasure;

    /**
     * @var MaterialGroup
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\MaterialGroup", inversedBy="materials")
     * @Assert\NotBlank()
     * @AppAssert\NodeWithNoChildren()
     */
    protected $group;

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
