<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div>
        {{ $users->links() }}
    </div>
    @forelse ($users as $user)
        <div>
            <div><strong>Nombre: </strong>{{ $user->name }}</div>
            <div><strong>cedula: </strong>{{ $user->identity_card }}</div>
            <div><strong>role: </strong>{{ $user->roles->name }}</div>
            @if ($user->hasRole('doctor'))
                <div><strong>Especialización: </strong>
                    @if ($user->speciality)
                        {{ $user->speciality->name }}
                    @else
                        No tiene especialización asignada.
                    @endif
                </div>
            @endif
            <div><strong>Fecha de nacimiento: </strong>{{ $user->birthday }}</div>
            <div><strong>estado: </strong>{{ $user->status }}</div>
            <div><a href="{{ route('user.show', $user->id) }}">Ver detalles</a></div>
            @if(auth()->user()->hasRole('admin'))
                <div><a href="{{ route('user.edit', $user->id) }}">Editar</a></div>
                <div>
                    <form action="{{ route('user.destroy', $user->id) }}" method='POST'>
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">Eliminar</button>
                    </form>
                </div>
            @endif
        </div>
    @empty
        <div><strong>No hay usuarios</strong></div>
    @endforelse
    <div>
        {{ $users->links() }}
    </div>
</body>
</html>