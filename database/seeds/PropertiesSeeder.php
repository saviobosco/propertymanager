<?php

use Illuminate\Database\Seeder;

class PropertiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // get the company id from first user
        $property = \GriffonTech\Property\Models\Property::create([
            'user_id' => 1,
            'property_type' => 1,
            'address_line1' => '10 Nnatu Str',
            'address_line2' => 'Ogoja Rd.',
            'address_line3' => 'Abakaliki',
            'city' => 'Abakaliki',
            'state' => 'EB',
            'zip_code' => '234',
            'country' => 'NGA',
            'company_id' => 1
        ]);

        if ($property) {
            // create property owner
            $propertyOwner = \GriffonTech\Property\Models\PropertyOwner::create([
                'first_name' => 'Nwafor',
                'last_name' => 'Kingsley',
                'company_name' => 'Skygrid Construction',
                'primary_email_address' => 'skygridconstruction@gmail.com',
                'alternate_email_address' => 'skygridconstruction2@gmail.com',
                'mobile_phone_number' => '08068865957',
                'home_phone_number' => '08118001659',
                'address_line1' => '10 Nnatu Street',
                'address_line2' => 'Ogoja Rd.',
                'address_line3' => 'Abakaliki',
                'city' => 'Abakaliki',
                'state' => 'EB',
                'zip_code' => '234',
                'country' => 'NGA',
                'agreement_start_date' => '2021-04-13',
                'company_id' => 1
            ]);

            \GriffonTech\Property\Models\RentalOwnerProperty::create([
                'property_id' => $property->id,
                'property_owner_id' => $propertyOwner->id,
                'ownership_percentage' => 100
            ]);

            \GriffonTech\Unit\Models\Unit::create([
                'property_id' => $property->id,
                'identifier' => 'FLAT 1',
                'market_rent' => '400000',
                'size' => 1200,
                'address_line1' => '10 Nnatu Street',
                'address_line2' => 'Ogoja Rd.',
                'address_line3' => 'Abakaliki',
                'city' => 'Abakaliki',
                'state' => 'EB',
                'zip_code' => '234',
                'country' => 'NGA',
                'room' => 3,
                'bath_room' => 4,
                'description' => 'In a choice location.',
                'features' => 'air conditioner'
            ]);

            \GriffonTech\Unit\Models\Unit::create([
                'property_id' => $property->id,
                'identifier' => 'FLAT 2',
                'market_rent' => '400000',
                'size' => 1200,
                'address_line1' => '10 Nnatu Street',
                'address_line2' => 'Ogoja Rd.',
                'address_line3' => 'Abakaliki',
                'city' => 'Abakaliki',
                'state' => 'EB',
                'zip_code' => '234',
                'country' => 'NGA',
                'room' => 3,
                'bath_room' => 4,
                'description' => 'In a choice location.',
                'features' => 'air conditioner'
            ]);
        }
    }
}
