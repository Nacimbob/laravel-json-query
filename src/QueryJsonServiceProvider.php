<?php

namespace QueryJson;
 
use Illuminate\Support\ServiceProvider;

class QueryJsonServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        $this->app[QueryJsonManager::class]->extendQueryBuilder();
    }
}
