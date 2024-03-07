@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Events</div>

                <div class="card-body">
                    <!-- Button to trigger modal -->
                    <button type="button" class="btn btn-primary">
                        Add Event
                    </button>
                </div>
            </div>
            @foreach ($Acceptevents as $Acceptevent)
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="{{ asset('Pback/assets/images/' . $Acceptevent->image) }}" class="img-fluid" alt="Acceptevent Image">
                        </div>
                        <div class="col-md-9">
                            <p class="card-text">{!! $Acceptevent->description !!}</p>
                        </div>
                    </div>

                    <h5 class="card-title">{{ $Acceptevent->titre }}</h5>
                    <h5 class="card-title">{{ $Acceptuser }}</h5>

                    <div class="row">
                        <div class="col-3">
                            <b>Categorie:</b> {{ $Acceptevent->categories->name }}
                        </div>
                        <div class="col-2">
                            <b>Places:</b> {{ $Acceptevent->places }}
                        </div>
                        <div class="col-3">
                            <b>Location:</b> {{ $Acceptevent->location }}
                        </div>
                        <div class="col-4 mb-2">
                            <b>Date:</b> {{ $Acceptevent->date }}
                        </div>
                    </div>
                    <form action="{{ route('approuve', ['id' => $Acceptevent->id]) }}" method="POST">
                      @csrf
                          <button type="submit" class="btn btn-success">Approuve</button>
                    </form>


                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>

<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .then(editor => {
            console.log(editor);
        })
        .catch(error => {
            console.error(error);
        });
    ClassicEditor
        .create(document.querySelector('#editorAddevent'))
        .then(editor => {
            console.log(editor);
        })
        .catch(error => {
            console.error(error);
        });
</script>

<script src="Pback/assets/libs/jquery/dist/jquery.min.js"></script>
<script src="Pback/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="Pback/assets/js/sidebarmenu.js"></script>
<script src="Pback/assets/js/app.min.js"></script>
<script src="Pback/assets/libs/simplebar/dist/simplebar.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection