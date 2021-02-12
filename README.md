# Parser example

This application is the task for example of parsing entities.
Some kinds of design patterns are implemented. For example DDD and CQRS.

## Environment installation


```bash
cd docker
docker-compose up -d
```

## Application installation

```php
composer install
php bin/console app:create:site rbc
php bin/console app:parse:articles rbc
```

## Demonstration
Look at the url http://127.0.0.1:81

## License
[MIT](https://choosealicense.com/licenses/mit/)
