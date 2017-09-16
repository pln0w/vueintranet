# VueIntranet

## The project
The project is a **Docker** based intranet app, including **Vue.js 2** as frontend layer and **Laravel 5.4** as REST API backend layer.

## Stack build
Step by step:

1. Run docker containers
```
docker-compose build
docker-compose up -d
```

Go to app container
```
docker exec -it vuaintranet_php7 /bin/bash
```

and run database migration 
```
php artisan migrate # runs migrations
php artisan db:seed # creates admin user
```

On production run docker-compose.prod.yml to work only on images from local registry. Provide Blue Green deployment and scaling

**vueintranet.dev:80** is the website

**vueintranet.dev:1936** is HAProxy stats

**localhost:8000** is the working laravel backend app

### This project is at very first phase! I just want to keep update my repository with my latest amends every time I develop it