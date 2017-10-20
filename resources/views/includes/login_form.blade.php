<div id="login_form">
    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}

        <div class="row">
            <div class="col-xs-12 col-md-6">
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="control-label">E-Mail</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            <div class="col-xs-12 col-md-6">
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="control-label">Password</label>
                    <input id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-4">
                <div class="row">
                    <button type="submit" class="btn btn-primary btn-xs col-xs-12">
                        Login
                    </button>
                </div>
            </div>
            <div class="col-xs-12 col-md-offset-2 col-md-4">
                <div class="row">
                    <a id="register" href="{{ route('register') }}">
                        <button type="button" class="btn btn-xs col-xs-12">
                            Register
                        </button>
                    </a>
                </div>

            </div>
        </div>




    </form>
</div>