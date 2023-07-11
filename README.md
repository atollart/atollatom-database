# AtollAtom Database

Enable postgres connection with pgbouncer support

```php
<?php

namespace App\Providers;

use AtollAtom\Database\Postgres\PostgresConnection;
use Illuminate\Database\Connection;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        Connection::resolverFor("pgsql", function ($connection, $database, $prefix, $config) {
            return new PostgresConnection($connection, $database, $prefix, $config);
        });
    }
}
```

Database connection config

```
"options" => [
    PDO::ATTR_EMULATE_PREPARES => true,
],
```
