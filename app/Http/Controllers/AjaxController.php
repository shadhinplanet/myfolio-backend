<?php

namespace App\Http\Controllers;

use App\Models\AboutMe;
use App\Models\FunFact;
use App\Models\Hero;
use App\Models\Knowledge;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\ServicesList;
use App\Models\Skill;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;

class AjaxController extends Controller
{



    // Update Hero
    public function updateHero(Request $request)
    {
        try {

            $hero = Hero::find($request->id);

            $thumb = $hero->image;

            if (!empty($request->file('thumbnail'))) {

                if (file_exists(public_path('storage/uploads/hero/' . $thumb))) {
                    unlink(public_path('storage/uploads/hero/' . $thumb));
                }
                $thumb = $request->file('thumbnail')->getClientOriginalName();
                $thumb = date('Yjhms') . '-' . $thumb;
                $request->file('thumbnail')->storeAs('/public/uploads/hero', $thumb);
            }

            $hero->title = $request->title;
            $hero->subtitle = $request->subtitle;
            $hero->skill_list = $request->experties;
            $hero->image = $thumb;
            $hero->update();

            return Response()->json(['success' => true, 'message' => 'Hero Updated' ]);
        } catch (\Throwable $th) {
            return Response()->json(['error' => $th->getMessage()]);
        }
    }

    // Create Knowledge
    public function createKnowledge(Request $request)
    {

        try {
            $image = '';

            if (!empty($request->file('image'))) {

                $image = $request->file('image')->getClientOriginalName();
                $image = date('Yjhms') . '-' . $image;
                $request->file('image')->storeAs('/public/uploads/hero', $image);
            } else {
                return Response()->json(['error' => true, 'message' => 'Image is required']);
            }

            $kn = Knowledge::create([
                'name' => $request->name,
                'image' => $image,
            ]);

            return Response()->json(['success' => true, 'data' => $kn]);
        } catch (\Throwable $th) {
            return Response()->json(['error' => $th->getMessage()]);
        }
    }

    // Update Knowledge
    public function updateKnowledge(Request $request)
    {
        try {

            $kn = Knowledge::find($request->id);

            $image = $kn->image;

            if (!empty($request->file('image'))) {

                if (file_exists(public_path('storage/uploads/hero/' . $image))) {
                    unlink(public_path('storage/uploads/hero/' . $image));
                }
                $image = $request->file('image')->getClientOriginalName();
                $image = date('Yjhms') . '-' . $image;
                $request->file('image')->storeAs('/public/uploads/hero', $image);
            }

            $kn->name = $request->name;
            $kn->image = $image;
            $kn->update();

            return Response()->json(['success' => true, 'data' => $kn]);
        } catch (\Throwable $th) {
            return Response()->json(['error' => $th->getMessage()]);
        }
    }

    // Delete Knowledge
    public function destroyKnowledge(Request $request)
    {
        try {
            $kn = Knowledge::find($request->id);

            $image = $kn->image;

            if (file_exists(public_path('storage/uploads/hero/' . $image))) {
                unlink(public_path('storage/uploads/hero/' . $image));
            }

            $kn->delete();

            return Response()->json(['data' => 'Delete Successfull']);
        } catch (\Throwable $th) {
            return Response()->json(['error' => $th->getMessage()]);
        }
    }

    // Update About Me
    public function updateAboutMe(Request $request)
    {
        try {
            $about = AboutMe::find($request->id);

            $thumb = $about->thumbnail;
            $cv = $about->cv_link;
            $signature = $about->signature;

            if (!empty($request->file('thumb'))) {
                if (file_exists(public_path('storage/uploads/about/' . $thumb))) {
                    unlink(public_path('storage/uploads/about/' . $thumb));
                }

                $thumb = $request->file('thumb')->getClientOriginalName();
                $thumb = date('Yjhms') . '-' . $thumb;

                $request->file('thumb')->storeAs('/public/uploads/about', $thumb);
            }
            if (!empty($request->file('cv'))) {

                if ($request->cv_link != null) {
                    if (file_exists(public_path('storage/uploads/about/' . $cv))) {
                        unlink(public_path('storage/uploads/about/' . $cv));
                    }
                }


                $cv = $request->file('cv')->getClientOriginalName();
                $cv = date('Yjhms') . '-' . $cv;
                $request->file('cv')->storeAs('/public/uploads/about', $cv);
            }
            if (!empty($request->file('signature'))) {
                if (file_exists(public_path('storage/uploads/about/' . $signature))) {
                    unlink(public_path('storage/uploads/about/' . $signature));
                }

                $signature = $request->file('cv')->getClientOriginalName();
                $signature = date('Yjhms') . '-' . $signature;

                $request->file('signature')->storeAs('/public/uploads/about', $signature);
            }

            $about->title = $request->title;
            $about->subtitle = $request->subtitle;
            $about->description = $request->description;
            $about->experience_year = $request->exp_year;
            $about->experience_text = $request->exp_text;

            $about->signature = $signature;
            $about->thumbnail = $thumb;
            $about->cv_link = $cv;

            $about->update();

            return Response()->json(['success' => true, 'data' => $about]);
        } catch (\Throwable $th) {
            return Response()->json(['error' => true, 'message' => $th->getMessage()]);
        }
    }


    // Update Service Page
    public function updateServicePage(Request $request)
    {
        try {
            $service = Service::find($request->id);

            $service->title = $request->title;
            $service->subtitle = $request->subtitle;
            $service->description = $request->description;

            $service->update();

            return Response()->json(['success' => true, 'message' => 'Service Updated']);
        } catch (\Throwable $th) {
            return Response()->json(['error' => true, 'message' => 'Error']);
        }
    }

    // Create Skill
    public function createSkill(Request $request)
    {
        try {

            Skill::create([
                'name'  => $request->name,
                'value'  => $request->value,
                'color'  => $request->color,
            ]);

            return Response()->json(['success' => true, 'message' => 'Skill Created']);
        } catch (\Throwable $th) {
            return Response()->json(['error' => true, 'message' => 'Error']);
        }
    }

    // Update Skill
    public function updateSkill(Request $request)
    {
        try {
            $skill = Skill::find($request->id);

            $skill->name = $request->name;
            $skill->value = $request->value;
            $skill->color = $request->color;

            $skill->update();

            return Response()->json(['success' => true, 'message' => 'Skill Updated']);
        } catch (\Throwable $th) {
            return Response()->json(['error' => true, 'message' => 'Error']);
        }
    }

    // Delete Skill
    public function deleteSkill(Request $request)
    {
        try {
            $skill = Skill::find($request->id)->delete();

            return Response()->json(['success' => true, 'message' => 'Skill Deleted']);
        } catch (\Throwable $th) {
            return Response()->json(['error' => true, 'message' => 'Error']);
        }
    }



    // Create New Service
    public function createNewService(Request $request)
    {
        try {
            $icon = '';

            if (!empty($request->file('icon'))) {
                $icon = $request->file('icon')->getClientOriginalName();
                $icon = date('Yjhms') . '-' . $icon;
                $request->file('icon')->storeAs('/public/uploads/services', $icon);
            } else {
                return Response()->json(['error' => true, 'message' => 'Image is required']);
            }

            ServicesList::create([
                'name'  => $request->name,
                'icon'  => $icon,
            ]);

            return Response()->json(['success' => true, 'message' => 'New Service Created']);
        } catch (\Throwable $th) {
            return Response()->json(['error' => true, 'message' => 'Error']);
        }
    }

    // Update Service
    public function updateService(Request $request)
    {
        try {
            $service = ServicesList::find($request->id);

            $icon = $service->icon;

            if (!empty($request->file('icon'))) {

                if (file_exists(public_path('storage/uploads/services/' . $icon))) {
                    unlink(public_path('storage/uploads/services/' . $icon));
                }
                $icon = $request->file('icon')->getClientOriginalName();
                $icon = date('Yjhms') . '-' . $icon;
                $request->file('icon')->storeAs('/public/uploads/services', $icon);
            }

            $service->name = $request->name;
            $service->icon = $icon;

            $service->update();

            return Response()->json(['success' => true, 'message' => 'Service Updated']);
        } catch (\Throwable $th) {
            return Response()->json(['error' => true, 'message' => 'Error']);
        }
    }

    // Delete Skill
    public function deleteService(Request $request)
    {
        try {
            ServicesList::find($request->id)->delete();
            return Response()->json(['success' => true, 'message' => 'Service Deleted']);
        } catch (\Throwable $th) {
            return Response()->json(['error' => true, 'message' => 'Error']);
        }
    }

    // Update Portfolio Page
    public function updatePortfolio(Request $request)
    {
        try {
            $port = Portfolio::find($request->id);

            $port->title = $request->title;
            $port->subtitle = $request->subtitle;
            $port->update();

            return Response()->json(['success' => true, 'message' => 'Portfolio Updated']);

        } catch (\Throwable $th) {
            return Response()->json(['error' => true, 'message' => 'Error']);
        }
    }

  // Create Funfact
  public function addnewFunfact(Request $request)
  {

      try {
          $icon = '';

          if (!empty($request->file('icon'))) {

              $icon = $request->file('icon')->getClientOriginalName();
              $icon = date('Yjhms') . '-' . $icon;
              $request->file('icon')->storeAs('/public/uploads/funfacts', $icon);
          }

          FunFact::create([
              'title' => $request->title,
              'value' => $request->value,
              'suffix' => $request->suffix,
              'icon' => $icon,
          ]);

          return Response()->json(['success' => true, 'message' => 'FunFact Created!']);

      } catch (\Throwable $th) {
          return Response()->json(['error' => $th->getMessage()]);
      }
  }



   // Update FunFact
   public function updateFunfact(Request $request)
   {
       try {

           $fun = FunFact::find($request->id);

           $icon = $fun->icon;

           if (!empty($request->file('icon'))) {

               if (file_exists(public_path('storage/uploads/funfacts/' . $icon))) {
                   unlink(public_path('storage/uploads/funfacts/' . $icon));
               }
               $icon = $request->file('icon')->getClientOriginalName();
               $icon = date('Yjhms') . '-' . $icon;
               $request->file('icon')->storeAs('/public/uploads/funfacts', $icon);
           }

           $fun->title = $request->title;
           $fun->value = $request->value;
           $fun->suffix = $request->suffix;
           $fun->icon = $icon;
           $fun->update();

           return Response()->json(['success' => true, 'message' => 'FunFact Updated']);
       } catch (\Throwable $th) {
           return Response()->json(['error' => $th->getMessage()]);
       }
   }

    // Delete deleteFunfact
    public function deleteFunfact(Request $request)
    {
        try {
            $fun = FunFact::find($request->id);

            $icon = $fun->icon;
            if($icon !=''){
                if (file_exists(public_path('storage/uploads/funfacts/' . $icon))) {
                    unlink(public_path('storage/uploads/funfacts/' . $icon));
                }
            }


            $fun->delete();

            return Response()->json(['success' => true, 'message' => 'FunFact Deleted']);
        } catch (\Throwable $th) {
            return Response()->json(['error' => true, 'message' => 'Error']);
        }
    }

}
