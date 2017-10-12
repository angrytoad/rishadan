@extends('app')

@section('content')
<div id="dashboard" class="main">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                @if ($errors->any())
                    {{ $errors->first() }}
                @endif
            </div>
            <div class="panel-body">
                @if (Auth::user())
                    <a href="/">Return to Dashboard</a>
                @else
                    <p>Didn't recieve our verification email?</p>
                    <p>Fill out this simple form to recieve a second email.</p>
                    <form method="post">
                        {{ csrf_field() }}
                        <input name="email" type="text" placeholder="Email">
                        <button type="submit">Send</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection