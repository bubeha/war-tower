include .env

ifndef APP_ENV
APP_ENV=prod
endif

DOCKER_COMPOSE = docker compose -f docker-compose.yml -f environments/$(APP_ENV)/docker-compose.yml
CURRENT_DIRECTORY = $(shell pwd)

init:
	$(DOCKER_COMPOSE) build --pull
ifeq ($(APP_ENV), prod)
	$(DOCKER_COMPOSE) run --rm php-cli composer install --no-dev
else
	$(DOCKER_COMPOSE) run --rm php-cli composer install
endif
	$(DOCKER_COMPOSE) up -d
	$(DOCKER_COMPOSE) run --rm php-cli wait-for-it postgres:5432 -t 60
	$(DOCKER_COMPOSE) run --rm php-cli bin/console d:m:m --no-interaction
ifneq ($(APP_ENV), prod)
	$(DOCKER_COMPOSE) run --rm php-cli bin/console d:f:l --no-interaction
endif

down:
	$(DOCKER_COMPOSE) down --remove-orphans

start:
	$(DOCKER_COMPOSE) up -d --remove-orphans --force-recreate --build

stop:
	$(DOCKER_COMPOSE) stop

down-clear:
	$(DOCKER_COMPOSE) down -v --remove-orphans

pull:
	$(DOCKER_COMPOSE) pull

update-deps:
	$(DOCKER_COMPOSE) run --rm --no-deps php-cli composer update

test:
	$(DOCKER_COMPOSE) run --rm --no-deps php-cli composer run test

test-coverage:
	$(DOCKER_COMPOSE) run --rm --no-deps php-cli composer run test-coverage

psalm:
	$(DOCKER_COMPOSE) run --rm --no-deps php-cli composer run psalm -- --no-diff

analyze: psalm

lint:
	$(DOCKER_COMPOSE) run --rm --no-deps php-cli composer run phplint
	$(DOCKER_COMPOSE) run --rm --no-deps php-cli composer run php-cs-fixer fix -- --dry-run --diff

cs-fix:
	$(DOCKER_COMPOSE) run --rm --no-deps php-cli composer run php-cs-fixer fix

rector:
	$(DOCKER_COMPOSE) run --rm --no-deps php-cli composer run rector

validate-db-schema:
	$(DOCKER_COMPOSE) run --rm php-cli ./bin/console doctrine:schema:validate

security-checker: back-end-security-checker

back-end-security-checker:
	docker run --rm -v $(CURRENT_DIRECTORY)/api:/app -w /app symfonycorp/cli check:security
