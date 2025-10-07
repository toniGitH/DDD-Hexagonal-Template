# PLANTILLA BASE PARA CREAR PROYECTOS LARAVEL CON DDD + HEXAGONAL

<br>

## Sobre la plantilla

1. La plantilla parte de un proyecto base de Laravel 12, sin kits de inicio.

2. Se han añadido las **rutas api** por si se quiere crear un proyecto API.
   Se ha añadido también el trait *HasApiTokens* en el modelo **User.php**

4. Para poder crear toda la estructura del proyecto hexagonal (*Domain-Application-Infrastructure*) de manera aislada, se debe crear, en la raíz del proyecto (fuera de cualquier carpeta), una **nueva carpeta llamada src**, dento de la que se creará toda la arquitectura del proyecto (las 3 capas de hexagonal).

5. Para que las clases que se creen dentro de esa nueva carpeta src sean detectadas por el *autoload*, también se ha modificado el archivo **composer.json** para añadir **"Src\\": "src/"** a la configuración correspondiente:
~~~
"autoload": {
        "psr-4": {
            "App\\": "app/",
            "Src\\": "src/",
            "Database\\Factories\\": "database/factories/",
            "Database\\Seeders\\": "database/seeders/"
        }
    },
~~~

## Instrucciones para despliegue en local

1. Copia, clona o haz fork del repositorio.
2. Copia el archivo .env.example y renombralo a **.env**
3. Configura las **variables de entorno** que necesites. Para un despliegue rápido, utiliza SQLite mediante esta configuración:
~~~
DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=
~~~
4. Instala las **dependencias de composer**:
   ~~~
   composer install
   ~~~
5. Genera la **clave de la aplicación**:
   ~~~
   php artisan key:generate
   ~~~
6. Ejecuta las **migraciones**:
   ~~~
   php artisan migrate
   ~~~
   
   Te saldrá este aviso:

    `**WARN**  The SQLite database configured for this application does not exist: database/database.sqlite.`

     `Would you like to create it?`
   
     `Yes / No`

    Debes decir que **SÍ** para que cree el archivo que actuará como base de datos.
   
7. Abre el proyecto en el **servidor local de laravel**:
   ~~~
   php artisan serve
   ~~~
