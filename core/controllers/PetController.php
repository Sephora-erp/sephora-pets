<?php

namespace App\modules\pets\core\controllers;

use App\Http\Controllers\Controller;
use App\modules\customers\core\models\Customer;
use App\modules\pets\core\models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Helpers\TriggerHelper;

class PetController extends Controller {
    /*
     * Get's the pets for a customer
     */

    public static function fetchPets($fk_client) {
        //Fetch the pets for this client
        $pets = Pet::where('fk_client', '=', $fk_client)->get();
        return $pets;
    }

    /*
     * Renders the hook instance for the pet widget
     */

    public static function drawCustomerBox($object) {
        view()->addLocation(app_path() . '/modules/pets/core/views');
        return view('customerpet', ['customer' => $object]);
    }

    /*
     * Creates the pet entry for the client
     */

    public function actionCreate(Request $request) {
        $data = $request->all();
        $pet = new Pet;
        //Set the data
        $pet->name = $data['name'];
        $pet->fk_user = \Auth::user()->id;
        $pet->fk_client = $data['fk_client'];
        $pet->description = $data['description'];
        $pet->observations = $data['observations'];
        $pet->birthdate = $data['birthdate'];
        $pet->type = $data['type'];
        //Save
        if ($pet->save)
            echo 'ok';
    }

}
