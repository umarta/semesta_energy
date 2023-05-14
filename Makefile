.DEFAULT_GOAL := help

build: ## build develoment environment with laradock
	cp src/semesta_energy/.env.example src/semesta_energy/.env
	docker-compose build
	docker-compose up


serve: ## Run Server
	docker-compose up -d

migrate:
	docker-compose run --rm php php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
	docker-compose run --rm php php artisan key:generate
	docker-compose run --rm php php artisan migrate
	docker-compose run --rm php php artisan passport:install
	docker-compose run --rm php php artisan db:seed
	docker-compose run --rm php php artisan config:clear

migrate_fresh:
	docker-compose run --rm php php artisan migrate:fresh
	docker-compose run --rm php php artisan passport:install
	docker-compose run --rm php php artisan db:seed
	docker-compose run --rm php php artisan config:clear

test:
	docker-compose run --rm php php artisan test


migrate_partial:
	docker-compose run --rm php php artisan migrate

tinker: ## Run tinker
	docker-compose run --rm php php artisan tinker


.PHONY: help
help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'