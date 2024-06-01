@extends('layouts.app')

@section('content')

<div class="container d-flex align-items-center justify-content-center py-5">

    <div class="alert border-1 border-black my-bg-opacity" role="alert">
      <div class="p-4">
  
        <div class="circle d-flex justify-content-center align-content-center mb-2">
          <i class="fa-solid fa-check check"></i>
        </div>
        <h4 class="alert-heading">Congratulazioni! <br>La tua sponsorizzazione è avvenuta con successo.</h4>
    
        <p>Ora il tuo appartamento avrà una visibilità maggiore del 25%</p>
      
        <a href="{{route('admin.apartments.index')}}" type="button" class="btn my-btn">Torna alle tue strutture</a>
      </div>
      
      
      </div>
        
    </div>
    
</div>
  @endsection
  
  @section('style')
  <style lang="scss">
    .circle{
      width: 80px;
      height: 80px;
      border-radius: 50%;
      background-color: #ff385c;
      position: relative;
    }
    .check{
     font-size: 90px;
     position: absolute;
     bottom: 5px;
     left: 15px;
     color: white;
    }
    .my-bg-opacity{
    background-color: rgb(0, 0, 0, .3);
    
   }
   .my-bg{
    background-color: #ff385c;
   }
   .my-btn{
    background-color: #ff385c;
    color: white;
    transition: 0.3 ease;
   }
   .my-btn:hover{
    background-color: #de1361;
    color: white;
   }
   
  
  </style>
@endsection