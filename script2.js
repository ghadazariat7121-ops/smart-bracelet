// Initialiser les icônes Lucide
lucide.createIcons();

// Configuration du Graphique
const ctx = document.getElementById('heartRateChart').getContext('2d');
const gradient = ctx.createLinearGradient(0, 0, 0, 400);
gradient.addColorStop(0, 'rgba(42, 133, 255, 0.6)');
gradient.addColorStop(1, 'rgba(30, 52, 81, 0)');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['00:00', '03:00', '06:00', '09:00', '12:00', '15:00', '18:00', '21:00', '23:59'],
        datasets: [{
            label: 'BPM',
            data: [40, 55, 75, 90, 85, 60, 50, 45, 55],
            backgroundColor: gradient,
            borderRadius: 5,
            borderSkipped: false,
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            y: { grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: '#676d7d' } },
            x: { grid: { display: false }, ticks: { color: '#676d7d' } }
        }
    }
});