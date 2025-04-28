<div class="card">
    <div class="card-header">
        VSLA Microcredit Distribution
    </div>
    <div class="card-body">
        <canvas id="vslaChart" width="400" height="200"></canvas>
    </div>
</div>
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('vslaChart').getContext('2d');

        const vslaChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($years),
                datasets: [{
                        label: 'Number of Beneficiaries',
                        data: @json($beneficiaries),
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                        yAxisID: 'y',
                    },
                    {
                        label: 'VSLA Number',
                        data: @json($vslaCounts),
                        type: 'line',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        fill: false,
                        tension: 0.4,
                        yAxisID: 'y',
                    }
                ]
            },
            options: {
                responsive: true,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                stacked: false,
                scales: {
                    y: {
                        beginAtZero: true,
                    }
                }
            }
        });
    </script>
@endpush
