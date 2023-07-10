<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## System requirements
- PHP 8.2^
- composer 2.5^
- node 19.8^
- npm 9.5^
- On production, it require supervisor or similar service.

## How to set up
- Clone this project `git clone https://git.staging.securemetasys.com/securemetasys/laravelvuexy.git`

### Production
- Run command `composer install --no-dev`
- Update the .env
```
APP_ENV=production
APP_DEBUG=false
```

### Development
- Run command `composer install`
- No need to update **APP_ENV** and **APP_DEBUG**

### Common steps
- Connect database
    ```
      DB_CONNECTION=mysql (recommended)
      DB_HOST=<DATABASE HOST>
      DB_PORT=<DATABASE PORT>
      DB_DATABASE=<DATABASE NAME>
      DB_USERNAME=<DATABASE USERNAME>
      DB_PASSWORD=<DATABASE PASSWORD>
    ```
- Run following command one by one
  - `composer run-script post-root-package-install`
  - `composer run-script post-create-project-cmd`
  - `php artisan migrate`
  - `php artisan db:seed`
  - `php artisan storage:link`
  - `npm install`
  - `npm run build`
### ***After the project setup very first update "Mail Setting" in the Settings section***

## Features
#### User side
- Register and login 
- Logging user can update profile information
#### Admin side
- User management admin can add, update and delete users.
- Settings 
  - Admin can **manage site configuration**
  - Admin can change **mail configuration**
  - Admin can manage **email templates**
- Activity logs
  - Audit Logs show all user operation logs
  - Auth Logs show all user login related logs
- Access management
  - Admin can manage user roles add, update and delete roles, also admin can manage permissions to each role
  - Admin can see all permissions of site
- Admin also can manage his profile information.
