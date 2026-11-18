const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: JSON.parse(ctx.dataset.nomMenu),
      datasets: [{
        label: 'Nombre de commandes par menu',
        data: JSON.parse(ctx.dataset.nbCommande),
        backgroundColor: '#D4A853',
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,

            ticks: {
                stepSize: 1
            }      
        }
    }
    }
});