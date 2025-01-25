<?php
class User {
    private $idUser;
    private $Email;
    private $psswd;
    private $type;

    public function __construct($idUser, $userName, $psswd, $tipoUser) {
        $this->idUser = $idUser;
        $this->Email = $userName;
        $this->psswd = $psswd; 
        $this->type = $tipoUser;
    }

    public function getIdUser() {
        return $this->idUser;
    }

    public function getEmail() {
        return $this->Email;
    }

    public function getPsswd() {
        return $this->psswd;
    }

    public function getType() {
        return $this->type;
    }

    public function setIdUser($idUser): void {
        $this->idUser = $idUser;
    }

    public function setEmail($Email): void {
        $this->Email = $Email;
    }

    public function setPsswd($psswd): void {
        $this->psswd = $psswd; // Debería ser un hash
    }

    public function setType($type): void {
        $this->type = $type;
    }

    public function verifyPassword($password): bool {
        return $this->psswd == $password;
    }

    public function hasRole($role): bool {
        return $this->type === $role;
    }
}
?>
