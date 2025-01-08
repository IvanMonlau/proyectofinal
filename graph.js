
const ctx = document.getElementById('myChart').getContext('2d');
const canvas = ctx.canvas;
canvas.width = canvas.parentElement.clientWidth;
canvas.height = canvas.parentElement.clientHeight;

const myChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ['Total orders', 'Total Sales'],
    datasets: [{
      label: 'Quantity',
      data: [10293, 89000],
      backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(75, 192, 192, 0.2)'],
      borderColor: ['rgba(255, 99, 132, 1)', 'rgba(75, 192, 192, 1)'],
      borderWidth: 2
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    },
    plugins: {
      legend: {
        display: true, // Mostrar la leyenda
        labels: {
          color: 'white' // Color de las etiquetas de la leyenda
        }
      }
    }
  }
});