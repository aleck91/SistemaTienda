# Inventario de Tienda Abarrotes con Laravel

 Esta aplicación web está desarrollada en Laravel y tiene como objetivo principal proporcionar un sistema de gestión de inventarios para una tienda de abarrotes. Permite registrar, actualizar y consultar productos, con un sistema de gestión de usuarios (administrador y empleados) para controlar el acceso a las funcionalidades.

 ---

 ## Estructura del Proyecto

El proyecto sigue el patrón MVC (Modelo-Vista-Controlador) típico de Laravel. A continuación, se presenta una vista simplificada de las carpetas más destacadas:

- `app/`: Contiene el código fuente de la aplicación.
  - `Http/`: Controladores y middleware.
  - `Models/`: Modelos de la base de datos.

- `database/`: Archivos relacionados con la base de datos.
  - `migrations/`: Estructura de las tablas.
  - `seeds/`: Datos iniciales para la base de datos (opcional).

- `resources/`: Archivos de recursos para las vistas y estilos.
  - `views/`: Plantillas Blade para las vistas de la aplicación.

- `routes/`: Archivos para definir las rutas.
  - `web.php`: Rutas accesibles desde el navegador.

- `public/`: Archivos públicos accesibles desde el navegador (CSS, JS, imágenes).

- `.env`: Archivo de configuración de entorno (base de datos, URL, claves).

- `composer.json`: Listado de dependencias del proyecto.

---

## Dependencias

Las siguientes dependencias son utilizadas en este proyecto:

- **Laravel**: Framework principal para el desarrollo de la aplicación.
- **Filament**: Paquete de administración para facilitar la creación de paneles de administración y CRUDs.
- **Composer**: Gestor de dependencias para instalar bibliotecas de PHP.

(Puedes ver todas las dependencias y sus versiones específicas en el archivo composer.json.)


---

## Manual básico de usuario para operar la aplicación de inventario

Accede al siguiente enlace para encontrarlo: [manual](https://docs.google.com/document/d/1U6h_WxbKurfVQqjEBxEEx5RGf0X_NqpH-WEbj23zW1Y/edit?usp=sharing)