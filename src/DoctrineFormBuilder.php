<?php

namespace WebCrafters\LaravelDoctrineForm;

use Collective\Html\FormBuilder;

class DoctrineFormBuilder extends FormBuilder
{
    /**
     * Get the model value that should be assigned to the field.
     * If there is any Doctrine Getter, use it instead of native Eloquent
     *
     * @param  string $name
     *
     * @return mixed
     */
    protected function getModelValueAttribute($name)
    {
        $key = $this->transformKey($name);

        if (method_exists($this->model, 'getFormValue')) {
            return $this->model->getFormValue($key);
        }

        $doctrineGetter = 'get' . ucfirst($key);

        if (method_exists($this->model, $doctrineGetter)) {
            return call_user_func([$this->model, $doctrineGetter]);
        }

        return data_get($this->model, $this->transformKey($name));
    }
}
