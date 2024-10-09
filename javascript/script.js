document.querySelector('form').
addEventListener('submit', function(event)
{
    event.preventDefault();

    const nombre = document.getElementById('nombre').value;
    const estreno = document.getElementById('estreno').value;
    const genero = document.getElementById('genero').value;
    if (!nombre || !estreno || !genero)
    {
        alert('Todos los campos son obligatorios.');
    }
}
);