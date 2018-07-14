@extends('layouts.master')

@section('content')
    <div class="row mt-5">
        <div class="col-md-12">

            <div class="row justify-content-center">
                <div class="col-md-7 mb-5">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h2>{{$film->name}}</h2>
                            <div>
                                @foreach($film->genres as $genre)
                                    <span class="badge badge-pill badge-secondary">{{$genre->name}}</span>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-6 text-right">
                            <div class="mb-2">
                                @for($i=0; $i < $film->rating; $i++)
                                    <i class="fa fa-star fa-2x" style="color: gold"></i>
                                @endfor
                                @for($i=$film->rating; $i < 5; $i++)
                                    <i class="fa fa-star-o fa-2x" style="color: gold"></i>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <hr />
                
                    <img class="card-img-top" src="{{$film->photo}}" alt="Card image cap">
                    <p class="mt-3">
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
                            Ticket Price
                        </div>
                        <div class="col-md-8 font-bold">
                            {{$film->ticket_price}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection