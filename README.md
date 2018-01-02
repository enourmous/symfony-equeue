symfony-equeue (Test Task)
==============
This project is test task for Stfalcon Company. 
Symfony version 4, storage used REDIS.

Add to host file
```
sudo echo '127.0.0.1 kenanduman.local' >> /etc/hosts
```

Docker run
```
docker-compose up -d
```
Build
```bash
$ docker-compose build
```
Containers
```
kenanduman-db
kenanduman-php # PHP
kenanduman-nginx #N ginx Web server
kenanduman-elk # Elasticsearch, Kibana
kenanduman-redis
```
Add new person to queue
```
http://kenanduman.local:8880/api/add/{PERSONNAME}
```
Get queue list
```
http://kenanduman.local:8880/api/list
```
Get last person
```
http://kenanduman.local:8880/api/last
```
Used
```
https://github.com/eko/docker-symfony
https://github.com/snc/SncRedisBundle
https://github.com/nrk/predis
```