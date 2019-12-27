<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;

/**
 * @ApiResource(iri="http://schema.org/material")
 * @ORM\Entity(repositoryClass="App\Repository\MaterialRepository")
 *
 */
class Material
{
    /**
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
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=10)
     * @SWG\Property(type="string", maxLength=10)
     * @ApiProperty(iri="http://schema.org/codeValue")
     */
    protected $code;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UnitOfMeasure", inversedBy="materials")
     * @ORM\JoinColumn(name="material_id", referencedColumnName="id")
     */
    protected $unitOfMeasure;

    /**
     * @var MaterialGroup
     *
     * @ORM\OneToOne(targetEntity="App\Entity\MaterialGroup")
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
    public function setName(?string  $name): self
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
     * @return UnitOfMeasure
     */
    public function getUnitOfMeasure(): UnitOfMeasure
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

}
