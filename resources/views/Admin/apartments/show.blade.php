@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <nav aria-label="breadcrumb" class="d-none d-md-block">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}" class="text-black">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.apartments.index') }}" class="text-black">Le tue
                        strutture</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $apartment->name }}</li>
            </ol>
        </nav>
        <nav class="d-block d-md-none mb-3">
            <a href="{{ route('admin.apartments.index') }}" class="text-decoration-none text-black"><i
                    class="fa-solid fa-chevron-left me-2"></i>Indietro</a>
        </nav>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div
            class="apartment-title d-flex flex-column flex-lg-row justify-content-between align-items-start gap-3 align-items-lg-end mb-4">
            <div class="header">
                <h1 class="fs-3 mb-0">{{ $apartment['name'] }}</h1>
            </div>

            <div class="button-container d-flex gap-2 align-items-center">
                <a href="{{ route('admin.apartments.edit', $apartment->slug) }}"
                    class="my-show-button btn bg-white text-black border border-1 border-black">
                    <i class="fa-solid fa-pen-to-square"></i> Modifica
                </a>
                <a href="{{ route('admin.apartments.show', $apartment) }}"
                    class="my-show-button btn bg-white text-black border border-1 border-black" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    <i class="fa-solid fa-trash-can text-color me-1"></i>Elimina
                </a>
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Elimina appartamento</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Sei sicuro di voler eliminare "{{ $apartment->name }}" ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                            <form action="{{ route('admin.apartments.destroy', $apartment) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Elimina</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="img-container w-100 mb-4 position-relative">
            <img src="{{ $apartment->cover_image ? asset('storage/' . $apartment->cover_image) : asset('placeholder/Placeholder.png') }}"
                alt="{{ $apartment['name'] }}" class="w-100 object-fit-cover rounded-3" style="height: 600px">

            <div class="visible-banner d-flex justify-content-end mb-0">
                @if ($apartment->visible == 1)
                    <p class="my-visible-pill rounded-5 px-4 rounded-3 p-2 text-black mb-0">Acquistabile</p>
                @elseif ($apartment->visible == 0)
                    <p class="my-visible-pill rounded-5 px-4 rounded-3 p-2 text-black mb-0">Non Acquistabile</p>
                @endif
            </div>
        </div>

        <div class="left-container">
            <h2 class="mb-0 fs-5">Appartamento in {{ $apartment['address'] }}</h2>
            <p class="mb-3">
                {{ $apartment['room_number'] }} {{ $apartment['room_number'] == 1 ? 'camera' : 'camere' }} &middot;
                {{ $apartment['bed_number'] }} {{ $apartment['bed_number'] == 1 ? 'letto' : 'letti' }} &middot;
                {{ $apartment['bathroom_number'] }} {{ $apartment['bathroom_number'] == 1 ? 'bagno' : 'bagni' }}
            </p>

            <p class="mb-4">{{ $apartment['description'] }}</p>

            <hr>

            <div class="mb-4">
                <label class="mb-3 fw-medium fs-5">Servizi</label>
                <div class="row d-flex row-gap-3">
                    @foreach ($apartment->services->take(6) as $service)
                        <div class="col-6 col-lg-4 d-flex gap-2 align-items-center">
                            <img src="{{ $service->icon }}" alt="">
                            <span>{{ $service->title }}</span>
                        </div>
                    @endforeach

                    @if ($apartment->services->count() > 6)
                        <div class="ps-2">
                            <button type="button"
                                class="my-show-button btn bg-white text-black border border-1 border-black"
                                data-bs-toggle="modal" data-bs-target="#exampleModal2">
                                Mostra tutti e {{ $apartment->services->count() }} i servizi
                            </button>
                            <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content vw-100">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Servizi</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row d-flex row-gap-3">
                                                @foreach ($apartment->services as $service)
                                                    <div class="col-6 d-flex gap-2 align-items-center">
                                                        <img src="{{ $service->icon }}" alt="">
                                                        <span>{{ $service->title }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <hr class="mb-4">

        <h1 class="fs-5 mb-3">Statistiche</h1>

        <div class="d-flex flex-wrap">
            <div class="modal-body col-12 col-lg-6 pe-lg-5 px-3 px-lg-0 mb-5">
                <p class="fs-6">Visualizzazioni</p>
                    <canvas id="viewsChart"></canvas>

                <div id="apartmentTotalViews" class="apartment-total-views mt-2 text-center">
                    <!-- Contatore delle visualizzazioni totali -->
                    <span id="totalViewsCounter" class="display-1 fw-bold">{{ $totalViews }}</span>
                    <br>
                    visualizzazioni negli ultimi 12 mesi
                </div>
            </div>

            <div class="modal-body col-12 col-lg-6 pe-lg-5 px-3 px-lg-0 mb-5">
                <p class="fs-6">Messaggi</p>
                    <canvas id="messagesChart"></canvas>

                <div id="apartmentTotalMessages" class="apartment-total-messages mt-2 text-center">
                    <!-- Contatore dei messaggi totali -->
                    <span id="totalMessagesCounter" class="display-1 fw-bold">{{ $totalMessages }}</span>
                    <br>
                    messaggi negli ultimi 12 mesi
                </div>
                {{-- <div id="messagesCount" class="messages-count mt-2 text-end text-center">
                    <span id="messagesCountValue" class="display-1 fw-bold">{{ $totalMessages }}</span> <br>
                    messaggi negli ultimi 12 mesi
                </div> --}}
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            const months = {!! json_encode($months) !!};
            const monthCount = {!! json_encode($monthCount) !!};
            const messageCount = {!! json_encode($messageCount) !!};
            const totalViews = {{ $totalViews }};
            const totalMessages = {{ $totalMessages }};

            const viewsChartCtx = document.getElementById('viewsChart').getContext('2d');
            const messagesChartCtx = document.getElementById('messagesChart').getContext('2d');

            new Chart(viewsChartCtx, {
                type: 'bar',
                data: {
                    labels: months,
                    datasets: [{
                        label: '# Visualizzazioni di questo appartamento',
                        data: monthCount,
                        borderWidth: 3,
                        backgroundColor: 'rgba(0, 0, 0, 0.4)',
                        borderColor: 'rgba(0, 0, 0, 1)'
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

            new Chart(messagesChartCtx, {
                type: 'bar',
                data: {
                    labels: months,
                    datasets: [{
                        label: '# Messaggi a questo appartamento',
                        data: messageCount,
                        borderWidth: 3,
                        backgroundColor: 'rgba(0, 0, 0, 0.4)',
                        borderColor: 'rgba(0, 0, 0, 1)'
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            suggestedMax: 3
                        }
                    }
                }
            });

            function animateCounter(id, endValue) {
                let currentValue = 0;
                const step = endValue / 100;
                const element = document.getElementById(id);

                if (element) {
                    const interval = setInterval(() => {
                        currentValue += step;
                        if (currentValue >= endValue) {
                            clearInterval(interval);
                            currentValue = endValue;
                        }
                        element.textContent = Math.floor(currentValue);
                    }, 10);
                }
            }

            document.addEventListener('DOMContentLoaded', () => {
                animateCounter('totalViewsCounter', totalViews);
                animateCounter('viewsCountValue', totalViews);
                animateCounter('totalMessagesCounter', totalMessages);
                animateCounter('messagesCountValue', totalMessages);
            });
        </script>
    </div>
@endsection
