<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Repositories\ContactRepository;
use Illuminate\Http\Request;
use App\Services\ContactService;

class ContactController extends Controller
{
    protected $contactRepository;
    protected $contactService;

    public function __construct(ContactRepository $contactRepository, ContactService $contactService)
    {
        $this->contactRepository = $contactRepository;
        $this->contactService = $contactService;
    }

    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);

        $updatedContact = $this->contactService->updateContact($contact, $request->all());

        return response()->json($updatedContact, 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'phones' => 'sometimes|array',
            'phones.*.phone_number' => 'required|string|max:15',
            'emails' => 'sometimes|array',
            'emails.*.email_address' => 'required|email|max:255',
            'addresses' => 'sometimes|array',
            'addresses.*.street' => 'required|string|max:255',
            'addresses.*.city' => 'required|string|max:255',
            'addresses.*.zipcode' => 'required|string|max:10',
        ]);

        $newContact = $this->contactService->createContact($validatedData);

        return response()->json($newContact, 201);
    }


    public function index()
    {
        return $this->contactRepository->getAllContacts();
    }

    public function show($id)
    {
        return $this->contactRepository->findContactById($id);
    }

    public function destroy($id)
    {
        $deletedContact = $this->contactRepository->deleteContact($id);
        return response()->json(['message' => 'Contact deleted successfully', 'contact' => $deletedContact], 200);
    }
}
