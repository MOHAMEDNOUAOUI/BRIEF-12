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

    public function store_data(Request $request) {
        $data = $request->validate([
            'title'=>'required',
            'content'=>'required',
            'id_destination'=>'required'
        ]);

        Posts::create($data);

        return redirect(route('home'));
    }

    public function ordernew(){
        $posts = Posts::with(['images', 'destination'])->orderBy('Posts.created_at', 'desc')->get();
            return response()->json(['posts'=>$posts]);
    }

    public function notordernow(){
        $posts = Posts::with(['images','destination'])
        ->orderBy('Posts.created_at')
        ->get();
        return response()->json(['posts'=>$posts]);
    }

    public function filter_continent(Request $request){
            $continent =  $request->input('continent');
            $data = Posts::with(['images', 'destination'])
    ->whereHas('destination', function ($query) use ($continent) {
        $query->where('destination_name', 'like', '%' . $continent . '%');
    })
    ->get();
        return response()->json(['posts'=>$data]);
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
