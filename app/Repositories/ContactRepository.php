<?php

namespace App\Repositories;

use App\Model\Contact;

class ContactRepository
{
    public $model;

    public function __construct()
    {
        $this->model = new Contact();
    }

    public function index()
    {
        return $this->model::all();
    }

    public function create($data): Contact
    {
        return $this->model->store($data);
    }
}
