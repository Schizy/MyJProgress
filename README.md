MyJProgress
==============
An application to keep track of your progress and keep you motivated even when you're feeling that you don't progress
anymore, this is the proof you are :)



Make commands
-------------

*Docker*

- `make up` (or `make u`) to launch the containers
- `make down` (or `make d`) to stop and remove the containers
- `make php` to enter the php container

*Database*

- `make db-dump FILENAME` (or `make dd`) to make a SQL backup
- `make load FILENAME` (or `make dl`) to load a SQL backup
- `make db-migration` (or `make dm`) to run the doctrine migrations

*Tests*

- `make test` (or `make t`) to run tests
- `make test-coverage` (or `make tc`) to run tests with coverage
- `make test-db` (or `make td`) to generate the test database using the fixtures

*Code style*

- `make code-style` (or `make cs`) to fix the code-style
