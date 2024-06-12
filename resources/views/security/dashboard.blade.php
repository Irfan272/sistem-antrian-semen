@extends('security.layout.master')

@section('title', 'Dashboard')

@section('content')
<div class="right_col" role="main">
    <div class="col-lg-12">
        <div class="top_tiles">
            <h1>Selamat Datang Di Sistem Antrian Semen</h1>
            <div class="row">
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
                        <div class="count">{{ $jenisTotal }}</div>
                        <h5>Data Jenis Semen</h5>
                    </div>
                </div>
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-comments-o"></i></div>
                        <div class="count">{{ $pelangganTotal }}</div>
                        <h5>Data Pelanggan</h5>
                    </div>
                </div>
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
                        <div class="count">{{ $deliveryTotal }}</div>
                        <h5>Data Delivery</h5>
                    </div>
                </div>
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
                        <div class="count">{{ $antrianTotal }}</div>
                        <h5>Data Antrian</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <canvas id="deliveryStatusChart"></canvas>
            </div>
            <div class="col-lg-6">
                <canvas id="antrianStatusChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const deliveryStatusCounts = @json($deliveryStatusCounts);
    const antrianStatusCounts = @json($antrianStatusCounts);

    // Labels and Data for Delivery Status Chart
    const deliveryLabels = ['Menunggu', 'Proses', 'Selesai'];
    const deliveryData = deliveryLabels.map(label => deliveryStatusCounts[label] || 0);

    const ctxDelivery = document.getElementById('deliveryStatusChart').getContext('2d');
    new Chart(ctxDelivery, {
        type: 'pie',
        data: {
            labels: deliveryLabels,
            datasets: [{
                label: 'Status Delivery',
                data: deliveryData,
                backgroundColor: ['#f39c12', '#00c0ef', '#00a65a']
            }]
        }
    });

    // Labels and Data for Antrian Status Chart
    const antrianLabels = ['Menunggu', 'Proses', 'Selesai'];
    const antrianData = antrianLabels.map(label => antrianStatusCounts[label] || 0);

    const ctxAntrian = document.getElementById('antrianStatusChart').getContext('2d');
    new Chart(ctxAntrian, {
        type: 'pie',
        data: {
            labels: antrianLabels,
            datasets: [{
                label: 'Status Antrian',
                data: antrianData,
                backgroundColor: ['#f39c12', '#00c0ef', '#00a65a']
            }]
        }
    });
</script>
@endsection
