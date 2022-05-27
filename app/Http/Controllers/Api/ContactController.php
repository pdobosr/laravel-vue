<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Contacts\StoreContactRequest;
use App\Service\Contact\ContactService;

class ContactController extends BaseApiController
{
    public function index(ContactService $contactService)
    {
        return self::_index($contactService);
    }

    public function store(StoreContactRequest $request, ContactService $contactService): \Illuminate\Http\JsonResponse
    {
        return self::_store($request, $contactService);
    }
}
