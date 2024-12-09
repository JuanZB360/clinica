<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div>
        @foreach ($appointments as $appointment)
            <div>
                @foreach ($appointment->users as $user)
                    @if ($user->hasRole('doctor'))
                        <h3>Doctor: {{$user->name}}</h3>
                    @endif
                    @if ($user->hasRole('patient'))
                        <h3>Paciente: {{$user->name}}</h3>
                    @endif
                @endforeach
                <p>Fecha de la cita: {{$appointment->appointment_date}}</p>
                <p>Razon: {{$appointment->reason}}</p>
            </div>
        @endforeach
    </div>
</body>
</html>