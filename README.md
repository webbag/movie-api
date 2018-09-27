## My solution to the task: MOVIE API

* Symfony 4.1 -  use friendsofsymfony/rest-bundle and symfony/serializer-pack and a few others ...

* Postman for API requests

* UnitPHP Tests 

##### Docker containers: Nginx proxy, Nginx, PHP, MySQL:
![Alt text](https://github.com/webbag/movie-api/blob/master/_develop/docker-ps.png?raw=true "Docker containers")


##### Schema MySQL:
![Alt text](https://github.com/webbag/movie-api/blob/master/_develop/movie-api.png?raw=true "Model DB")


##### Routing:
![Alt text](https://github.com/webbag/movie-api/blob/master/_develop/routing.png?raw=true "Model DB")

### Install 
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

* Doctrine fixtures load

```
docker exec -it php php app/console doctrine:fixtures:load
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


#### Help commends Symfony: 

Generate entity by DB
``` 
docker exec -it php bin/console doctrine:mapping:import App\\Entity annotation --path=src/Entity
docker exec -it php bin/console make:entity --regenerate App
``` 

