@extends('app')
@section('title', 'Welcome')
@section('content')
    <div id="welcome" class="main">
        @include('includes.flash_message')
        <div id="quick_search">
            <!--
            Quick search bar with minimal filters
             -->
        </div>
        <div id="recent_trades">
            <!--
            Display recent trades between users
            -->
        </div>
        <div id="recent_set">
            <!--
            Display the most recent set and link to page that shows all the cards in that set
            -->
        </div>
        <div id="trending_cards">
            <!--
            Look at trade data and work out which cards are most popular
            -->
        </div>
        <div id="top_sellers">
            <!--
            Display the top 15 sellers on the website by rating
            -->
        </div>
        <div id="account_creation_advertisement">
            <!--
            Small Advertisement to encourage people who aren't signed up to do so.
            -->
        </div>
        <div id="user_storefront">
            <!--
            Personalised section that shows how many items you have on your storefront, with a button to encourage you to
            add more to the store
            -->
        </div>
        <div id="user_trade_information">
            <!--
            Information about how many trades the user has conducted in the last 30 days.
            -->
        </div>

        <div class="row">
            <form action="{{ route('search.card') }}" method="POST">
                <div class="col-xs-12">
                    <p>Quick Search</p>
                </div>
                <div id="card_search_input" class="col-xs-12 col-md-8">
                    <div class="form-group">
                        {{ csrf_field() }}
                        <input
                                class="col-xs-12 form-control"
                                type="text"
                                name="search"
                                placeholder="Please search for the card name here | min 4 characters"
                                value="{{ old('card') }}"
                        />
                    </div>
                </div>
                <div class="col-xs-12 col-md-4">
                    <button class="btn btn-info">Search</button>
                </div>
            </form>
        </div>
    </div>
@endsection
