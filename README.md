En este trabajo creamos una base de datos, que está diseñada para gestionar la información de los proveedores y productos de
una tienda de mascotas.

Esta base de datos cuenta con **2 entidades**: `proveedores` y `productos`.
Su relación es **1 a N**, es decir, un proveedor puede suministrar muchos productos, pero cada producto tiene un solo proveedor.

### La entidad `proveedores` está compuesta por los siguientes atributos:
- `id_proveedor` (PRIMARY KEY)
- `nombre`
- `telefono`
- `dirección`

### La entidad `productos` cuenta con los siguientes atributos:
- `id_producto` (PRIMARY KEY)
- `nombre`
- `precio`
- `peso_neto`
- `fecha_empaquetado`
- `fecha_vencimiento`
- `stock`
- `id_proveedor` (FOREIGN KEY)

![Diagrama Entidad Relacion](/database/diagrama.png)



Implementamos en este proyecto un sistema de gestión de ítems y categorías, permitiendo tanto acceso público como administración privada de datos.
En las funcionalidades de aspecto público podemos encontrar:

Listado de ítems y categorias: Permite visualizar todos los ítems y categorias disponibles en la base de datos.
Detalle de ítems y categorias: Ofreciendo una vista detallada de cada item y/o categoria.

Para la parte del administrador se le dio acceso a las siguientes funcionalidades:

Inicio de sesion: Los administradore deben autenticarse mediante usuario y contraseña (Usuario: webadmin, Contraseña: admin).
Gestión de ítems: CRUD completo para la entidad ítem, incluyendo:
Listar, agregar, editar y eliminar tanto ítems como categorías.

Requerimientos técnicos:
El sistema utiliza PHP como lenguaje de programación y MySQL como base de datos.
Base de datos: la conexion se configura a traves de constantes en config.php.
Arquitectura MVC: Todas las acciones están implementadas bajo el patraon de arquitectura MVC (Modelo - Vista - Controlador).
Sistema de Ruteo y URL's semánticas: Se implementa un router y urls semanticas a la página.
Plantillas: Se utilizan plantillas con extension. phtml, invocadas por la vista.

![Diagrama Entidad Relacion](/database/diagrama2daParte.png)

Lamorte Nahuel, Alonso Mateo.






