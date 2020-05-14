<?php

class user {

    private $nombre;
    private $email;
    private $password;
    private $direccion;
    private $dni;
    private $is_admin;

    function __construct($nom, $email, $pass, $dir, $dni, $adm) {
        $this->nombre = $nom;
        $this->email = $email;
        $this->password = $pass;
        $this->direccion = $dir;
        $this->dni = $dni;
        $this->is_admin = $adm;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getEmail() {
        return $this->email;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getDNI() {
        return $this->dni;
    }

    function getIsAdmin() {
        return $this->is_admin;
    }

}
