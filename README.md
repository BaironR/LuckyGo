# LuckyGo

##

LuckyGo es una aplicacion que permite a sus usuarios poder participar de loterias, el administrador podra designar personas encargadas de manejar los sorteos para determinar los numeros ganadores, la aplicacion es llevada a vida por el equipo WebTitans. 

El projecto implementa las siguientes herramientas:
* Comprar tickets de loteria, los cuales proceden a ser guardados dentro de una base de datos, sin necesidad de registro.
* Gestionar por sistema el registro de usuarios como sorteadores.
* Permitir a los sorteadores seleccionar los números ganadores de ticket de cada sorteo.
* Interactuar con una base de datos para los registros de loterias realizadas y analizar la participación de los sorteadores.

## Pasos para poder levantar el projecto:
1. Clonar el projecto.
2. Instalar XAMPP.
3. Instalar Composer - 
4. Instalar Node.js -
5. Realizar copia o renombrar .env.example como .env.
6. Configurar .env según valores locales.
7. Generar APP-KEY local - php artisan key:generate.
8. Migrar la base de datos - 'php artisan migrate:refresh'.
9. Activar por medio de XAMPP servicios de Apache y MySQL.
10. Utilizar el comando 'npm run dev' para activar el entorno local
11. Activar y levantar la página por medio del comando 'php artisan serve'