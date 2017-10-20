@extends('app')
@section('title', $collection->name )
@section('content')
    <div id="collection_view" class="main">
        @include('includes.flash_message')
        <h1 class="title">{{ $collection->name }}</h1>
        <h4 id="collection_view_card_count">Total Cards in this Collection: {{ count($collection->cards) }}</h4>
        <div id="collection_view_buttons">
            <a href="{{ route('search.card') }}"><button class="btn btn-success">Add cards</button></a>
        </div>




        <div id="collection_view_extra">
            <div id="collection_view_extra_hover">
                <i class="fa fa-cogs" aria-hidden="true"></i>
                <i class="fa fa-caret-down" aria-hidden="true"></i>
            </div>
            <div id="collection_view_extra_menu" class="hidden">
                <button class="btn btn-info" onclick="confirmDelete()">Rename this collection</button>
                <button class="btn btn-danger" onclick="confirmDelete()">Delete this collection</button>
            </div>
        </div>

    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){

           $('#collection_view_extra').mouseenter(function(){
              $('#collection_view_extra_menu').removeClass('hidden');
           });

            $('#collection_view_extra').mouseleave(function(){
                $('#collection_view_extra_menu').addClass('hidden');
            });
        });

        function confirmDelete()
        {
            vex.dialog.confirm({
                message: 'Are you absolutely sure you want to delete this collection? Any cards will also be removed alongside it.',
                callback: function (value) {
                    if(value === true){
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            method: "DELETE",
                            url: "{{ route('collection.view', $collection->id) }}",
                        })
                        .done(function( data ) {
                            location.href = '{{ route('collection') }}';
                        });
                    }
                }
            })
        }
    </script>
@endsection
