#PBKDF2 package for Laravel 4#

##Installing instructions##

Put a new service provider:

```
'Vjroby\LaravelPbkdf2\LaravelPbkdf2ServiceProvider'
```

and the alias


```
'Pbkdf2'		=> 'Vjroby\LaravelPbkdf2\Facades\Pbkdf2Facade'
```

in the ``` app.php ```.

There are 3 methods that can be used:


```
Pbkdf2::safeEquals($string1, $string2)
```

```
Pbkdf2::createSalt()
```

```
Pbkdf2::createHash('test',$salt)
```

For changing the configuration:

```
php artisan config:publish vjroby/laravel-pbkdf2
```