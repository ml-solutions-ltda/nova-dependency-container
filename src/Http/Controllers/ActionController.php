<?php

namespace MlSolutions\DependencyContainer\Http\Controllers;

use MlSolutions\DependencyContainer\ActionHasDependencies;
use MlSolutions\DependencyContainer\Http\Requests\ActionRequest;
use Laravel\Nova\Http\Requests\ActionRequest as NovaActionRequest;
use Laravel\Nova\Http\Controllers\ActionController as NovaActionController;

class ActionController extends NovaActionController
{
    /**
     * create custom request from base Nova ActionRequest
     *
     * @param  \Laravel\Nova\Http\Requests\ActionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NovaActionRequest $request): mixed
    {
        $action = $request->action();

        if (in_array(ActionHasDependencies::class, class_uses_recursive($action))) {
            $request = ActionRequest::createFrom($request);
        }

        return parent::store($request);
    }
}
