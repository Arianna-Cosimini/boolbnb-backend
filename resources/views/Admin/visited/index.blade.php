@extends('layouts.app')
@section('content')

<div class="container">
   {{--  {{dd($monthCount)}}
    {{dd($months)}} --}}
<canvas id="myChart" ></canvas>
</div>
    
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
   /*  let months = '{!! json_encode($months) !!}';
    let monthCount = '{!! json_encode($monthCount) !!}';
    console.log(months);
    console.log(monthCount) */
  const ctx = document.getElementById('myChart').getContext('2d');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels:  {!! json_encode($months) !!},
      datasets: [{
        label: '# Visualizzazioni',
        data: {!! json_encode($monthCount) !!},
        borderWidth: 3,
        backgroundColor: [
            'rgba(255, 99, 132, 0.4)',
               
        ],
        borderColor: [
            'rgba(255, 99, 132, 1)',
           
      ]
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
          suggestedMax: 60,
        }
      }
    }
  });
</script>

@endsection