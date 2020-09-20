# Employee Blog

Employee blog is a simple blog application based on lumen microframe work of laravel.

## Setup
First of all clone the application from github

```bash
git clone https://github.com/otim22/employee_blog.git
```
Enter into the directory

```bash
cd employee_blog
```

Ensure you have composer install on your terminal, then install application dependencies by run the following commad

```bash
composer install
```

Set JWT

```bash
php artisan jwt:secret
```

After then run migrations

```bash
php artisan migrate
```

Lastly, you start the application which gets served to port 8000 and can start playing around with the application.

```bash
php -S localhost:8000 -t public
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://opensource.org/licenses/MIT)
