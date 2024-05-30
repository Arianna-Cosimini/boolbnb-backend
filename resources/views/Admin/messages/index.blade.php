@extends('layouts.app')

@section('content')
    <div id="messages_index" class="container py-5">
        <nav aria-label="breadcrumb" class="d-none d-md-block">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}" class="text-black">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Messaggi</li>
            </ol>
        </nav>
        <nav class="d-block d-md-none mb-3">
            <a href="{{ route('admin.index') }}" class="text-decoration-none text-black"><i class="fa-solid fa-chevron-left me-2"></i>Indietro</a>
        </nav>

        <div class="row">
            <!-- Colonna degli Appartamenti -->
            <div class="apartments-column col-12 py-3 d-flex flex-column mb-5">
                <h1 class="fs-3 mb-5">Messaggi</h1>
                <h2 class="fs-6">Seleziona una struttura</h2>
                <select id="apartmentSelect" class="form-select">
                    @if ($apartments->isEmpty())
                        <option value="">Non ci sono strutture da visualizzare</option>
                    @else
                        @foreach ($apartments as $apartment)
                            <option value="{{ $apartment->id }}" data-apartment-name="{{ $apartment->name }}">
                                {{ $apartment->name }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>

            <!-- Colonna dei Messaggi -->
            <div class="messages-column col-12 border-0 ">
                {{-- <h3 class="mb-5 fs-6">Messaggi per la tua struttura:<br><span id="selectedApartmentName"
                        class="fs-6 mb-5" style="font-size: 25px"></span></h3> --}}

                <div class="messages-list d-flex flex-column gap-3 overflow-y-auto" style="height: 70vh">
                    @if ($messages->isEmpty())
                        <p>Non ci sono messaggi da visualizzare.</p>
                    @else
                        @foreach ($messages as $index => $message)
                            <div class="message p-3 rounded-4 @if ($index === 0) @endif"
                                data-message-id="{{ $message->id }}" data-apartment-id="{{ $message->apartment_id }}">
                                <div class="name-date d-flex justify-content-between">
                                    <span class="message-text text-black message-name"
                                        style="overflow: hidden; text-black text-overflow: ellipsis; white-space: nowrap;"><span class="fw-normal" style="font-size: 18px">{{ $message->name }} {{ $message->surname }}</span></span>
                                    <span
                                        class="message-text small message-date">{{ $message->created_at->format('d-m-Y') }}</span>
                                </div>
                                {{-- <span class="message-text message-address"> <strong class="fw-regular"></strong>{{ $message->address }}</span> --}}
                                <p class="message-text mt-3 mb-0 message-content"
                                    style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    {{ $message->message }}</p>

                                <div class="button-container d-flex gap-2 justify-content-end align-items-end">
                                    <!-- Button modal for messages-->
                                    <button type="button" class="btn btn-dark my-3 text-white" data-bs-toggle="modal"
                                        data-bs-target="#messageModal{{ $message->id }}">
                                        Dettagli messaggio
                                    </button>

                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="messageModal{{ $message->id }}" tabindex="-1"
                                    aria-labelledby="messageModalLabel{{ $message->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title" id="messageModalLabel{{ $message->id }}">Dettagli
                                                    messaggio</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                

                                                <p class="apartment-info text-black-50 mb-3" style="font-size: 14px">Struttura di
                                                    riferimento:<br> {{ $message->apartment->name }}</p>

                                                    
                                                    
                                                    <div class="modal-message-detail-content px-3 py-4 border border-1 rounded-2 mb-4 text-white" style="background-color: #222">
                                                    <p class="message-name mb-1 fs-5">{{ $message->name }} {{ $message->surname }}</p>
                                                    <p class="message-text mb-0 text-white"
                                                        id="modal-message-text{{ $message->id }}"
                                                        style="font-weight: 200">{{ $message->message }}</p>
                                                </div>

                                                <div class="button-container d-flex justify-content-end gap-2 align-items-center">
                                                    <a href="mailto:{{ $message->address }}"
                                                        id="reply-button{{ $message->id }}"
                                                        class="btn border border-1 text-black">
                                                        <i class="fa-solid fa-reply me-1"></i>Rispondi</a>

                                                    <a href="{{ route('admin.messages.show', $message->id) }}"
                                                        class="btn bg-white text-black border border-1 delete-message-button"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#confirmDeleteModal{{ $message->id }}">
                                                        <i class="fa-solid fa-trash-can text-color me-1"></i>Elimina
                                                    </a>
                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div class="modal fade" id="confirmDeleteModal{{ $message->id }}" tabindex="-1"
                                    aria-labelledby="confirmDeleteModalLabel{{ $message->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered ">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Elimina
                                                    messaggio</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                Sei sicuro di voler eliminare il messaggio ?
                                            </div>


                                            <div class="modal-footer">

                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Annulla</button>

                                                <form action="{{ route('admin.messages.destroy', $message->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger">Elimina</button>
                                                </form>

                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <hr>

                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Stile della scrollbar */
        .messages-list::-webkit-scrollbar {
            width: 6px;
            border-radius: 10px
        }

        .messages-list::-webkit-scrollbar-thumb {
            background-color: grey;
            border-radius: 15px;
        }

        .messages-list::-webkit-scrollbar-track {
            background-color: transparent;
        }

    </style>

@endsection
@section('javascript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const apartmentSelect = document.getElementById('apartmentSelect');
            const messages = document.querySelectorAll('.message');

            function showMessagesForApartment(apartmentId) {
                messages.forEach(message => {
                    if (message.getAttribute('data-apartment-id') === apartmentId) {
                        message.style.display = 'block';
                    } else {
                        message.style.display = 'none';
                    }
                });
            }

            apartmentSelect.addEventListener('change', function() {
                const selectedOption = apartmentSelect.options[apartmentSelect.selectedIndex];
                const apartmentId = selectedOption.value;
                const apartmentName = selectedOption.getAttribute('data-apartment-name');

                if (apartmentId) {
                    showMessagesForApartment(apartmentId);
                    const firstMessage = document.querySelector(
                        `.message[data-apartment-id="${apartmentId}"]`);
                    if (firstMessage) {
                        updateMessageDetails(firstMessage);
                    }
                    selectedApartmentName.textContent = `${apartmentName}`;
                } else {
                    selectedApartmentName.textContent = "";
                    messages.forEach(message => message.style.display = 'none');
                }
            });

            function updateMessageDetails(message) {
                const messageId = message.getAttribute('data-message-id');

                const name = message.querySelector('.message-name').innerText;
                const dateTimeString = message.querySelector('.message-date').innerText;
                const address = message.querySelector('.message-address').innerText;
                const content = message.querySelector('.message-content').innerText;

                const date = new Date(dateTimeString);
                const formattedDate = date.toLocaleDateString('it-IT', {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric'
                });
                const formattedTime = date.toLocaleTimeString('it-IT', {
                    hour: '2-digit',
                    minute: '2-digit'
                });

                // Aggiorna il contenuto del tag span con l'ID corrispondente
                const messageDateElement = document.getElementById(`modal-message-date${messageId}`);
                messageDateElement.textContent = `${formattedDate} ${formattedTime}`;
            }

            // Seleziona il primo appartamento automaticamente se esiste
            if (apartmentSelect.options.length > 1) {
                apartmentSelect.selectedIndex = 1; // Il primo elemento è l'opzione "Seleziona un appartamento"
                const event = new Event('change');
                apartmentSelect.dispatchEvent(event);
            }
        });
    </script>
@endsection
