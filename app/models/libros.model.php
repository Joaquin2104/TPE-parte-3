<?php

class librosmodel {
    private $db;

    public function __construct() {
       $this->db = new PDO('mysql:host=localhost;dbname=libreria;charset=utf8', 'root', '');
    }
 
    public function getlibros($orderBy = false, $forma = false, $nombre = false) {
        $sql = 'SELECT * FROM `libros`';

        
        if($nombre){
            $sql .= " WHERE `Nombre` = ?";
        }

        if($forma) {
            $sql.= ' DESC';
        }

        if($orderBy) {
            switch($orderBy) {
                case 'Nombre':
                    $sql .= ' ORDER BY Nombre';
                    break;
                case 'Genero':
                    $sql .= ' ORDER BY Genero';
                    break;
                case 'Precio':
                    $sql .= ' ORDER BY Precio';
                    break;
                case 'id_usuario':
                    $sql .= ' ORDER BY id_usuario';
                    break;
            }
        }

        $query = $this->db->prepare($sql);

        if($nombre) {
            $query->execute([$nombre]); 
        } else {
            $query->execute(); 
        } 

        $libros = $query->fetchAll(PDO::FETCH_OBJ); 

        return $libros;
    }
 
    public function getlibro($id) {    
        $query = $this->db->prepare('SELECT * FROM libros WHERE Id = ?');
        $query->execute([$id]);   
    
        $libro = $query->fetch(PDO::FETCH_OBJ);
    
        return $libro;
    }
 
    public function insertlibro($nombre, $genero, $precio, $id_usuario) { 
        $query = $this->db->prepare('INSERT INTO libros(Nombre, Genero, Precio, id_usuario) VALUES (?, ?, ?, ?)');
        $query->execute([$nombre, $genero, $precio, $id_usuario]);
    
        $id = $this->db->lastInsertId();
    
        return $id;
    }
 
    public function eraselibro($id) {
        $query = $this->db->prepare('DELETE FROM libros WHERE Id = ?');
        $query->execute([$id]);
    }

    function updatelibro($id, $nombre, $genero, $precio, $id_usuario) {    
        $query = $this->db->prepare('UPDATE libros SET Nombre = ?, Genero = ?, Precio = ?, id_usuario = ? WHERE Id = ?');
        $query->execute([$nombre, $genero, $precio, $id_usuario, $id]);
    }
}