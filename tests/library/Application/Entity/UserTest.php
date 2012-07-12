<?php
namespace Outlaw\Entity;
/**
 * Test Cases for User Entity
 *
 * @author Ken Thompson <ken@digitalm.co>
 */
class UserTest
	extends \ModelTestCase
{
	public function testCanCreateUser()
	{
		$this->assertInstanceOf('Outlaw\Entity\User', new User());
	}

	public function testCanSaveFirstAndLastNameAndRetrieveThem()
	{
		$user = new User();
		$user->setFirstName("Ken");
		$user->setLastName("Thompson");

		$em = $this->doctrineContainer->getEntityManager();
		$em->persist($user);
		$em->flush();

		$users = $em->createQuery('select u from Outlaw\Entity\User u')->execute();
		$this->assertEquals(1, count($users));

		$this->assertEquals('Ken', $users[0]->getFirstName());
		$this->assertEquals('Thompson', $users[0]->getLastName());
	}

}