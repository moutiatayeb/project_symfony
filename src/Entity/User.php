<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(
 *     fields={"email"},
 *     message="L'émail que vous avez tapé est déjà utilisé !"
 * )
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Assert\Length(
     *      min = 8,
     *      minMessage = "Votre mot de passe doit comporter au minimum {{ limit }} caractères")
     *  @Assert\EqualTo(propertyPath = "confirmPassword", message="Vous n'avez pas passé le même mot de passe !" )")
     */
    private $password;

    /**
     *  @Assert\EqualTo(propertyPath = "password",
     *      message="Vous n'avez pas passé le même mot de passe !" )
     */
    private $confirmPassword;


    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];


    /**
     * @return mixed
     */
    public function getConfirmPassword()
    {
        return $this->confirmPassword;
    }

    /**
     * @param mixed $confirmPassword
     */
    public function setConfirmPassword($confirmPassword): void
    {
        $this->confirmPassword = $confirmPassword;
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles()
    {
        $roles = $this->roles;
        // garantit que chaque utilisateur possède le rôle ROLE_USER
        // équvalent à array_push() qui ajoute un élément au tabeau
        $roles[] = '';
        //array_unique élémine des doublons
        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function eraseCredentials() {}

    public function getSalt() {}
}
