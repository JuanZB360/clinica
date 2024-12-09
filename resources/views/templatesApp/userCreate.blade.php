<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ isset($user) ? 'Editar Usuario' : 'Crear Usuario' }}</title>
</head>
<body>
    <div>
        <div><a href="{{route('user.index')}}">volver a usuarios</a></div>
        
        <h1>{{ isset($user) ? 'Editar Usuario' : 'Crear Usuario' }}</h1>

        <form action="{{ isset($user) ? route('user.update', $user->id) : route('user.store') }}" method="POST">

            @csrf
            
            @if(isset($user))
                @method('PUT')
            @endif


            <div>
                <label for="name">Nombre:</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name ?? '') }}">
                @error('name')
                    <div style="color: red;" class="error">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="email">Correo Electrónico:</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email ?? '') }}">
                @error('email')
                    <div style="color: red;" class="error">{{ $message }}</div>
                @enderror
            </div>

            @if(!isset($user))
                <div>
                    <label for="password">Contraseña:</label>
                    <input type="password" name="password" id="password">
                    @error('password')
                        <div style="color: red;" class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation">Confirmar Contraseña:</label>
                    <input type="password" name="password_confirmation" id="password_confirmation">
                </div>
            @endif

            <div>
                <label for="identity_card">Cédula:</label>
                <input type="text" name="identity_card" id="identity_card" value="{{ old('identity_card', $user->identity_card ?? '') }}">
                @error('identity_card')
                    <div style="color: red;" class="error">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="birthday">Fecha de Nacimiento:</label>
                <input type="date" name="birthday" id="birthday" value="{{ old('birthday', $user->birthday ?? '') }}">
                @error('birthday')
                    <div style="color: red;" class="error">{{ $message }}</div>
                @enderror
            </div>

            @if (auth()->user()->hasRole('admin'))
                <div>
                    <label for="speciality_id">Especialidad:</label>
                    <select name="speciality_id" id="speciality_id">
                        <option value="">Seleccione una especialidad</option>
                        @foreach($specialities as $speciality)
                            <option value="{{ $speciality->id }}" {{ old('speciality_id', $user->speciality_id ?? '') == $speciality->id ? 'selected' : '' }}>
                                {{ $speciality->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('speciality_id')
                        <div style="color: red;" class="error">{{ $message }}</div>
                    @enderror
                </div>
            @endif

            <div>
                <button type="submit">{{ isset($user) ? 'Actualizar Usuario' : 'Crear Usuario' }}</button>
            </div>
        </form>
    </div>
    <script>
        setTimeout(() => {
            const messages = document.getElementsByClassName('error');
            for (let i = 0; i < messages.length; i++) {
                messages[i].style.display = 'none';
            }
        }, 3000);
    </script>
</body>
</html>
