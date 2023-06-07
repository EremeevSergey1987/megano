<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @Gedmo\Slug(fields={"name"})
     */
    #[ORM\Column(length: 200, unique: true)]
    private ?string $slug = null;

    #[ORM\Column(length: 255)]
    private ?string $text = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $publishedAt = null;

    /**
     * @Gedmo\Timestampable(on="create")
     */
    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    /**
     * @Gedmo\Timestampable(on="update")
     */
    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'php')]
    private ?self $category = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: self::class)]
    private Collection $categories;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Products::class)]
    private Collection $products;

    #[ORM\Column]
    private ?int $parent_id = null;

    #[ORM\ManyToOne(targetEntity: self::class)]
    private ?self $childre_id = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'childre')]
    private ?self $parent = null;

    #[ORM\OneToMany(mappedBy: 'parent', targetEntity: self::class)]
    private Collection $childre;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->products = new ArrayCollection();
        $this->childre = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getPublishedAt(): ?\DateTimeImmutable
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(?\DateTimeImmutable $publishedAt): self
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    public function getParentID(): ?int
    {
        return $this->parentID;
    }

    public function setParentID(?int $parentID): self
    {
        $this->parentID = $parentID;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCategory(): ?self
    {
        return $this->category;
    }

    public function setCategory(?self $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(self $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
            $category->setCategory($this);
        }

        return $this;
    }

    public function removeCategory(self $category): self
    {
        if ($this->categories->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getCategory() === $this) {
                $category->setCategory(null);
            }
        }

        return $this;
    }

    public function getNo(): ?string
    {
        return $this->no;
    }

    public function setNo(string $no): self
    {
        $this->no = $no;

        return $this;
    }

    /**
     * @return Collection<int, Products>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Products $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
            $product->setCategory($this);
        }

        return $this;
    }

    public function removeProduct(Products $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getCategory() === $this) {
                $product->setCategory(null);
            }
        }

        return $this;
    }

    public function getChildreId(): ?self
    {
        return $this->childre_id;
    }

    public function setChildreId(?self $childre_id): self
    {
        $this->childre_id = $childre_id;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getChildre(): Collection
    {
        return $this->childre;
    }

    public function addChildre(self $childre): self
    {
        if (!$this->childre->contains($childre)) {
            $this->childre->add($childre);
            $childre->setParent($this);
        }

        return $this;
    }

    public function removeChildre(self $childre): self
    {
        if ($this->childre->removeElement($childre)) {
            // set the owning side to null (unless already changed)
            if ($childre->getParent() === $this) {
                $childre->setParent(null);
            }
        }

        return $this;
    }
}
