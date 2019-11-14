**Instalation**

Data to sign in; u: admin, p: admin

First of all you need variables to .env
DB_PASS
DB_USER
DB_NAME

To run project use ./start.sh

To run test use ./bin/phpunit.sh

To fire symfony command use ./bin/php.sh ./bin/console command

To clean: docker stop $(docker --filter=name=simple-shop -q) && docker rm $(docker --filter=name=simple-shop -qa) 
docker rmi frontend_tools -f
or to clean all images docker rmi $(docker images -q) -f
