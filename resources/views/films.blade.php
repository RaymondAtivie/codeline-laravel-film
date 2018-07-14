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
    <div class="row mt-5" id="vue-film-app">
        <div class="col-md-12">
            <h2>Films</h2>
            <hr />
            <div class="row justify-content-center">
                {{-- @foreach($films as $film) --}}
                <div class="col-md-4 mb-5" v-for="film in films" :key="film.id">
                    <div class="card">
                        <div class="card-img-top" :style="{'background-image': 'url('+film.photo+')'}" alt="Card image cap"></div>
                        <div class="card-body">
                            <h5 class="card-title truncate mb-0">@{{film.name}}</h5>
                            <div class="mb-2 truncate">
                                <span class="badge badge-pill badge-secondary mr-1" v-for="genre in film.genres" :key="genre.id">@{{genre.name}}</span>
                            </div>
                            <p class="card-text truncate" :title="film.description">
                                @{{film.description}}
                            </p>
                            <div class="row mb-2">
                                <div class="col-md-4 text-muted">
                                    Release
                                </div>
                                <div class="col-md-8 font-bold truncate">
                                    @{{film.release_date}} (@{{film.country}})
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 text-muted">
                                    Ticket
                                </div>
                                <div class="col-md-8 font-bold">
                                    @{{film.ticket_price}}
                                </div>
                            </div>

                            <div class="my-2 mt-3">
                                <template v-for="n in 5">
                                    <i v-if="n <= film.rating" class="fa fa-star fa-2x" style="color: gold"></i>
                                    <i v-else class="fa fa-star-o fa-2x" style="color: gold"></i>
                                </template>
                                &nbsp;
                            </div>
                            <a :href="film.url" class="btn btn-sm mt-3 btn-success">View Details</a>
                        </div>
                    </div>
                </div>
                {{-- @endforeach --}}
            </div>

            <div class="row justify-content-center">
                <div class="col-md-2 col-6">
                    <button class="btn btn-block mb-2 btn-info" :disabled="!prev_url" @click="gotoPrev">Previous</button>
                </div>
                <div class="col-md-2 col-6">
                    <button class="btn btn-block mb-2 btn-info" :disabled="!next_url" @click="gotoNext">Next</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
<script>
    var first_url = "{{url('/api/films')}}";

    var app = new Vue({
        el: '#vue-film-app',
        data: {
            message: 'Hello Vue!',
            films: [],
            metadata: null,
            loaded: false,
            loading: false,
            next_url: null,
            prev_url: null,
        },
        methods: {
            gotoNext(){
                this.getData(this.next_url);
            },
            gotoPrev(){
                this.getData(this.prev_url);
            },
            getData(url){
                axios.get(url)
                    .then(({data}) => {
                        console.log(data);

                        this.films = data.data;
                        this.next_url = data.next_page_url;
                        this.prev_url = data.prev_page_url;
                    })
                    .catch()
                    .then(() => {
                        this.loaded = true;
                        this.loading = false;
                    })
            }
        },
        created(){
            this.getData(first_url);
        }
    });
</script>
@endsection