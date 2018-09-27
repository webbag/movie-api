## My solution to the task: Movie-API

* Symfony 4.1 - use friendsofsymfony/rest-bundle and symfony/serializer-pack and a few others ...

#### Docker containers: Nginx proxy, Nginx, PHP, MySQL:
![Alt text](https://github.com/webbag/movie-api/blob/master/_develop/docker-ps.png?raw=true "Docker containers")

#### Schema MySQL:
![Alt text](https://github.com/webbag/movie-api/blob/master/_develop/movie-api.png?raw=true "Model DB")

#### Routing:
![Alt text](https://github.com/webbag/movie-api/blob/master/_develop/routing.png?raw=true "Model DB")

#### Help commends Symfony: 

* Load fixtures
``` 
 docker exec -it php bin/console doctrine:fixtures:load
``` 

* Debug router
``` 
docker exec -it php-movie bin/console debug:router
``` 

* Important show tests
``` 
 docker exec -it php bin/phpunit
``` 

## Examples

### Postmen collection
https://www.getpostman.com/collections/203e3a856064f6ec2417

#### List movies 
* GET  http://movie-api.webbag.pl/movies

#### Gets one movie
* GET  http://movie-api.webbag.pl/movies/20 

#### Adding rating for one movie
* POST http://movie-api.webbag.pl/movies/20/ratings?rating=10



## Install dev
Check version your docker
```
docker -v
 17.05.0-ce, build 89658be
docker-compose -v
 version  1.17.1 or higher
```
```
git clone git@github.com:webbag/movie-api.git
``` 

Create network from dedicated ip
* If the network uses this ip then select others (eg 172.255.0.1 or similar)
``` 
docker network create nginx-proxy --subnet=172.18.0.0/16 --gateway=172.18.0.1
```
Inspect network
``` 
docker network inspect nginx-proxy
```
Add to /ete/hosts IP gateway
* Also change the IP gateway in the _develop/.env file NGINX_PROXY_IP=172.18.0.1 
``` 
sudo echo "172.18.0.1 movie-api.lh" >> /etc/hosts
```

### Getting started DEV
```
cd _develop/ 
```
(enter your own settings)
```
cp .env.disc .env 
```

* Up
```
cd _develop/ 
docker-compose up -d
```
Open url 
http://movie-api.lh/ 

* Down
```
docker-compose down
```

* Composer install

```
docker exec -it php composer install
```

* Doctrine schema:update 

```
docker exec -it php php app/console doctrine:schema:update --force
```
    
* Generate entity by DB
``` 
docker exec -it php bin/console doctrine:mapping:import App\\Entity annotation --path=src/Entity
docker exec -it php bin/console make:entity --regenerate App
``` 

#### Entrance to the container
*  ```docker exec -it php bash ```
*  ```docker exec -it web bash ```
*  ```docker exec -it MySQL bash ```
 
#### Diagnosing containers

* Main 
``` 
docker ps
``` 

* Other
``` 
docker ps -a -f status=dead
docker ps -a -f status=exited
docker rm -f $(docker ps -aqf status=dead)
docker rm -f $(docker ps -aqf status=exited)

docker images -f dangling=true
docker rmi $(docker images -q -f dangling=true)
``` 

### MySQL

DEV
* host:       movie-api.lh
* port:       3306
* user:       movie-api
* pass:       movie-api
* pass_root:  movie-api
* db:         movie-api


# TODO in the future

### Install HATEOAS REST
* composer require arte/hateoas-bundle 

### Install REDIS
* composer require symfony-bundles/redis-bundle