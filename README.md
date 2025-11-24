# Arvicuenca - TFG 🚗

![Badge TFG](https://img.shields.io/badge/Proyecto-TFG-blue.svg)

Este repositorio contiene el código fuente de mi Trabajo de Fin de Grado (TFG) para el Grado Superior de Aplicaciones Web. El proyecto es una tienda online sobre uan tienda de recambios para el mundo del automovil.

## 📖 Descripción del Proyecto

El objetivo es diseñar y desarrollar una web que sea compltamente funcional y nos permita implementarla en una tienda fisica real, la web esta enfocada en los recambios del automovil. La web permite al usuario navegar por un catalogo de productos, buscar productos mediante filtros y realizar pedidos que posteriormente seran enviados a su domicilio, de momento todo el proceso de pago y envio esta simulado en un futuro se podria implenar una pasarela de pago real y un sistema de mensajeria con otras mejoras en la web.

### Motivación

Este proyecto busca apliar mis conocimientos aprendidos en estos dos años y de poner en practica todo lo visto durante los años del grado. Tambien quiero mejorar como programador, este proyecto me ha ayudado a enfrentarme a problemas que me han surguido durante el desarrollo.

---

## 🚀 Características Principales

* 👤 **Gestión de Usuarios:** Sistema completo de registro e inicio de sesión (Login) con hash de contraseñas para mejorar la robustez.
* 🛒 **Carrito de Compras:** Funcionalidad para añadir, eliminar, y modificar las cantidades de productos en el carrito de forma persistente.
* 🔍 **Catálogo y Búsqueda:**
    * Listado de productos por categorías (Frenos, Motor, Filtros, etc.).
* 💳 **Proceso de Pago (Checkout):** Simulación de un proceso de compra en varios pasos (dirección de envío, método de pago).
* 🔧 **Panel de Administración:** Una sección privada a la que solo los administradores pueden acceder:
    * Gestionar (CRUD) productos.
    * Gestionar categorías y marcas.
    * Gestionar el stock de los productos.
    * Gestionar cuentas de usuario (Eliminar y mododificar permisos).
---

## 🛠️ Stack Tecnológico

Este proyecto está construido utilizando las siguientes tecnologías:

### Frontend
* **[JavaScript](https://lenguajejs.com/javascript)**
* **[HTML](https://lenguajehtml.com)**
* **[CSS](https://lenguajecss.com)**

### Backend
* **[PHP](https://www.php.net)**

### Base de Datos
* **[MySQL](https://www.mysql.com/)**

### Despliegue
* [InfinityFree](https://www.infinityfree.com)

---

## ⚙️ Instalación y Puesta en Marcha (Local)

Sigue estos pasos para desplegar este proyecto en tu equipo local

### Prerrequisitos
* Tener instalado XAMP
* Tener visual studio code
* Tener la base de datos descargada.
* Tener la extension php server en visual studio code
* Tener las credenciales

### Paso 1
Descargar la base de datos esta se encuentra en la siguiente ruta sql/arvicuenca.sql.

### Paso 2
Debemos de abrir XAMP y despues entrar en phpmyadmin una vez dentro debemos darle al boton de importar y selecionamos la base de datos previamente descargada.

### Paso 3
Descargar el proyecto entero se descargara en un .zip

### Paso 4
Descomprimir el archivo .zip en la siguiente ruta C:\xampp\htdocs.

### Paso 5
Abrir el proyecto en visual studio code, para ello le damos a file despues a open folder y buscamos el archivo que acabamos de descomprimir.

### Paso 6
Buscamos el archivo index.php este se encontrara fuera de todas las carpetas es decir en la carpeta raiz del proyecto, entramos en el archivo como si lo fueramos a editar y le damos click derecho se nos deplegaran muchas opciones nosotros debemos darle a la de PHP Server: reload server esto hara que se nos abra la pagina princiapl del proyecto en el navegador.

### Paso 7
Por ultimo debemos de buscar el archivo credenciales.txt que se encontrara junto al de index.php este archivo nos dara dos usuarios uno administrador y otro cliente para que podamos hacer uso de toda la web.



