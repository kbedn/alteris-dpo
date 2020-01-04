<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Swagger\Annotations as SWG;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Gedmo\Tree(type="nested")
 * @ApiResource(
 *      itemOperations={
 *         "get", "put", "patch"
 *     },
 *     collectionOperations={
 *         "get", "post"
 *     }
 * )
 * @ORM\Entity(repositoryClass="Gedmo\Tree\Entity\Repository\NestedTreeRepository")
 */
class MaterialGroup
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @SWG\Property(description="The unique identifier of the material group.")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @ApiProperty(iri="http://schema.org/name")
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @Gedmo\TreeLeft
     * @ORM\Column(name="lft", type="integer")
     */
    private $lft;

    /**
     * @Gedmo\TreeLevel
     * @ORM\Column(name="lvl", type="integer")
     */
    private $lvl;

    /**
     * @Gedmo\TreeRight
     * @ORM\Column(name="rgt", type="integer")
     */
    private $rgt;

    /**
     * @var MaterialGroup|null
     * @Gedmo\TreeRoot
     * @ORM\ManyToOne(targetEntity="MaterialGroup")
     * @ORM\JoinColumn(name="tree_root", referencedColumnName="id", onDelete="CASCADE")
     */
    private $root;

    /**
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="MaterialGroup", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="CASCADE")
     * @Assert\Expression(
     *     "this.materials.count() > 0",
     *     message="Node without children violation"
     * )
     */
    private $parent;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="MaterialGroup", mappedBy="parent")
     * @ORM\OrderBy({"lft" = "ASC"})
     */
    protected $children;

    /**
     * @var Material[]
     * @ORM\OneToMany(targetEntity="App\Entity\Material", mappedBy="group", cascade={"all"})
     */
    public $materials;

    public function __construct()
    {
        $this->children = new ArrayCollection();
        $this->materials = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

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
     * @return $this|null
     */
    public function getRoot(): ?self
    {
        return $this->root;
    }

    /**
     * @param MaterialGroup|null $root
     * @return MaterialGroup
     */
    public function setRoot(MaterialGroup $root = null): self
    {
        $this->root = $root;

        return $this;
    }

    /**
     * @param MaterialGroup|null $parent
     * @return MaterialGroup
     */
    public function setParent(MaterialGroup $parent = null): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return MaterialGroup|null
     */
    public function getParent(): ?self
    {
        return $this->parent;
    }

    /**
     * @return Collection
     */
    public function getMaterials(): Collection
    {
        return $this->materials;
    }

    /**
     * @param Material $material
     * @return MaterialGroup
     */
    public function addMaterial(Material $material): MaterialGroup
    {
        $this->materials->contains($material) ?: $this->materials->add($material);

        return $this;
    }

    public function removeMaterial(Material $material): MaterialGroup
    {
        !$this->materials->contains($material) ?: $this->materials->add($material);

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

