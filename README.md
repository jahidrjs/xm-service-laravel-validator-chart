# Install and Set Up Laravel with Docker Compose as a microservice

Setting up Laravel in the local environment with Docker using the LEMP stack that includes: Nginx, MySQL, PHP, and phpMyAdmin. or postgreesql and pgadmin as a microservice 

## How to Install and Run the Project

1. ```git clone``https://github.com/jahidrjs/laravel_docker_microservice.git`
2. ```cd src```
3. ```composer install```
3. Copy ```.env.example``` to ```.env```
4. ```docker-compose build```
5. ```docker compose up -d```
6. You can see the project on ```127.0.0.1:8080``` as nginx gateway port

## How to use MySQL as a database

1. Uncomment the MySQL configuration inside the ```docker-compose.yml``` including: ```db``` and ```phpMyAdmin```
2. Copy ```.env.example``` to ```.env```
3. Change ```DB_CONNECTION``` to ```mysql```
4. Change ```DB_PORT``` to ```3306```
5. Open the ```phpMyAdmin``` on ```127.0.0.1:3400```

## How to use PostgreSQL as a database

1. Uncomment the PostgreSQL configuration inside the ```docker-compose.yml``` including: ```db``` and ```pgamdin```
2. Copy ```.env.example``` to ```.env```
3. Change ```DB_CONNECTION``` to ```pgsql```
4. Change ```DB_PORT``` to ```5432```
5. Open the ```pgAdmin``` on ```127.0.0.1:5050```

## How to run Laravel Commands with Docker Compose

1. ```cd src```
2. ```docker-compose exec app php artisan {your command}``` or if you use destop docker then you can open container terminal and run code directly.



## Linkedin 
https://www.linkedin.com/in/jahid-al-mamun-9b02372b/
