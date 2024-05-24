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
                @foreach ($messages as $message)
                    <div class="message p-4 rounded-4" data-message-id="{{ $message->id }}">
                        <div class="name-date d-flex justify-content-between">
                            <span class="message-text" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $message->name }}</span>
                            <span class="message-text small">{{ date_format($message->created_at, 'd/m/Y H:i') }}</span>
                        </div>
                        <span class="message-text small">{{ $message->address }}</span>
                        <p class="message-text mt-3 mb-0" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $message->message }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="message-details col-8 py-3 px-5 d-flex flex-column">
            <h1 class="message-name fs-4 pb-3 mb-5" id="message-name"></h1>
            <span class="message-date text-center mb-4" id="message-date"></span>
            <span class="message-time small mb-2" style="font-size: 12px" id="message-time"></span>
            <div id="message-detail-content" class="p-4 rounded-4 text-white">
                <p class="message-text mb-0" id="message-text" style="font-weight: 200"></p>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const messages = document.querySelectorAll('.message');
        messages.forEach(message => {
            message.addEventListener('click', function () {
                const messageId = this.getAttribute('data-message-id');

                fetch(`/admin/messages/${messageId}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('message-name').textContent = data.name;
                        document.getElementById('message-date').textContent = new Date(data.created_at).toLocaleDateString();
                        document.getElementById('message-time').textContent = new Date(data.created_at).toLocaleTimeString();
                        document.getElementById('message-text').textContent = data.message;
                        document.getElementById('message-detail-content').innerHTML = `
                            <p><strong>Email:</strong> ${data.address}</p>
                            <p><strong>Messaggio:</strong> ${data.message}</p>
                        `;
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
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
       

     
     
