@extends('app')
@section('title', 'My Collection')
@section('content')
    <div id="collection" class="main">
        @include('includes.flash_message')
        <div id="collection_wrapper">
            @foreach($collections as $collection)
                <a href="{{ route('collection.view', $collection->id) }}">
                    <div class="collection_item">
                        <div class="collection_info">
                            <i class="fa fa-book" aria-hidden="true"></i>
                            <p>{{ $collection->name }}</p>
                            <p class="sub_data"><small>Created: {{ \Carbon\Carbon::parse($collection->created_at)->toFormattedDateString() }}</small></p>
                        </div>
                    </div>
                </a>
            @endforeach
                <div class="collection_item">
                    <div class="collection_info" onclick="newCollectionModalDialogue()">
                        <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                        <p>Create a new collection</p>
                        <p class="sub_data"><small>Total: {{ count($collections) }}</small></p>
                    </div>
                </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function newCollectionModalDialogue()
        {
            vex.dialog.prompt({
                message: 'Please enter a name for your new collection',
                placeholder: 'Collection name',
                callback: function (value) {
                    if(value !== false){
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            method: "POST",
                            url: "/me/collection/create",
                            data: { name: value }
                        })
                        .done(function( data ) {
                            var uuid = data.uuid;
                            location.reload();
                        });
                    }
                }
            })
        }
    </script>
@endsection
