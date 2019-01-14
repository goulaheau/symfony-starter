<?php

namespace App\Entity\Example;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Goulaheau\RestBundle\Entity\RestEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Example\PostCategoryRepository")
 * @ORM\Table(name="example_post_category")
 */
class PostCategory extends RestEntity
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
     * @var Collection|Post[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Example\Post", mappedBy="category")
     *
     * @Groups({"readable"})
     */
    protected $posts;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

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
     * @return Collection|Post[]
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * @param Post $post
     *
     * @return $this
     */
    public function addPost($post)
    {
        if (!$this->posts->contains($post)) {
            $this->posts[] = $post;
            $post->setCategory($this);
        }

        return $this;
    }

    /**
     * @param Post $post
     *
     * @return $this
     */
    public function removePost($post)
    {
        if ($this->posts->contains($post)) {
            $this->posts->removeElement($post);

            if ($post->getCategory() === $this) {
                $post->setCategory(null);
            }
        }

        return $this;
    }
}
