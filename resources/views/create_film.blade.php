@extends('layouts.master')

@section('content')
    <div class="row mt-5 shadow p-4">
        <div class="col-md-12">
            <h2>New Film</h2>
            <hr />

            <form action="{{route('create_film')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Film Name" required>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label>Release Date</label>
                            <input type="date" class="form-control" name="release_date" value="{{ old('release_date') }}"  placeholder="Release Date" required>
                        </div>
                    </div>
                    
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="description" placeholder="Films synopsis" required>{{ old('description') }}</textarea>
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label>Country</label>
                            <select name="country" class="form-control">
                                <option value="">--SELECT Country--</option>
                                @foreach ($countries as $country)
                                    <option value="{{$country}}" {{ old('country') == $country ? 'selected' : '' }}>{{$country}}</option>                            
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label>Rating</label>
                            <select name="rating" class="form-control">
                                <option value="">--SELECT RATING--</option>
                                <option value="1" {{ old('rating') == '1' ? 'selected' : '' }} >1</option>
                                <option value="2" {{ old('rating') == '2' ? 'selected' : '' }} >2</option>
                                <option value="3" {{ old('rating') == '3' ? 'selected' : '' }} >3</option>
                                <option value="4" {{ old('rating') == '4' ? 'selected' : '' }} >4</option>
                                <option value="5" {{ old('rating') == '5' ? 'selected' : '' }} >5</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label>Ticket Price</label>
                            <input type="number" class="form-control" name="ticket_price" value="{{old('ticket_price')}}" placeholder="How much is a ticket?" required>
                        </div>
                    </div>
                    
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label>Genre</label>
                            
                            <div class="row">
                                @foreach($genres as $genre)
                                <div class="col-md-4 col-6">
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" name="genres[]" value="{{$genre->id}}" id="genre{{$genre->id}}"
                                        {{ in_array($genre->id, old('genres', [])) ? 'checked' : '' }}
                                        >

                                        <label class="form-check-label" for="genre{{$genre->id}}">{{ucFirst($genre->name)}}</label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label>Film Image</label>
                            <input type="file" name="photo" class="form-control" required />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-block btn-primary">Add Film</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection