<?php

namespace App\Http\Controllers;

use App\Film;
use App\Comment;
use Illuminate\Http\Request;
use Validator;
use Auth;
use App\Genre;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $films = Film::with(['genres'])->paginate(1);
        
        return response()->json($films, 200);
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
        $genres = Genre::get();
        $countries = config("data.countries");

        return view('create_film', compact('genres', 'countries'));
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
            return response()->json($result, 400);
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

        $film->load(['genres', 'comments']);

        $result = [
            "status" => true,
            "message" => "successfully retrieved film",
            "data" => $film,
        ];

        return response()->json($result, 200);
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
        $film->update($request->all());

        $result = [
            "status" => true,
            "message" => "successfully updated film",
            "data" => $film,
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function destroy(Film $film)
    {
        $film->delete();

        $result = [
            "status" => true,
            "message" => "successfully removed film",
        ];

        return response()->json($result, 204);
    }

    public function addComment(Request $request, $film_slug){
        $film = Film::where(['slug' => $film_slug])->first();

        if(!$film){
            return redirect()->back()-with([
                'msg' => 'cannot comment here',
                'type' => 'warning'
            ]);
        }

        $data = $request->all();

        $rules = [
            // 'name' => 'required',
            'comment' => 'required',
        ];
        $validator = Validator::make($data, $rules);
        if($validator->fails()) {

            $result = [
                "status" => false,
                "message" => "validation error",
                "errors" => $validator->errors()->all()
            ];
            return redirect()->back()->with($result);
        }

        $user = Auth::user();

        $comment = new Comment;
        $comment->name = $user->name;
        $comment->comment = $data['comment'];
        $comment->film_id = $film->id;
        $comment->user_id = $user->id;

        $comment->save();

        return redirect()->back()->with([
            'msg' => 'Comment successful',
            'type' => 'success',
        ]);
    }


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
     * Display a single of the resource.
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

    public function submit(Request $request)
    {
        $data = $request->all();
        // dd($data);

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

            return redirect()->back()->with([
                'msg' => implode("<br />", $validator->errors()->all()),
                'type' => 'danger',
            ])
            ->withInput($request->input());
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

        return redirect()->back()->with([
            'msg' => $result['message'],
            'type' => 'success',
        ]);
    }
}
