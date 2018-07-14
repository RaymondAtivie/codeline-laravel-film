<?php

namespace App\Http\Controllers;

use App\Film;
use Illuminate\Http\Request;
use Validator;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        $films = Film::with(['genres'])->get();

        return view('films', compact('films'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function singleFilm($film_slug)
    {
        $film = Film::where(['slug' => $film_slug])->first();

        if(!$film){
            echo "The film you are looking for doesn't exist";
            return;
        }

        return view('film', compact('film'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $films = Film::with(['genres'])->get();
        
        $result = [
            "status" => true,
            "message" => "successfully retrieved films",
            "data" => $films,
        ];

        return response()->json($result, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $rules = [
            'name' => 'required',
            'description' => 'required',
            'release_date' => 'required|date',
            'rating' => 'required|numeric',
            'ticket_price' => 'required|numeric',
            'country' => 'required',
            'photo' => 'required|image',
            'genres' => 'required|array'
        ];

        $validator = Validator::make($data, $rules);

        if($validator->fails()) {

            $result = [
                "status" => false,
                "message" => "validation error",
                "errors" => $validator->errors()->all()
            ];
            return response()->json($result);
        }

        $film = new Film;
        $film->name = $data['name'];
        $film->slug = str_slug($data['name']);
        $film->description = $data['description'];
        $film->release_date = $data['release_date'];
        $film->rating = $data['rating'];
        $film->ticket_price = $data['ticket_price'];
        $film->country = $data['country'];
        $film->photo = $request->file('photo')->store('public/film_images');
        $film->save();

        $film->genres()->sync($data['genres']);

        $result = [
            "status" => true,
            "message" => "successfully created film",
            "data" => $film,
        ];
        return response()->json($result, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function show(Film $film)
    {   
        if(!$film){
            $result = [
                "status" => false,
                "message" => "film doesn't exist",
                "data" => $film,
            ];
    
            return response()->json($result, 200);
        }

        $film->load(['genres']);

        $result = [
            "status" => true,
            "message" => "successfully retrieved film",
            "data" => $film,
        ];

        return response()->json($result, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function edit(Film $film)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Film $film)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function destroy(Film $film)
    {
        //
    }
}
