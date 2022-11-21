# capitol-promotions-api
Test for Capitol consulting

### Requirements:
- Docker 
- Docker Compose

### The project is runnable with 1 simple command from any machine:
- Just run the command `make projectInit` on root to start the application

### Tests should be runnable with 1 command:
- Run `make test-run` to start the test 

## NOTE: tests also runs when bringing up the project


## Explanations

### Stack
I decided to use this structure to be more confortable while developing and have all setted up by one single command:
- Symfony 5.4 As main development framework 
- MySQL 8 as Database Engine
- Nginx 

### Desicions
- Using Hexagonal Architecture as main architectural design for the application, to divide on layers from the application of the resources and the strict business rules 
- In the discounts i just apply a simple rule because boots category always has the highest discount percentage, so went first for the category verification and if it's not then to the SKU discount, also, having as null discount init, so by default it always be a non discount product
- I applied DTOs with JsonSerializable method in order to be able to transform objects to a json encodeable by default php
- I created an interface for the repo with the main methods needed by the application, in order to be prepare if changes the ORM or the repository class to consume a distinct db can be maded easly 
- Use Filters based on the domain layer so filters can be applied if it is a bussines desicion 
- Thanks to using symfony it resolves the dependency injection
- i created test for every layer, and the functional test for healthchecking the main endpoint mocking the DB, the best solution to the functional test is create a temporal test database so the test doesn't consume directly from the "productions" database
- Using `Make` allows me to create the instruction for bringing up the whole project with just one command and also those commands runs inside the docker container making it cleaner
- Enums inside the domain layer to having the business definition on constants