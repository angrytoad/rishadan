@extends('app')
@section('title', 'Search for a card' )
@section('content')
    <div id="card_search" class="main">
        @include('includes.flash_message')
        <h1 class="title">Card Search</h1>
        <div class="row">
            <form action="{{ route('search.card') }}" method="POST">
                <div id="card_search_input" class="col-xs-12">
                    <div class="form-group">
                        <label for="card">Enter keywords</label>
                        {{ csrf_field() }}
                        <input
                                class="col-xs-12 form-control"
                                type="text"
                                name="search"
                                placeholder="Please search for the card name here | min 4 characters"
                                value="{{ old('search') }}"
                        />
                    </div>
                </div>
                <div class="col-xs-12">
                    <button class="btn btn-info">Search</button>
                </div>
            </form>
        </div>
        <div class="row">
            @if(isset($results))
                <div id="card_search_results" class="col-xs-12">
                    <p>Total Results : {{ count($results) }}</p>
                    @foreach($results as $card)
                        <div class="col-xs-12">
                            <h2>{{ $card->name }}</h2>
                            @foreach($card->sets as $set)
                                <p>{{ $set->name }}</p>
                            @endforeach
                            <img src="{{$card->image_url}}" />
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
@section('scripts')
    <script>

    </script>
@endsection
