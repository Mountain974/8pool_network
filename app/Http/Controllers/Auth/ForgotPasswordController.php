<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    |  Ce contrôleur est responsable du traitement des courriels de réinitialisation 
       de mot de passe et comprend un trait qui aide à envoyer ces notifications depuis 
       votre application à vos utilisateurs.
       Ce contrôleur est responsable de la gestion des courriels de réinitialisation de mot
       de passe. N'hésitez pas à explorer ce trait.
    |
    */

    use SendsPasswordResetEmails;
}
