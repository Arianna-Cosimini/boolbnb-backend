@extends('layouts.app')
@section('content')

<div class="container">
   {{--  {{dd($monthCount)}}
    {{dd($months)}} --}}
<canvas id="myChart"></canvas>
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
      labels: ['Gen', 'Feb', 'Mar', 'Apr', 'Mag', 'Giu', 'Lug', 'Ago',
                        'Set', 'Ott', 'Nov', 'Dic'
                    ] /* {!! json_encode($months) !!} */,
      datasets: [{
        label: '# Visualizzazioni',
        data: {!! json_encode($monthCount) !!},
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