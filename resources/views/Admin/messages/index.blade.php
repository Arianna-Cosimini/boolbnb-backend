@extends('layouts.app')

@section('content')
    <div id="messages_index" class="container py-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}" class="text-black">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Messaggi</li>
            </ol>
        </nav>

        <div class="row">
            <!-- Colonna degli Appartamenti -->
            <div class="apartments-column col-6 py-3 pe-4" style="cursor: pointer">
                <h1 class="fs-3 mb-5">Appartamenti</h1>
                <div class="apartments-list d-flex flex-column gap-3 overflow-y-auto" style="height: 70vh">
                    @if ($apartments->isEmpty())
                        <p>Non ci sono appartamenti da visualizzare.</p>
                    @else
                        @foreach ($apartments as $apartment)
                            <div class="apartment p-4 rounded-4 @if ($selected_apartment_id == $apartment->id) selected @endif"
                                data-apartment-id="{{ $apartment->id }}">
                                <div class="name-date d-flex justify-content-between">
                                    <span class="apartment-name"
                                        style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $apartment->name }}</span>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Colonna dei Messaggi -->
            <div class="messages-column col-6 py-3 pe-4">
                <h1 class="fs-3 mb-5">Messaggi</h1>
                <div class="messages-list d-flex flex-column gap-3 overflow-y-auto" style="height: 70vh">
                    @if ($messages->isEmpty())
                        <p>Non ci sono messaggi da visualizzare.</p>
                    @else
                        @foreach ($messages as $index => $message)
                            <div class="message p-4 rounded-4 @if ($index === 0) selected @endif"
                                data-message-id="{{ $message->id }}" data-apartment-id="{{ $message->apartment_id }}">
                                <div class="name-date d-flex justify-content-between">
                                    <span class="message-text message-name"
                                        style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $message->name }}</span>
                                    <span
                                        class="message-text small message-date">{{ $message->created_at->format('Y-m-d') }}</span>
                                </div>
                                <span class="message-text small message-address">{{ $message->address }}</span>
                                <p class="message-text mt-3 mb-0 message-content"
                                    style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    {{ $message->message }}</p>

                                <!-- Button modal for messages-->
                                <button type="button" class="btn btn-dark mt-3 text-white" data-bs-toggle="modal"
                                    data-bs-target="#messageModal{{ $message->id }}">
                                    Dettagli messaggio
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="messageModal{{ $message->id }}" tabindex="-1"
                                    aria-labelledby="messageModalLabel{{ $message->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="messageModalLabel{{ $message->id }}">Dettagli
                                                    del Messaggio</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h1 class="message-name fs-4">Messaggio scritto da: {{ $message->name }}
                                                </h1>
                                                <div class="d-flex justify-content-start">
                                                    <span class="message-date text-center mb-4"
                                                        id="modal-message-date{{ $message->id }}">
                                                        {{ \Carbon\Carbon::parse($message->created_at)->translatedFormat('d M Y') }}
                                                    </span>
                                                </div>
                                                <p class="apartment-info mb-3 text-center"><strong>Appartamento di
                                                        riferimento: </strong> <br> {{ $message->apartment->name }}</p>
                                                <h6>Messaggio:</h6>
                                                <div class="modal-message-detail-content p-4 rounded-4 text-white">
                                                    <p class="message-text mb-0 text-end"
                                                        id="modal-message-text{{ $message->id }}"
                                                        style="font-weight: 200">{{ $message->message }}</p>
                                                </div>

                                                <div class="button-container d-flex gap-2 align-items-center">
                                                    <a href="mailto:{{ $message->address }}"
                                                        id="reply-button{{ $message->id }}"
                                                        class="btn button-black text-white"> <i
                                                            class="fa-solid fa-pen-to-square text-white"></i>Rispondi</a>

                                                    <a href="{{ route('admin.messages.show', $message->id) }}"
                                                        class="btn bg-white text-black border border-1 border-black delete-message-button"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#confirmDeleteModal{{ $message->id }}">
                                                        <i class="fa-solid fa-trash-can text-color me-1"></i>Elimina
                                                    </a>


                                                </div>

                                                <div class="modal fade" id="confirmDeleteModal{{ $message->id }}"
                                                    tabindex="-1"
                                                    aria-labelledby="confirmDeleteModalLabel{{ $message->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered ">
                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Elimina
                                                                    messaggio</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>

                                                            <div class="modal-body">
                                                                Sei sicuro di voler eliminare il messaggio ?
                                                            </div>


                                                            <div class="modal-footer">

                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Annulla</button>

                                                                <form
                                                                    action="{{ route('admin.messages.destroy', $message->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')

                                                                    <button type="submit"
                                                                        class="btn btn-danger">Elimina</button>
                                                                </form>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
@section('javascript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
          
            const apartments = document.querySelectorAll('.apartment');
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

            apartments.forEach(apartment => {
                apartment.addEventListener('click', function() {
                    const apartmentId = this.getAttribute('data-apartment-id');

                    apartments.forEach(ap => ap.classList.remove('selected'));
                    this.classList.add('selected');

                    showMessagesForApartment(apartmentId);

                    const firstMessage = document.querySelector(
                        `.message[data-apartment-id="${apartmentId}"]`);
                    if (firstMessage) {
                        updateMessageDetails(firstMessage);
                    } else {
                        // Handle no message details
                    }
                });
            });

            messages.forEach(message => {
                message.addEventListener('click', function() {
                    messages.forEach(msg => msg.classList.remove('selected'));
                    this.classList.add('selected');
                    updateMessageDetails(this);
                });
            });

            if (apartments.length > 0) {
                apartments[0].classList.add('selected');
                showMessagesForApartment(apartments[0].getAttribute('data-apartment-id'));
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

        }
    </script>
@endsection
