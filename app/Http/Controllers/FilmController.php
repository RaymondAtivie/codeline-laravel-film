<?php

namespace App\Http\Controllers;

use App\Film;
use Illuminate\Http\Request;

class FilmController extends Controller
{
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

        $film = new Film;
        $film->name = $data['name'];
        $film->description = $data['description'];
        $film->release_date = $data['release_date'];
        $film->rating = $data['rating'];
        $film->ticket_price = $data['ticket_price'];
        $film->country = $data['country'];

        //? TODO: upload file and save picture 
        $film->photo = $data['photo'];

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
