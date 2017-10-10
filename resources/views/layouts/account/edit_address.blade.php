@extends('app')
@section('title', 'Edit my address')
@section('content')
    <div id="account_add_address" class="main">
        @include('includes.flash_message')
        <h4 class="subtitle">Edit my address</h4>
        <form method="POST" action="{{ route('post.account.edit_address', ['uuid' => $address->id]) }}">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                        <label for="first_Line" class="control-label">First Line*</label>
                        <input type="text" name="first_line" placeholder="First Line" required class="form-control" value="{{ $address->first_line }}"/>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                        <label for="second_line" class="control-label">Second Line*</label>
                        <input type="text" name="second_line" placeholder="Second Line" required class="form-control" value="{{$address->second_line }}"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                        <label for="city" class="control-label">City*</label>
                        <input type="text" name="city" placeholder="City" required class="form-control" value="{{ $address->city }}"/>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                        <label for="postcode" class="control-label">Postcode*</label>
                        <input type="text" name="postcode" placeholder="Postcode"required class="form-control" value="{{ $address->postcode }}"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                        <label for="country" class="control-label">Country*</label>
                        @include('includes.form.countries')
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <button class="btn btn-primary">Edit this address</button>
                </div>
                <div class="col-xs-12 col-md-6">
                    <button type="button" class="btn btn-danger" onclick="confirmDelete()">Delete this address</button>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
    <script>
        function confirmDelete(){
            vex.dialog.confirm({
                message: 'Are you absolutely sure you want to delete this address?',
                callback: function (value) {
                    if(value){
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: '{{route('post.account.delete_address', ['uuid' => $address->id])}}',
                            type: 'DELETE',
                            success: function(result) {
                                window.location.href = '{{ route('account') }}'
                            }
                        });
                    }
                }.bind(this)
            })
        }
    </script>
@endsection
