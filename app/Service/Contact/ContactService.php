<?php

namespace App\Service\Contact;

use App\Model\Contact;
use App\Repositories\ContactRepository;


class ContactService
{
    /**
     * @var ContactRepository
     */
    protected $contactRepository;

    /**
     * @param ContactRepository $contactRepository
     */
    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function index()
    {
        return $this->contactRepository->index();
    }

    public function create(array $data): Contact
    {
        return $this->contactRepository->create($data);
    }
}
