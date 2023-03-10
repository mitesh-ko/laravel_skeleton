<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Project Setup steps
- Clone this project `git clone https://git.staging.securemetasys.com/securemetasys/laravelvuexy.git`
- Copy the **.env.example** file and rename it to **.env**
- run command to add APP_KEY in .env `php artisan key:generate --ansi`
- Update the .env to connect with database.
```
  DB_CONNECTION=mysql (recommended)
  DB_HOST=<DATABASE HOST>
  DB_PORT=<DATABASE PORT>
  DB_DATABASE=<DATABASE NAME>
  DB_USERNAME=<DATABASE USERNAME>
  DB_PASSWORD=<DATABASE PASSWORD>
```
- Run command on terminal `composer install` This installs all PHP dependencies.
- Run command on terminal `npm install` This installs all node dependencies.
- Migrate the databases. run command `php artisan migrate`
- To access storage files run command `php artisan storage:link`
