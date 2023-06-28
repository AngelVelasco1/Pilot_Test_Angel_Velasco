fetch('./marketing_area/marketing_area.php')
  .then(response => response.json())
  .then(data => {
    
    const table = document.querySelector('#selected-table');
    data.forEach(item => {
      const row = document.createElement('tr');
      row.innerHTML = `
        <td>${item.id}</td>
        <td>${item.id_area}</td>
        <td>${item.id_staff}</td>
        <td>${item.id_position}</td>
        <td>${item.id_journeys}</td>
      `;
      table.appendChild(row);
    });
  })
  .catch(error => console.error(error));
