@extends('layouts.master')

@section('content')
    <div class="row mt-5">
        <div class="col-md-12">
            <h2>Films</h2>
            <hr />

            <div class="row">
                @foreach($films as $film)
                <div class="col-md-4 mb-5">
                    <div class="card">
                        <img class="card-img-top" src="{{$film->photo}}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title mb-0">{{$film->name}}</h5>
                            <div class="mb-2">
                                @foreach($film->genres as $genre)
                                <span class="badge badge-pill badge-secondary">{{$genre->name}}</span>
                                @endforeach
                            </div>
                            <p class="card-text">
                                {{$film->description}}
                            </p>
                            <div class="row">
                                <div class="col-md-4 text-muted">
                                    Release
                                </div>
                                <div class="col-md-8 font-bold">
                                    {{$film->release_date}} ({{$film->country}})
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 text-muted">
                                    Ticket
                                </div>
                                <div class="col-md-8 font-bold">
                                    {{$film->ticket_price}}
                                </div>
                            </div>

                            <div class="my-2 mt-3">
                                @for($i=0; $i < $film->rating; $i++)
                                    <i class="fa fa-star fa-2x" style="color: gold"></i>
                                @endfor
                                @for($i=$film->rating; $i < 5; $i++)
                                    <i class="fa fa-star-o fa-2x" style="color: gold"></i>
                                @endfor
                                &nbsp;
                            </div>
                            <a href="{{route('single_film', ['film_slug' => $film->slug])}}" class="btn btn-sm mt-3 btn-success">View Details</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection