TPE Parte 3 - Miembros: Joaquín Ferreyra, Ignacio Moser.

Para esta 3ra parte se agrego una API REST que seguirá interactuando con la misma base de datos que se venia trabajando en las 2 partes anteriores.

Esta API REST no cuenta con un FrontEnd ya que las operaciones se realizaron con la extensión Thunder Client, herramienta similar a Postman.

En la misma se pueden hacer las operaciones CRUD, en las cuales los servicios requerirán de un Token para poder llevarlos a cabo. 

Las peticiones se podrán realizar de distintas maneras, como por ejemplo listar elementos de manera ascendente o descendente, listar por ID, por precio, entre otras.

En caso de ingresar algún dato de manera errónea, se mostrara un mensaje con la descripción de dicho error y su respectivo código.

Pasos para usarla:

1. Abrir XAMPP y habilitar Apache y MySQL.

2. Abrir la extensión Thunder Client o similar en Visual Studio Code.

3. En la ruta ingresar ".../api/user/token".

4. Ir al apartado Auth, luego a Basic, una vez ahí poner el nombre y contraseña (Nombre: webadmin, Contraseña: admin).
A la derecha aparecerá el Token, copiarlo y pegarlo en Bearer sin las comillas. 

5. Iniciar sesión para poder hacer las peticiones.

6. Peticiones:

.Agregar libro: Verbo POST, RUTA: ".../api/libros"

Ir a body, y poner datos del libro a agregar, por ejemplo:
 {
    "Nombre": "blabla",
    "Genero": "Accion, Ficcion y Aventura",
    "Precio": "11134",
    "id_usuario": "234"
  }

.Eliminar libro: Verbo DELETE, RUTA: ".../api/libros/:id"

.Modificar libro: Verbo PUT, RUTA: ".../api/libros/:id"

Ir a body, y poner datos del libro a modificar, por ejemplo:
 {
    "Nombre": "blabla",
    "Genero": "Accion, Ficcion y Aventura",
    "Precio": "123",
    "id_usuario": "234"
  }

.Listar todos los libros: Verbo GET, RUTA: "…/api/libros"

.Listar libro por ID: Verbo GET, RUTA: "…/api/libros/:id"

.Filtrar libro por Nombre: Verbo GET, RUTA: "…/api/libros?nombre=blablabla"

.Ordenar libros por nombre, precio, id o genero descendentemente: Verbo GET, RUTA: ".../api/libros?orderBy=Genero&forma=DESC"

