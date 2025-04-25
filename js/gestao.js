const data = {
    '07h': [40, 20, 10, 30],
    '12h': [30, 25, 20, 25],
    '17h': [50, 15, 20, 15],
    '20h': [20, 35, 30, 15]
};

const ctx = document.getElementById('myPieChart').getContext('2d');
let myPieChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Linha A', 'Linha B', 'Linha C', 'Linha D'],
        datasets: [{
            data: data['07h'],
            backgroundColor: ['#ff6384', '#36a2eb', '#ffce56', '#4bc0c0']
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position: 'top' },
            title: { display: true, text: 'Uso das Linhas nos Horários de Pico' }
        }
    }
});

function updateChart() {
    const selectedTime = document.getElementById('timeSelect').value;
    myPieChart.data.datasets[0].data = data[selectedTime];
    myPieChart.update();
}