DOCKER_COMPOSE = docker-compose -f docker-compose.yml
CURRENT_DIRECTORY = $(shell pwd)

init:
	$(DOCKER_COMPOSE) build --pull
	$(DOCKER_COMPOSE) run --rm php-cli composer install
	$(DOCKER_COMPOSE) up -d
	$(DOCKER_COMPOSE) run --rm php-cli wait-for-it postgres:5432 -t 60
	$(DOCKER_COMPOSE) run --rm php-cli bin/console d:m:m --no-interaction

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

validate-db-schema:
	$(DOCKER_COMPOSE) run --rm php-cli ./bin/console doctrine:schema:validate

security-checker: back-end-security-checker

back-end-security-checker:
	docker run --rm -v $(CURRENT_DIRECTORY)/api:/app -w /app symfonycorp/cli check:security
