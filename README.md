## Prerequisites
- Docker
- Docker-compose

## Installation

##### Run all containers
`docker-compose up -d`

##### Run migrations
` docker-compose exec app php artisan migrate`

##### Run seeds
` docker-compose exec app php artisan migrate`

##### Generate app key
`docker-compose exec app php artisan key:generate`

##### Check out the app at 127.0.0.1 / localhost 

