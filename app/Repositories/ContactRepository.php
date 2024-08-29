<?php

namespace App\Repositories;

use App\Models\Contact;

class ContactRepository
{
    public function getAllContacts($pagination = 50)
    {
        return Contact::with(['phones', 'emails', 'addresses'])->paginate($pagination);
    }

    public function findContactById($id)
    {
        return Contact::with(['phones', 'emails', 'addresses'])->findOrFail($id);
    }

    public function deleteContact($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return $contact;
    }
}
