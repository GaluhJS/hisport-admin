<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Abilities
    Route::apiResource('abilities', 'AbilitiesController', ['only' => ['index']]);

    // Locales
    Route::get('locales/languages', 'LocalesController@languages')->name('locales.languages');
    Route::get('locales/messages', 'LocalesController@messages')->name('locales.messages');

    // Permissions
    Route::resource('permissions', 'PermissionsApiController');

    // Roles
    Route::resource('roles', 'RolesApiController');

    // Users
    Route::resource('users', 'UsersApiController');

    // Hi Games
    Route::post('hi-games/media', 'HiGameApiController@storeMedia')->name('hi-games.storeMedia');
    Route::resource('hi-games', 'HiGameApiController');

    // Hi Venues
    Route::post('hi-venues/media', 'HiVenueApiController@storeMedia')->name('hi-venues.storeMedia');
    Route::resource('hi-venues', 'HiVenueApiController');

    // Hi Events
    Route::post('hi-events/media', 'HiEventApiController@storeMedia')->name('hi-events.storeMedia');
    Route::resource('hi-events', 'HiEventApiController');

    // Hi Event Infos
    Route::resource('hi-event-infos', 'HiEventInfosApiController');
});
