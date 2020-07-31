### Pokemon search with Lumen Api + React front
----------------------------------------------------------------------------

This is a simple project for a test.

### Getting Started
----------------------------------------------------------------------------

#### Requirements
```
PHP >= 7.2
OpenSSL PHP Extension
PDO PHP Extension
Mbstring PHP Extension
composer (https://getcomposer.org/download/)
nodejs (https://nodejs.org/en/)
```

#### Installing dependencies

```php
composer install
npm install
```

#### Copy configuration .env
```php
cp .env.example .env
```

#### Compile frontend (Make sure REACT_APP_API_URL is set)
```php
npm run build
```

#### Executing the app
Run with php development server
```php
php -S localhost:8000 -t public
```

To run with nginx this is a configuration example
```
server {
    listen 80 default_server;
    listen [::]:80 default_server;

    # Set Path to public folder
    root /var/www/poke-search/public;

    # Add index.php to the list if you are using PHP
    index index.php index.html index.htm index.nginx-debian.html;

    server_name _;

    location / {
            try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
            fastcgi_split_path_info ^(.+\.php)(/.+)$;
            # Set Path to php fpm sock
            fastcgi_pass unix:/var/run/php/php7.3-fpm.sock;
            fastcgi_index index.php;
            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
            include fastcgi_params;
    }
}
```

### Unit Testing
----------------------------------------------------------------------------
To run tests:
```shell
./vendor/bin/phpunit
```

### Static Analysis (https://phpstan.org/)
----------------------------------------------------------------------------
To run static analysis:
```shell
./vendor/bin/phpstan analyze app
```
