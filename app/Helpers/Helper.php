<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class Helper {

        public static function getProfile() {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Load the 'roles' relationship for the authenticated user
            $user = Auth::user();
            $user->load('roles'); // Load the roles relationship
            return $user;
        }

        return null; // Return null if the user is not authenticated
    }
        

}
