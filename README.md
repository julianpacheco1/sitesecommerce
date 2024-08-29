# Sites Ecommerce


## Instalación

Sigue estos pasos para configurar y ejecutar el proyecto en tu entorno local:

1. **Clonar el Repositorio**:
   Clona el repositorio a tu máquina local si aún no lo has hecho.


   ```bash
   git clone https://github.com/julianpacheco1/sitesecommerce.git
   ```

   ```bash
   cd sitesecommerce
   ```

Siguientes Pasos, son todos ejecutados en la raíz del proyecto.

1. **Instalar Dependencias**:

   ```bash
   composer install
   ```

   ```bash
   npm install
   ```
   
   ```bash
    cp .env.example .env
   ```

3. **Crear Base de datos**:

Deberás crear una base de datos en tu gestor de mysql, y luego, configurar el archivo .env para establecer la conexion.



 ### ¡IMPORTANTE!

## Antes de comenzar con la configuracion, deberás crearte una cuenta en Stripe, para poder obtener tus credenciales y así poder configurar el .env (para que funcione).

## - [Link para crearte una cuenta](https://dashboard.stripe.com/register).



Agrega las siguientes claves a tu archivo `.env`:

```bash
STRIPE_KEY=
STRIPE_SECRET=
```




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





7. **Roadmap del proyecto**

En el inicio, te encontraras con una básica navegacion, a la cual podras acceder sin problemas, aunque no estes logueado; pero cuando intentes comprar, inevitablemente vas a necesitar loguearte.
Te va a redirigir automáticamente cuando el aplicativo necesite que estes logueado.
Obviamente vas a poder, y vas a tener que registrarte para hacer cualquier transaccion. 

La aplicacion cuenta con 2 versiones, una que la llamo local, y otra que la llamo Api.

La version en local, es la que no te redirije hacia Stripe para poder comprar, lo podes hacer dentro del mismo aplicativo.
Y la version Api, cuando ejecutes una compra, te redirige hacia su sitio. Una vez ejecutada esa compra, te devuelve al aplicativo.





8 . **Informacion útil**

Para probar la integración del formulario de pago alojado en Stripe:

Crear una sesión de pago.
Complete los detalles de pago con un método de la siguiente tabla.
Introduzca cualquier fecha futura de vencimiento de la tarjeta.
Introduzca cualquier número de 3 dígitos para el CVC.
Introduzca cualquier código postal de facturación.

Para poder simular una compra : 

- **Email:** "cualquiera"
- **Número de Tarjeta:** `4242 4242 4242 4242`
- **Fecha de Vencimiento:** "cualquiera" (puedes usar cualquier fecha futura)
- **CVC:** "cualquiera" (puedes usar cualquier número de 3 dígitos)
- **Código Postal de Facturación:** "cualquiera"


**Nota:** Asegúrate de utilizar los datos de prueba proporcionados por Stripe para asegurar que la simulación funcione correctamente.


**Documentacion de Stripe**:

 - [Vea aquí la documentacion](https://docs.stripe.com/payments/accept-a-payment).