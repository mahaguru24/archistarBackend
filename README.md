## Prerequisites
- Docker
- Docker-compose

## Installation

##### Install composer dependencies
`docker run --rm -v $(pwd):/app composer install`

##### Run all containers
`docker-compose up -d`

##### Run migrations
` docker-compose exec app php artisan migrate`

##### Run seeds
` docker-compose exec app php artisan migrate`

##### Generate app key
`docker-compose exec app php artisan key:generate`

##### Check out the app at 127.0.0.1 / localhost 

