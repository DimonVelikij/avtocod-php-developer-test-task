Для разворачивания проекта выполнить следующие дейсвия:

1) переходим в каталог где будет располагаться проект
2) выполняем git clone https://github.com/DimonVelikij/avtocod-php-developer-test-task.git .
3) в файл .env прописываем значения для переменных окружения
    APP_ENV=local
    APP_DEBUG=true
    APP_URL=http://localhost
    
    BROADCAST_DRIVER=log
    QUEUE_DRIVER=sync
    
    REDIS_HOST=127.0.0.1
    REDIS_PASSWORD=null
    REDIS_PORT=6379
    
    DB_CONNECTION=pgsql
    DB_HOST=db
    DB_PORT=5432
    DB_DATABASE=по желанию
    DB_USERNAME=по желанию
    DB_PASSWORD=по желанию
    
    APP_PATH_HOST=каталог, где находить проекта на хоте
    APP_PATH_CONTAINER=каталог, где будет находиться проект в контейнере
    
4) выполняем docker-compose up --build
5) заходим в контейнер php: docker-compose exec php bash, сразу попадаем в каталог где находится проект
6) выполняем composer install
7) убеждаемся что приложение развернулось php artisan
8) накатываем миграции php artisan migrate
9) открываем в браузере http://0.0.0.0:8080/
