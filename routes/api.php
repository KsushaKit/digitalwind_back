<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AgeGroupsController;
use App\Http\Controllers\ToursController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\JuriesController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\AttendeesController;
use App\Http\Controllers\NominationsController;
use App\Http\Controllers\NominationToursController;
use App\Http\Controllers\NominationJuriesController;
use App\Http\Controllers\CreationsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\CreationJuryController;
use App\Http\Controllers\RoundsController;

use Illuminate\Support\Facades\Route;


Route::middleware('auth:api')->group(function () {
    // защищенные маршруты
});

//-----------News------------------------------------------------------------------------------//
Route::group(['prefix' => 'news'], function () {
    Route::get('/', [NewsController::class, 'index']);
    Route::get('/last', [NewsController::class, 'last']);
    Route::post('/', [NewsController::class, 'store']);
    Route::get('/{id}', [NewsController::class, 'show']);
    Route::put('/{id}', [NewsController::class, 'update']);
    Route::delete('/{id}', [NewsController::class, 'destroy']);
});

//-----------Events----------------------------------------------------------------------------//
Route::group(['prefix' => 'events'], function () {
    Route::get('/', [EventController::class, 'index']);
    Route::post('/', [EventController::class, 'store']);
    Route::get('/{id}', [EventController::class, 'show']);
    Route::delete('/{id}', [EventController::class, 'destroy']);
});

//-----------AgeGroups------------------------------------------------------------------------------//

Route::group(['prefix' => 'ageGroups'], function () {
    Route::get('/', [AgeGroupsController::class, 'index']);
    Route::post('/', [AgeGroupsController::class, 'store']);
    Route::get('/{id}', [AgeGroupsController::class, 'show']);
    Route::put('/{id}', [AgeGroupsController::class, 'update']);
    Route::delete('/{id}', [AgeGroupsController::class, 'destroy']);
});

//-----------Tours------------------------------------------------------------------------------//

Route::group(['prefix' => 'tours'], function () {
    Route::get('/', [ToursController::class, 'index']);
    Route::post('/', [ToursController::class, 'store']);
    Route::get('/{id}', [ToursController::class, 'show']);
    Route::put('/{id}', [ToursController::class, 'update']);
    Route::delete('/{id}', [ToursController::class, 'destroy']);
});

//-----------Users------------------------------------------------------------------------------//

Route::group(['prefix' => 'users'], function () {
    Route::get('/', [UsersController::class, 'index']);
    Route::post('/', [UsersController::class, 'store']);
    Route::get('/{id}', [UsersController::class, 'show']);
    Route::put('/{id}', [UsersController::class, 'update']);
    Route::delete('/{id}', [UsersController::class, 'destroy']);
});

//-----------Juries------------------------------------------------------------------------------//

Route::group(['prefix' => 'juries'], function () {
    Route::get('/', [JuriesController::class, 'index']);
    Route::get('/creations/age/{juryID}/{ageGroupID}/{limit}', [JuriesController::class, 'getCreations4']);
    Route::get('/creations/nominations/{juryID}/{nominationID}/{limit}', [JuriesController::class, 'getCreations3']);
    Route::get('/creations/{juryID}/{limit}', [JuriesController::class, 'getCreations']);
    Route::get('/creations/{juryID}/{nominationID}/{ageGroupID}/{limit}', [JuriesController::class, 'getCreations2']);
    Route::get('/user/{userID}', [JuriesController::class, 'getJuryByUser']);
    Route::post('/', [JuriesController::class, 'store']);
    Route::get('/{id}', [JuriesController::class, 'show']);
    Route::put('/{id}', [JuriesController::class, 'update']);
    Route::put('/nta/{id}', [JuriesController::class, 'updateJuryFields']);
    Route::delete('/{id}', [JuriesController::class, 'destroy']);
});

//-----------Admins------------------------------------------------------------------------------//

Route::group(['prefix' => 'admins'], function () {
    Route::get('/', [AdminsController::class, 'index']);
    Route::get('/user/{userID}', [AdminsController::class, 'getAdminByUser']);
    Route::post('/', [AdminsController::class, 'store']);
    Route::get('/{id}', [AdminsController::class, 'show']);
    Route::put('/{id}', [AdminsController::class, 'update']);
    Route::delete('/{id}', [AdminsController::class, 'destroy']);
});

//-----------Attendees------------------------------------------------------------------------------//

Route::group(['prefix' => 'attendees'], function () {
    Route::get('/', [AttendeesController::class, 'index']);
    Route::get('/user2/{userID}', [AttendeesController::class, 'getAttendeeByUser']);
    Route::get('/user/{attendeeID}', [AttendeesController::class, 'getUserByAttendee']);
    Route::post('/', [AttendeesController::class, 'store']);
    Route::get('/{id}', [AttendeesController::class, 'show']);
    Route::put('/{id}', [AttendeesController::class, 'update']);
    Route::delete('/{id}', [AttendeesController::class, 'destroy']);
});

//-----------Nominations------------------------------------------------------------------------------//

Route::group(['prefix' => 'nominations'], function () {
    Route::get('/', [NominationsController::class, 'index']);
    Route::post('/', [NominationsController::class, 'store']);
    Route::get('/{id}', [NominationsController::class, 'show']);
    Route::put('/{id}', [NominationsController::class, 'update']);
    Route::delete('/{id}', [NominationsController::class, 'destroy']);
});

//-----------NominationTours------------------------------------------------------------------------------//

Route::group(['prefix' => 'nominationTours'], function () {
    Route::get('/', [NominationToursController::class, 'index']);
    Route::post('/', [NominationToursController::class, 'store']);
    Route::get('/{id}', [NominationToursController::class, 'show']);
    Route::put('/{id}', [NominationToursController::class, 'update']);
    Route::delete('/{id}', [NominationToursController::class, 'destroy']);
});

//-----------NominationJuries------------------------------------------------------------------------------//

Route::group(['prefix' => 'nominationJuries'], function () {
    Route::get('/', [NominationJuriesController::class, 'index']);
    Route::post('/', [NominationJuriesController::class, 'store']);
    Route::get('/{id}', [NominationJuriesController::class, 'show']);
    Route::put('/{id}', [NominationJuriesController::class, 'update']);
    Route::delete('/{id}', [NominationJuriesController::class, 'destroy']);
});

//-----------Creations------------------------------------------------------------------------------//

Route::group(['prefix' => 'creations'], function () {
    Route::get('/', [CreationsController::class, 'index']);
    Route::post('/many', [CreationsController::class, 'getCreations']);
    Route::get('/download/{filename}', [CreationsController::class, 'download']);
    Route::get('/byn/{nominationId}', [CreationsController::class, 'getCreationsByNomination']);
    Route::get('/byaan/{ageGroupId}/{nominationId}', [CreationsController::class, 'getCreationsByAgeGroupAndNomination']);
    Route::get('/mycreations/{attendeeID}', [CreationsController::class, 'getCreationsByAttendeeID']);
    Route::get('/mycreation/{attendeeID}/{creationID}', [CreationsController::class, 'getCreationByAttendeeIDCreationID']);
    Route::get('/files/{creationID}', [CreationsController::class, 'getFile']);
    Route::post('/', [CreationsController::class, 'store']);
    Route::get('/{id}', [CreationsController::class, 'show']);
    Route::put('/updateAllcreations', [CreationsController::class, 'updateAllcreations']);
    Route::put('/{id}', [CreationsController::class, 'update']);
    Route::delete('/{id}', [CreationsController::class, 'destroy']);
});

//-----------Comments------------------------------------------------------------------------------//

Route::group(['prefix' => 'comments'], function () {
    Route::get('/', [CommentsController::class, 'index']);
    Route::get('/cbc/{creationId}', [CommentsController::class, 'getCommentsByCreationId']);
    Route::post('/', [CommentsController::class, 'store']);
    Route::get('/{id}', [CommentsController::class, 'show']);
    Route::put('/{id}', [CommentsController::class, 'update']);
    Route::delete('/{id}', [CommentsController::class, 'destroy']);
});

//-----------CreationJury------------------------------------------------------------------------------//

Route::group(['prefix' => 'creationjury'], function () {
    Route::get('/', [CreationJuryController::class, 'index']);
    Route::get('/forjury/{juryId}', [CreationJuryController::class, 'getByJury']);
    Route::post('/', [CreationJuryController::class, 'store']);
    Route::get('/{id}', [CreationJuryController::class, 'show']);
    Route::put('/updatescore', [CreationJuryController::class, 'updateAllcreations']);
    Route::post('/creatsecore', [CreationJuryController::class, 'createAllcreations']);
    Route::put('/{id}', [CreationJuryController::class, 'update']);
    Route::delete('/{id}', [CreationJuryController::class, 'destroy']);
});

//-----------Rounds------------------------------------------------------------------------------//

Route::group(['prefix' => 'rounds'], function () {
    Route::get('/', [RoundsController::class, 'index']);
    Route::post('/', [RoundsController::class, 'store']);
    Route::get('/{id}', [RoundsController::class, 'show']);
    Route::put('/{id}', [RoundsController::class, 'update']);
    Route::delete('/{id}', [RoundsController::class, 'destroy']);
});

//-----------Login------------------------------------------------------------------------------//

Route::post('/login', 'LoginController');

//-----------Registrate------------------------------------------------------------------------------//

Route::group(['prefix' => 'registrate'], function () {
    Route::post('/jury', [JuriesController::class, 'registrate']);
    Route::post('/attendee', [AttendeesController::class, 'registrate']);
    Route::post('/admin', [AdminsController::class, 'registrate']);
});



