<?php

namespace WebCrafters\LaravelDoctrineForm;

class LaravelDoctrineFormServiceProvider extends HtmlServiceProvider
{

    /**
     * Registering form builder override
     */
    protected function registerFormBuilder()
    {
        $this->app->singleton('form', function ($app) {
            $form = new DoctrineFormBuilder($app['html'], $app['url'], $app['view'], $app['session.store']->token(), $app['request']);

            return $form->setSessionStore($app['session.store']);
        });
    }
}
