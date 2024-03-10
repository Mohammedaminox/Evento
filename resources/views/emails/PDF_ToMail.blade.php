<!DOCTYPE html>
<html>
<head>
    <title>{{ $titre }}</title>
</head>
<body>
    <p>Hello {{ $username }},</p>
    <p>Please find your ticket details attached.</p>
    <p>Event: {{ $event }}</p>
    <p>Location: {{ $location }}</p>
    <p>Description: {!! $description !!}</p>
    <p>Date: {{ $date }}</p>
    <p>Thank you!</p>
</body>
</html>
