<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Banner;
use App\Models\Service;
use App\Models\ServiceContent;
use App\Models\OurTeam;
use App\Models\Gallery;
use App\Models\Career;
use App\Models\Projects;
use App\Models\ProjectImage;

class WebsiteController extends Controller
{
    //

    public function index(){

        $title = "Home";
        $banners = Banner::orderby('id', "DESC")->get();
        $page = Page::all()->keyBy('id');
        $services = Service::all();
        $teams = OurTeam::all();


        return view('index', compact('title', 'banners','page','services', 'teams'));
    }

    public function contactus(){

        $title = "Contact";


        return view('contact', compact('title'));
    }

    public function gallery(){

        $title = "Gallery";
        $galleries = Gallery::orderby('id', "DESC")->get();


        return view('gallery', compact('title', 'galleries'));
    }

    public function carrers(){

        $title = "Carrers";
        $careers = Career::orderby('id', "DESC")->get();


        return view('carrers', compact('title', 'careers'));

    }

    public function projects(){
        $title = "Projects";
        $projects = Projects::orderby('id', "DESC")->get();


        return view('projects', compact('title', 'projects'));
    }

}
