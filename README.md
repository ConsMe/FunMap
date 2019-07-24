# FunMap  

Local installation steps:  
- install docker and docker-compose  
- git clone https://github.com/ConsMe/FunMap.git  
- cd ./FunMap/laradock  
- docker-compose up -d nginx mysql  
- docker-compose exec --user=laradock  workspace bash  
- cp .env.example .env  
- php artisan key:generate  
- php artisan migrate  
- php artisan db:seed  
- go to http://localhost/ in your browser  
