<?php


namespace GriffonTech\User\Http\Controllers;


use GriffonTech\Property\Models\RentalOwnerProperty;

class RentalOwnerPropertiesController extends Controller
{

    public function destroy(RentalOwnerProperty $rentalOwnerProperty)
    {
        try {
            $rentalOwnerProperty->delete();
        } catch (\Exception $exception) {

        }
        return back();
    }

}
