<?php

namespace App\Providers;

use App\Component\Queue\Rabbitmq;
use App\Services\Interfaces\IUserService;
use App\Services\UserService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $singletons = [
        IUserService::class => UserService::class,
    ];


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton('Rabbitmq', function ($app) {
            return new Rabbitmq(config('queue.connections.rabbitmq'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->environment() == 'local') {
            DB::listen(
                function ($sql) {
                    foreach ($sql->bindings as $i => $binding) {
                        if ($binding instanceof \DateTime) {
                            $sql->bindings[$i] = $binding->format('\'Y-m-d H:i:s\'');
                        } else {
                            if (is_string($binding)) {
                                $sql->bindings[$i] = "'$binding'";
                            }
                        }
                    }

                    // Insert bindings into query
                    $query = str_replace(array('%', '?'), array('%%', '%s'), $sql->sql);

                    $query = vsprintf($query, $sql->bindings);

                    // Save the query to file
                    $logFile = fopen(
                        storage_path('logs'.DIRECTORY_SEPARATOR.date('Y-m-d').'_query.log'),
                        'a+'
                    );
                    fwrite($logFile, date('Y-m-d H:i:s').': '.$query.PHP_EOL);
                    fclose($logFile);
                }
            );
        }
    }
}
