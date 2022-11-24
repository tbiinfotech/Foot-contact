<?php

use App\Models\ClubInfo;
use App\Models\CoachPasscodePlayer;
use App\Models\SportCategory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('auth.login');
// });


Route::get('/', [
    'uses' => 'App\Http\Controllers\UserController@index'
]);
// Route::post('/login', [
//     'uses'=>'App\Http\Controllers\UserController@login'
// ]);
Route::get('/home', [App\Http\Controllers\UserController::class, 'verify'])->name('verify');
Route::get('/reset/{token}', [App\Http\Controllers\UserController::class, 'reset'])->name('reset');
Route::get('/reset-email', [App\Http\Controllers\UserController::class, 'resetEmail'])->name('resetEmail');
Route::post('/sendLink', [App\Http\Controllers\UserController::class, 'sendLink'])->name('sendLink');

Route::post('/updatePassword', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('updatePassword');

Route::post('/verification', [App\Http\Controllers\UserController::class, 'verification'])->name('verification');
Auth::routes();
Route::get('/logout-user', [App\Http\Controllers\HomeController::class, 'logoutUser'])->name('logout-user');
Route::group(['middleware' => ['role', 'prevent-back-history']], function () {
    Route::post('/save-token', [App\Http\Controllers\FCMController::class, 'index'])->name('index');
    Route::get('/chat-home', [App\Http\Controllers\FCMController::class, 'home'])->name('home');

    Route::get('/chat-firebase', [App\Http\Controllers\FirebaseController::class, 'chat'])->name('chat');
    Route::get('/chat', [App\Http\Controllers\HomeController::class, 'chat'])->name('chat');
    Route::get('/send-push-notification', [App\Http\Controllers\HomeController::class, 'sendPushNotification'])->name('send.push-notification');
    Route::get('/save-push-notification-token', [App\Http\Controllers\HomeController::class, 'savePushNotificationToken'])->name('save-push-notification-token');
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/edit-profile', [App\Http\Controllers\HomeController::class, 'edit_profile'])->name('edit-profile');
    Route::get('/change-password', [App\Http\Controllers\HomeController::class, 'change_password'])->name('change-password');
    Route::post('/update-password', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('update-password');

    Route::post('/update/{id}', [App\Http\Controllers\HomeController::class, 'update'])->name('update');
    Route::get('/event-reminder', [App\Http\Controllers\HomeController::class, 'event_reminder'])->name('event-reminder');
    Route::get('/event-reminder-before', [App\Http\Controllers\HomeController::class, 'event_reminder_before'])->name('event-reminder-before');
    //Sport Category
    Route::get('/sport-category-index', [App\Http\Controllers\SportCategoryController::class, 'index']);
    Route::get('/sport-category-add', function () {
        return view('sportCategory.add');
    });
    Route::post('/sport-category-add', [App\Http\Controllers\SportCategoryController::class, 'add'])->name('sport-category-add');
    Route::get('/sport-category-edit', [App\Http\Controllers\SportCategoryController::class, 'edit'])->name('sport-category-edit');
    Route::post('/sport-category-update/{id}', [App\Http\Controllers\SportCategoryController::class, 'update'])->name('sport-category-update');
    Route::get('/sport-category-delete', [App\Http\Controllers\SportCategoryController::class, 'delete'])->name('sport-category-delete');
    Route::get('/sport-category-notdelete', [App\Http\Controllers\SportCategoryController::class, 'notdelete'])->name('sport-category-notdelete');
    Route::get('/sport-category-view', [App\Http\Controllers\SportCategoryController::class, 'view'])->name('sport-category-view');
    Route::get('/sport-category-export', [App\Http\Controllers\SportCategoryController::class, 'export'])->name('sport-category-export');
    Route::post('/sport-category-import', [App\Http\Controllers\SportCategoryController::class, 'import'])->name('sport-category-import');
    Route::get('/sport-category-input', [App\Http\Controllers\SportCategoryController::class, 'input'])->name('sport-category-input');

    //Event
    Route::get('/event-index', [App\Http\Controllers\EventController::class, 'index']);
    Route::get('/event-add', [App\Http\Controllers\EventController::class, 'add'])->name('event-add');
    Route::get('/event-player/{id}', [App\Http\Controllers\EventController::class, 'event_player'])->name('event-player');
    Route::post('/add-player', [App\Http\Controllers\EventController::class, 'add_player'])->name('add-player');
    Route::post('/event-create', [App\Http\Controllers\EventController::class, 'create'])->name('event-create');
    Route::get('/event-edit', [App\Http\Controllers\EventController::class, 'edit'])->name('event-edit');
    Route::post('/event-update/{id}', [App\Http\Controllers\EventController::class, 'update'])->name('event-update');
    Route::get('/event-delete', [App\Http\Controllers\EventController::class, 'delete'])->name('event-delete');
    Route::get('/event-view', [App\Http\Controllers\EventController::class, 'view'])->name('event-view');
    Route::get('/event-export', [App\Http\Controllers\EventController::class, 'export'])->name('event-export');

    //Contact Reason
    Route::get('/contact-reason-index', [App\Http\Controllers\ContactReasonController::class, 'index']);
    Route::get('/contact-reason-add', function () {
        return view('contactReason.add');
    });
    Route::post('/contact-reason-add', [App\Http\Controllers\ContactReasonController::class, 'add'])->name('contact-reason-add');
    Route::get('/contact-reason-edit', [App\Http\Controllers\ContactReasonController::class, 'edit'])->name('contact-reason-edit');
    Route::post('/contact-reason-update/{id}', [App\Http\Controllers\ContactReasonController::class, 'update'])->name('contact-reason-update');
    Route::get('/contact-reason-delete', [App\Http\Controllers\ContactReasonController::class, 'delete'])->name('contact-reason-delete');
    Route::post('/send-mail', [App\Http\Controllers\ContactReasonController::class, 'send_mail'])->name('send-mail');

    //Contact Us
    Route::get('/contact-us-index', [App\Http\Controllers\ContactUsController::class, 'index']);
    Route::get('/contact-us-create', [App\Http\Controllers\ContactUsController::class, 'create']);

    //Club Admin
    Route::get('/club-index', [App\Http\Controllers\ClubController::class, 'index']);
    Route::get('/club-add', [App\Http\Controllers\ClubController::class, 'add'])->name('club-add');
    Route::post('/club-create', [App\Http\Controllers\ClubController::class, 'create'])->name('club-create');
    Route::get('/club-delete', [App\Http\Controllers\ClubController::class, 'delete'])->name('club-delete');
    Route::get('/club-edit', [App\Http\Controllers\ClubController::class, 'edit'])->name('club-edit');
    Route::post('/club-update/{id}', [App\Http\Controllers\ClubController::class, 'update'])->name('club-update');
    Route::get('/club-view', [App\Http\Controllers\ClubController::class, 'view'])->name('club-view');
    Route::get('/club-export', [App\Http\Controllers\ClubController::class, 'export'])->name('club-export');
    Route::get('/club-Information', [App\Http\Controllers\ClubController::class, 'edit'])->name('club-Information');
    Route::get('/club-detail/{id?}', [App\Http\Controllers\ClubController::class, 'detail'])->name('club-detail');
    Route::get('/update-club', [App\Http\Controllers\ClubController::class, 'update_club'])->name('update-club');
    Route::get('/club-input', [App\Http\Controllers\ClubController::class, 'input'])->name('club-input');
    Route::post('/club-import', [App\Http\Controllers\ClubController::class, 'import'])->name('club-import');
    //Club  
    Route::get('/club-info-index', [App\Http\Controllers\ClubInfoController::class, 'index']);
    Route::get('/club-info-add', [App\Http\Controllers\ClubInfoController::class, 'add'])->name('club-info-add');
    Route::post('/club-info-create', [App\Http\Controllers\ClubInfoController::class, 'create'])->name('club-info-create');
    Route::get('/club-info-delete', [App\Http\Controllers\ClubInfoController::class, 'delete'])->name('club-info-delete');
    Route::get('/club-info-edit', [App\Http\Controllers\ClubInfoController::class, 'edit'])->name('club-info-edit');
    Route::post('/club-info-update/{id}', [App\Http\Controllers\ClubInfoController::class, 'update'])->name('club-info-update');
    Route::get('/club-info-view', [App\Http\Controllers\ClubInfoController::class, 'view'])->name('club-info-view');
    Route::get('/club-info-export', [App\Http\Controllers\ClubInfoController::class, 'export'])->name('club-info-export');
    Route::get('/club-info-Information', [App\Http\Controllers\ClubInfoController::class, 'edit'])->name('club-info-Information');
    Route::get('/club-info-detail/{id?}', [App\Http\Controllers\ClubInfoController::class, 'detail'])->name('club-info-detail');
    Route::get('/update-info-club', [App\Http\Controllers\ClubInfoController::class, 'update_club'])->name('update-info-club');
    Route::get('/club-info-input', [App\Http\Controllers\ClubInfoController::class, 'input'])->name('club-info-input');
    Route::post('/club-info-import', [App\Http\Controllers\ClubInfoController::class, 'import'])->name('club-info-import');
    //Player 
    Route::get('/player-index/{search?}/{group?}', [App\Http\Controllers\PlayerController::class, 'index']);
    Route::get('/player-view', [App\Http\Controllers\PlayerController::class, 'view'])->name('player-view');
    Route::get('/player-status', [App\Http\Controllers\PlayerController::class, 'status'])->name('player-status');
    Route::get('/player-delete', [App\Http\Controllers\PlayerController::class, 'delete'])->name('player-delete');
    Route::get('/player-notdelete', [App\Http\Controllers\PlayerController::class, 'notdelete'])->name('player-notdelete');

    Route::get('/player-edit', [App\Http\Controllers\PlayerController::class, 'edit'])->name('player-edit');
    Route::post('/player-update/{id}', [App\Http\Controllers\PlayerController::class, 'update'])->name('player-update');
    Route::get('/player-export', [App\Http\Controllers\PlayerController::class, 'export'])->name('player-export');
    Route::get('/player-input', [App\Http\Controllers\PlayerController::class, 'input'])->name('player-input');
    Route::post('/player-import', [App\Http\Controllers\PlayerController::class, 'import'])->name('player-import');
    //Archive 
    Route::get('/archive-index/{search?}/{group?}', [App\Http\Controllers\ArchiveController::class, 'index']);
    Route::get('/archive-coach/{search?}/{group?}', [App\Http\Controllers\ArchiveController::class, 'archiveCoach']);
    Route::get('/archive-view', [App\Http\Controllers\ArchiveController::class, 'view'])->name('archive-view');
    Route::get('/archive-delete', [App\Http\Controllers\ArchiveController::class, 'delete'])->name('archive-delete');
    Route::get('/archive-notdelete', [App\Http\Controllers\ArchiveController::class, 'notdelete'])->name('archive-notdelete');

    //Group
    Route::get('/group-index', [App\Http\Controllers\GroupController::class, 'index']);
    Route::get('/group-add-form', [App\Http\Controllers\GroupController::class, 'group_add_form'])->name('group-add-form');
    Route::post('/group-add', [App\Http\Controllers\GroupController::class, 'add'])->name('group-add');
    Route::get('/group-view', [App\Http\Controllers\GroupController::class, 'view'])->name('group-view');
    Route::get('/group-status', [App\Http\Controllers\GroupController::class, 'status'])->name('group-status');
    Route::get('/group-delete', [App\Http\Controllers\GroupController::class, 'delete'])->name('group-delete');
    Route::get('/group-edit', [App\Http\Controllers\GroupController::class, 'edit'])->name('group-edit');
    Route::post('/group-update/{id}', [App\Http\Controllers\GroupController::class, 'update'])->name('group-update');
    Route::get('/group-edit', [App\Http\Controllers\GroupController::class, 'edit'])->name('group-edit');
    Route::get('/group-export', [App\Http\Controllers\GroupController::class, 'export'])->name('group-export');

    //Coach
    Route::get('/coach-index', [App\Http\Controllers\CoachController::class, 'index']);
    Route::get('/coach-add-form', [App\Http\Controllers\CoachController::class, 'addForm'])->name('coach-add-form');
    Route::post('/coach-add', [App\Http\Controllers\CoachController::class, 'add'])->name('coach-add');
    Route::get('/coach-view', [App\Http\Controllers\CoachController::class, 'view'])->name('coach-view');
    Route::get('/coach-status', [App\Http\Controllers\CoachController::class, 'status'])->name('coach-status');
    Route::get('/coach-delete', [App\Http\Controllers\CoachController::class, 'delete'])->name('coach-delete');
    Route::get('/coach-existing', [App\Http\Controllers\CoachController::class, 'coach_existing'])->name('coach-existing');
    Route::get('/coach-edit', [App\Http\Controllers\CoachController::class, 'edit'])->name('coach-edit');
    Route::get('/assign-player', [App\Http\Controllers\CoachController::class, 'assign_player'])->name('assign-player');
    Route::post('/assign-coach-to-player/{id}', [App\Http\Controllers\CoachController::class, 'assign_coach_to_player'])->name('assign-coach-to-player');

    Route::post('/coach-update/{id}', [App\Http\Controllers\CoachController::class, 'update'])->name('coach-update');
    Route::post('/coach-role-delete', [App\Http\Controllers\CoachController::class, 'coach_role_delete'])->name('coach-role-delete');
    Route::post('/coach-group-delete', [App\Http\Controllers\CoachController::class, 'coach_group_delete'])->name('coach-group-delete');
    Route::get('/coach-export', [App\Http\Controllers\CoachController::class, 'export'])->name('coach-export');
    Route::get('/coach-archive', [App\Http\Controllers\CoachController::class, 'archive'])->name('coach-archive');

    //Trophies 
    Route::get('/trophy-index', [App\Http\Controllers\TrophiesController::class, 'index']);
    Route::get('/trophy-add', function () {
        return view('trophy.add');
    });
    Route::post('/trophy-add', [App\Http\Controllers\TrophiesController::class, 'add'])->name('trophy-add');
    Route::get('/trophy-view', [App\Http\Controllers\TrophiesController::class, 'view'])->name('trophy-view');
    Route::get('/trophy-status', [App\Http\Controllers\TrophiesController::class, 'status'])->name('trophy-status');
    Route::get('/trophy-delete', [App\Http\Controllers\TrophiesController::class, 'delete'])->name('trophy-delete');
    Route::get('/trophy-edit', [App\Http\Controllers\TrophiesController::class, 'edit'])->name('trophy-edit');
    Route::post('/trophy-update/{id}', [App\Http\Controllers\TrophiesController::class, 'update'])->name('trophy-update');
    //club notes 
    Route::get('/club-notes-index', [App\Http\Controllers\ClubNotesController::class, 'index']);
    Route::get('/club-notes-add', function () {
        return view('clubNotes.add');
    });
    Route::post('/club-notes-add', [App\Http\Controllers\ClubNotesController::class, 'add'])->name('club-notes-add');
    Route::get('/club-notes-view', [App\Http\Controllers\ClubNotesController::class, 'view'])->name('club-notes-view');
    Route::get('/club-notes-status', [App\Http\Controllers\ClubNotesController::class, 'status'])->name('club-notes-status');
    Route::get('/club-notes-delete', [App\Http\Controllers\ClubNotesController::class, 'delete'])->name('club-notes-delete');
    Route::get('/club-notes-edit', [App\Http\Controllers\ClubNotesController::class, 'edit'])->name('club-notes-edit');
    Route::post('/club-notes-update/{id}', [App\Http\Controllers\ClubNotesController::class, 'update'])->name('club-notes-update');
    Route::get('/club-notes-input', [App\Http\Controllers\ClubNotesController::class, 'input'])->name('club-notes-input');
    Route::post('/club-notes-import', [App\Http\Controllers\ClubNotesController::class, 'import'])->name('club-notes-import');
    Route::get('/club-notes-export', [App\Http\Controllers\ClubNotesController::class, 'export'])->name('club-notes-export');

    //Team
    Route::get('/team-index', [App\Http\Controllers\TeamController::class, 'index']);
    Route::get('/team-add', function () {
        $clubs = ClubInfo::get();
        $passcode= CoachPasscodePlayer::where(['coach_id' =>Auth::user()->id])->pluck('player_id');
        $players = User::whereIn('id', $passcode)->get();
        $coaches = User::where([ 'is_archive' => 0,'created_by_id'=>Auth::user()->id])->whereIn('role_id',[3,5])->get();
        return view('team.add', ['clubs' => $clubs,'players'=>$players,'coaches'=>$coaches]);
    });
    Route::post('/team-add', [App\Http\Controllers\TeamController::class, 'add'])->name('team-add');
    Route::get('/team-edit', [App\Http\Controllers\TeamController::class, 'edit'])->name('team-edit');
    Route::post('/team-update/{id}', [App\Http\Controllers\TeamController::class, 'update'])->name('team-update');
    Route::get('/team-delete', [App\Http\Controllers\TeamController::class, 'delete'])->name('team-delete');
    Route::get('/team-view', [App\Http\Controllers\TeamController::class, 'view'])->name('team-view');
    Route::post('/team-coach-delete', [App\Http\Controllers\TeamController::class, 'team_coach_delete'])->name('team-coach-delete');
    Route::post('/team-player-delete', [App\Http\Controllers\TeamController::class, 'team_player_delete'])->name('team-player-delete');

});
