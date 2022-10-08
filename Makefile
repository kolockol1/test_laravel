init:
	composer install
    cp .env.example .env
    touch database/database.sqlite
    php artisan migrate
    php artisan key:generate
    ./vendor/bin/sail up
    npm install
    npm run dev
