<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;
use App\Models\Phone;
use App\Models\Email;
use App\Models\Address;
use Faker\Factory as Faker;

class ContactSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i < 5000; $i++) {
            $contact = Contact::create([
                'name' => $faker->firstName,
                'surname' => $faker->lastName,
            ]);

            // Create phones
            for ($j = 0; $j < mt_rand(1, 3); $j++) {
                Phone::create([
                    'contact_id' => $contact->id,
                    'phone_number' => $faker->phoneNumber,
                ]);
            }

            // Create emails
            for ($j = 0; $j < mt_rand(1, 3); $j++) {
                Email::create([
                    'contact_id' => $contact->id,
                    'email_address' => $faker->email,
                ]);
            }

            // Create addresses
            for ($j = 0; $j < mt_rand(1, 2); $j++) {
                Address::create([
                    'contact_id' => $contact->id,
                    'city' => $faker->city,
                    'street' => $faker->streetAddress,
                    'zipcode' => $faker->postcode,
                ]);
            }
        }
    }
}
