
<h1>Richiesta di contatto</h1>

<p>
   
        
    
    <ul>
        <li>
            Da: {{$lead->name}} {{$lead->surname}}
        </li>
        <li>
            Email: {{$lead->address}}
        </li>
        <li>
            Messaggio: {{$lead->message}}
        </li>
        <li>
            Il: {{date_format($lead->created_at, 'd/m/Y H:i') }}
        </li>
    </ul>
  
</p>
