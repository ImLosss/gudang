@extends('layouts.master')

@section('title', 'dashboard')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title"></h3>
                    <ul class="breadcrumb">
                        <li>Admin /</li>
                        <li class="breadcrumb-item"> <a href="">@yield('title')</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3 col-sm-6 col-12 d-flex">
            <div class="card bg-comman w-100">
                <div class="card-body">
                    <div class="db-widgets d-flex justify-content-between align-items-center">
                        <div class="db-info">
                            <h6>Stok Barang</h6>
                            <h3></h3>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-database fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12 d-flex">
            <div class="card bg-comman w-100">
                <div class="card-body">
                    <div class="db-widgets d-flex justify-content-between align-items-center">
                        <div class="db-info">
                            <h6>Barang Masuk</h6>
                            <h3></h3>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-arrow-right fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12 d-flex">
            <div class="card bg-comman w-100">
                <div class="card-body">
                    <div class="db-widgets d-flex justify-content-between align-items-center">
                        <div class="db-info">
                            <h6>Barang Keluar</h6>
                            <h3></h3>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-arrow-left fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart untuk barang masuk -->
        <div class="col-6">
            <div id="chartMasuk"></div>
        </div>

        <!-- Chart untuk barang keluar -->
        <div class="col-6">
            <div id="chartKeluar"></div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // Data yang dikirim dari Laravel ke JavaScript
        var dates = @json($datesArray); // Array tanggal
        var dataMasuk = @json($barangMasuk); // Array jumlah barang masuk per tanggal
        var dataKeluar = @json($barangKeluar); // Array jumlah barang keluar per tanggal

        // Konfigurasi chart
        var optionsMasuk = {
            chart: {
                type: 'line', // Jenis chart: garis
            },
            series: [{
                name: 'Barang Masuk', // Nama seri data
                data: dataMasuk // Data jumlah barang masuk
            }],
            tooltip: {
                x: {
                    show: true,
                },
                y: {
                    title: {
                        formatter: function formatter(val) {
                        return '';
                        }
                    },
                    formatter: function(value, { series, seriesIndex, dataPointIndex, w }) {
                        let ratingVal = w.globals.initialSeries[seriesIndex].data[dataPointIndex];

                        let formattedNumber = ratingVal.toLocaleString('id-ID');
                        return formattedNumber
                    }
                }
            },
            xaxis: {
                categories: dates, // Tanggal-tanggal pada sumbu X
            },
            title: {
                text: 'Jumlah Barang Masuk per Tanggal', // Judul chart
            }
        };

        // Konfigurasi chart
        var optionsKeluar = {
            chart: {
                type: 'line', // Jenis chart: garis
            },
            series: [{
                name: 'Barang Keluar', // Nama seri data
                data: dataKeluar // Data jumlah barang masuk
            }],
            tooltip: {
                x: {
                    show: true,
                },
                y: {
                    title: {
                        formatter: function formatter(val) {
                        return '';
                        }
                    },
                    formatter: function(value, { series, seriesIndex, dataPointIndex, w }) {
                        let ratingVal = w.globals.initialSeries[seriesIndex].data[dataPointIndex];

                        let formattedNumber = ratingVal.toLocaleString('id-ID');
                        return formattedNumber
                    }
                }
            },
            xaxis: {
                categories: dates, // Tanggal-tanggal pada sumbu X
            },
            title: {
                text: 'Jumlah Barang Keluar per Tanggal', // Judul chart
            }
        };

        // Inisialisasi dan render chart
        var chartMasuk = new ApexCharts(document.querySelector("#chartMasuk"), optionsMasuk);
        var chartKeluar = new ApexCharts(document.querySelector("#chartKeluar"), optionsKeluar);
        chartMasuk.render(); // Render chart ke dalam elemen dengan id "chart"
        chartKeluar.render();
    </script>
@endsection
