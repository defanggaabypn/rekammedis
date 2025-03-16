## Requirement

1. [Composer](getcomposer.org)
2. [Laravel](https://laravel.com/docs/8.x)
3. [Xampp](https://www.apachefriends.org/index.html)

## Getting Started!!

1. [git clone https://gitlab.com/pti-ggwp/lshc.git]
2. Buat database baru dengan nama [lshc]
3. git bash project [composer install]
4. git bash project [cp .env.example .env]
5. git bash project [php artisan key:generate]
6. git bash project [php artisan migrate:fresh --seed]
7. git bash project [php artisan serve]

## Tambahan(recommended)

1. Debugbar [composer require barryvdh/laravel-debugbar --dev]

## Tambahan(Optional)

1.-

## Perhatian Commit

1. [optional for --]->deletable => bisa dihapus karena udh slesai digunakan
2. [optional for --] => file optional, tolong jangan di hapus/diganti

## Perhatian Directory

1. Front-end
   a. {resources/views} => Blade
   b. {public/css} => Penyimpanan CSS
   c. {public/js} => Penyimpanan JS

2. Back-end
   a. {App\Http\Controllers} => Controller
   b. {App\Http\Middleware} => Middleware
   c. {App\Models} => Models

3. DB-Engineer
   a. {Database\factories} => Factory untuk generate random data
   b. {Database\Migration} => Struktural database
   c. {Database\Seeder} => Seeding data yang sudah ada ke database
