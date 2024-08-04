# Display Informasi Sekolah 

DisplayInformasi merupakan media yang digunakan untuk memajang berita, agenda, poster, dan beberapa informasi lainnya terkait sekolah. Aplikasi ini dibuat menggunakan Laravel 11 dan memiliki fitur yang memungkinkan tema untuk diubah menjadi biru dan hijau.


## Clone the Repository

```sh
git clone https://github.com/kevidn/DisplayInformasi.git
cd DisplayInformasi
```

## Install Composer & NPM (Dependencies)

```sh
composer install
```

```sh
npm run build
```

## Create `.env` File

```sh
cp .env.example .env
```

## Generate Application Key

```sh
php artisan key:generate
```

## Run the Storage Link

```sh
php artisan storage:link
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

```sh
npm run dev
```


Now, you can access DisplayInformasi application by visiting `http://localhost:8000` in your web browser.
