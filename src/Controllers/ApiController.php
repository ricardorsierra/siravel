<?php

namespace Sitec\Siravel\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;

class ApiController extends SiravelController
{
    protected $model;

    public function __construct(Request $request)
    {
        $this->modelName = str_singular($request->segment(3));
        if (!empty($this->modelName)) {
            $this->model = app('Sitec\Siravel\Models\\'.ucfirst($this->modelName));
        }
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function all()
    {
        $query = $this->model;

        if (Schema::hasColumn(str_plural($this->modelName), 'published_at')) {
            $query = $query->where('is_published', 1)
                ->where('published_at', '<=', Carbon::now()->format('Y-m-d h:i:s'));
        }

        return $query
            ->orderBy('created_at', 'desc')
            ->paginate(Config::get('siravel.pagination', 25));
    }

    public function search($term)
    {
        $query = $this->model->orderBy('created_at', 'desc');
        $query->where('id', 'LIKE', '%'.$input['term'].'%');

        $columns = Schema::getColumnListing(str_plural($this->modelName));

        foreach ($columns as $attribute) {
            $query->orWhere($attribute, 'LIKE', '%'.$input['term'].'%');
        }

        return [
            'term' => $input['term'],
            'result' => $query->paginate(Config::get('siravel.pagination', 25)),
        ];
    }
}
