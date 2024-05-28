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
        <div class="messages-column col-4 py-3 pe-4">
            <h1 class="fs-3 mb-5">Messaggi</h1>
            <div class="messages-list d-flex flex-column gap-3 overflow-y-auto" style="height: 70vh">
                @if($messages->isEmpty())
                    <p>Non ci sono messaggi da visualizzare.</p>
                @else
                    @foreach ($messages as $index => $message)
                        <div class="message p-4 rounded-4 @if($loop->first) selected @endif" data-message-id="{{ $message->id }}">
                            <div class="name-date d-flex justify-content-between">
                                <span class="message-text message-name" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $message->name }}</span>
                                <span class="message-text small message-date">{{ $message->created_at }}</span>
                            </div>
                            <span class="message-text small message-address">{{ $message->address }}</span>
                            <p class="message-text mt-3 mb-0 message-content" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $message->message }}</p>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        @if($messages->isEmpty())

        @else
        <div class="message-details col-8 py-3 px-5 d-flex flex-column">
            <div class="header d-flex mb-4 justify-content-between">
                <div class="apartment-message-info">
                    <h1 class="message-name fs-4 pb-3" id="message-name">{{ $messages->first()->name ?? '' }}</h1>
                    <p class="apartment-info mb-3">Appartamento di riferimento: {{ $message->apartment->name }}</p>
                </div>
                <div class="bnt-container">
                    <a href="mailto:{{ $message->address }}" class="btn button-black text-white">Rispondi</a>
                </div>
            </div>
            <span class="message-date text-center mb-4" id="message-date">{{ $messages->first() ? \Carbon\Carbon::parse($messages->first()->created_at)->translatedFormat('d M Y') : '' }}</span>
            <span class="message-time small mb-2" style="font-size: 12px" id="message-time">{{ $messages->first() ? \Carbon\Carbon::parse($messages->first()->created_at)->format('H:i') : '' }}</span>
            <div id="message-detail-content" class="p-4 rounded-4 text-white">
                <p class="message-text mb-0" id="message-text" style="font-weight: 200">{{ $messages->first()->message ?? '' }}</p>
            </div>
        </div>
        @endif
    </div>
</div>

<div class="container">
    <canvas id="messageChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const messages = document.querySelectorAll('.message');
        const messageNameElement = document.getElementById('message-name');
        const messageDateElement = document.getElementById('message-date');
        const messageTimeElement = document.getElementById('message-time');
        const messageTextElement = document.getElementById('message-text');

        // Seleziona il primo messaggio all'apertura della pagina
        if (messages.length > 0) {
            const firstMessage = messages[0];
            firstMessage.classList.add('selected');

            const name = firstMessage.querySelector('.message-name').innerText;
            const dateTimeString = firstMessage.querySelector('.message-date').innerText;
            const address = firstMessage.querySelector('.message-address').innerText;
            const content = firstMessage.querySelector('.message-content').innerText;

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

            messageNameElement.innerText = name;
            messageDateElement.innerText = formattedDate;
            messageTimeElement.innerText = formattedTime;
            messageTextElement.innerText = content;
        }

        messages.forEach(message => {
            message.addEventListener('click', function () {
                // Rimuove la classe 'selected' da tutti i messaggi
                messages.forEach(msg => msg.classList.remove('selected'));

                // Aggiunge la classe 'selected' al messaggio cliccato
                this.classList.add('selected');

                const name = this.querySelector('.message-name').innerText;
                const dateTimeString = this.querySelector('.message-date').innerText;
                const address = this.querySelector('.message-address').innerText;
                const content = this.querySelector('.message-content').innerText;

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

                messageNameElement.innerText = name;
                messageDateElement.innerText = formattedDate;
                messageTimeElement.innerText = formattedTime;
                messageTextElement.innerText = content;
            });
        });
    });

    const ctx = document.getElementById('messageChart').getContext('2d');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Gen', 'Feb', 'Mar', 'Apr', 'Mag', 'Giu', 'Lug', 'Ago',
                        'Set', 'Ott', 'Nov', 'Dic'
                    ] /* {!! json_encode($months) !!} */,
      datasets: [{
        label: '# Visualizzazioni',
        data: {!! json_encode($messageCount) !!},
        borderWidth: 3,
        backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)',   
        ],
        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
      ]
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
@endsection








    {{-- eliminazione --}}
             {{-- <a href="" class="btn button-red  text-white border border-1 border-black text-center " data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-trash-can text-white me-1 border-0 "></i></a>
                 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered ">
                       <div class="modal-content">
             
                         <div class="modal-header">
                           <h1 class="modal-title fs-5" id="exampleModalLabel">Elimina appartamento</h1>
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class=" fa-solid fa-square-xmark"></i></button>
                         </div>
             
                         <div class="modal-body">
                           Sei sicuro di voler eliminare il messaggio di {{$message->name}} {{$message->surname}} ?
                         </div>
             
             
                         <div class="modal-footer">
             
                         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
             
                             <form action="{{route('admin.messages.destroy', $message)}}" method="POST">
                                 @csrf
                                 @method("DELETE")
                                 
                                 <button type="submit" class="btn btn-danger">Elimina</button>
                             </form>
             
                         </div>
             
                       </div>
                      </div>
                     </div>
                 </div> --}}
       

     
     
