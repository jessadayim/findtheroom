<?php

namespace FTR\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FTR\WebBundle\Entity\User_owner
 *
 * @ORM\Table(name="user_owner")
 * @ORM\Entity(repositoryClass="FTR\WebBundle\Repository\User_ownerRepository")
 */
class User_owner {
	/**
	 * @var integer $id
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @var string $username
	 *
	 * @ORM\Column(name="username", type="string", length=255)
	 */
	private $username;

	/**
	 * @var string $password
	 *
	 * @ORM\Column(name="password", type="string", length=255)
	 */
	private $password;

	/**
	 * @var string $firstname
	 *
	 * @ORM\Column(name="firstname", type="string", length=255)
	 */
	private $firstname;

	/**
	 * @var string $lastname
	 *
	 * @ORM\Column(name="lastname", type="string", length=255)
	 */
	private $lastname;

	/**
	 * @var string $email
	 *
	 * @ORM\Column(name="email", type="string", length=255)
	 */
	private $email;

	/**
	 * @var string $phone_number
	 *
	 * @ORM\Column(name="phone_number", type="string", length=127)
	 */
	private $phone_number;

	/**
	 * @var string $fax_number
	 *
	 * @ORM\Column(name="fax_number", type="string", length=127)
	 */
	private $fax_number;

	/**
	 * @var string $user_level
	 *
	 * @ORM\Column(name="user_level", type="string", length=127, nullable="true")
	 */
	private $user_level;

	/**
	 * @var datetime $last_login
	 *
	 * @ORM\Column(name="last_login", type="datetime", nullable="true")
	 */
	private $last_login;

	/**
	 * @var datetime $password_requested
	 *
	 * @ORM\Column(name="password_requested", type="datetime", nullable="true")
	 */
	private $password_requested;

	/**
	 * @var string $confirm_token
	 *
	 * @ORM\Column(name="confirm_token", type="string", length=255, nullable="true")
	 */
	private $confirm_token;

	/**
	 * @var boolean $enabled
	 *
	 * @ORM\Column(name="enabled", type="boolean", nullable="true")
	 */
	private $enabled;

	/**
	 * @var string $facebook_id
	 *
	 * @ORM\Column(name="facebook_id", type="string", length=64, nullable="true")
	 */
	private $facebook_id;

	/**
	 * @var boolean $deleted
	 *
	 * @ORM\Column(name="deleted", type="boolean", nullable="true")
	 */
	private $deleted;

	/**
	 * Get id
	 *
	 * @return integer
	 */
	public function getId() {
		return $this -> id;
	}

	/**
	 * Set username
	 *
	 * @param string $username
	 */
	public function setUsername($username) {
		$this -> username = $username;
	}

	/**
	 * Get username
	 *
	 * @return string
	 */
	public function getUsername() {
		return $this -> username;
	}

	/**
	 * Set password
	 *
	 * @param string $password
	 */
	public function setPassword($password) {
		$this -> password = $password;
	}

	/**
	 * Get password
	 *
	 * @return string
	 */
	public function getPassword() {
		return $this -> password;
	}

	/**
	 * Set firstname
	 *
	 * @param string $firstname
	 */
	public function setFirstname($firstname) {
		$this -> firstname = $firstname;
	}

	/**
	 * Get firstname
	 *
	 * @return string
	 */
	public function getFirstname() {
		return $this -> firstname;
	}

	/**
	 * Set lastname
	 *
	 * @param string $lastname
	 */
	public function setLastname($lastname) {
		$this -> lastname = $lastname;
	}

	/**
	 * Get lastname
	 *
	 * @return string
	 */
	public function getLastname() {
		return $this -> lastname;
	}

	/**
	 * Set email
	 *
	 * @param string $email
	 */
	public function setEmail($email) {
		$this -> email = $email;
	}

	/**
	 * Get email
	 *
	 * @return string
	 */
	public function getEmail() {
		return $this -> email;
	}

	/**
	 * Set phone_number
	 *
	 * @param string $phoneNumber
	 */
	public function setPhoneNumber($phoneNumber) {
		$this -> phone_number = $phoneNumber;
	}

	/**
	 * Get phone_number
	 *
	 * @return string
	 */
	public function getPhoneNumber() {
		return $this -> phone_number;
	}

	/**
	 * Set fax_number
	 *
	 * @param string $faxNumber
	 */
	public function setFaxNumber($faxNumber) {
		$this -> fax_number = $faxNumber;
	}

	/**
	 * Get fax_number
	 *
	 * @return string
	 */
	public function getFaxNumber() {
		return $this -> fax_number;
	}

/**
	 * Set user_level
	 *
	 * @param string $user_level
	 */
	public function setUserLevel($user_level) {
		$this -> user_level = $user_level;
	}

	/**
	 * Get user_level
	 *
	 * @return string
	 */
	public function getUserLevel() {
		return $this -> user_level;
	}

	/**
	 * Set last_login
	 *
	 * @param date_time $last_login
	 */
	public function setLastLogin($last_login) {
		$this -> last_login = $last_login;
	}

	/**
	 * Get last_login
	 *
	 * @return date_time
	 */
	public function getLastLogin() {
		return $this -> last_login;
	}

	/**
	 * Set password_requested
	 *
	 * @param date_time $password_requested
	 */
	public function setPasswordRequested($password_requested) {
		$this -> password_requested = $password_requested;
	}

	/**
	 * Get password_requested
	 *
	 * @return date_time
	 */
	public function getPasswordRequested() {
		return $this -> password_requested;
	}

	/**
	 * Set confirm_token
	 *
	 * @param boolean $confirm_token
	 */
	public function setConfirmToken($confirm_token) {
		$this -> confirm_token = $confirm_token;
	}

	/**
	 * Get confirm_token
	 *
	 * @return boolean
	 */
	public function getConfirmToken() {
		return $this -> confirm_token;
	}

	/**
	 * Set enabled
	 *
	 * @param boolean $enabled
	 */
	public function setEnabled($enabled) {
		$this -> enabled = $enabled;
	}

	/**
	 * Get enabled
	 *
	 * @return boolean
	 */
	public function getEnabled() {
		return $this -> enabled;
	}

	/**
	 * Set facebook_id
	 *
	 * @param string $facebook_id
	 */
	public function setFacebookId($facebook_id) {
		$this -> facebook_id = $facebook_id;
	}

	/**
	 * Get facebook_id
	 *
	 * @return string
	 */
	public function getFacebookId() {
		return $this -> facebook_id;
	}

	/**
	 * Set deleted
	 *
	 * @param boolean $deleted
	 */
	public function setDeleted($deleted) {
		$this -> deleted = $deleted;
	}

	/**
	 * Get deleted
	 *
	 * @return boolean
	 */
	public function getDeleted() {
		return $this -> deleted;
	}

}
