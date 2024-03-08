@extends('layout')

@section('content')
<!-- Header End -->
<div class="container-fluid">
    <div class="card">

        <div class="d-flex justify-content-between align-items-center mb-3" id="header2">
            <div>
                <button type="button" class="btn btn-primary btn-lg me-2" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Add Category</button>
            </div>
            <div>
                <!-- You can add any additional controls or information here if needed -->
            </div>
        </div>

        <table class="table table-stripe align-middle mb-0 bg-white">
            <thead class="bg-light">
                <tr>
                    <th>UserName</th>
                    <th></th>
                    <th>Event</th>
                    <th></th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->user->name }}</td>
                    <td></td>
                    <td>{{ $reservation->event->titre }}</td>
                    <td></td>

                    <td>
                       <div class="btn-group" role="group" aria-label="Reservation actions">
                           <form action="{{ route('StatusAccepted', ['id' => $reservation->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">Accept</button>
                            </form>
                            
                            <form action="{{ route('StatusRefused', ['id' => $reservation->id]) }}" method="POST">
                                @csrf
                               <button type="submit" class="btn btn-danger">Refuse</button>
                           </form>
                       </div>
                    </td>

                </tr>
                @endforeach
                </tr>
            </tbody>
        </table>
    </div>
</div>



@endsection

<script src="Pback/assets/libs/jquery/dist/jquery.min.js"></script>
<script src="Pback/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="Pback/assets/js/sidebarmenu.js"></script>
<script src="Pback/assets/js/app.min.js"></script>
<script src="Pback/assets/libs/simplebar/dist/simplebar.js"></script>


</body>

</html>