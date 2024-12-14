<?php


namespace App\Http\Controllers;
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use GuzzleHttp\Client;
use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FeesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Anhskohbo\NoCaptcha\NoCaptcha;
use File;
use App\Models\User;
use App\Models\NewsLetter;
use App\Models\Page;
use App\Models\Banner;
use App\Models\Service;
use App\Models\ServiceContent;
use App\Models\OurTeam;
use App\Models\Gallery;
use App\Models\Career;
use App\Models\Projects;
use App\Models\ProjectImage;


class AdministratorController extends Controller
{
    //
    private $fb;
    private $client;

    public function dashboard(){
        $title = "Dashboard";
        $user = Auth::guard()->user();

        
        $userCount = User::count();

        return view('back.dashboard', compact('user','title', 'userCount'));
    }

    public function users(){
        $title = "Administors";
        $user = Auth::guard()->user();
        $users = User::orderby('id', "DESC")->get();

        return view('back.users', compact('user','title', 'users'));
    }

    public function deleteuser($id){
        $id = Crypt::decrypt($id);
        $data = User::where('id',$id)->delete();

        if($data){
            return back()->with('success', 'Profile deleted successfully.');
        }

    }

    public function createadministrator(Request $request){

        request()->validate([
            'name'              => ['required', 'string'],
            'email'             => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'          => ['required', 'min:4'],
        ]);

        $password = $request->password;

        //save to user table
        $saveUser = User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => Hash::make($password)
        ]);

        return back()->with('success', 'Profile has been created successfully.');

    }


    public function banners(Request $request){
        $title = "Manage Homepage Banners";
        $user = Auth::guard()->user();
        $banners = Banner::orderby('id', "DESC")->get();

        $input = $request->all();
        if($input){ 
	        $query = $request->all();
            //validation
            request()->validate([
                'banner'        => ['required'],
                'title'         => ['nullable', 'string'],
                'subtitle'      => ['nullable', 'string'],
                'desc'          => ['nullable', 'string'],
            ]);

            if($request->hasFile('banner')){
                //save banner
                $rand = Carbon::now()->format('YmdHis');
                $filename = $rand.'.'.$request->banner->extension();
                $request->banner->move('img', $filename);

                //save banner
                $saveBanner = Banner::create([
                    'title'        => $request->title,
                    'subtitle'     => $request->subtitle,
                    'image'        => $filename,
                    'desc'         => sprintf($request->desc), 
                ]);

                return back()->with('success', 'Banner has been uploaded successfully.');
            }
            
                  
        }


        return view('back.banners', compact('title', 'user', 'banners'));
    }

    public function deletebanner($id){
        $id = Crypt::decrypt($id);
        $data = Banner::where('id',$id)->first();

        if($data && !empty($data)){
            if(file_exists(public_path("assets/website/images/banner/$data->image"))){
                File::delete(public_path("assets/website/images/banner/$data->image"));
                //dd('File exists.');
            }

            $data->delete();
            return back()->with('success', 'Banner deleted successfully.');
        }
    }


    public function cms(){
        $title = "Content Management";
        $user = Auth::guard()->user();
        $cms = Page::all();

        return view('back.cms', compact('user','title', 'cms'));
    }

    public function addcms(Request $request, $id=null){
        $user = Auth::guard()->user();

        if($id != null){
            $id = Crypt::decrypt($id);
            $title = "Update CMS";
            $content = Page::where('id', $id)->first();

            return view('back.managecms', compact('user','title', 'content'));
        }

        if($request->has('_token') && isset($request->update) && $request->update == 1){
                
            request()->validate([
                'id'               => ['required', 'integer'],
                'name'             => ['required', 'string'],
                'content'          => ['nullable', 'string'],
                'image'            => ['nullable'],
            ]);

            $content = Page::where('id', $request->id)->first();

            if($request->hasFile('image')){
                //save page image
                $rand = Carbon::now()->format('YmdHis');
                $filename = $rand.'.'.$request->image->extension();
                $request->image->move('img', $filename);
                $content->image = $filename;
            }

            $content->name       = $request->name;
            $content->content    = sprintf($request->content);
            $content->update();

            return back()->with('success', 'CMS has been updated successfully.');
                
        }

    }



    public function services(){
        $title = "Services";
        $user = Auth::guard()->user();
        $services = Service::all();

        return view('back.services', compact('user','title', 'services'));
    }

    public function addservice(Request $request, $id=null){
        $user = Auth::guard()->user();
        $title = "Add Service";

        if($id != null){
            $id = Crypt::decrypt($id);
            $title = "Update Service";
            $content = Service::where('id', $id)->first();
            $servicecontents = ServiceContent::where('service_id', $id)->get();

            return view('back.manageservice', compact('user','title', 'content', 'servicecontents'));
        }

        if($request->has('_token') && isset($request->update) && $request->update == 1){
                
            request()->validate([
                'id'               => ['required', 'integer'],
                'title'            => ['required', 'string'],
                'subtitle'         => ['required', 'string'],
                'content'          => ['required', 'string'],
            ]);

            $content = Service::where('id', $request->id)->first();

            $content->title       = $request->title;
            $content->subtitle    = $request->subtitle;
            $content->content     = sprintf($request->content);
            $content->update();

            //check if service bullet point is set
            if(isset($request->servicetitle)){
                foreach($request->servicetitle as $servicetitle){
                    $saveServiceTitle = ServiceContent::create([
                                            'service_id'    => $content->id,
                                            'content'       => sprintf($servicetitle), 
                                        ]);
                }
            }

            return back()->with('success', 'Service has been updated successfully.');
                
        }

        if($request->has('_token') && isset($request->submit) && $request->submit == 1){
                
            request()->validate([
                'title'            => ['required', 'string'],
                'subtitle'         => ['required', 'string'],
                'content'          => ['required', 'string'],
            ]);

            $saveService = Service::create([
                'title'        => $request->title,
                'subtitle'     => $request->subtitle,
                'content'      => sprintf($request->content), 
            ]);

            if($saveService){
                //check if service bullet point is set
                if(isset($request->servicetitle)){
                    foreach($request->servicetitle as $servicetitle){
                        $saveServiceTitle = ServiceContent::create([
                                                'service_id'    => $saveService->id,
                                                'content'       => sprintf($servicetitle), 
                                            ]);
                    }
                }

            }

        }

        return view('back.manageservice', compact('user','title'));

    }

    public function deleteservice($id){
        $id = Crypt::decrypt($id);
        $data = Service::where('id', $id)->first();

        if(isset($data) && !empty($data)){
            $data1 = ServiceContent::where('id', $data->service_id)->get();

            if(isset($data1) && count($data1) > 0){
                foreach($data1 as $data11){
                    $data11->delete();
                }
            }

            $data->delete();
        }
        

        return back()->with('success', 'Service point has been deleted successfully.');
    }

    public static function getServicecontents($id){
        $data = ServiceContent::where('service_id', $id)->get();

        return $data;
    }


    public function deleteservicecontent($id){
        $id = Crypt::decrypt($id);
        $data = ServiceContent::where('id', $id)->delete();

        return back()->with('success', 'Service point has been deleted successfully.');
    }


    public function careers(){
        $title = "Careers";
        $user = Auth::guard()->user();
        $careers = Career::all();

        return view('back.careers', compact('user','title', 'careers'));
    }

    public function addcareer(Request $request, $id=null){
        $user = Auth::guard()->user();
        $title = "Add Career";

        if($id != null){
            $id = Crypt::decrypt($id);
            $title = "Update Career";
            $content = Career::where('id', $id)->first();
            
            return view('back.managecareer', compact('user','title', 'content'));
        }

        if($request->has('_token') && isset($request->update) && $request->update == 1){
                
            request()->validate([
                'id'               => ['required', 'integer'],
                'title'            => ['required', 'string'],
                'type'             => ['required', 'string'],
                'location'         => ['required', 'string'],
                'content'          => ['required', 'string'],
            ]);

            $content = Career::where('id', $request->id)->first();

            $content->title       = $request->title;
            $content->type        = $request->type;
            $content->location    = $request->location;
            $content->content     = sprintf($request->content);
            $content->update();

            return back()->with('success', 'Career has been updated successfully.');
                
        }

        if($request->has('_token') && isset($request->submit) && $request->submit == 1){
                
            request()->validate([
                'title'            => ['required', 'string'],
                'type'             => ['required', 'string'],
                'location'         => ['required', 'string'],
                'content'          => ['required', 'string'],
            ]);

            $saveCareer = Career::create([
                'title'        => $request->title,
                'type'         => $request->type,
                'location'     => $request->location,
                'content'      => sprintf($request->content), 
            ]);

            return back()->with('success', 'Career has been saved successfully.');


        }

        return view('back.managecareer', compact('user','title'));

    }

    public function deletecareer($id){
        $id = Crypt::decrypt($id);
        $data = Career::where('id', $id)->delete();

        return back()->with('success', 'Career has been deleted successfully.');
    }


    public function projects(){
        $title = "Projects";
        $user = Auth::guard()->user();
        $projects = Projects::all();

        return view('back.projects', compact('user','title', 'projects'));
    }

    public function addproject(Request $request, $id=null){
        $user = Auth::guard()->user();
        $title = "Add Project";

        if($id != null){
            $id = Crypt::decrypt($id);
            $title = "Update Project";
            $content = Projects::where('id', $id)->first();
            $projectimages = ProjectImage::where('project_id', $id)->get();

            return view('back.manageproject', compact('user','title', 'content', 'projectimages'));
        }

        if($request->has('_token') && isset($request->update) && $request->update == 1){
                
            request()->validate([
                'id'               => ['required', 'integer'],
                'title'            => ['required', 'string'],
                'image'            => ['nullable'],
                'content'          => ['required', 'string'],
                'images*.'         => ['nullable']
            ]);

            $content = Projects::where('id', $request->id)->first();

            if($request->hasFile('image')){
                //save page image
                $rand = Carbon::now()->format('YmdHis');
                $filename = $rand.'.'.$request->image->extension();
                $request->image->move('img/projects', $filename);
                $content->image = $filename;
            }

            $content->title       = $request->title;
            $content->content     = sprintf($request->content);
            $content->update();

            //check if projects have aditional images
            if($request->hasFile('images')){
                foreach($request->file('images') as $key=>$image){
                    $rand = $this->RandomString(8);
                    $filename = $rand.'.'.$image->extension();
                    $image->move('img/projects/', $filename);

                    //save in project images table
                    $savePImages = ProjectImage::create([
                                            'project_id' => $content->id,
                                            'image' => $filename,
                                    ]);

                }
            }

            return back()->with('success', 'Project has been updated successfully.');
                
        }

        if($request->has('_token') && isset($request->submit) && $request->submit == 1){
                
            request()->validate([
                'title'            => ['required', 'string'],
                'image'            => ['required'],
                'content'          => ['required', 'string'],
                'images*.'         => ['nullable']
            ]);


            if($request->hasFile('image')){
                //save page image
                $rand = Carbon::now()->format('YmdHis');
                $filename = $rand.'.'.$request->image->extension();
                $request->image->move('img/projects', $filename);
                

                $saveProject = Projects::create([
                    'title'        => $request->title,
                    'image'        => $filename,
                    'content'      => sprintf($request->content), 
                ]);

                if($saveProject){
                    //check if projects have aditional images
                    if($request->hasFile('images')){
                        foreach($request->file('images') as $key=>$image){
                            $rand = $this->RandomString(8);
                            $filename = $rand.'.'.$image->extension();
                            $image->move('img/projects/', $filename);

                            //save in project images table
                            $savePImages = ProjectImage::create([
                                                'project_id' => $saveProject->id,
                                                'image' => $filename,
                                            ]);

                        }
                    }
                }


                return back()->with('success', 'Project has been saved successfully.');

            }

            

            
        }

        return view('back.manageproject', compact('user','title'));

    }

    public function deleteproject($id){
        $id = Crypt::decrypt($id);
        $data = Projects::where('id', $id)->first();

        if(isset($data) && !empty($data)){
            $data1 = ProjectImage::where('id', $data->project_id)->get();

            if(isset($data1) && count($data1) > 0){
                foreach($data1 as $data11){
                    $data11->delete();
                }
            }

            $data->delete();
        }
        

        return back()->with('success', 'Project has been deleted successfully.');
    }

    public static function getProjectImages($id){
        $data = ProjectImage::where('project_id', $id)->get();

        return $data;
    }


    public function deleteprojectimage($id){
        $id = Crypt::decrypt($id);
        $data = ProjectImage::where('id', $id)->delete();

        return back()->with('success', 'Project image has been deleted successfully.');
    }




    public function teams(){
        $title = "Our Team";
        $user = Auth::guard()->user();
        $teams = OurTeam::all();

        return view('back.teams', compact('user','title', 'teams'));
    }

    public function addteam(Request $request, $id=null){
        $user = Auth::guard()->user();
        $title = "Add Team";

        if($id != null){
            $id = Crypt::decrypt($id);
            $title = "Update Team";
            $team = OurTeam::where('id', $id)->first();

            return view('back.manageteam', compact('user','title', 'team'));
        }

        if($request->has('_token') && isset($request->update) && $request->update == 1){
                
            request()->validate([
                'id'        => ['required', 'integer'],
                'name'      => ['required', 'string'],
                'role'      => ['required', 'string'],
                'content'   => ['required', 'string'],
                'image'     => ['nullable'],
                'fb'        => ['nullable'],
                'tw'        => ['nullable'],
                'ln'        => ['nullable'],
            ]);

            $content = OurTeam::where('id', $request->id)->first();

            if($request->hasFile('image')){
                //save page image
                $rand = Carbon::now()->format('YmdHis');
                $filename = $rand.'.'.$request->image->extension();
                $request->image->move('img/teams', $filename);
                $content->image = $filename;
            }

            $content->name          = $request->name;
            $content->designation   = $request->role;
            $content->content       = $request->content;
            $content->fb            = $request->fb;
            $content->tw            = $request->tw;
            $content->ln            = $request->ln;
            $content->update();

            return back()->with('success', 'Team member has been updated successfully.');
                
        }

        if($request->has('_token') && isset($request->submit) && $request->submit == 1){
                
            request()->validate([
                'name'      => ['required', 'string'],
                'role'      => ['required', 'string'],
                'content'   => ['required', 'string'],
                'image'     => ['nullable'],
                'fb'        => ['nullable'],
                'tw'        => ['nullable'],
                'ln'        => ['nullable'],
            ]);

            $filename = "";

            if($request->hasFile('image')){
                //save page image
                $rand = Carbon::now()->format('YmdHis');
                $filename = $rand.'.'.$request->image->extension();
                $request->image->move('img/teams', $filename);
            }

            $saveTeam = OurTeam::create([
                'name'          => $request->name,
                'designation'   => $request->role,
                'content'       => $request->content, 
                'image'         => $filename,
                'fb'            => $request->fb,
                'tw'            => $request->tw,
                'ln'            => $request->ln,
            ]);

            return back()->with('success', 'Team member has been added successfully.');

        }

        return view('back.manageteam', compact('user','title'));

    }


    public function deleteteam($id){
        $id = Crypt::decrypt($id);
        $data = OurTeam::where('id',$id)->delete();

        return back()->with('success', 'Team member has been deleted successfully.');
    }

    public function manageblogs(){
        $title = "Manage Blog";
        $user = Auth::guard()->user();
        $blogs = Blog::orderby('id',"DESC")->get();

        return view("back.manageblogs", compact('title', 'user', 'blogs'));          
    }


    public function gallery(Request $request){
        $title = "Manage Image Gallery";
        $user = Auth::guard()->user();
        $galleryz = Gallery::orderby('id', "DESC")->paginate(10)->withQueryString();

        $input = $request->all();
        if($input){ 
	        $query = $request->all();
            //validation
            request()->validate([
                'images.*' => ['required'],
            ]);

            if($request->hasFile('images')){
                foreach($request->file('images') as $key=>$image){
                    $rand = $this->RandomString(8);
                    $filename = $rand.'.'.$image->extension();
                    $image->move('img/gallery/', $filename);

                    //save in gallery_categories table
                    $saveGallery = Gallery::create([
                                                'image' => $filename,
                                            ]);

                }

                return back()->with('success', 'Gallery image has been deleted successfully.');
            }
            
                  
        }


        return view('back.gallery', compact('title', 'user', 'galleryz'));
    }

    public function deletegallery($id){
        $id = Crypt::decrypt($id);
        $data = Gallery::where('id',$id)->first();

        if($data && !empty($data)){
            if(file_exists(public_path("img/gallery/$data->image"))){
                File::delete(public_path("img/gallery/$data->image"));
                //dd('File exists.');
            }

            $data->delete();
            return back()->with('success', 'Gallery image has been deleted successfully.');
        }
    }



    public function addblog(Request $request, $id=null){     
        $user = Auth::guard()->user();

        if($id != null){
            $title = "Update Article";
            $id = Crypt::decrypt($id);
            $blog = Blog::where('id', $id)->first();

            if($blog && !empty($blog)){
                return view("back.addblog", compact('title', 'user', 'blog'));
            }
        }
        
        if($request->has('_token')){  

            if(isset($request->update) && $request->update == 1){
                //validation
                request()->validate([
                    'title'             => ['required', 'string'],
                    'id'                => ['required', 'integer'],
                    'short'             => ['required', 'string'],
                    'desc'              => ['required', 'string'],            
                    'image'             => ['nullable'],
                ]);


                
                $data = Blog::where('id', $request->id)->first();

                if($data && !empty($data)){
                    //save featured image
                    if($request->hasFile('image')){
                        //save level image
                        $rand = Carbon::now()->format('YmdHis');
                        $filename = $rand.'.'.$request->image->extension();
                        $request->image->move('assets/img/blog', $filename);
                        $data->image        = $filename;
                    }

                            
                    $data->title            = sprintf($request->title);
                    $data->short_desc       = sprintf($request->short);
                    $data->desc             = sprintf($request->desc);

                    if($request->date != null){
                        $data->date         = $request->date;
                    }

                    $data->update();


                    return back()->with('success', 'Article has been updated successfully.');
                }
            }
        }
        

        $title = "Add New Article";

        if($request->has('_token')){
            if(isset($request->submit) && $request->submit == 1){
                //validation
                request()->validate([
                    'title'             => ['required', 'string'],
                    'short'             => ['required', 'string'],
                    'desc'              => ['required', 'string'],            
                    'image'             => ['required'],
                    'date'              => ['nullable'],
                ]);

                if($request->date == null){ $date = date("Y-m-d"); }else{ $date = $request->date; }

                
                //save featured image
                if($request->hasFile('image')){
                    //save level image
                    $rand = Carbon::now()->format('YmdHis');
                    $filename = $rand.'.'.$request->image->extension();
                    $request->image->move('assets/img/blog', $filename);

                    //save in blog table
                    $saveBlog = Blog::create([
                        'title'             => sprintf($request->title),
                        'image'             => $filename,
                        'short_desc'        => sprintf($request->short),
                        'desc'              => sprintf($request->desc),
                        'date'              => $date,
                        'status'            => 1
                    ]);

                    $title = sprintf($request->title);
                    $shortDescription = sprintf($request->short);
                    $blogid = Crypt::encrypt($saveBlog->id);
                    $link = URL::to("/blogdetails/$blogid");

                    // Shorten the link using Bitly API
                    $shortenedLink = $this->shortenLink($link);

                    // Concatenate the title, short description, and link
                    $message = $title . "\n" . $shortDescription . "\nRead more: <a href='" . $shortenedLink . "'>" . $shortenedLink . "</a>";


                    // Remove HTML tags from the message
                    $message = strip_tags($message);

                    //publish on Facebook
                    $this->publishToFacebook($message,$filename);

                    //publish on Intagram
                    $this->publishToinstagram($message,$filename);
                }

                return back()->with('success', 'Article has been saved successfully.');
            }
        }

        return view("back.addblog", compact('title', 'user'));

    }

    public function deleteblog($id){
        $id = Crypt::decrypt($id);
        $data = Blog::where('id',$id)->first();

        if($data && !empty($data)){
            if(file_exists(public_path("assets/img/blog/$data->image"))){
                File::delete(public_path("assets/img/blog/$data->image"));
                //dd('File exists.');
            }

            $data->delete();
            return back()->with('success', 'Article has been deleted successfully.');
        }
    }

    public function deactivateblog($id){
        $id = Crypt::decrypt($id);
        $data = Blog::where('id',$id)->first();

        if($data && !empty($data)){
            $data->status = 0;
            $data->update();

            return back()->with('success', 'Article has been deactivated successfully.');
        }

    }

    public function activateblog($id){
        $id = Crypt::decrypt($id);
        $data = Blog::where('id',$id)->first();

        if($data && !empty($data)){
            $data->status = 1;
            $data->update();

            return back()->with('success', 'Article has been activated successfully.');
        }

    }

    public function newsletters(){
        $title = "NewsLetter Subcription";
        $user = Auth::guard()->user();
        $newsletters = NewsLetter::orderby('id',"DESC")->get();

        return view("back.newsletter", compact('title', 'user', 'newsletters'));          
    }


    public function products(){
        $title = "Manage Products";
        $user = Auth::guard()->user();
        $products = Product::orderby('id', "DESC")->get();

        return view('back.products', compact('user','title', 'products'));
    }

    public function deleteproduct($id){
        $id = Crypt::decrypt($id);
        $data = Product::where('id',$id)->delete();

        if($data){
            return back()->with('success', 'Product deleted successfully.');
        }

    }

    public function addproduct(Request $request, $id=null){

        $title = "New Product";
        $user = Auth::guard()->user();

        if($id != null){
            $id = Crypt::decrypt($id);
            $title = "Update Product";
            $product = Product::where('id', $id)->first();

            return view('back.manageproduct', compact('user','title', 'product'));
        }

        if($request->has('_token') && isset($request->update) && $request->update == 1){
                
            request()->validate([
                'id'               => ['required', 'integer'],
                'name'             => ['required', 'string'],
                'size'             => ['required', 'string'],
                'amount'           => ['required', 'min:4'],
                'image'            => ['nullable'],
            ]);

            $product = Product::where('id', $request->id)->first();

            //save featured image
            if($request->hasFile('image')){
                //save level image
                $rand = Carbon::now()->format('YmdHis');
                $filename = $rand.'.'.$request->image->extension();
                $request->image->move('assets/img/product', $filename);

                $product->file = "$filename";
            }

            $product->name      = $request->name;
            $product->size     = $request->size;
            $product->amount    = $request->amount;
            $product->update();

            return back()->with('success', 'Product has been updated successfully.');
                
        }

          

            
        if($request->has('_token') && isset($request->submit) && $request->submit == 1){

            request()->validate([
                'name'             => ['required', 'string'],
                'size'             => ['required', 'string'],
                'amount'           => ['required', 'min:4'],
                'image'            => ['required'],
            ]);

            //save featured image
            if($request->hasFile('image')){
                //save level image
                $rand = Carbon::now()->format('YmdHis');
                $filename = $rand.'.'.$request->image->extension();
                $request->image->move('assets/img/product', $filename);


                //save to product table
                $saveProduct = Product::create([
                    'name'      => $request->name,
                    'size'      => $request->size,
                    'file'      => $filename,
                    'amount'    => $request->amount,
                    'status'    => 1
                ]);

                return back()->with('success', 'Product has been created successfully.');
            }
                
        }


        return view('back.manageproduct', compact('user','title'));

    }

    public function activateproduct($id){
        $id = Crypt::decrypt($id);
        $status = 1;
        $product = Product::where('id', $id)->first();

        if($product && !empty($product)){
            $product->status = $status;
            $product->update();
        }

        return back()->with('success', 'Product has been activated successfully.');

    }

    public function deactivateproduct($id){
        $id = Crypt::decrypt($id);
        $status = 0;
        $product = Product::where('id', $id)->first();

        if($product && !empty($product)){
            $product->status = $status;
            $product->update();
        }

        return back()->with('success', 'Product has been de-activated successfully.');

    }

    public function testimonials(){
        $title = "Manage Customer Reviews";
        $user = Auth::guard()->user();
        $testimonials = Testimonial::orderby('id', "DESC")->get();

        return view('back.reviews', compact('user','title', 'testimonials'));
    }

    public function deletetestimonial($id){
        $id = Crypt::decrypt($id);
        $data = Testimonial::where('id',$id)->delete();

        if($data){
            return back()->with('success', 'Testimonial deleted successfully.');
        }

    }

    public function addtestimonial(Request $request, $id=null){

        $title = "New Customer Review";
        $user = Auth::guard()->user();

        if($id != null){
            $id = Crypt::decrypt($id);
            $title = "Update Customer Review";
            $testimonial = Testimonial::where('id', $id)->first();

            return view('back.managetestimonial', compact('user','title', 'testimonial'));
        }

        if($request->has('_token') && isset($request->update) && $request->update == 1){
                
            request()->validate([
                'id'               => ['required', 'integer'],
                'name'             => ['required', 'string'],
                'testimonial'      => ['required', 'string'],
                'image'            => ['nullable'],
            ]);

            $testimonial = Testimonial::where('id', $request->id)->first();

            //save featured image
            if($request->hasFile('image')){
                //save level image
                $rand = Carbon::now()->format('YmdHis');
                $filename = $rand.'.'.$request->image->extension();
                $request->image->move('assets/img/testimonials', $filename);

                $testimonial->image = "$filename";
            }

            $testimonial->name           = $request->name;
            $testimonial->testimonial    = $request->testimonial;
            $testimonial->update();

            return back()->with('success', 'Testimonial has been updated successfully.');
                
        }

          

            
        if($request->has('_token') && isset($request->submit) && $request->submit == 1){

            request()->validate([
                'name'             => ['required', 'string'],
                'testimonial'      => ['required', 'string'],
                'image'            => ['nullable'],
            ]);

            //save featured image
            if($request->hasFile('image')){
                //save level image
                $rand = Carbon::now()->format('YmdHis');
                $filename = $rand.'.'.$request->image->extension();
                $request->image->move('assets/img/testimonials', $filename);                
            }else{
                $filename = "";
            }

            //save to testimonials table
            $saveProduct = Testimonial::create([
                'name'             => $request->name,
                'testimonial'      => $request->testimonial,
                'image'            => $filename,
                'status'           => 1
            ]);

            return back()->with('success', 'Testimonial has been created successfully.');
                
        }


        return view('back.managetestimonial', compact('user','title'));

    }

    public function activatetestimonial($id){
        $id = Crypt::decrypt($id);
        $status = 1;
        $testimonial = Testimonial::where('id', $id)->first();

        if($testimonial && !empty($testimonial)){
            $testimonial->status = $status;
            $testimonial->update();
        }

        return back()->with('success', 'Testimonial has been activated successfully.');

    }

    public function deactivatetestimonial($id){
        $id = Crypt::decrypt($id);
        $status = 0;
        $testimonial = Testimonial::where('id', $id)->first();

        if($testimonial && !empty($testimonial)){
            $testimonial->status = $status;
            $testimonial->update();
        }

        return back()->with('success', 'Testimonial has been de-activated successfully.');

    }

    private function RandomString($length, $charset='123456789'){
        $str = '';
        $count = strlen($charset);
        while ($length--) {
            $str .= $charset[mt_rand(0, $count-1)];
        }
        return $str;
    }


    public function ournumbers(){
        $title = "Our Achievements";
        $user = Auth::guard()->user();
        $numbers = OurNumber::orderby('id', "DESC")->get();

        return view('back.numbers', compact('user','title', 'numbers'));
    }


    public function deleteournumber($id){
        $id = Crypt::decrypt($id);
        $data = OurNumber::where('id',$id)->delete();

        if($data){
            return back()->with('success', 'Achievement deleted successfully.');
        }

    }

    public function addournumber(Request $request, $id=null){

        $title = "New Achievement";
        $user = Auth::guard()->user();

        if($id != null){
            $id = Crypt::decrypt($id);
            $title = "Update Achievement";
            $number = OurNumber::where('id', $id)->first();

            return view('back.managenumber', compact('user','title', 'number'));
        }

        if($request->has('_token') && isset($request->update) && $request->update == 1){
                
            request()->validate([
                'id'               => ['required', 'integer'],
                'name'             => ['required', 'string'],
                'image'            => ['nullable'],
            ]);

            $number = OurNumber::where('id', $request->id)->first();

            //save featured image
            if($request->hasFile('image')){
                //save level image
                $rand = Carbon::now()->format('YmdHis');
                $filename = $rand.'.'.$request->image->extension();
                $request->image->move('assets/img/icon', $filename);

                $number->image = "$filename";
            }

            $number->name      = $request->name;
            $number->update();

            return back()->with('success', 'Achievement has been updated successfully.');
                
        }

          

            
        if($request->has('_token') && isset($request->submit) && $request->submit == 1){

            request()->validate([
                'name'             => ['required', 'string'],
                'image'            => ['required'],
            ]);

            //save featured image
            if($request->hasFile('image')){
                //save level image
                $rand = Carbon::now()->format('YmdHis');
                $filename = $rand.'.'.$request->image->extension();
                $request->image->move('assets/img/icon', $filename);


                //save to number table
                $saveNumber = OurNumber::create([
                    'name'      => $request->name,
                    'image'     => $filename
                ]);

                return back()->with('success', 'Achievement has been created successfully.');
            }
                
        }


        return view('back.managenumber', compact('user','title'));

    }



    
    public function __construct()
    {
        $this->middleware('auth'); // Optional: Add authentication middleware
        $this->client = new Client();
        $this->httpClient = new Client();
    }

    public function publishToFacebook($message,$image)
    {

        try {
            $pageId = '113765459392783'; // Replace with your Facebook Page ID

            // Use a valid user access token with 'manage_pages' and 'publish_pages' permissions
            $accessToken = 'EAAG1UzZC4y8oBOzYsF73ic25Fb9c2eijwvoivb7yIOwWSYv8ywGv6Fz4Nz0zVUr8Yu90P8PZCdy16byAcaZBmLwSs0quiKrjsJ4fj9geZBMBPBqgJPaGE0P9ZCisHo269AIH3jPRitE6ZCNwK0QDv2qev8DI5J9qNvJOHuRvYG5S27pReMZAsONm76mF9hixZA77fN0Nlg0aCVHJoBgUk7EADC70JunbfA5rEvIZBjKAZD'; // Replace with a valid user access token
 
            //$imageUrl = asset("/assets/img/blog/20240212222833.jpg") ;   // URL of the image you want to post

            $imagePath = public_path("assets/img/blog/$image");
            $url = "https://graph.facebook.com/v12.0/$pageId/photos";

         

            // Use multipart/form-data for uploading images
            $response = $this->client->post($url, [
                'query' => ['access_token' => $accessToken],
                'multipart' => [
                    [
                        'name' => 'message',
                        'contents' => $message,
                    ],
                    [
                        'name' => 'source',
                        'contents' => fopen($imagePath, 'r'), // Upload image file
                    ],
                ],
            ]);

            $data = json_decode($response->getBody(), true);
            $postId = $data['id']; // Update this based on the actual response structure

            return true;
            //return back()->with('success', "Post published successfully. Post ID: $postId");
        } catch (\Exception $e) {
            // Handle errors
            return false;
            //dd($e->getMessage());
            //return "Error: " . $e->getMessage();
            //return back()->with('success', "$e->getMessage()");
        }
    }

    public function publishToinstagram($message, $image){

        // Instagram Graph API endpoint for uploading media
        $mediaEndpoint = 'https://graph.instagram.com/v12.0/{user-id}/media';

        // Access Token obtained from the Instagram Graph API
        $accessToken = 'your-access-token';

        // Guzzle HTTP client
        $client = new Client();

        $imagePath = public_path("assets/img/blog/$image");

        // Example: Posting an image
        $response = $client->post($mediaEndpoint, [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
            ],
            'multipart' => [
                [
                    'name' => 'message',
                    'contents' => $message,
                ],
                [
                    'name' => 'image',
                    'contents' => fopen($imagePath, 'r'),
                ],
            ],
        ]);

        // Handle the response and any errors
        $data = json_decode($response->getBody(), true);

        // Return success or error message
        if ($response->getStatusCode() === 200) {
            return response()->json(['message' => 'Post successfully published']);
        } else {
            return response()->json(['error' => $data['error']['message']], 500);
        }
    }


    public function authenticateAndObtainToken(Request $request){
        // Redirect the user to the Instagram login page
        return redirect()->away('https://api.instagram.com/oauth/authorize?client_id={your-client-id}&redirect_uri={your-redirect-uri}&scope={requested-scopes}&response_type=code');
    }

    public function handleCallback(Request $request){
        // Handle the callback after the user grants permission
        $code = $request->get('code');

        // Exchange the code for an access token
        $response = Http::post('https://api.instagram.com/oauth/access_token', [
            'client_id' => '{your-client-id}',
            'client_secret' => '{your-client-secret}',
            'grant_type' => 'authorization_code',
            'redirect_uri' => '{your-redirect-uri}',
            'code' => $code,
        ]);

        $accessToken = $response->json()['access_token'];

        // Store the access token securely for later use
    }

    public function postToTwitter()
    {
        $tweet = "Tomatrix is a very good product";

        $twitterOAuth = new TwitterOAuth(
            config('services.twitter.consumer_key'),
            config('services.twitter.consumer_secret'),
            config('services.twitter.access_token'),
            config('services.twitter.access_token_secret')
        );

        $response = $twitterOAuth->post(
            'statuses/update',
            ['status' => $tweet]
        );

        if ($twitterOAuth->getLastHttpCode() == 200) {
            dd($tweet);
            //return redirect()->back()->with('success', 'Tweet posted successfully.');
        } else {
            dd($tweet . '. Response: ' . json_encode($response));
            //return redirect()->back()->with('error', 'Error posting tweet. Please try again later.');
        }
    }


    private function shortenLink($originalLink)
    {
        $rebrandlyApiKey = 'afca77e707674b0487b00be7aca3c35d'; // Replace with your Rebrandly API key

        $rebrandlyApiUrl = "https://api.rebrandly.com/v1/links";
        $response = $this->client->post($rebrandlyApiUrl, [
            'headers' => [
                'Content-Type' => 'application/json',
                'apikey' => $rebrandlyApiKey,
            ],
            'json' => [
                'destination' => $originalLink,
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        return $data['shortUrl']; // Returns the shortened link
    }

    public function twittercallback(){
        
    }


    
}
