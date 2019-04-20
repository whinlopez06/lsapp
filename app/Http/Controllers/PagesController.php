<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    
    public function index(){
        $title = 'Welcome to Laravel!';

        // send param to view by using compact
        // return view('pages.index', compact('title'));
        
        return view('pages.index')->with('title', $title);  
    }


    public function about(){
        // add title array to be passed on the view front ent
        return view('pages.about', ['title' => 'About']);
    }


    public function services(){
        /* pass multiple values. you can access it with associative array value in the view. 
           it will be extract on the view */
        $data = array(
            'title' => 'Services',
            'employees' => array('John Louie', 'Erwin Lopez', 'Vincent Chan','Mark Torres'),
            'services' => ['Web Developement', 'Software Developement', 'SEO', 'Admin and Network Services']
        );
        
        // add data array and pass to view using with()
        return view('pages.services')->with($data);
    }

}
