<?php
// src/Entity/User.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM ;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Table(name="app_users")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields="email", message="Cet email est déjà enregistré en base.")
 * @UniqueEntity(fields="username", message="Cet identifiant est déjà enregistré en base")
 */
class User implements AdvancedUserInterface, \Serializable
{
	/**
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @ORM\Column(type="string", length=25, unique=true)
	 * @Assert\NotBlank()
	 * @Assert\Length(max=25)
	 */
	private $username;

	/**
	 * @ORM\Column(type="string", length=64)
	 */
	private $password;

	/**
	 * @ORM\Column(type="string", length=60, unique=true)
	 * @Assert\NotBlank()
	 * @Assert\Length(max=60)
	 * @Assert\Email()
	 */
	private $email;

	/**
	 * @ORM\Column(name="is_active", type="boolean")
	 */
	private $isActive;

	// ...
	/**
	 * @var array
	 * @ORM\Column(type="array")
	 */
	private $roles;

	public function __construct()
	{
		$this->isActive = true;
		$this->roles = ['ROLE_USER'];
	}

	/*
	 * Get id
	 */
	public function getId()
	{
		return $this->id;
	}

	public function getUsername()
	{
		return $this->username;
	}

	public function setUsername($username)
	{
		$this->username = $username;
		return $this;
	}


	public function getPassword()
	{
		return $this->password;
	}

	public function setPassword($password)
	{
		$this->password = $password;
		return $this;
	}

	/*
	 * Get email
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/*
	 * Set email
	 */
	public function setEmail($email)
	{
		$this->email = $email;
		return $this;
	}

	/*
	 * Get isActive
	 */
	public function getIsActive()
	{
		return $this->isActive;
	}

	/*
	 * Set isActive
	 */
	public function setIsActive($isActive)
	{
		$this->isActive = $isActive;
		return $this;
	}

	public function getSalt()
	{
		// pas besoin de salt puisque nous allons utiliser bcrypt
		// attention si vous utilisez une méthode d'encodage différente !
		// il faudra décommenter les lignes concernant le salt, créer la propriété correspondante, et renvoyer sa valeur dans cette méthode
		return null;
	}

	// modifier la méthode getRoles
	public function getRoles()
	{
		return $this->roles; 
	}

	public function setRoles(array $roles)
	{
		if (!in_array('ROLE_USER', $roles))
		{
			$roles[] = 'ROLE_USER';
		}
		foreach ($roles as $role)
		{
			if(substr($role, 0, 5) !== 'ROLE_') {
				throw new InvalidArgumentException("Chaque rôle doit commencer par 'ROLE_'");
			}
		}
		$this->roles = $roles;
		return $this;
	} 
	public function eraseCredentials()
	{
	}

	/* les 3 méthodes suivantes renvoient simplement true. 
	Elles sont nécessaires pour implémenter AdvancedUserInterface,
	permettant d'intégrer la méthode isEnabled, pour activer ou bloquer un membre en fonction de la propriété isActive. */

	public function isAccountNonExpired()
	{
		return true;
	}

	public function isAccountNonLocked()
	{
		return true;
	}

	public function isCredentialsNonExpired()
	{
		return true;
	}

	public function isEnabled()
	{
		return $this->isActive;
	}

	/** @see \Serializable::serialize() */
	public function serialize()
	{
		return serialize(array(
			$this->id,
			$this->username,
			$this->password,
			$this->isActive,
			// voir remarques sur salt plus haut
			// $this->salt,
		));
	}

	/** @see \Serializable::unserialize() */
	public function unserialize($serialized)
	{
		list (
			$this->id,
			$this->username,
			$this->password,
			$this->isActive,
			// voir remarques sur salt plus haut
			// $this->salt
		) = unserialize($serialized);
	}
}