.PHONY: up down

build:
	@docker compose build

up:
	@docker compose run --rm php bash

down:
	@docker compose down --volumes
