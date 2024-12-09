<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div><a href="{{route('user.index')}}">volver a usuarios</a></div>
    <div>
        <div><strong>Nombre: </strong>{{ $user->name }}</div>
        <div><strong>cedula: </strong>{{ $user->identity_card }}</div>
        @if ($user->hasRole('doctor'))
            <div><strong>especialización: </strong>{{ $user->speciality->name }}</div>
        @endif
        <div><strong>Fecha de nacimiento: </strong>{{ $user->birthday }}</div>
        <div><strong>estado: </strong>{{ $user->status }}</div>
        <div><a href="{{ route('user.edit', $user->id) }}">editar</a></div>
        @if (Auth::user()->hasRole('admin')) 
            <div>
                <form action="{{ route('user.destroy', $user->id) }}" method='POST'>
                    @csrf
                    @method('PATH')
                    <button type="submit" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">Eliminar</button>
                </form>
            </div>
        @endif
    </div>
</body>
</html>