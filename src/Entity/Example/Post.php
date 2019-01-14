<?php

namespace App\Entity\Example;

use Doctrine\ORM\Mapping as ORM;
use Goulaheau\RestBundle\Entity\RestEntity;
use Goulaheau\RestBundle\Validator\Constraints as RestAssert;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Example\PostRepository")
 * @ORM\Table(name="example_post")
 */
class Post extends RestEntity
{
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank
     * @Assert\Length(max="255")
     *
     * @Groups({"readable", "editable"})
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     *
     * @Groups({"readable", "editable"})
     */
    protected $description;

    /**
     * @var PostCategory
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Example\PostCategory", inversedBy="posts")
     * @ORM\JoinColumn(nullable=false)
     *
     * @Assert\NotBlank
     * @RestAssert\EntityExist
     *
     * @Groups({"readable", "editable"})
     */
    protected $category;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return PostCategory
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param PostCategory $category
     *
     * @return $this
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }
}
