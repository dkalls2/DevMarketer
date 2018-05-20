<?php
namespace App\Observers;
    // We want the API token to be generated without us having to worry about creating it for each user.
    // We want the token to be automatically generated when we create a new user using Observers.
    // Observers watch the model and when certain events get triggered, the observer will take over control of the model, manipulate the model, and then pass it back to the model.
    // The Observer we will create below iwll manage our api token for us. 
    // Observers tie to models.  You create one for the model you want to observe.
    // Documentation for the template here is found: https://laravel.com/docs/5.6/eloquent#observers

    //In order to get this Observer set up, we need to set this up in our service providers.  We need to create a srevice provider to tie the service provider to the model.
    //we will make the service provider by typing "php artisan make:provider ObserverServiceProvider" 
    //we also need to go in config.app and set up this new provider there.

    //finally, we need to test it by going into routes and api.php and we can create an api route.  There is already one there by default that we can use.
    //we can use a REST HTTP client, Insomnia (https://insomnia.rest/download/#windows), to test this.  
    //we can send a request to this /api/user using Insomnia.

use App\User;

class UserObserver
{
    /**
     * Listen to the User creating event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function creating(User $user)
    {
        //the created event triggers after the model has been saved into the database.  We want the observer to intervene before it gets saved into the database.
        //we want to manipulate the model before it gets saved into the database because we want to add that api token.
        //therefore, we want to work with the "creating" event. The creating event is triggered right before it is saved into the database. 
        //The observer will jump in, manipulate the model, add that API token, step back away and let the save continue to run.
        $user->api_token = bin2hex(openssl_random_pseudo_bytes(30));
    }

    // We don't need the deleting event for this application./**
    //  * Listen to the User deleting event.
    //  *
    //  * @param  \App\User  $user
    //  * @return void
    //  */
    // public function deleting(User $user)
    // {
    //     //
    // }
}