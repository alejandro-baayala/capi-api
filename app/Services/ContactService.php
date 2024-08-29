<?php

namespace App\Services;

use App\Models\Contact;
use App\Models\Phone;
use App\Models\Email;
use App\Models\Address;

class ContactService
{
    public function createContact(array $data)
    {
        $contact = Contact::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
        ]);

        if (isset($data['phones'])) {
            $contact->phones()->createMany($data['phones']);
        }

        if (isset($data['emails'])) {
            $contact->emails()->createMany($data['emails']);
        }

        if (isset($data['addresses'])) {
            $contact->addresses()->createMany($data['addresses']);
        }

        return $contact->load(['phones', 'emails', 'addresses']);
    }

    public function updateContact(Contact $contact, array $data)
    {
        // Actualizar los datos principales del contacto
        $contact->update([
            'name' => $data['name'],
            'surname' => $data['surname'],
        ]);

        // Actualizar teléfonos
        if (isset($data['phones'])) {
            // Eliminar los teléfonos existentes
            $contact->phones()->delete();
            // Crear los nuevos teléfonos
            $contact->phones()->createMany($data['phones']);
        }

        // Actualizar correos electrónicos
        if (isset($data['emails'])) {
            // Eliminar los correos electrónicos existentes
            $contact->emails()->delete();
            // Crear los nuevos correos electrónicos
            $contact->emails()->createMany($data['emails']);
        }

        // Actualizar direcciones
        if (isset($data['addresses'])) {
            // Eliminar las direcciones existentes
            $contact->addresses()->delete();
            // Crear las nuevas direcciones
            $contact->addresses()->createMany($data['addresses']);
        }

        // Retornar el contacto actualizado con sus relaciones
        return $contact->load(['phones', 'emails', 'addresses']);
    }
}
