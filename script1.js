// Initialisation des icônes Lucide
lucide.createIcons();

// Configuration du graphique principal
const ctx = document.getElementById('mainChart').getContext('2d');
const mainChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['00:00', '04:00', '08:00', '12:00', '16:00', '20:00', '23:59'],
        datasets: [{
            label: 'BPM',
            data: [70, 75, 85, 80, 95, 72, 74],
            borderColor: '#38bdf8',
            tension: 0.4,
            fill: true,
            backgroundColor: 'rgba(56, 189, 248, 0.1)'
        }, {
            label: 'SpO2',
            data: [98, 97, 98, 99, 98, 98, 98],
            borderColor: '#a78bfa',
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: { grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: '#94a3b8' } },
            x: { grid: { display: false }, ticks: { color: '#94a3b8' } }
        }
    }
});