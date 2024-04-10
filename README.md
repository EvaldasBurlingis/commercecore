# Requirements

- PHP > 8.2
- Node > 20.12.1
-

---

## Installation

For easy setup use Laravel Herd or Valet(Docker on mac is not working great)

```
#clone repository
git clone <repo>

# copy .env.example to .env
cp .env.example .env

# create sqlite database
touch database/database.sqlite 

# install composer dependencies
composer install

# install npm dependencies
npm install

# generate app key
php artisan key:generate

# run migrations
php artisan migrate

# run seeders
php artisan db:seed

# run npm
npm run dev
```

---

## Testing

**Change env APP_ENV=local to APP_ENV=testing**

```
# run tests
./vendor/bin/pest
```
