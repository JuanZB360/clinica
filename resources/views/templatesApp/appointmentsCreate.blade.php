<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mostrar Fechas Disponibles</title>
</head>
<body>
    <div>
        <form action="{{route('appointment.store')}}" method="POST">
            @csrf
            <label for="identity_card">Numero de identidad:</label>
            <input type="text" id="identity_card" name="identity_card">
            @error('identity_card')
                <div class="error">{{ $message }}</div>
            @enderror
            <label for="reason">Motivo de Cita:</label>
            <input type="text" id="reason" name="reason">
            @error('reason')
                <div class="error">{{ $message }}</div>
            @enderror
            <label for="appointment_date">Selecciona la fecha y hora:</label>
            <input type="datetime-local" id="appointment_date" name="appointment_date">
            @error('appointment_date')
                <div class="error">{{ $message }}</div>
            @enderror
            <p id="error_message" style="color: red; display: none;">La hora debe ser múltiplo de 30 minutos.</p>

            <button type="submit">Agendar Cita</button>
        </form>
    </div>
    <div>
        <button id="showDates">Mostrar Fechas Disponibles</button>

        <div id="availableContent" style="display: none;"></div>
    </div>

    <script>
        const arrayDates = @json($appointments)@json($appointments).map(date => 
            new Date(date).toISOString().slice(0, 19).replace('T', ' ')
        );

        function availableDates() {

            if (arrayDates.length === 0) {
                console.error("No hay fechas disponibles en el arreglo.");
                return;
            }

            let currentDate = new Date();
            let lastDate = new Date(arrayDates[arrayDates.length - 1]);

            const contentDate = document.getElementById("availableContent");
            contentDate.innerHTML = '';

            while (currentDate.getTime() <= lastDate.getTime()) {
                const formattedDate = currentDate.toISOString().slice(0, 19).replace('T', ' ');

                if (!arrayDates.includes(formattedDate)) {
                    const divDate = document.createElement("div");
                    divDate.textContent = `Fecha libre: ${formattedDate}`;
                    contentDate.appendChild(divDate);
                }

                currentDate.setMinutes(currentDate.getMinutes() + 30);
                if(currentDate.getTime() === new Date(arrayDates[arrayDates.length - 1]).getTime()){
                    const finalDiv = document.createElement("div");
                    finalDiv.textContent = `A partir de esta Fecha ${formattedDate} puedes agendar la cita en cualquier fecha`;
                    contentDate.appendChild(finalDiv)
                }
            }
        }

        document.getElementById("showDates").addEventListener("click", function() {
            const contentDates = document.getElementById("availableContent");
            if (contentDates.style.display === "none") {
                availableDates();
                contentDates.style.display = "block";
            } else {
                contentDates.style.display = "none"; 
            }
        });

        const appointmentInput = document.getElementById('appointment_date');
        const errorMessage = document.getElementById('error_message');
    
        appointmentInput.addEventListener('change', function () {
            const selectedDateTime = new Date(appointmentInput.value);
            const selectedMinutes = selectedDateTime.getMinutes();
    
            if (selectedMinutes % 30 !== 0) {
                errorMessage.style.display = 'block'; 
                appointmentInput.setCustomValidity('La hora debe ser múltiplo de 30 minutos');
            } else {
                errorMessage.style.display = 'none'; 
                appointmentInput.setCustomValidity('');
            }
        });
    
        setTimeout(() => {
            const messages = document.getElementsByClassName('error');
            for (let i = 0; i < messages.length; i++) {
                messages[i].style.display = 'none';
            }
        }, 3000);
        
    </script>
    
</body>
</html>
