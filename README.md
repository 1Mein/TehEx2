## Установка

```bash
git clone https://github.com/1Mein/TehEx2.git
cd TehEx2

composer install

copy .env.example .env

php artisan sail:install
pgsql

docker-compose up -d
docker-compose exec laravel.test php artisan migrate
```
