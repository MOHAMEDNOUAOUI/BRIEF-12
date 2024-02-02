<?php

namespace App\Http\Controllers;

use App\Models\destinations;
use App\Models\images;
use Illuminate\Http\Request;
use App\Models\Posts;

class PostsController extends Controller
{
    public function index() {
        $posts = Posts::with('destination', 'images')->get();
        $poststats = Posts::count();
        $destinationstats = destinations::count();
        $continents = destinations::all();
        return view('home',['posts'=>$posts,
        'destinations'=>$continents,
        'postsstats'=>$poststats,
        'destinationStats'=>$destinationstats
    ]);
    }


    public function timefilter (request $request){

        $input  = $request->input('timefilter');


        if($input == 'up'){
            $posts = Posts::with(['images','destination'])
        ->orderBy('Posts.created_at' , 'desc')
        ->get();
        }
        else {
            $posts = Posts::with(['images','destination'])
        ->orderBy('Posts.created_at')
        ->get();
        }


        $poststats = Posts::count();
        $destinationstats = destinations::count();
        $continents = destinations::all();


        return view('home',['posts'=>$posts,
        'destinations'=>$continents,
        'postsstats'=>$poststats,
        'destinationStats'=>$destinationstats
    ]);
    }



    public function filterPosts (Request $request)
    {
        $destinationName = $request->input('destination_name');

        // Query posts based on the selected destination
        $posts = Posts::whereHas('destination', function ($query) use ($destinationName) {
            $query->where('destination_name', $destinationName);
        })->get();

        $poststats = Posts::count();
        $destinationstats = destinations::count();
        $continents = destinations::all();


        // Return the filtered posts to the view or perform any other action
        return view('home',['posts'=>$posts,
        'destinations'=>$continents,
        'postsstats'=>$poststats,
        'destinationStats'=>$destinationstats
    ]);
    }



    public function saverecits(Request $request){
        $title = $request->input('title');
        $content = $request->input('textarea'); // Assuming textarea is the name of your content field
        $continent = $request->input('continent');

        Posts::create([
            'title' => $title,
            'content' => $content,
            'id_destination' => $continent,
        ]);
        $articleId = Posts::latest()->first()->id;  


        foreach($request->file('myFile') as $file){
            $tempName = $file->getRealPath();
            $imageData = file_get_contents($tempName);
        images::create([
                'image'=>$imageData,
                'id_post'=>$articleId
            ]);

        }


        return redirect(route('home'));
    }
}
