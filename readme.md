Demo App for Edubookers
=================

To be able to run this app follow instructions below.

## 1. Install Docker

First of all, install [Docker Compose](https://docs.docker.com/compose/install/). Once it'll be done, double check if everything went smoothly:

 ```sh
 $ docker-compose --version
 # Start docker machine
 $ docker-machine start
 ```
## 2. Build & Run Images

Make sure you're in root dir and then just copy & paste a following command:

```sh
 $ docker-compose build
```
This will download all required docker images (Postgresql, Elasticsearch, Apache2 + php7), be patient, it might take some time. 

```sh
 # Run all containers
 $ docker-compose up -d
 # Make sure that all up and running
 $ docker-compose ps
```
## 3. Install dependencies

```sh
 $ docker-compose exec apache composer install --no-dev -o 
```

## 4. Update Environment vars

```sh 
 # Get IP address of your virt machine
 $ docker-machine ip
```

In the root you'll find a file `.env` replace an ip address to yours, in my case it was `192.168.99.100`. 
Finally run Laravel's migration command, it'll create an appropriate table/index in Postgresql & Elasticsearch respectively.                                                 

```sh
 $ docker-compose exec apache php artisan migrate
```

Open your browser by entering your virt machine ip address, like `http://192.168.99.100` that it. I hope you like it ;-)