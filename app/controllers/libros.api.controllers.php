<?php
require_once './app/models/libros.model.php';
require_once './app/views/json.view.php';

class librosApiController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new librosmodel();
        $this->view = new JSONView();
    }

    public function getAll($req, $res) {

        $nombre =false;
        if(isset($req->query->nombre))
            $nombre = $req->query->nombre;

        $orderBy = false;
        if(isset($req->query->orderBy))
            $orderBy = $req->query->orderBy;

        $forma =false;
        if(isset($req->query->forma))
            $forma = $req->query->forma;

        $libros = $this->model->getlibros($orderBy, $forma, $nombre);

        return $this->view->response($libros);
    }

    public function get($req, $res) {
        
        $id = $req->params->id;

        $libro = $this->model->getlibro($id);

        if(!$libro) {
            return $this->view->response("El libro con el id=$id no existe", 404);
        }

        return $this->view->response($libro);
    }

    public function delete($req, $res) {
        if(!$res->user) {
            return $this->view->response("No autorizado", 401);
        }
        
        
        $id = $req->params->Id;

        $libro = $this->model->getlibro($id);

        if (!$libro) {
            return $this->view->response("El libro con el id=$id no existe", 404);
        }

        $this->model->eraselibro($id);
        $this->view->response("El libro con el id=$id se eliminó con éxito");
    }
    public function create($req, $res) {
        if(!$res->user) {
            return $this->view->response("No autorizado", 401);
        }
        

        if (empty($req->body->Nombre) || empty($req->body->Genero) || empty($req->body->Precio) || empty($req->body->id_usuario)){
            return $this->view->response('Faltan completar datos', 400);
        }
        $nombre = $req->body->Nombre;       
        $genero = $req->body->Genero;       
        $precio = $req->body->Precio;
        $id_usuario = $req->body->id_usuario;        

        $id = $this->model->insertlibro($nombre, $genero, $precio, $id_usuario);

        if (!$id) {
            return $this->view->response("Error al insertar el libro", 500);
        }

        $libro = $this->model->getlibro($id);
        return $this->view->response($libro, 201);
    }

    public function update($req, $res) {
        if(!$res->user) {
            return $this->view->response("No autorizado", 401);
        }
        
        
        $id = $req->params->id;


        $libro = $this->model->getlibro($id);
        if (!$libro) {
            return $this->view->response("La tarea con el id=$id no existe", 404);
        }


         if (empty($req->body->Nombre) || empty($req->body->Genero) || empty($req->body->Precio) || empty($req->body->id_usuario)){
            return $this->view->response('Faltan completar datos', 400);
        }

        $nombre = $req->body->Nombre;       
        $genero = $req->body->Genero;       
        $precio = $req->body->Precio;
        $id_usuario = $req->body->id_usuario;  


        $this->model->updatelibro($id, $nombre, $genero, $precio, $id_usuario);

        $libro = $this->model->getlibro($id);
        $this->view->response($libro, 200);
    }


}

