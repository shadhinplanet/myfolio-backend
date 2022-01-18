<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\DashboardController;
use App\Models\AboutMe;
use App\Models\Category;
use App\Models\Experience;
use App\Models\ExperienceList;
use App\Models\FunFact;
use App\Models\Hero;
use App\Models\Knowledge;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\ServicesList;
use App\Models\Skill;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;



Route::prefix('admin')->group(function () {
    Route::resource('dashboard', DashboardController::class);


    Route::get('hero', function () {
        $hero = Hero::first();
        $hero['experties'] = explode(',', $hero->skill_list);
        $knowledges = Knowledge::all();
        return view('admin.hero')->with([
            'hero' => $hero,
            'knowledges' => $knowledges,
        ]);
    })->name('hero');


    Route::get('portfolio', function () {
        $portfolio = Portfolio::first();
        return view('admin.portfolio')->with(['portfolio' => $portfolio]);
    })->name('portfolio');



    Route::get('about', function () {
        $about = AboutMe::first();
        return view('admin.about')->with('about', $about);
    })->name('about');
    Route::get('service', function () {
        $service = Service::first();
        $skills = Skill::all();
        $services = ServicesList::all();
        return view('admin.service')->with([
            'service' => $service,
            'skills' => $skills,
            'services' => $services,
        ]);
    })->name('service');


    Route::get('funfacts', function () {
        $fun = FunFact::all();
        return view('admin.funfact')->with([
            'funfacts' => $fun,
        ]);
    })->name('funfacts');

    Route::get('categories', function () {
        $cat = Category::all();
        return view('admin.categories')->with([
            'categories' => $cat,
        ]);
    })->name('categories');

    Route::get('experiences', function () {
        $exp = Experience::first();
        $expList = ExperienceList::all();
        return view('admin.experience')->with([
            'experience' => $exp,
            'experienceList' => $expList,
        ]);
    })->name('experiences');



    // Ajax
    Route::post('hero/update', [AjaxController::class, 'updateHero'])->name('updateHero');


    Route::post('knowledge/new', [AjaxController::class, 'createKnowledge'])->name('addKnowledge');
    Route::post('kn/delete/', [AjaxController::class, 'destroyKnowledge'])->name('deleteKnowledge');
    Route::post('kn/update/', [AjaxController::class, 'updateKnowledge'])->name('editKnowledge');


    Route::post('about/update/', [AjaxController::class, 'updateAboutMe'])->name('updateAboutMe');
    Route::post('servicepage/update/', [AjaxController::class, 'updateServicePage'])->name('updateServicePage');

    Route::post('skill/new/', [AjaxController::class, 'createSkill'])->name('createSkill');
    Route::post('skill/update/', [AjaxController::class, 'updateSkill'])->name('updateSkill');
    Route::post('skill/delete/', [AjaxController::class, 'deleteSkill'])->name('deleteSkill');


    Route::post('service/new/', [AjaxController::class, 'createNewService'])->name('createNewService');
    Route::post('service/update/', [AjaxController::class, 'updateService'])->name('updateService');
    Route::post('service/delete/', [AjaxController::class, 'deleteService'])->name('deleteService');


    Route::post('portfolio/update/', [AjaxController::class, 'updatePortfolio'])->name('updatePortfolio');


    // fun facts
    Route::post('funfact/add/', [AjaxController::class, 'addnewFunfact'])->name('createFunfact');
    Route::post('funfact/update/', [AjaxController::class, 'updateFunfact'])->name('updateFunfact');
    Route::post('funfact/delete/', [AjaxController::class, 'deleteFunfact'])->name('deleteFunfact');
});






Route::post('logout', function (Request $request) {
    // auth()->user()->tokens()->delete();

    return response([
        'auth'  => auth()->user(),
        'message' => "User Logged Out",
    ]);
});




// Front end


Route::get('/', function () {
    try {
        return view('frontend.home')->with([
            'connection'    => true,
            'hero'          => Hero::first(),
            'knowledges'    => Knowledge::all(),
            'about'         => AboutMe::first(),
            'service'       => Service::first(),
            'skills'        => Skill::all(),
            'services'      => ServicesList::all(),
            'funfacts'      => FunFact::all(),
            'experience'      => Experience::first(),
            'experienceList'      => ExperienceList::all(),
        ]);
    } catch (\Throwable $th) {
        return view('frontend.home')->with([
            'connection'    => false,
        ]);
    }
})->name('home');
