<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $titre }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            font-size: 20px;
            text-align: center;
            margin-bottom: 20px;
        }

        .ticket-details {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
        }

        .ticket-details h2 {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .ticket-details p {
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>{{ $titre }}</h1>
        <div class="ticket-details">
            <h2>Ticket Information</h2>
            <p><strong>Ticket ID:</strong> {{ $ticket_id }}</p>
            <p><strong>User Name:</strong> {{ $username }}</p>
            <p><strong>Email:</strong> {{ $email }}</p>
            <p><strong>Event:</strong> {{ $event }}</p>
            <p><strong>Location:</strong> {{ $location }}</p>
            <p><strong>Description:</strong> {!! $description !!}</p>
            <p><strong>Date Start:</strong> {{ $date }}</p>
        </div>
    </div>
</body>

</html>