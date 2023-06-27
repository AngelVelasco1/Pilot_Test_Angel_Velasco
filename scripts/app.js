// Realizar la solicitud AJAX al archivo PHP
fetch('ruta_al_archivo/get_data.php')
  .then(response => response.json())
  .then(data => {
    // Trabajar con los datos obtenidos
    console.log(data); // Imprime los datos en la consola
    
    // Ejemplo: Mostrar los datos en el documento HTML
    const tableBody = document.querySelector('#marketingTable tbody');
    data.forEach(item => {
      const row = document.createElement('tr');
      row.innerHTML = `
        <td>${item.id}</td>
        <td>${item.area}</td>
        <td>${item.staff}</td>
        <td>${item.position}</td>
        <td>${item.journey}</td>
      `;
      tableBody.appendChild(row);
    });
  })
  .catch(error => console.error(error));
