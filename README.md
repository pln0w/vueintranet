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
docker exec -it vuaintranet_laravel_1 /bin/bash
```

and run database migration 
```
php artisan migrate # runs migrations
php artisan db:seed # creates admin user
```

**vueintranet.dev:80** is the website

**vueintranet.dev:1936** is HAProxy stats

**localhost:8000** is the working laravel backend app

### The goal of this repo is to keep all I've done for fun just to see how it works. Also during development process I've been learning HAProxy, load balancing and generally building docker environment for such a uses

### This project is an frontend app separated from backend server to be able to plug whatever I want as a REST API

### This is not completed application. Only proof of concept for fun. Users CRUD works (display via GET and create via POST). 