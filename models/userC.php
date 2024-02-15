<?php
class User {
  private $firstname;
  private $lastname;
  private $dob;
  private $email;
  private $password;
  private $role;
  private $verification_token;
  private $verified;

  public function __construct($firstname = '', $lastname = '', $dob = '', $email, $password, $role = 'user', $verification_token = '', $verified = 0) {
    $this->firstname = $firstname;
    $this->lastname = $lastname;
    $this->dob = $dob;
    $this->email = $email;
    $this->password = $password;
    $this->role = $role;
    $this->verification_token = $verification_token;
    $this->verified = $verified;
  }

  public function getEmail() {
    return $this->email;
  }

  public function getPassword() {
    return $this->password;
  }

  public function getRole() {
    return $this->role;
  }

  public function getFirstname() {
    return $this->firstname;
  }

  public function getLastname() {
    return $this->lastname;
  }

  public function getDob() {
    return $this->dob;
  }

  public function getVerificationToken() {
    return $this->verification_token;
  }

  public function getVerified() {
    return $this->verified;
  }

  public function setEmail($email) {
    $this->email = $email;
  }

  public function setPassword($password) {
    $this->password = $password;
  }

  public function setRole($role) {
    $this->role = $role;
  }

  public function setFirstname($firstname) {
    $this->firstname = $firstname;
  }

  public function setLastname($lastname) {
    $this->lastname = $lastname;
  }

  public function setDob($dob) {
    $this->dob = $dob;
  }

  public function setVerificationToken($verification_token) {
    $this->verification_token = $verification_token;
  }

  public function setVerified($verified) {
    $this->verified = $verified;
  }
}
?>
