<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', [App\Http\Controllers\Api\UserController::class, 'register']);
Route::post('/send-otp', [App\Http\Controllers\Api\UserController::class, 'send_otp']);
Route::post('/resend-otp', [App\Http\Controllers\Api\UserController::class, 'resend_otp']);
Route::post('/verify-otp', [App\Http\Controllers\Api\UserController::class, 'verify_otp']);
Route::post('/verify-email', [App\Http\Controllers\Api\UserController::class, 'verify_email']);
Route::get('/email-status/{id}/{email}', [App\Http\Controllers\Api\UserController::class, 'email_status']);
Route::post('/login', [App\Http\Controllers\Api\UserController::class, 'login']);

/** middleware */ 
Route::group(['middleware' => ['jwt.verify']], function() {
Route::post('/logout', [App\Http\Controllers\Api\UserController::class, 'logout']);
Route::post('/update-profile/{id}', [App\Http\Controllers\Api\UserController::class, 'update_profile']);
Route::post('/update-coach-profile/{id}', [App\Http\Controllers\Api\UserController::class, 'update_coach_profile']);
Route::get('/event-type-list', [App\Http\Controllers\Api\UserController::class, 'event_type_list']);

Route::get('/category-list', [App\Http\Controllers\SportCategoryController::class, 'category_list']);

Route::get('/match-type-list', [App\Http\Controllers\Api\UserController::class, 'match_type_list']);
Route::post('/team-player', [App\Http\Controllers\Api\UserController::class, 'team_player']);
Route::post('/group-player', [App\Http\Controllers\Api\UserController::class, 'group_player']);
Route::post('/coach-group', [App\Http\Controllers\Api\UserController::class, 'coach_group']);
Route::post('/passcode', [App\Http\Controllers\Api\UserController::class, 'passcode']);
Route::get('/coach-player/{id}', [App\Http\Controllers\Api\UserController::class, 'coach_player']); 
Route::get('/coach-event-player/{id}', [App\Http\Controllers\Api\UserController::class, 'coach_event_player']); 
Route::get('/profile-detail/{id}', [App\Http\Controllers\Api\UserController::class, 'profile_detail']); 
Route::post('/group-code', [App\Http\Controllers\Api\UserController::class, 'groupCode']);
Route::get('/passcode-list', [App\Http\Controllers\Api\UserController::class, 'passcodeList']);
Route::get('/notification-list', [App\Http\Controllers\Api\UserController::class, 'notification_list']);
Route::get('/notification-read/{id}', [App\Http\Controllers\Api\UserController::class, 'notification_read']);
Route::get('/club-notes-list', [App\Http\Controllers\Api\UserController::class, 'club_notes_list']);
Route::get('/club-notes-list-player', [App\Http\Controllers\Api\UserController::class, 'club_notes_list_player']); 

Route::get('/reason-list', [App\Http\Controllers\Api\ContactReasonController::class, 'reason_list']);
Route::post('/contact-reason', [App\Http\Controllers\Api\ContactReasonController::class, 'contact_reason']);

Route::post('/create-event', [App\Http\Controllers\Api\EventController::class, 'create_event']);
Route::get('/accept-invite/{id}', [App\Http\Controllers\Api\EventController::class, 'accept_invite']);
Route::get('/cancel-event/{id}', [App\Http\Controllers\Api\EventController::class, 'cancel_event']);
Route::get('/event-detail/{id}', [App\Http\Controllers\Api\EventController::class, 'event_detail']);
Route::post('/event-list', [App\Http\Controllers\Api\EventController::class, 'event_list']);
Route::post('/montly-event-list', [App\Http\Controllers\Api\EventController::class, 'montly_event_list']);
Route::post('/edit-event/{id}', [App\Http\Controllers\Api\EventController::class, 'edit_event']); 
Route::get('/event-player-list/{id}', [App\Http\Controllers\Api\EventController::class, 'event_player_list']); 
Route::get('/player-event-list/{page}', [App\Http\Controllers\Api\EventController::class, 'player_event_list']); 
Route::get('/player-event-detail/{id}', [App\Http\Controllers\Api\EventController::class, 'player_event_detail']); 
Route::post('/player-event-status', [App\Http\Controllers\Api\EventController::class, 'player_event_status']); 
Route::post('/message-notification', [App\Http\Controllers\Api\EventController::class, 'message_notification']); 

Route::post('/create-notes', [App\Http\Controllers\Api\NotesController::class, 'create_notes']); 
Route::post('/edit-notes/{id}', [App\Http\Controllers\Api\NotesController::class, 'edit_notes']); 
Route::get('/delete-notes/{id}', [App\Http\Controllers\Api\NotesController::class, 'delete_notes']); 
Route::get('/get-notes/{event_id}/{type_id}', [App\Http\Controllers\Api\NotesController::class, 'get_notes']); 

/**Team */
Route::get('/player-team-list', [App\Http\Controllers\Api\TeamController::class, 'playerTeamList']); 
Route::get('/coach-team-list', [App\Http\Controllers\Api\TeamController::class, 'coachTeamList']); 
Route::post('/join-team', [App\Http\Controllers\Api\TeamController::class, 'joinTeam']); 
Route::get('/team-detail/{id}', [App\Http\Controllers\Api\TeamController::class, 'teamDetail']); 

Route::get('/group-list', [App\Http\Controllers\Api\GroupController::class, 'list']); 
Route::get('/group-detail/{id}', [App\Http\Controllers\Api\GroupController::class, 'groupDetail']); 
Route::get('/team-list/{group_id}', [App\Http\Controllers\Api\GroupController::class, 'teamList']); 
Route::post('/player-list', [App\Http\Controllers\Api\GroupController::class, 'teamPlayer']); 
Route::get('/coach-event/{page}', [App\Http\Controllers\Api\GroupController::class, 'coach_event']); 
Route::get('/player-request/{group_id}', [App\Http\Controllers\Api\GroupController::class, 'groupPlayer']); 
Route::get('/coaches/{group_id}', [App\Http\Controllers\Api\GroupController::class, 'groupCoach']); 
Route::get('/player-detail/{id}', [App\Http\Controllers\Api\GroupController::class, 'playerDetail']); 
Route::get('/children-list', [App\Http\Controllers\Api\GroupController::class, 'childrenList']); 
});