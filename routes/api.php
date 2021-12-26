<?php

use App\Models\AboutMe;
use App\Models\Experience;
use App\Models\ExperienceList;
use App\Models\FunFact;
use App\Models\Hero;
use App\Models\Knowledge;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\ServicesList;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Sanctum;

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


Route::middleware('auth:sanctum')->get('/test', function () {
    return "Test";
});

Route::group(['middleware'=>['auth:sanctum']],function () {

});

Route::post('login', function (Request $request) {
    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response([
            'message' => 'User Not Found!',
        ], 401);
    }
    $token = $user->createToken($user->name)->plainTextToken;
    $response = [
        'user' => $user,
        'token' => $token
    ];
    return response($response);
});


Route::get('heros', function () {
    $heros = Hero::first();
    $kn = Knowledge::all();
    $heros->image = url('/storage/uploads/hero/' . $heros->image);

    $heros['experties'] = explode(',', $heros->skill_list);

    // $kn->image = url('/storage/uploads/hero/'.$kn->image);

    $heros['knowledges'] = $kn;
    // $heros['knowledges']['image'] = 'test';

    return response()->json($heros);
});

Route::get('about', function () {
    $about = AboutMe::first();
    $about->thumbnail = url('/storage/uploads/about/' . $about->thumbnail);
    $about->signature = url('/storage/uploads/about/' . $about->signature);
    $about->cv_link = url('/storage/uploads/about/' . $about->cv_link);

    return response()->json($about);
});


Route::get('service', function () {
    $service = Service::first();
    $service['skills'] = Skill::all();
    $service['services'] = ServicesList::all();

    return response()->json($service);
});


Route::get('portfolio', function () {
    $port = Portfolio::first();
    // $port['portfolios'] = Portfolio::all();
    return response()->json(['portfolio' => $port]);
});

Route::get('portfolio/{id}', function ($id) {

    try {
        $port = Portfolio::find($id)->get();
        return response()->json($port);
    } catch (\Throwable $th) {
        //throw $th;
        return response()->json(['error' => 'Not Found']);
    }
});

Route::get('funfacts', function () {
    $fun = FunFact::all();
    return response()->json(['funfacts' => $fun]);
});

Route::get('experiences', function () {
    $exp = Experience::first();
    $expList = ExperienceList::all();
    return response()->json(['experience' => $exp,'experienceList' => $expList]);
});
