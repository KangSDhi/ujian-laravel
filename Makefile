SHELL = /bin/bash

build:
	docker compose build --no-cache

init:
	docker compose up -d app \
	&& docker compose up -d db \
	&& docker compose exec app composer install \
	&& docker compose exec app php artisan key:generate \
	&& docker compose exec app php artisan migrate:fresh --seed \
	&& docker compose exec app php artisan jwt:secret

up:
	docker compose up -d

down:
	docker compose down

restart:
	docker compose restart

shutdown:
	docker compose down -v