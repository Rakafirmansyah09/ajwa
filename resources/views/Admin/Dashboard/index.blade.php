@extends('template.index')

@section('css')
<style>
   .lgreen1 {
      background-color: #00B07426;
   }

   .icon-ntv {
      background-color: #FFF5D9;
      border-radius: 40%;
   }

   .icon-ntv img {
      padding: 12px;
   }
</style>
@endsection

@section('main')
<header class="mb-3">
   <a href="#" class="burger-btn d-block d-xl-none">
      <i class="bi bi-justify fs-3"></i>
   </a>
</header>

<section class="row">
   <div class="col-6 col-lg-3 col-md-6">
      <div class="card">
         <div class="card-body ">
            <div class="row">
               <div class="col-md-4">
                  <div class="stats-icon lgreen1">
                     <img src="{{asset('asset/picture/Group 121.png')}}" alt="icon" class="img-fluid">
                  </div>

               </div>
               <div class="col-md-8">
                  <h6 class="text-muted font-semibold">Pendaftaran</h6>
                  <h6 class="font-extrabold mb-0">{{$data1}}</h6>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-6 col-lg-3 col-md-6">
      <div class="card">
         <div class="card-body ">
            <div class="row">
               <div class="col-md-4">
                  <div class="stats-icon lgreen1">
                     <img src="{{asset('asset/picture/Group 121.png')}}" alt="icon" class="img-fluid">
                  </div>
               </div>
               <div class="col-md-8">
                  <h6 class="text-muted font-semibold">Keberangkatan</h6>
                  <h6 class="font-extrabold mb-0">{{$data2}}</h6>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-6 col-lg-3 col-md-6">
      <div class="card">
         <div class="card-body ">
            <div class="row">
               <div class="col-md-4">
                  <div class="stats-icon lgreen1">
                     <img src="{{asset('asset/picture/Group 121.png')}}" alt="icon" class="img-fluid">
                  </div>
               </div>
               <div class="col-md-8">
                  <h6 class="text-muted font-semibold">Total Paket</h6>
                  <h6 class="font-extrabold mb-0">{{$data3}}</h6>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-6 col-lg-3 col-md-6">
      <div class="card">
         <div class="card-body ">
            <div class="row">
               <div class="col-md-4">
                  <div class="stats-icon lgreen1">
                     <img src="{{asset('asset/picture/Group 121.png')}}" alt="icon" class="img-fluid">
                  </div>
               </div>
               <div class="col-md-8">
                  <h6 class="text-muted font-semibold">Pembatalan </h6>
                  <h6 class="font-extrabold mb-0">{{$data4}}</h6>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>

<section class="row">
   <div class="col-12 col-lg-8">
      <div class="card">
         <div class="card-body">
            <p><b>Perbandingan Paket</b></p>
            <div class="row">
               @foreach ($data7 as $item7)
               <div class="col">
                  <div id="chartPie-{{$item7['id']}}"></div>
                  <p class="text-center"><b>{{$item7['nama_paket']}}</b></p>
               </div>
               @endforeach
            </div>
         </div>
      </div>
   </div>
   <div class="col-12 col-lg-4">
      <div class="card">
         <div class="card-header">
            <h4>Notifikasi</h4>
         </div>
         <div class="card-content pb-4">

            @foreach ($data5 as $not)
            <div class="recent-message d-flex px-4 py-3">
               <div>
                  <div class="icon-ntv">
                     <img src="{{asset('asset/picture/Vector1.png')}}" alt="avatar">
                  </div>
               </div>
               <div class="name ms-4">
                  <p>{{$not}}</p>
               </div>
            </div>
            @endforeach


         </div>
      </div>
   </div>
   <div class="col-12 col-lg-8">
      <div class="card">
         <div class="card-body">
            <p><b>Grafik Pendaftaran</b></p>
            <div id="chart-pendaftaran-visit"></div>
         </div>
      </div>
   </div>


</section>
@endsection


@section('js')
<script src="{{ asset('mazer/extensions/apexcharts/apexcharts.min.js') }}"></script>
<script>
   const rawDataPendaftaran = @json($data6);

   // Inisialisasi array bulan dari Jan - Dec
   const bulanMap = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
   const dataChart = Array(12).fill(0); // default 0 untuk semua bulan

   rawDataPendaftaran.forEach(item => {
      const index = parseInt(item.bulan) - 1;
      dataChart[index] = item.total;
   });

   var optionsPendaftaranVisit = {
      chart: {
         height: 300,
         type: 'line'
      },
      dataLabels: {
         enabled: false
      },
      stroke: {
         curve: 'smooth'
      },
      series: [{
         name: 'Jemaah',
         data: dataChart
      }],
      xaxis: {
         categories: bulanMap
      },
      colors: ['#435ebe']
   };

   var chartPendaftaranVisit = new ApexCharts(
      document.querySelector("#chart-pendaftaran-visit"),
      optionsPendaftaranVisit
   )

   chartPendaftaranVisit.render()
</script>

<script>
   const rawDataJemaahPaket = @json($data7);

   document.addEventListener("DOMContentLoaded", function() {
      rawDataJemaahPaket.forEach(item => {
         createChart(item.id, item);
      });
   });

   function createChart(id, data) {
      let optionsPaketProfile = {
         series: [data.jemaah_lunas, data.jemaah_belum_lunas],
         labels: ["Lunas", "Belum Lunas"],
         colors: ["#435ebe", "#55c6e8"],
         chart: {
            type: "donut",
            height: 350,
         },
         legend: {
            position: "bottom",
         },
         plotOptions: {
            pie: {
               donut: {
                  size: "30%",
               },
            },
         },
      };

      const chartJemaahPaket = new ApexCharts(
         document.querySelector("#chartPie-" + id),
         optionsPaketProfile
      );
      chartJemaahPaket.render();
   }
</script>
@endsection