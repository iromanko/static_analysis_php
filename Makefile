.PHONY: build up down phpcs phpcbf phpmd

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

phpmd:
	@docker compose run --rm php vendor/bin/phpmd /app/src/phpmd text /app/phpmd.xml
