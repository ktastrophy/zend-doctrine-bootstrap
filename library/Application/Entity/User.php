<?php
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 *
 * @ORM\Entity@ORM\Table[name="users"]
 * @author Ken Thompson <ken@digitalm.co>
 */
class User
{
	/**
	 * @var integer $id
	 * @ORM\Column(name="id", type="integer", nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $id;

	/**
	 * @ORM\Column(type="string", length=60, nullable=true)
	 * @var string
	 */
	private $firstname;

	/**
	 * @ORM\Column(type="string", length=60, nullable=true)
	 * @var string
	 */
	private $lastname;


	public function getFirstName()
	{
		return $this->firstname;
	}

	public function getLastName()
	{
		return $this->lastname;
	}


	public function setFirstName($firstname)
	{
		return $this->firstname = $firstname;
	}

	public function setLastName($lastname)
	{
		return $this->lastname = $lastname;
	}


}