@extends('layouts.master')

@section('css')
<style>
    .card-img-top{
        height: 250px;
        {{-- background-image: url('../images/home-top.svg'); --}}
        background-repeat: no-repeat;
        background-position: bottom center;
        background-size: cover;
    }
    .truncate {
        width: 100%;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
      }
</style>
@endsection

@section('content')
    <div class="row mt-5">
        <div class="col-md-12">
            <h2>Films</h2>
            <hr />

            <div class="row">
                @foreach($films as $film)
                <div class="col-md-4 mb-5">
                    <div class="card">
                        <div class="card-img-top" style="background-image: url('{{$film->photo}}')" alt="Card image cap"></div>
                        <div class="card-body">
                            <h5 class="card-title truncate mb-0">{{$film->name}}</h5>
                            <div class="mb-2 truncate">
                                @foreach($film->genres as $genre)
                                <span class="badge badge-pill badge-secondary">{{$genre->name}}</span>
                                @endforeach
                            </div>
                            <p class="card-text truncate" title="{{$film->description}}">
                                {{$film->description}}
                            </p>
                            <div class="row mb-2">
                                <div class="col-md-4 text-muted">
                                    Release
                                </div>
                                <div class="col-md-8 font-bold truncate">
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