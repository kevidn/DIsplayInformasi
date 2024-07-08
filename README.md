
## Clone the Repository

```sh
git clone https://github.com/kevidn/DisplayInformasi.git
cd DisplayInformasi
```

## Install Composer (Dependencies)

```sh
composer install
```

## Create `.env` File

```sh
cp .env.example .env
```

## Generate Application Key
Generate the application key, which will be used for encryption.

```sh
php artisan key:generate
```

## Configure Database (optional)

Update the `.env` file with your database credentials.

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

## Run Migrations

```sh
php artisan migrate
```

## Run Seeder

```sh
php artisan db:seed
```

## Run the Application

```sh
php artisan serve
```

Now, you can access your Laravel application by visiting `http://localhost:8000` in your web browser.
```
