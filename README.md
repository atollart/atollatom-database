# AtollAtom Database

Enable postgres connection with pgbouncer support.

```php
use AtollAtom\Database\Postgres\PostgresConnection;

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
