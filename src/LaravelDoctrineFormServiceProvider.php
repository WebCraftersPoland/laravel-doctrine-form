<?php

namespace WebCrafters\LaravelDoctrineForm;


use Collective\Html\HtmlServiceProvider;
use Illuminate\Foundation\Application;
use Illuminate\Support\Str;
use Illuminate\View\Compilers\BladeCompiler;

class LaravelDoctrineFormServiceProvider extends HtmlServiceProvider
{

    protected function registerFormBuilder()
    {
        $this->app->singleton('form', function ($app) {
            $form = new DoctrineFormBuilder($app['html'], $app['url'], $app['view'], $app['session.store']->token(), $app['request']);

            return $form->setSessionStore($app['session.store']);
        });
    }
}