@extends('layouts.master')

@section('content')
    <div class="row mt-5">
        <div class="col-md-12">

            <div class="row justify-content-center">
                <div class="col-md-10 mb-5">

                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h2>{{$film->name}}</h2>
                            <div>
                                @foreach($film->genres as $genre)
                                    <span class="badge badge-pill badge-secondary">{{$genre->name}}</span>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-6 text-md-right mt-2 text-sm-left">
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
                    <div class="row mb-2">
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

            <div class="row justify-content-center">
                <div class="col-md-10">
                    <h4>Comments</h4>
                    <hr />

                    @if($film->comments()->count() < 1)
                        <div class="alert alert-info">
                            No comments for this film!
                        </div>
                    @endif

                    @if(\Auth::user())
                    <form action="{{route('add_comment', ['film_slug' => $film->slug])}}" method="POST">
                        {{csrf_field()}}
                        <div class="row mb-3">
                            <div class="col-md-12 mb-3">
                                <div class="mt-2">
                                    <textarea name="comment" class="form-control" placeholder="Make a comment" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-block btn-primary">Comment</button>
                            </div>
                        </div>
                    </form>
                    
                    <hr />
                    @else
                        <div class="alert alert-info">
                            Login to add a comment
                        </div>
                    @endif
                    
                    @foreach ($film->comments as $comment)
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div><b>{{$comment->name}}</b></div>
                                <div>
                                    {{$comment->comment}}
                                </div>
                                <small class="text-muted">
                                    <i>{{$comment->created_at->diffForHumans()}}</i>
                                </small>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection