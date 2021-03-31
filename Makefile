DC=docker-compose
EXEC=$(DC) exec php
CON =  $(EXEC) bin/console
DB=$(DC) exec db

##
## Docker-Compose
##---------------------------------------------------------------------------
.PHONY: up

up:
	$(DC) up -d
down:
	$(DC) down -v --remove-orphans
php: ## Run remove for db
	$(EXEC) sh

##
## Database
##---------------------------------------------------------------------------

db-dump:
	#Type password after command: root
	 $(DB) mysqldump  --add-drop-table -uroot -p jpgrammar > $(filter-out $@,$(MAKECMDGOALS))

db-load:
	$(DB) mysql -uroot -proot jpgrammar < $(filter-out $@,$(MAKECMDGOALS))

db-migration:
	$(CON) doctrine:migrations:migrate --no-interaction

##
## Tests
##---------------------------------------------------------------------------
.PHONY: test

test: ## Run unit tests
	$(EXEC) bin/phpunit

test-coverage: ## Run unit tests with code coverage generate
	$(EXEC) bin/phpunit --coverage-html public/code-coverage

#Generate tests' database
test-db:
	$(EXEC) rm var/data/test.sqlite
	$(CON) d:d:c -e test
	$(CON) d:s:c -e test
	$(CON) d:f:l -n -e test
	$(EXEC) mv var/data/test.sqlite tests/test.sqlite

##
## Code Style
##---------------------------------------------------------------------------
cs:
	$(EXEC) tools/php-cs-fixer/vendor/bin/php-cs-fixer fix src
