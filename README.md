Automotive Data Solution - Backend skill test - PHP
==========================

## Tasks

The list of the tasks listed in the [Readme](../Readme.md) in the root directory of the bitbucket project.

## Requirement

* You need to have composer installed [Download composer](https://getcomposer.org/download/)

* You need to install docker desktop and Sign Up [Download Docker](https://www.docker.com/products/docker-desktop)


## Notes 

* You are free to organize the content of the folder `src` as you want. 
* You are free to install any packages 

## How to run the project

### Install the application

```bash
cd php
composer install
```

### Run API

1) Spawn containers

``` 
docker-compose up
```

2) Check that everything is ok

``` 
curl http://localhost:8080
```

``` 
curl http://localhost:8080/api/vehicle-makes
```

Sample response

```
{
    "vehicle_makes": [
        {
            "id": 1,
            "name": "Acura",
            "url": "https://www.acura.ca"
        },
        {
            "id": 2,
            "name": "Alfa Romeo",
            "url": "https://www.alfaromeo.ca"
        }
    ]
}
```

### Interact with MySQL when you have to update the schema

1) Stop and Purge the MySQL container
```
./runmysql.sh  #Choose purge in the contextual menu
```

2) Re-run containers
```
docker-compose up
```

**IMPORTANT**: Everytime you modify the file `data\sql\update_database.sql` you have to run the script `runmysql.sh` with the command *purge* 

Note: You can apply directly your SQL queries to test them in your favorite Mysql UI by using the credential defined in the `docker-compose.yml` file

### Unit Tests

```
composer test
```

### Documentation

This app use [PHP Slim Framework](https://www.slimframework.com/). This is a web framework written in PHP.
Complementary documentation can be found here: https://odan.github.io/2019/11/05/slim4-tutorial.html

We use docker compose to have a database MySQL in local accessible by this project.
The documentation of how to use *docker-compose* can be found here: https://docs.docker.com/compose/