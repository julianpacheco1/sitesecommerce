# Sites Ecommerce

## Descripción

Breve descripción del proyecto. Explica qué hace y cuál es su propósito.

## Instalación

Sigue estos pasos para configurar y ejecutar el proyecto en tu entorno local:

1. **Clonar el Repositorio**:
   Clona el repositorio a tu máquina local si aún no lo has hecho.

   ```bash
   git clone <https://github.com/julianpacheco1/sitesecommerce>
   cd <NOMBRE_DEL_DIRECTORIO_DEL_PROYECTO>

Siguientes Pasos, son todos ejecutados en la raíz del proyecto.

1. **Instalar Dependencias**:

   ```bash
   composer install

   ```bash
   npm install
   ```
   
   ```bash
    cp .env.example .env
   ```

3. **Crear Base de datos**:

Deberás crear una base de datos en tu gestor de mysql, y luego, configurar el archivo .env para establecer la conexion.


4. **Ejecutar Migraciones**:

   ```bash
   php artisan migrate
   ```

5. **Ejecutar Seeders**:

   ```bash
   php artisan db:seed


6. **Levantar el proyecto**:
   ```bash
   php artisan serve