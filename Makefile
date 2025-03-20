.PHONY: build up down phpcs phpcbf phpmd psalm psalm-baseline

build:
	@docker compose build

up:
	@docker compose run --rm php bash

down:
	@docker compose down --volumes --remove-orphans

phpcs:
	@docker compose run --rm php vendor/bin/phpcs /app/src/phpcs/

phpcbf:
	@docker compose run --rm php vendor/bin/phpcbf /app/src/phpcs/

phpmd:
	@docker compose run --rm php vendor/bin/phpmd /app/src/phpmd text /app/phpmd.xml

psalm:
	@docker compose run --rm php vendor/bin/psalm --no-progress --output-format=compact --show-info=false

psalm-baseline:
	@docker compose run --rm php vendor/bin/psalm --set-baseline=psalm-baseline.xml
