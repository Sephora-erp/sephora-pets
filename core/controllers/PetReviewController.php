<?php

namespace App\modules\pets\core\controllers;

use App\Http\Controllers\Controller;
use App\modules\customers\core\models\Customer;
use App\modules\pets\core\models\Pet;
use App\modules\pets\core\models\PetReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Helpers\TriggerHelper;

class PetReviewController extends Controller {
    
    /*
     * This function returns the reviews for a specific pet
     */
    public static function fetchRevisions($fk_pet)
    {
        $reviews = PetReview::where('fk_pet', '=', $fk_pet)->get();
        return $reviews;
    }
}
