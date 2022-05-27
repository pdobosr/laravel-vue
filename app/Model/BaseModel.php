<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected $model;
    protected $fields = [];

    public function __construct($model, $fields)
    {
        parent::__construct();

        $this->model = $model;
        $this->fields = $fields;
    }

    public function store($data)
    {
        $model = new $this->model();

        return $this->modelSave($model, $data);
    }

    public function edit($model, $data)
    {
        return $this->modelSave($model, $data);
    }

    public function modelSave($model, $data)
    {
        foreach($data as $key => $value) {
            if (array_search($key, $this->fields) !== false) {
                $model[$key] = $value;
            }
        }
        $model->save();

        return $model;
    }
}
