<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Skill;
use App\Models\Category;
use App\Models\Post;
use App\Models\Lead;
use App\Models\Slider;
use App\Models\Gallery;

use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function renderWelcomePage () 
    {
        $skills = Skill::all();
        $sliders = Slider::all();
        $gallery = Gallery::all();

        return view('welcome')->with('skills', $skills)->with('sliders', $sliders)->with('gallery', $gallery);
    }

    public function renderPublicPages ($name)
    {
        $data = [];

        switch(strtoupper($name)) {
            case 'WORKS':
                $data = [];
                break;

            case 'POST':
                $post_id = request()->get('post_id', '');

                if($post_id) {
                    $data['post'] = Post::find($post_id);

                    if(!$data['post']) {
                        return abort(404);
                    }
                } else {
                    return abort(404);
                }

                break;

            case 'BLOG':
                
                $category_id = request()->get('category_id', '');
                $count_posts = request()->get('count_posts', 10);
                $data['categories'] = Category::all();

                if($category_id) {
                    $data['posts'] = Post::where('category_id', $category_id)->paginate($count_posts); 
                } else {
                    $data['posts'] = Post::paginate($count_posts);
                }
                

                break;

            case 'CONTACTS':

                break; 
        }

        return view("pages.$name", $data);
    }

    public function renderLeads ()
    {
        $leads = Lead::all();

        return view('admin.leads')->with('leads', $leads);
    }

    public function addLead ()
    {
        $data = request()->all();

        if(isset($data['name']) && isset($data['email'])) {
            Lead::create($data);

            return redirect( route('pages', 
                ['name' => 'contacts', 'createdLead' => 1]) );
        }

        return redirect( route('pages', 
                ['name' => 'contacts']) );
    }

    public function deleteLead ($id)
    {
        $lead = Lead::find($id);

        if($lead) {
            $lead->delete();
        }

        return back();
    }

    public function renderUsers ()
    {
        $users = User::all();

        return view('admin.users')->with('users', $users);
    }

    public function renderEditUser ($id)
    {
        $user = User::find($id);

        if(!$user) {
            return abort(404);
        }

        return view('admin.users.edit')->with('user', $user);
    }

    public function editUser ($id) 
    {
        $user = User::find($id);

        if(!$user) {
            return abort(404);
        }

        $user->name = request()->get('name', $user->name);
        $user->email = request()->get('email', $user->email);
        $user->role = request()->get('role', $user->role);

        $user->save();

        return redirect( route('renderEditUser', $user->id) );
    }

    // Добавление юзера
    public function renderAddUser ()
    {
        return view('admin.users.add');
    }

    
    public function addUser ()
    {
        $data = request()->all();
        $user = null;

        if(isset($data['name']) && isset($data['email']) && isset($data['password'])) {
            $user = User::create($data);
        }

        if($user) {
            return redirect( route('renderUsers') );
        } 

        return abort(400);
    }

    // Удаление юзера
    public function deleteUser ($id)
    {
        $user = User::find($id);

        if($user) {
            $user->delete();
        }

        return back();
    }

    /**
     * Добавление слайдера
     */
    public function renderSlidersPage ()
    {
        $sliders = Slider::all();

        return view('admin.sliders')->with('sliders', $sliders);
    }

    public function renderAddSliderPage () 
    {
        return view('admin.sliders.add');
    }

    public function deleteSlide ($id)
    {
        $slide = Slider::find($id);

        if($slide) {
            $imagePath = $slide->image;
            $slide->delete();

            Storage::disk('public')->delete($imagePath); // uploads/1734088351_продолжающий.jpg
        }

        return back();
    }

    public function renderEditSlide ($id)
    {
        $slide = Slider::find($id);

        return view('admin.sliders.edit')->with('slide', $slide);
    }

    public function editSlide (Request $request)
    {
        $id = $request->id;
        $slide = Slider::find($id);

        if($slide) {
            $slide->title = request()->get('title', $slide->title);   
            $slide->description = request()->get('description', '');
            $slide->btn_name = request()->get('btn_name', $slide->btn_name);
            $slide->btn_link = request()->get('btn_link', '');
            $image = $request->file('image');

            if($image) {
                Storage::disk('public')->delete($slide->image);

                // Создаем уникальное имя для файла + поставляем его оригинальное имя и расширение
                $fileName = time() . '_' . $image->getClientOriginalName();
                // Получаем итоговый путь к файлу (в данном случае будет uploads/1125151_файл.расширение)
                $fileName = $image->storeAs('uploads', $fileName, 'public');

                $slide->image = $fileName;
            }

            $slide->save();

            return redirect( route('renderSlidersPage') );
        }
        
        return abort(404);
    }

    public function addSlider (Request $request) 
    {
        $title = request()->get('title', 'Заголовок 1');
        // Получаем файл с запроса
        $image = $request->file('image');   
        $description = request()->get('description', '');
        $btn_name = request()->get('btn_name', 'Подробнее');
        $btn_link = request()->get('btn_link', '');

        // Создали переменную для пути файла
        $fileName = '';

        if($image) {
            // Создаем уникальное имя для файла + поставляем его оригинальное имя и расширение
            $fileName = time() . '_' . $image->getClientOriginalName();
            // Получаем итоговый путь к файлу (в данном случае будет uploads/1125151_файл.расширение)
            $fileName = $image->storeAs('uploads', $fileName, 'public');
        }

        Slider::create([
            'title' => $title,
            'description' => $description,
            'image' => $fileName,
            'btn_name' => $btn_name,
            'btn_link' => $btn_link
        ]);
        
        return redirect( route('renderSlidersPage') );
    }

    /**
     * Галерея
     */
    public function renderGalleryPage ()
    {
        $gallery = Gallery::all();

        return view('admin.gallery')->with('gallery', $gallery);
    }

    public function addGallery (Request $request)
    {
        $images = $request->file('image');

        foreach($images as $image) {
            // Создаем уникальное имя для файла + поставляем его оригинальное имя и расширение
            $fileName = time() . '_' . $image->getClientOriginalName();
            // Получаем итоговый путь к файлу (в данном случае будет uploads/1125151_файл.расширение)
            $fileName = $image->storeAs('gallery', $fileName, 'public');
            
            Gallery::create([ 'image' => $fileName ]);
        }

        return redirect( route('renderGalleryPage') );
    }

    public function deleteGallery ($id)
    {
        $gallery = Gallery::find($id);

        if($gallery) {
            $image = $gallery->image;
            $gallery->delete();
            Storage::disk('public')->delete($gallery->image);

            return redirect( route('renderGalleryPage') );
        }

        return abort(404);
    }
}
