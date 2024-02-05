<!DOCTYPE html>
<html>
<head>
    <title>User Creation Chart</title>
    <!-- Inclure Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="userCreationChart" width="400" height="200"></canvas>

    <script>
        // Récupérer les données du contrôleur
        var labels = @json($labels);
        var data = @json($data);

        // Créer le graphique avec Chart.js
        var ctx = document.getElementById('userCreationChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Nombre d\'utilisateurs créés par heure',
                    data: data,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
