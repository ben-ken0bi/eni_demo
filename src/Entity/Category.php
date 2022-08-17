<?php

namespace App\Entity;

use App\Entity\Idee;
use App\Repository\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Collection;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=900, nullable=true)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Comment::Class, mappedBy='category', orphanRemoval=true, cascade={"remove"})
     */
    private $ideeList;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getIdeeList(): Collection
    {
        return $this->ideeList;
    }

    public function addIdee(Idee $idee): self
    {
        if(!$this->ideeList->contains($idee)){
            $this->ideeList[] = $idee;
            $idee->setPost($this);
        }
        return $this;
    }

    public function removeIdee(Idee $idee): self
    {
        if($this->ideeList->removeElement($idee)){
            if($idee->getPost() === $this){
                $idee->setPost(null);
            }
        }
        return $this;
    }

}
