<?php
class User
{
    private $id;
    private $username;
    private $email;
    private $rol;

    public function __construct($id, $username, $email, $rol)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->rol = $rol;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getRol()
    {
        return $this->rol;
    }

    public function isOwner(): bool
    {
        return $this->rol === 'owner';
    }

    public function isAdmin(): bool
    {
        return $this->rol === 'admin';
    }

    // acceso al modo administrador: solo admin y owner
    public function hasAdminAccess(): bool
    {
        return $this->isOwner() || $this->isAdmin();
    }
}