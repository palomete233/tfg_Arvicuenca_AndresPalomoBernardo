# Arvicuenca - TFG 🚗

![Badge TFG](https://img.shields.io/badge/Proyecto-TFG-blue.svg)
![GitHub repo size](https://img.shields.io/github/repo-size/[TU_USUARIO_GITHUB]/[TU_REPOSITORIO])
![GitHub last commit](https://img.shields.io/github/last-commit/[TU_USUARIO_GITHUB]/[TU_REPOSITORIO])

Este repositorio contiene el código fuente de mi Trabajo de Fin de Grado (TFG) para el Grado Superior de Aplicaciones Web. El proyecto es una tienda online sobre uan tienda de recambios para el mundo del automovil.

## 📖 Descripción del Proyecto

El objetivo es diseñar y desarrollar una web que sea compltamente funcional y nos permita implementarla en una tienda fisica real, la web esta enfocada en los recambios del automovil. La web permite al usuario navegar por un ctalogo de productos, buscar productos mediante filtros y realizar pedidos que posteriormente seran enviados a su domicilio, de momento todo el proceso de pago y envio esta simulado en un futuro se podria implenar una pasarela de pago real y un sistema de mensajeroa con otras mejoras en la web.

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

## 🖼️ Vistas Previas (Screenshots)

*Aquí es muy recomendable que añadas capturas de pantalla de tu aplicación. Sube las imágenes a tu repositorio (ej. en una carpeta `/docs/images`) y enlaza a ellas.*

| Página de Inicio | Catálogo de Productos |
| :---: | :---: |
| [Imagen de la Home Page] | [Imagen de la página de productos/filtros] |

| Carrito de Compras | Proceso de Pago (Checkout) |
| :---: | :---: |
| [Imagen del carrito] | [Imagen del checkout] |

*(Ejemplo de cómo enlazar una imagen si la subes a la carpeta /docs/images/home.png)*
`![Página de Inicio](docs/images/home.png)`

---

## 🛠️ Stack Tecnológico

Este proyecto está construido utilizando las siguientes tecnologías:

### Frontend
* **[React](https://reactjs.org/)** (o [Vue.js](https://vuejs.org/), [Angular](https://angular.io/), [HTML/CSS/JS puro])
* **[Tailwind CSS](https://tailwindcss.com/)** (o [Bootstrap](https://getbootstrap.com/), [Material-UI](https://mui.com/), [Sass](https://sass-lang.com/))
* **[React Router](https://reactrouter.com/)** (para el enrutado)
* **[Axios](https://axios-http.com/)** (para las peticiones HTTP)

### Backend
* **[Node.js](https://nodejs.org/)** (con **[Express](https://expressjs.com/)**) (o [Python/Django], [Java/Spring Boot], [PHP/Laravel])
* **[Sequelize](https://sequelize.org/)** (o [Mongoose], [Prisma], [TypeORM]) como ORM.
* **[JWT (JSON Web Tokens)](https://jwt.io/)** (para la autenticación)
* **[Stripe](https://stripe.com/)** (para la simulación de pasarela de pago) [O el que hayas usado]

### Base de Datos
* **[MySQL](https://www.mysql.com/)** (o [PostgreSQL](https://www.postgresql.org/), [MongoDB](https://www.mongodb.com/))

### Despliegue (Opcional)
* [Vercel](https://vercel.com/) (para el Frontend)
* [Heroku](https://www.heroku.com/) / [Render](https://render.com/) (para el Backend y la BD)

---

## ⚙️ Instalación y Puesta en Marcha (Local)

Sigue estos pasos para levantar el proyecto en un entorno local.

*(Este es un ejemplo asumiendo una estructura estándar de Frontend/Backend. ¡Ajústalo a tu proyecto!)*

### Prerrequisitos
* Node.js (v16 o superior)
* NPM / Yarn
* [Nombre de tu BD] (ej. MySQL Workbench)
