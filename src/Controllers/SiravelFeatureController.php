<?php

namespace Sitec\Siravel\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Siravel;
use Sitec\Siravel\Models\Archive;

class SiravelFeatureController extends SiravelController
{
    function __construct()
    {
        $this->middleware('web');
    }

    public function sendHome()
    {
        return redirect('/');
    }

    /**
     * Rollback to a previous version of an entity, a specific moment.
     *
     * @param int $id
     *
     * @return Redirect
     */
    public function revert($id)
    {
        $archive = Archive::find($id);

        $model = app($archive->entity_type);
        $modelInstance = $model->find($archive->entity_id);

        $archiveData = (array) json_decode($archive->entity_data);

        $modelInstance->fill($archiveData);
        $modelInstance->save();

        Siravel::notification('Reversion was successful', 'success');

        return redirect(URL::previous());
    }

    /**
     * Rollback to a previous version of an entity.
     *
     * @param string $entity
     * @param int    $id
     *
     * @return Redirect
     */
    public function rollback($entity, $id)
    {
        $modelString = str_replace('_', '\\', $entity);

        if (!class_exists($modelString)) {
            Siravel::notification('Could not rollback Model not found', 'warning');

            return redirect(URL::previous());
        }

        $model = app($modelString);
        $modelInstance = $model->find($id);

        $archive = Archive::where('entity_id', $id)->where('entity_type', $modelString)->limit(1)->offset(1)->orderBy('id', 'desc')->first();

        if (!$archive) {
            Siravel::notification('Could not rollback', 'warning');

            return redirect(URL::previous());
        }
        $archiveData = (array) json_decode($archive->entity_data);

        $modelInstance->fill($archiveData);
        $modelInstance->save();

        Siravel::notification('Rollback was successful', 'success');

        return redirect(URL::previous());
    }

    /**
     * Preview content.
     *
     * @param string $entity
     * @param int    $id
     *
     * @return Response
     */
    public function preview($entity, $id)
    {
        $modelString = 'Sitec\Siravel\Models\\'.ucfirst($entity);

        if (!class_exists($modelString)) {
            $modelString = 'Sitec\Siravel\Models\\'.ucfirst($entity).'s';
        }

        $model = new $modelString();
        $modelInstance = $model->find($id);

        $data = [
            $entity => $modelInstance,
        ];

        if (request('lang') != config('siravel.default-language', Siravel::config('siravel.default-language'))) {
            if ($modelInstance->translation(request('lang'))) {
                $data = [
                    $entity => $modelInstance->translation(request('lang'))->data,
                ];
            }
        }

        $view = 'siravel-frontend::'.$entity.'.show';

        if (!View::exists($view)) {
            $view = 'siravel-frontend::'.$entity.'s.show';
        }

        if ($entity === 'page') {
            $view = 'siravel-frontend::pages.'.$modelInstance->template;
        }

        return view($view, $data);
    }

    /**
     * Set the default lanugage for the session.
     *
     * @param Request $request
     * @param string  $lang
     */
    public function setLanguage(Request $request, $lang)
    {
        $request->session()->put('language', $lang);
        return back();
    }
}
