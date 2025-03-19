.PHONY: up down

build:
	@docker compose build

up:
	@docker compose run --rm php bash

down:
	@docker compose down --volumes

phpcs:
	@docker compose run --rm php vendor/bin/phpcs /app/src/phpcs/

phpcbf:
	@docker compose run --rm php vendor/bin/phpcbf /app/src/phpcs/
