include .env

# HELP
# This will output the help for each task
# thanks to https://marmelab.com/blog/2016/02/29/auto-documented-makefile.html
.PHONY: help

help: ## This help.
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

.DEFAULT_GOAL := help


# DOCKER TASKS
build: ## Build project
	docker-compose build

init: ## Init project. Install composer
	docker exec -it --user www-data events_php composer install
	cp ../.env.example ../.env

init-db: ## Init project. Install composer
	mysql -h172.31.0.11 -u${MYSQL_USER} -p${MYSQL_PASSWORD} ${MYSQL_DATABASE} < mysql/schema.sql

up: ## Start docker containers
	docker-compose up -d

down: ## Down docker containers. Stop & remove containers
	docker-compose down

stop: ## Stop running containers
	docker-compose stop

start: ## Start existing containers
	docker-compose start

console: ## Connect to container
	docker exec -it --user www-data events_php bash

dev-enable: ## Enable development mode. MODE enable/disable/status
	docker exec -it --user www-data events_php composer development-enable

dev-disable: ## Enable development mode. MODE enable/disable/status
	docker exec -it --user www-data events_php composer development-disable

dev-status: ## Enable development mode. MODE enable/disable/status
	docker exec -it --user www-data events_php composer development-status

mezzio: ## Run CLI command. example: make mezzio COMMAND="--help"
	docker exec -it --user www-data events_php composer mezzio ${COMMAND}