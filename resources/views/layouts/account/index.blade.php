@extends('app')

@section('content')
    <div id="account" class="main">
        @include('includes.flash_message')
        <div id="account_blocks_wrapper">
            <div id="address_settings">
                <h4 class="subtitle">My Addresses</h4>
                <div id="address_settings_wrap">
                    @foreach(Auth::user()->addresses as $address)
                        <a href="/me/account/address/{{$address->id}}">
                            <div class="address">
                                <div class="address_cell">
                                    <p>
                                        {{ $address->first_line }}, {{ $address->second_line }}
                                    </p>
                                    <p>
                                        {{ $address->postcode }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                    @if(count(Auth::user()->addresses) === 0)
                        <a href="{{ route('account.add_address') }}">
                            <div class="address">
                                <div class="address_cell">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                    <p>Add a new address</p>
                                </div>
                            </div>
                        </a>
                    @endif
                </div>
            </div>
            <div id="account_settings">
                <h4 class="subtitle">My Account</h4>
            </div>
            <div id="profile_information">
                <h4 class="subtitle">My Profile</h4>
            </div>
        </div>
    </div>
@endsection
