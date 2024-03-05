@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Events</div>

                <div class="card-body">
                    <!-- Button to trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addeventModal">
                        Add Event
                    </button>
                </div>
            </div>
            @foreach ($events as $event)
            <div class="card mb-3">
                <img src="{{ asset('Pback/assets/images/' . $event->image) }}" class="card-img-top w-25" alt="event Image">
                <div class="card-body">
                    <h5 class="card-title">{{ $event->titre }}</h5>
                    <p class="card-text">{!! $event->description !!}</p>
                    <p><b>Categories:</b>
                        @foreach ($event->categories as $category)
                        ,{{ $category->name }}
                        @endforeach
                    </p>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editeventModal{{ $event->id }}">Edit</button>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal{{ $event->id }}">Delete</button>


                    <!-- Delete Confirmation Modal -->
                    <div class="modal fade" id="confirmDeleteModal{{ $event->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel{{ $event->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmDeleteModalLabel{{ $event->id }}">
                                        Confirm Delete</h5>

                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this event?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <!-- Form to submit delete request -->
                                    <form action="{{ route('event.destroy', $event->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Edit event Modal -->
                <div class="modal fade" id="editeventModal{{ $event->id }}" tabindex="-1" role="dialog" aria-labelledby="editeventModalLabel{{ $event->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editeventModalLabel{{ $event->id }}">Edit
                                    event</h5>

                            </div>
                            <div class="modal-body">
                                <form action="{{ route('event.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <!-- Your form fields go here -->
                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input type="file" class="form-control-file" id="images" name="images">
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" id="title" name="title" value="{{ $event->title }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="content">Content</label>
                                        <textarea class="form-control" id="editor" name="content" rows="6">{{ $event->content }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="user_id">User</label>
                                        <select class="form-control" id="user_id" name="user_id">
                                            @foreach ($users as $user)
                                            <option value="{{ $user->id }}" {{ $event->user_id == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="categories">Categories</label>
                                        <select class="form-control" id="categories" name="categories[]" multiple>
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ in_array($category->id, $event->categories->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Add event Modal -->
    <div class="modal fade" id="addeventModal" tabindex="-1" role="dialog" aria-labelledby="addeventModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addeventModalLabel">Add event</h5>

                </div>
                <form action="{{ url('event') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="eventImage">Image</label>
                            <input type="file" class="form-control-file" id="images" name="images">
                        </div>
                        <div class="form-group">
                            <label for="eventTitle">Titre</label>
                            <input type="text" class="form-control" id="eventTitle" name="titre" placeholder="Enter title">
                        </div>
                        <div class="form-group">
                            <label for="eventPlaces">Places</label>
                            <input type="number" min="1" class="form-control" id="eventPlaces" name="places" placeholder="Enter places">
                        </div>
                        <div class="form-group">
                            <label for="eventLocation">Location</label>
                            <input type="text" class="form-control" id="eventLocation" name="location" placeholder="Enter location">
                        </div>
                        <div class="form-group">
                            <label for="editor">Description</label>
                            <!-- CKEditor WYSIWYG Editor -->
                            <textarea name="description" id="editorAddevent"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="eventDate">Date</label>
                            <input type="date" class="form-control" id="eventDate" name="date" placeholder="Enter date">
                        </div>
                        <div class="form-group">
                            <label for="userId">User</label>
                            <select class="form-control" id="userId" name="user_id">
                                <!-- Populate options with user IDs -->
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="categories">Categories</label>
                            <select class="form-control" id="categories" name="categories">
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="typeAccept">Type Acceptation</label>
                            <select class="form-control" id="typeAccept" name="typeAccept">
                                <option value="automatique">Automatique</option>
                                <option value="manuelle">Manuelle</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
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





    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarmenu.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @endsection