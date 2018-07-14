@extends('layouts.master')

@section('content')
    <div class="row mt-5">
        <div class="col-md-12">
            <h2>Films</h2>
            <hr />

            <div class="row">
                @foreach($films as $film)
                <div class="col-md-4 mb-5">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="{{$film->photo}}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{$film->name}}</h5>
                            <p class="card-text">
                                {{$film->description}}
                            </p>
                            <div>
                                Release Date: {{$film->release_date}}
                            </div>
                            <div>
                                Ticket Price: {{$film->ticket_price}}
                            </div>
                            <div class="mb-2">
                                @foreach($film->genres as $genre)
                                <span class="badge badge-pill badge-secondary">{{$genre->name}}</span>
                                @endforeach
                            </div>
                            <a href="#" class="btn btn-sm mt-3 btn-success">View Details</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection