.PHONY: help
.DEFAULT_GOAL = help

DC=docker-compose
PHP=$(DC) exec php
CONS=$(PHP) bin/console
DB=$(DC) exec db

## —— Docker 🐳  ———————————————————————————————————————————————————————————————
u: up
up: ## docker-compose up -d
	$(DC) up -d

d: down
down: ## docker-compose down
	$(DC) down -v --remove-orphans

php: ## Enters the PHP container
	$(PHP) sh

## —— Database 📑 ———————————————————————————————————————————————————————————————
dd: db-dump
db-dump: ## Backup the database as a SQL backup file (the filename as an argument)
	#Type password after command: root
	 $(DB) mysqldump  --add-drop-table -uroot -p jpgrammar > $(filter-out $@,$(MAKECMDGOALS))

dl: db-load
db-load: ## Load a SQL backup file (the filename as an argument)
	$(DB) mysql -uroot -proot jpgrammar < $(filter-out $@,$(MAKECMDGOALS))

dm: db-migration
db-migration: ## Run doctrine migrations
	$(CONS) doctrine:migrations:migrate --no-interaction

## —— Tests 🤖 ———————————————————————————————————————————————————————————————
t: test
test: ## Run tests
	$(PHP) bin/phpunit

tc: test-coverage
test-coverage: ## Run tests with code coverage
	$(PHP) bin/phpunit --coverage-html public/code-coverage

td: test-db
test-db:
	$(PHP) rm var/data/test.sqlite
	$(CONS) d:d:c -e test
	$(CONS) d:s:c -e test
	$(CONS) d:f:l -n -e test
	$(PHP) mv var/data/test.sqlite tests/test.sqlite

## —— Others 🛠️️ ———————————————————————————————————————————————————————————————
help: ## Generates this list
	@grep -E '(^[a-zA-Z0-9_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

cs: code-style
code-style: ## Fix code style
	$(PHP) tools/php-cs-fixer/vendor/bin/php-cs-fixer fix src
