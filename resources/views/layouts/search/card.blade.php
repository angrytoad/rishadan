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
                        <input class="col-xs-12 form-control" type="text" name="card" placeholder="Please enter the name of the card" value="{{ old('card') }}"/>
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
                </div>
            @endif
        </div>
    </div>
@endsection
@section('scripts')
    <script>

    </script>
@endsection
