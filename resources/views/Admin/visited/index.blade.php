@extends('layouts.app')

@section('content')
    <div id="views_index" class="container py-5">
        <nav aria-label="breadcrumb" class="d-none d-md-block">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}" class="text-black">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Statistiche</li>
            </ol>
        </nav>
        <nav class="d-block d-md-none mb-3">
            <a href="{{ route('admin.apartments.index') }}" class="text-decoration-none text-black"><i
                    class="fa-solid fa-chevron-left me-2"></i>Indietro</a>
        </nav>

        <div class="row flex-column">
            <!-- Colonna degli Appartamenti -->
            <div class="apartments-column d-flex flex-column py-3 pe-4">
                <h1 class="fs-3 mb-4 mb-md-5">Statistiche</h1>
                <select id="apartmentSelect" class="form-select">
                    @if ($apartments->isEmpty())
                        <option value="">Non ci sono appartamenti da visualizzare</option>
                    @else
                        @foreach ($apartments as $index => $apartment)
                            <option value="{{ $apartment->id }}" data-apartment-name="{{ $apartment->name }}"
                                data-apartment-views="{{ $apartmentViewCounts[$apartment->id] ?? 0 }}"
                                data-monthly-counts="{{ json_encode($apartmentMonthlyCounts[$apartment->id]) }}"
                                {{ $index === 0 ? 'selected' : '' }}>
                                {{ $apartment->name }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>

            <!-- Colonna delle Visualizzazioni -->
            <div class="col-12">
                <div class="views-column mt-5">
                    <canvas id="viewsChart"></canvas>
                    <div id="apartmentTotalViews" class="apartment-total-views mt-4 text-center">
                    </div>
                    <div id="viewsCount" class="views-count mt-2 text-end text-center">
                        <span id="viewsCountValue" class="display-1 fw-bold">0</span> <br>
                        visualizzazioni negli ultimi 12 mesi
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .d-none {
            display: none;
        }

        /* Classe per l'appartamento selezionato */
        .selected-apartment {
            background-color: #f0f0f0;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const apartmentSelect = document.getElementById('apartmentSelect');
            const viewsChartElement = document.getElementById('viewsChart').getContext('2d');
            const apartmentTotalViewsElement = document.getElementById('apartmentTotalViews');
            const viewsCountElement = document.getElementById('viewsCount');
            const viewsCountValueElement = document.getElementById('viewsCountValue');

            const months = ['Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre', 'Gennaio',
                'Febbraio', 'Marzo', 'Aprile', 'Maggio'
            ];

            // Inizializza il grafico
            let viewsChart = new Chart(viewsChartElement, {
                type: 'bar',
                data: {
                    labels: months,
                    datasets: [{
                        label: '# Visualizzazioni',
                        data: [],
                        borderWidth: 3,
                        backgroundColor: 'rgba(255, 99, 132, 0.4)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            suggestedMax: 10,
                        }
                    }
                }
            });

            // Funzione per aggiornare il grafico e le visualizzazioni
            function updateChartAndViews(apartmentName, apartmentViews, monthlyCounts) {
                viewsChart.data.datasets[0].data = monthlyCounts;
                viewsChart.update();

                let currentCount = 0;
                const step = apartmentViews / 100;
                const interval = setInterval(() => {
                    currentCount += step;
                    if (currentCount >= apartmentViews) {
                        clearInterval(interval);
                        currentCount = apartmentViews;
                    }
                    viewsCountValueElement.textContent = Math.floor(currentCount);
                }, 10);
            }

            // Seleziona il primo appartamento di default
            const firstOption = apartmentSelect.options[0];
            if (firstOption) {
                const apartmentName = firstOption.getAttribute('data-apartment-name');
                const apartmentViews = parseInt(firstOption.getAttribute('data-apartment-views'));
                const monthlyCounts = JSON.parse(firstOption.getAttribute('data-monthly-counts'));
                updateChartAndViews(apartmentName, apartmentViews, monthlyCounts);
            }

            // Aggiorna il grafico quando cambia la selezione
            apartmentSelect.addEventListener('change', function() {
                const selectedOption = apartmentSelect.options[apartmentSelect.selectedIndex];

                if (selectedOption.value) {
                    const apartmentName = selectedOption.getAttribute('data-apartment-name');
                    const apartmentViews = parseInt(selectedOption.getAttribute('data-apartment-views'));
                    const monthlyCounts = JSON.parse(selectedOption.getAttribute('data-monthly-counts'));
                    updateChartAndViews(apartmentName, apartmentViews, monthlyCounts);
                } else {
                    // Nascondi il grafico e il testo delle visualizzazioni totali se nessun appartamento è selezionato
                    document.getElementById('viewsChart').classList.add('d-none');
                    apartmentTotalViewsElement.classList.add('d-none');
                    viewsCountElement.classList.add('d-none');
                    viewsCountValueElement.textContent = '0';
                }
            });
        });
    </script>
@endsection
