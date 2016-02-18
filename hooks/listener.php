<?php

use App\modules\pets\core\controllers\PetController;

class petsHook{
    
    /*
     * This function is called when the hook is fired
     * 
     * @param {String} $action - The action name to fire
     * @param {Object} $object - The data to pass to the hook
     */
    public function fireEvent($action, $object){
        if($action == 'headerCss'){
            echo '<link rel="stylesheet" href="'.URL::to('/').'/../app/modules/pets/public/pets.css">';
        }
        //Show the new box below the customers
        if($action == 'afterCustomer'){
            echo PetController::drawCustomerBox($object);
            //include_once app_path() . '/modules/pets/core/views/customerpet.blade.php';
        }
    }
}