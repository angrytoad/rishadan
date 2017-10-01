@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        <button onclick="window.signin();">Login</button>
                        <div id="root" style="width: 320px; margin: 40px auto; padding: 10px; box-sizing: border-box;">
                            embedded area
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.auth0.com/js/lock/10.20/lock.min.js"></script>
    <script type="text/javascript">
        var lock = new Auth0Lock( '{{ env('AUTH0_CLIENT_ID') }}', '{{ env('AUTH0_DOMAIN') }}', {
            container: 'root',
            auth: {
                redirectUrl: '{{ env('AUTH0_CALLBACK_URL') }}',
                responseType: 'code',
                params: {
                    scope: 'openid profile email'
                }
            }
        });
        lock.show();
    </script>
@endsection