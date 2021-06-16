# DCRSMS
## Author
[Anas Adham bin Azlan CB18013](https://github.com/AnasAdham) \
[Mohammad Alif Yasir bin Soleh CB18015](https://github.com/yasirsoleh/) \
[Hazwan Afiq bin Mohamad CB18081](https://github.com/hazwanafiqq) \
[Zul Adli Izzuddin bin Zalimin CB18086](https://github.com/zul99hack) \
[Muhammad Amar bin Razali CB18096](https://github.com/AmarRazali) \
[Nur Azlin Liana binti Mohd Adlan CB18139](https://github.com/youseethatdaisy)
## Purpose
For the subject BCS3133 Software Engineering Practices Semester 2 Session 2020/2021.
## Why dcrsms-nuked?
Because of integration failure at old repo [dcrsms](https://github.com/yasirsoleh/dcrsms).
## How to run
There is two way to run, using [Laravel Sail](#using-laravel-sail) or [XAMPP](#using-xampp). Follow the instructions accordingly.
### Using Laravel Sail 
#### 0. Clone the repository
```
git clone https://github.com/yasirsoleh/dcrsms-nuked.git
```
#### 1. Make sure to be inside the directory
```
cd dcrsms-nuked
```
#### 2. Composer install using docker to prepare vendor folder
```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/opt \
    -w /opt \
    laravelsail/php80-composer:latest \
    composer install --ignore-platform-reqs
```
#### 3. Prepare .env
```
cp .env.example .env
```
#### 4. Edit .env and change the variable as follows
```
DB_HOST=mysql
DB_USERNAME=sail
DB_PASSWORD=password
```
#### 5. Run using sail detached
```
./vendor/bin/sail up -d
```
#### 6. Run node dependencies
```
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
```
#### 7. Run migration
```
./vendor/bin/sail artisan migrate:fresh
```
#### 8. Run database seeder
```
./vendor/bin/sail artisan db:seed
```
#### 9. Open browser and go to localhost
```
http://localhost
```

### Using XAMPP
#### 0. Clone the repository
```
git clone https://github.com/yasirsoleh/dcrsms-nuked.git
```
#### 1. Make sure to be inside the directory
```
cd dcrsms-nuked
```
#### 2. Composer install dependencies
```
composer install
```
#### 3. Install node dependencies
```
npm install
npm run dev
```
#### 4. Prepare .env
```
cp .env.example .env
```
#### 5. Create new database in phpmyadmin with the name
```
dcrsms
```
#### 6. Run migration
```
php artisan migrate:fresh
```
#### 7. Run database seeder
```
php artisan db:seed
```
#### 8. Serve the app
```
php artisan serve
```
#### 9. Open browser and go to localhost
```
http://localhost:8000
```