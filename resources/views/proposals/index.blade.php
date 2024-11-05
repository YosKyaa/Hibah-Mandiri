@extends('layouts.master')
@section('title', 'Pengajuan')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="assets/vendor/libs/bootstrap-select/bootstrap-select.css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert2.css') }}">
@endsection

@section('style')
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        .timeline .timeline-item .timeline-indicator i,
        .timeline .timeline-item .timeline-indicator-advanced i {
            color: #696cff;
        }

        .timeline .timeline-indicator-primary i {
            color: #696cff !important;
        }

        .bx {
            vertical-align: middle;
            font-size: 1.15rem;
            line-height: 1;
        }

        .bx {
            font-family: "boxicons" !important;
            font-weight: normal;
            font-style: normal;
            font-variant: normal;
            line-height: 1;
            text-rendering: auto;
            display: inline-block;
            text-transform: none;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        user agent stylesheet i {
            font-style: italic;
        }

        .timeline .timeline-item .timeline-indicator,
        .timeline .timeline-item .timeline-indicator-advanced {
            position: absolute;
            left: -0.75rem;
            top: 0;
            z-index: 2;
            height: 1.5rem;
            width: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            border-radius: 50%;
        }

        user agent stylesheet li {
            text-align: -webkit-match-parent;
        }

        .timeline {
            position: relative;
            height: 100%;
            width: 100%;
            padding: 0;
            list-style: none;
        }

        .mb-4 {
            margin-bottom: 1.5rem !important;
        }

        .layout-page,
        .content-wrapper,
        .content-wrapper>*,
        .layout-menu {
            min-height: unset;
        }

        .table table-hover table-sm {
            font-size: 0.875rem;
        }
    </style>
    <link rel="stylesheet" href="../../assets/vendor/libs/bs-stepper/bs-stepper.css" />
@endsection

@section('content')
    @if (session('proposals'))
        <div class="alert alert-info alert-dismissible" role="alert">
            {{ session('proposals') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    <!-- Data is empty, do not display the table -->

    <!-- <div class="card border"> -->
    <div class="card mb-3 ">
        <div class="card-body">
            <div class="card-header justify-content-between align-items-center">
                <h2 class="mb-0"><strong>Halaman Manajemen Pengajuan Hibah Mandiri</strong></h2>
                @if ($proposals->isEmpty())
                    <span class="text-muted">Silahkan ajukan proposal anda!</span>
                @elseif ($proposals->last()->status_id == 'S04')
                    <span class="text-muted">Silahkan kembali ajukan proposal anda!</span>
                @else
                    <span class="text-muted">Ini adalah halaman untuk mengelola pengajuan.</span>
                @endif
            </div>
        </div>
    </div>

    @foreach ($proposals as $proposal)
        @if ($proposal->review_notes && !$proposal->review_notes)
            <div class="row g-6 mb-3">
                <div class="col-md-12 col-xl-12">
                    <div class="card bg-warning text-white">
                        <div class="card-body">
                            <h5 class="card-title text-white">Mohon Segera Melakukan Revisi! </h5>
                            <p class="card-text">
                                Mohon segera melakukan revisi. Proposal Anda membutuhkan perbaikan sebelum dapat melanjutkan
                                proses selanjutnya.
                                <br>
                                Catatan Reviewer: {!! $proposal->review_notes !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach


    @foreach ($proposals as $proposal)
        @if ($proposal->approval_head_of_lppm === 1 && !$proposal->bank_id)
            <div class="row g-6 mb-3">
                <div class="col-md-12 col-xl-12">
                    <div class="card bg-warning text-white">
                        <div class="card-body">
                            <h5 class="card-title text-white">Silahkan Lengkapi Nomor Rekening! </h5>
                            <p class="card-text">
                                Nomor rekening anda belum lengkap, silahkan lengkapi nomor rekening anda untuk
                                melanjutkan proses selanjutnya.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

    @foreach ($proposals as $proposal)
        @if ($proposal->bank_id && !$proposal->documents->contains('doc_type_id', 'DC3'))
            <div class="row g-6 mb-3">
                <div class="col-md-12 col-xl-12">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <h5 class="card-title text-white">Kontrak Anda Telah terbit</h5>
                            <p class="card-text">
                                Silahkan cek dan unduh kontrak anda pada kolom tombol aksi.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

    @foreach ($proposals as $proposal)
        @if ($proposal->documents->contains('doc_type_id', 'DC3') && !$proposal->monev_comment)
            <div class="row g-6 mb-3">
                <div class="col-md-12 col-xl-12">
                    <div class="card bg-warning text-white">
                        <div class="card-body">
                            <h5 class="card-title text-white">Silahkan Unggah Laporan Monev!</h5>
                            <p class="card-text">
                                Silahkan unggah laporan monitoring dan evaluasi anda pada kolom tombol aksi untuk Pencairan
                                dana tahap II.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

    @foreach ($proposals as $proposal)
        @if (
            $proposal->documents->contains('doc_type_id', 'DC4') &&
                !$proposal->documents->contains('doc_type_id', 'DC6') &&
                !in_array($proposal->status_id, ['S00', 'S01', 'S02', 'S03', 'S04', 'S05', 'S06', 'S07', 'S08']))
            <div class="row g-6 mb-3">
                <div class="col-md-12 col-xl-12">
                    <div class="card bg-warning text-white">
                        <div class="card-body">
                            <h5 class="card-title text-white">Silahkan Unggah Laporan Akhir</h5>
                            <p class="card-text">
                                Dana tahap 2 telah cair, silahkan cek rekening anda. silahkan unggah laporan akhir
                                penelitian anda pada kolom aksi.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

    @foreach ($proposals as $proposal)
        @if (
            $proposal->documents->contains('doc_type_id', 'DC6') &&
                !in_array($proposal->status_id, ['S00', 'S01', 'S02', 'S03', 'S04', 'S05', 'S06', 'S07', 'S08', 'S09']))
            <div class="row g-6 mb-3">
                <div class="col-md-12 col-xl-12">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h5 class="card-title text-white">Rangkaian Pengajuan Telah Selesai</h5>
                            <p class="card-text">
                                Terima kasih telah menggunakan layanan kami, pengajuan anda telah selesai.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach


    <div id="wizard-checkout" class="bs-stepper wizard-icons wizard-icons-example p-3">
        <div class="bs-stepper-header m-lg-auto border-0">
            <div class="step active" data-target="#checkout-cart">
                <button type="button" class="step-trigger" id="Step-1" aria-selected="true">
                    <span class="bs-stepper-icon">
                        <svg fill="#000000" width="800px" height="800px" viewBox="0 0 1920 1920"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M1750.21 0v1468.235h-225.882v338.824h169.412V1920H451.387c-82.447 0-161.506-36.141-214.701-99.388-43.934-51.953-67.652-116.33-67.652-182.965V282.353C169.034 126.494 295.528 0 451.387 0H1750.21Zm-338.823 1468.235H463.81c-89.223 0-166.136 59.86-179.576 140.047-1.242 9.036-2.259 18.07-2.259 27.106v2.26c0 40.658 13.553 77.928 40.659 109.552 32.753 38.4 79.059 59.859 128.753 59.859h960v-112.941H409.599v-112.942h1001.788v-112.94Zm225.882-1355.294H451.387c-92.725 0-169.412 75.67-169.412 169.412v1132.8c50.824-37.27 113.958-59.859 181.835-59.859h1173.46V112.941ZM1354.882 903.53v112.942H564.294V903.529h790.588Zm56.47-564.705v451.764H507.825V338.824h903.529Zm-112.94 112.94H620.765v225.883h677.647V451.765Z"
                                fill-rule="evenodd" />
                        </svg>
                    </span>
                    <span class="bs-stepper-label">Pengajuan</span>
                </button>
            </div>
            <div class="line">
                <i class="bx bx-chevron-right"></i>
            </div>
            <div class="step" data-target="#checkout-address">
                <button type="button" class="step-trigger" id="Step-2" aria-selected="false">
                    <span class="bs-stepper-icon">
                        <svg fill="#000000" width="800px" height="800px" viewBox="0 0 1920 1920"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M640.376 790.588c38.852 0 55.68 15.586 83.577 41.337 32.866 30.155 77.816 71.604 161.506 71.604 60.31 0 100.066-22.023 129.882-45.628-5.873 150.55-129.205 271.51-281.223 271.51-139.483 0-255.022-101.985-277.61-235.143 45.403-13.666 75.67-40.433 98.937-62.004 28.235-25.977 45.29-41.676 84.931-41.676ZM1920-.012V1129.4h-338.824v-112.94h225.883V112.93H112.94v903.53h112.941v112.94H0V-.01h1920ZM734.118 451.766c148.404 0 269.138 115.539 280.207 261.233-17.393 11.633-32.753 24.17-45.967 36.367-27.784 25.75-44.386 41.223-82.9 41.223-39.642 0-56.696-15.699-84.93-41.675-32.528-30.042-77.253-71.266-160.152-71.266-83.689 0-128.64 41.45-161.505 71.605-9.94 9.148-18.523 16.49-27.106 22.814v-37.948c0-155.633 126.607-282.353 282.353-282.353Zm737.731 262.475-310.136 826.955c-217.412 22.589-482.598 24.621-638.57-32.3l-38.851 106.164c232.659 84.932 614.852 48.339 747.332 39.755l7.115 2.71 1.242-3.275c.678 0 1.92-.113 2.71-.113l-31.849 87.078c-4.404 12.31-14.57 21.12-27.67 24.057-117.46 26.993-277.045 41.788-449.054 41.788-171.784 0-346.617-32.64-508.236-94.645V1459.2c0-75.67 50.598-142.758 123.22-163.426 123.896-35.35 251.406-53.76 382.192-53.647.904 0 1.807.226 2.824.226.564 0 1.016-.113 1.58-.113 126.27.452 255.474 17.958 387.502 54.664l37.045-106.617-14.683-4.63c-53.534-14.796-107.746-25.638-161.844-34.673 88.094-72.509 145.694-181.045 145.694-303.925V734.118c0-217.977-177.318-395.294-395.294-395.294-217.977 0-395.294 177.317-395.294 395.294v112.94c0 122.655 57.374 231.078 145.355 303.7-56.019 9.26-111.586 20.894-166.024 36.367-120.847 34.334-205.214 146.259-205.214 272.075v328.998l34.899 14.57C332.386 1879.453 535.228 1920 734.118 1920c180.367 0 348.762-15.812 474.24-44.612 50.371-11.633 90.917-47.096 108.536-95.322l31.85-87.078c14.343-39.303 7.567-82.22-18.41-114.748-12.988-16.376-29.59-28.687-48.226-36.254l295.454-787.99-105.713-39.756Z"
                                fill-rule="evenodd" />
                        </svg>
                    </span>
                    <span class="bs-stepper-label">Penilaian</span>
                </button>
            </div>
            <div class="line">
                <i class="bx bx-chevron-right"></i>
            </div>
            <div class="step" data-target="#checkout-payment">
                <button type="button" class="step-trigger" id="Step-3" aria-selected="false">
                    <span class="bs-stepper-icon">
                        <svg fill="#000000" width="800px" height="800px" viewBox="0 0 1920 1920"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M960 1807.059c-467.125 0-847.059-379.934-847.059-847.059 0-467.125 379.934-847.059 847.059-847.059 467.125 0 847.059 379.934 847.059 847.059 0 467.125-379.934 847.059-847.059 847.059M960 0C430.645 0 0 430.645 0 960s430.645 960 960 960 960-430.645 960-960S1489.355 0 960 0M854.344 1157.975 583.059 886.69l-79.85 79.85 351.135 351.133L1454.4 717.617l-79.85-79.85-520.206 520.208Z"
                                fill-rule="evenodd" />
                        </svg>
                    </span>
                    <span class="bs-stepper-label">Approval</span>
                </button>
            </div>
            <div class="line">
                <i class="bx bx-chevron-right"></i>
            </div>
            <div class="step" data-target="#checkout-confirmation">
                <button type="button" class="step-trigger" id="Step-4" aria-selected="false">
                    <span class="bs-stepper-icon">
                        <svg fill="#000000" width="800px" height="800px" viewBox="0 0 1920 1920"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M1226.667 267c88.213 0 160 71.787 160 160v426.667H1280v-160H106.667v800C106.667 1523 130.56 1547 160 1547h1066.667c29.44 0 53.333-24 53.333-53.333v-213.334h106.667v213.334c0 88.213-71.787 160-160 160H160c-88.213 0-160-71.787-160-160V427c0-88.213 71.787-160 160-160Zm357.706 442.293 320 320c20.8 20.8 20.8 54.614 0 75.414l-320 320-75.413-75.414 228.907-228.906H906.613V1013.72h831.254L1508.96 784.707l75.413-75.414Zm-357.706-335.626H160c-29.44 0-53.333 24-53.333 53.333v160H1280V427c0-29.333-23.893-53.333-53.333-53.333Z"
                                fill-rule="evenodd" />
                        </svg>
                    </span>
                    <span class="bs-stepper-label">Pencairan Dana</span>
                </button>
            </div>
            <div class="line">
                <i class="bx bx-chevron-right"></i>
            </div>
            <div class="step" data-target="#checkout-confirmation">
                <button type="button" class="step-trigger" id="Step-4" aria-selected="false">
                    <span class="bs-stepper-icon">
                        <svg width="800px" height="800px" viewBox="0 0 1024 1024" fill="#000000" class="icon"
                            version="1.1" xmlns="http://www.w3.org/2000/svg">
                            <path d="M300 462.4h424.8v48H300v-48zM300 673.6H560v48H300v-48z" fill="" />
                            <path
                                d="M818.4 981.6H205.6c-12.8 0-24.8-2.4-36.8-7.2-11.2-4.8-21.6-11.2-29.6-20-8.8-8.8-15.2-18.4-20-29.6-4.8-12-7.2-24-7.2-36.8V250.4c0-12.8 2.4-24.8 7.2-36.8 4.8-11.2 11.2-21.6 20-29.6 8.8-8.8 18.4-15.2 29.6-20 12-4.8 24-7.2 36.8-7.2h92.8v47.2H205.6c-25.6 0-47.2 20.8-47.2 47.2v637.6c0 25.6 20.8 47.2 47.2 47.2h612c25.6 0 47.2-20.8 47.2-47.2V250.4c0-25.6-20.8-47.2-47.2-47.2H725.6v-47.2h92.8c12.8 0 24.8 2.4 36.8 7.2 11.2 4.8 21.6 11.2 29.6 20 8.8 8.8 15.2 18.4 20 29.6 4.8 12 7.2 24 7.2 36.8v637.6c0 12.8-2.4 24.8-7.2 36.8-4.8 11.2-11.2 21.6-20 29.6-8.8 8.8-18.4 15.2-29.6 20-12 5.6-24 8-36.8 8z"
                                fill="" />
                            <path
                                d="M747.2 297.6H276.8V144c0-32.8 26.4-59.2 59.2-59.2h60.8c21.6-43.2 66.4-71.2 116-71.2 49.6 0 94.4 28 116 71.2h60.8c32.8 0 59.2 26.4 59.2 59.2l-1.6 153.6z m-423.2-47.2h376.8V144c0-6.4-5.6-12-12-12H595.2l-5.6-16c-11.2-32.8-42.4-55.2-77.6-55.2-35.2 0-66.4 22.4-77.6 55.2l-5.6 16H335.2c-6.4 0-12 5.6-12 12v106.4z"
                                fill="" />
                        </svg>
                    </span>
                    <span class="bs-stepper-label">Monev</span>
                </button>
            </div>
            <div class="line">
                <i class="bx bx-chevron-right"></i>
            </div>
            <div class="step" data-target="#checkout-confirmation">
                <button type="button" class="step-trigger" id="Step-5" aria-selected="false">
                    <span class="bs-stepper-icon">
                        <svg fill="#000000" width="800px" height="800px" viewBox="0 0 1920 1920"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M1468.214 0v564.698h-112.94V112.94H112.94v1694.092h1242.334v-225.879h112.94v338.819H0V0h1468.214Zm129.428 581.311c22.137-22.136 57.825-22.136 79.962 0l225.879 225.879c22.023 22.023 22.023 57.712 0 79.848l-677.638 677.637c-10.616 10.504-24.96 16.49-39.98 16.49h-225.88c-31.17 0-56.469-25.299-56.469-56.47v-225.88c0-15.02 5.986-29.364 16.49-39.867Zm-155.291 314.988-425.895 425.895v146.031h146.03l425.895-425.895-146.03-146.03Zm-764.714 346.047v112.94H338.82v-112.94h338.818Zm225.88-225.88v112.94H338.818v-112.94h564.697Zm734.106-315.44-115.424 115.425 146.03 146.03 115.425-115.423-146.031-146.031ZM1129.395 338.83v451.758H338.82V338.83h790.576Zm-112.94 112.94H451.759v225.878h564.698V451.77Z"
                                fill-rule="evenodd" />
                        </svg>
                    </span>
                    <span class="bs-stepper-label">Laporan Akhir</span>
                </button>
            </div>
        </div>
        <hr class="my-0 mb-3">
        <div class="card-body p-3">
            <div class="row p-3">
                <div class="mb-2 col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div>
                                <h3 class="mb-3">List Pengajuan Proposal</h3>
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="../user-proposals/create" class="btn btn-md btn-primary"><span><i
                                        class="bx bx-plus me-sm-2"></i><span>Ajukan Proposal</span></span></a>
                        </div>
                    </div>

                </div>

                <div class="mb-2 col-md-12">
                    <div class="table-responsive">
                        <div class="card-datatable table-responsive">
                            <table class="table table-hover table-sm" id="datatable" width="100%">
                                <thead>
                                    <tr>
                                        <th data-priority="1"><strong>Judul Proposal</strong></th>
                                        <th><strong>Jenis Penelitian</strong></th>
                                        <th data-priority="3"><strong>TopiK Penelitian</strong></th>
                                        <th><strong>Status</strong></th>
                                        <th data-priority="2" style="width: 15%;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    </div>


    <!-- </div> -->


@endsection

@section('script')
    <script src="{{ asset('assets/vendor/libs/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables/datatables.responsive.js') }}"></script>
    <script src="assets/vendor/libs/select2/select2.js"></script>
    <script src="assets/vendor/libs/bootstrap-select/bootstrap-select.js"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>

    @if (session('proposals'))
        <script type="text/javascript">
            //swall message notification
            $(document).ready(function() {
                Swal.fire({
                    title: 'Info!',
                    text: '{!! session('proposals') !!}',
                    type: 'info',
                    customClass: {
                        confirmButton: 'btn btn-primary'
                    },
                    buttonsStyling: false
                });
            });
        </script>
    @endif
    @if (session('error'))
        <script type="text/javascript">
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "{{ session('error') }}",
            });
        </script>
    @endif
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#datatable').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ordering: false,
                searching: false,
                language: {
                    searchPlaceholder: 'Search..',
                    // url: "{{ asset('assets/vendor/libs/datatables/id.json') }}"
                },
                ajax: {
                    url: "{{ route('user-proposals.data') }}",
                    data: function(d) {
                        d.search = $('#datatable_filter input[type="search"]').val()
                    },
                },
                columnDefs: [{
                    "defaultContent": "-",
                    "targets": "_all"
                }],
                columns: [{
                        render: function(data, type, row, meta) {
                            var html = '<strong>' + row.research_title + '</strong>';
                            return html;
                        }
                    },
                    {
                        render: function(data, type, row, meta) {
                            var html = '<em>' + row.research_type.title + '</em>';
                            return html;
                        }
                    },
                    {
                        render: function(data, type, row, meta) {
                            var html = row.research_topic.name;
                            return html;
                        }
                    },
                    {
                        render: function(data, type, row, meta) {
                            var html =
                                `<span class="badge rounded-pill bg-label-${row.statuses.color}">
                                <span class="badge badge-dot bg-${row.statuses.color} me-1"></span>${row.statuses.status} </span>`;
                            return html;
                        }
                    },
                    {
                        render: function(data, type, row, meta) {
                            var html = '';
                            // if (row.documents && row.documents.some(doc => doc.doc_type_id ===
                            //         'DC6')) {
                            //     html =
                            //         `<a class="badge badge-center rounded-pill bg-warning" title="Show" href="{{ url('user-proposals/show/${row.id}') }}"><i class="bx bx-show"></i></a>
                        //         `;
                            // } else if (row.documents && row.documents.some(doc => doc
                            //         .doc_type_id ===
                            //         'DC4')) {
                            //     html =
                            //         `<a class="badge badge-center rounded-pill bg-warning" title="Show" href="{{ url('user-proposals/show/${row.id}') }}"><i class="bx bx-show"></i></a>
                        //         <a class="badge badge-center rounded-pill bg-success" title="Unggah Laporan Akhir" href="{{ url('user-proposals/final-report/${row.id}') }}"><i class="bx bx-upload"></i></a>`;
                            // } else if (row.documents && row.documents.some(doc => doc
                            //         .doc_type_id ===
                            //         'DC5')) {
                            //     html =
                            //         `<a class="badge badge-center rounded-pill bg-warning" title="Show" href="{{ url('user-proposals/show/${row.id}') }}"><i class="bx bx-show"></i></a>`;
                            // } else if (row.documents && row.documents.some(doc => doc
                            //         .doc_type_id === 'DC3')) {
                            //     html =
                            //         `<a class="badge badge-center rounded-pill bg-warning" title="Show" href="{{ url('user-proposals/show/${row.id}') }}"><i class="bx bx-show"></i></a>
                        // <a class="badge badge-center rounded-pill bg-success" title="Unggah Monev" href="{{ url('user-proposals/monev/${row.id}') }}"><i class="bx bx-upload"></i></a>`;
                            // } else if (row.bank_id) {
                            //     html =
                            //         `<a class="badge badge-center rounded-pill bg-warning" title="Show" href="{{ url('user-proposals/show/${row.id}') }}"><i class="bx bx-show" style="color:#ffff"></i></a>
                        //         <a class="badge badge-center rounded-pill bg-success" title="Kontrak" href="{{ url('user-proposals/print_pdf/${row.id}') }}"><i class="bx bx-download"></i></a>`;
                            // } else if (row.approval_vice_rector_2) {
                            //     html =
                            //         `<a class="badge badge-center rounded-pill bg-warning" title="Show" href="{{ url('user-proposals/show/${row.id}') }}"><i class="bx bx-show" style="color:#ffff"></i></a>
                        //         <a class="badge badge-center rounded-pill bg-success" title="Upload Nomor Rekening" href="{{ url('user-proposals/account-bank/${row.id}') }}"><i class="bx bx-upload" style="color:#ffff"></i></a>`;
                            // } else if (row.mark_as_revised_2) {
                            //     html =
                            //         `<a class="badge badge-center rounded-pill bg-warning" title="Show" href="{{ url('user-proposals/show/${row.id}') }}"><i class="bx bx-show" style="color:#ffff"></i></a>`;
                            // } else if (row.review_notes_2) {
                            //     html +=
                            //         `<a class="badge badge-center rounded-pill bg-success" title="Kirim Revisi 2" style="cursor:pointer" onclick="mark_as_revised_2('${row.id}')"><i class="bx bx-check" style="color:#ffff"></i></a>
                        //         <a class="badge badge-center rounded-pill bg-success" title="Edit" href="{{ url('user-proposals/edit/${row.id}') }}"><i class="bx bxs-edit" style="color:#ffff"></i></a>`;
                            // } else if (row.statuses.id === 'S01' || row.statuses.id === 'S02' || row
                            //     .statuses.id === 'S04' || row.statuses.id === 'S05' || row.statuses
                            //     .id === 'S06' || row.statuses.id === 'S07') {
                            //     html +=
                            //         `<a class="badge badge-center rounded-pill bg-warning" title="Show" href="{{ url('user-proposals/show/${row.id}') }}"><i class="bx bx-show" style="color:#ffff"></i></a>`;
                            if (row.documents && row.documents.some(doc => doc
                                    .doc_type_id ===
                                    'DC5')) {
                                html +=
                                    `<a class="badge badge-center rounded-pill bg-warning" title="Show" href="{{ url('user-proposals/show/${row.id}') }}"><i class="bx bx-show"></i></a>`;
                            } else if (row.documents && row.documents.some(doc => doc
                                    .doc_type_id ===
                                    'DC3')) {
                                html +=
                                    `<a class="badge badge-center rounded-pill bg-warning" title="Show" href="{{ url('user-proposals/show/${row.id}') }}"><i class="bx bx-show"></i></a>
                            <a class="badge badge-center rounded-pill bg-info" title="Unggah Monev" href="{{ url('user-proposals/monev/${row.id}') }}"><i class="bx bx-upload"></i></a>`;
                            } else if (row.bank_id) {
                                html =
                                    `<ul class="list-unstyled users-list m-0 avatar-group d-flex justify-content-center align-items-center gap-2">
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="Show">
                                            <a class="badge badge-center rounded-pill bg-warning mb-2" href="{{ url('user-proposals/show/${row.id}') }}">
                                                <i class="bx bx-show" style="color:#ffff"></i>
                                            </a>
                                        </li>
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="Kontrak">
                                            <a class="badge badge-center rounded-pill bg-info" href="{{ url('user-proposals/print_pdf/${row.id}') }}">
                                                <i class="bx bx-download" style="color:#ffff"></i>
                                            </a>
                                        </li>
                                    </ul>`;
                            } else if (row.status_id === 'S06') {
                                html =
                                    `<ul class="list-unstyled users-list m-0 avatar-group d-flex justify-content-center align-items-center gap-2">
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="Show">
                                            <a class="badge badge-center rounded-pill bg-warning mb-2" href="{{ url('user-proposals/show/${row.id}') }}">
                                                <i class="bx bx-show" style="color:#ffff"></i>
                                            </a>
                                        </li>
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="Upload Nomor Rekening">
                                            <a class="badge badge-center rounded-pill bg-success" href="{{ url('user-proposals/account-bank/${row.id}') }}">
                                                <i class="bx bx-upload" style="color:#ffff"></i>
                                            </a>
                                        </li>
                                    </ul>`;
                            } else if (row.status_id === 'S05') {
                                html =
                                `<ul class="list-unstyled users-list m-0 avatar-group d-flex justify-content-center align-items-center gap-2">
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="Show">
                                            <a class="badge badge-center rounded-pill bg-warning mb-2" href="{{ url('user-proposals/show/${row.id}') }}">
                                                <i class="bx bx-show" style="color:#ffff"></i>
                                            </a>
                                        </li>
                                    </ul>`;
                            } else if (row.mark_as_revised) {
                                html =
                                `<ul class="list-unstyled users-list m-0 avatar-group d-flex justify-content-center align-items-center gap-2">
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="Show">
                                            <a class="badge badge-center rounded-pill bg-warning mb-2" href="{{ url('user-proposals/show/${row.id}') }}">
                                                <i class="bx bx-show" style="color:#ffff"></i>
                                            </a>
                                        </li>
                                    </ul>`;
                            } else if (row.review_notes) {
                                html +=
                                    `<ul class="list-unstyled users-list m-0 avatar-group d-flex justify-content-center align-items-center gap-2">
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="Kirim Revisi">
                                            <a class="badge badge-center rounded-pill bg-success" style="cursor:pointer" onclick="mark_as_revised('${row.id}')">
                                                <i class="bx bx-check" style="color:#ffff"></i>
                                            </a>
                                        </li>
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="Edit">
                                            <a class="badge badge-center rounded-pill bg-success" href="{{ url('user-proposals/edit/${row.id}') }}">
                                                <i class="bx bxs-edit" style="color:#ffff"></i>
                                            </a>
                                        </li>
                                    </ul>`;
                            } else if (row.status_id === 'S01' || row.status_id === 'S02') {
                                html =
                                    `<ul class="list-unstyled users-list m-0 avatar-group d-flex justify-content-center align-items-center gap-2">
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="Show">
                                            <a class="badge badge-center rounded-pill bg-warning mb-2" href="{{ url('user-proposals/show/${row.id}') }}">
                                                <i class="bx bx-show" style="color:#ffff"></i>
                                            </a>
                                        </li>
                                    </ul>`;
                            } else {
                                html =
                                    `<ul class="list-unstyled users-list m-0 avatar-group d-flex justify-content-center align-items-center gap-2">
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="Kirim">
                                            <a class="badge badge-center rounded-pill bg-success mb-2" style="cursor:pointer" onclick="SubmitFirst('${row.id}')">
                                                <i class="bx bx-check" style="color:#ffff"></i>
                                            </a>
                                        </li>
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="Show">
                                            <a class="badge badge-center rounded-pill bg-warning mb-2" href="{{ url('user-proposals/show/${row.id}') }}">
                                                <i class="bx bx-show" style="color:#ffff"></i>
                                            </a>
                                        </li>
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="Edit">
                                            <a class="badge badge-center rounded-pill bg-success mb-2" href="{{ url('user-proposals/edit/${row.id}') }}">
                                                <i class="bx bxs-edit" style="color:#ffff"></i>
                                            </a>
                                        </li>
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="Hapus">
                                            <a class="badge badge-center rounded-pill bg-danger mb-2" style="cursor:pointer" onclick="DeleteId('${row.id}','${row.name}')">
                                                <i class="bx bxs-trash" style="color:#ffff"></i>
                                            </a>
                                        </li>
                                    </ul>`
                            }
                            return html;
                        },
                        "orderable": false,
                        className: "text-md-center"
                    }
                ]

            });

        });


        function SubmitFirst(id) {
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Anda akan mengajukan proposal ini! Jika sudah diajukan, tidak dapat diubah kembali.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Ajukan!',
                customClass: {
                    confirmButton: 'btn btn-primary me-1',
                    cancelButton: 'btn btn-label-secondary'
                },
                buttonsStyling: false
            }).then(function(result) {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('user-proposals.approve') }}",
                        type: "POST",
                        data: {
                            id: id,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Terkirim!',
                                    text: 'Proposal telah berhasil diajukan.',
                                    customClass: {
                                        confirmButton: 'btn btn-success'
                                    }
                                });
                                $('#datatable').DataTable().ajax.reload();
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: response.message,
                                    customClass: {
                                        confirmButton: 'btn btn-danger'
                                    }
                                });
                            }
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Terjadi kesalahan saat mengirim proposal.',
                                customClass: {
                                    confirmButton: 'btn btn-danger'
                                }
                            });
                        }
                    });
                }
            });
        }




        //Revisi 1
        function mark_as_revised(id) {
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Anda akan mengirim hasil revisi ini!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Kirim!',
                customClass: {
                    confirmButton: 'btn btn-primary me-1',
                    cancelButton: 'btn btn-label-secondary'
                },
                buttonsStyling: false
            }).then(function(result) {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('user-proposals.mark_as_revised') }}",
                        type: "POST",
                        data: {
                            id: id,
                            _token: "{{ csrf_token() }}" // Include CSRF token for security
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Terkirim!',
                                    text: 'Hasil revisi telah berhasil dikirim.',
                                    customClass: {
                                        confirmButton: 'btn btn-success'
                                    }
                                });
                                $('#datatable').DataTable().ajax.reload();
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: data.error,
                                    customClass: {
                                        confirmButton: 'btn btn-danger'
                                    }
                                });
                            }
                        }
                    });
                }
            });
        }


        function DeleteId(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Setelah dihapus, data tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                customClass: {
                    confirmButton: 'btn btn-primary me-1',
                    cancelButton: 'btn btn-label-secondary'
                },
                buttonsStyling: false
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: "{{ route('user-proposals.delete') }}",
                        type: "DELETE",
                        data: {
                            "id": id,
                            "_token": $("meta[name='csrf-token']").attr("content"),
                        },
                        success: function(data) {
                            if (data['success']) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Terhapus!',
                                    text: 'File Anda telah dihapus.',
                                    customClass: {
                                        confirmButton: 'btn btn-success'
                                    }
                                });
                                $('#datatable').DataTable().ajax.reload();
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: 'Terjadi kesalahan saat menghapus file.',
                                    customClass: {
                                        confirmButton: 'btn btn-success'
                                    }
                                });
                            }
                        }
                    })
                }
            })
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const status_id = {
                'S01': ['#Step-1'],
                'S02': ['#Step-1'],
                'S03': ['#Step-1'],
                'S05': ['#Step-1'],
                'S06': ['#Step-1', '#Step-2'],
                'S07': ['#Step-1', '#Step-2', '#Step-3'],
                'S08': ['#Step-1', '#Step-2', '#Step-3', '#Step-4'],
                'S09': ['#Step-1', '#Step-2', '#Step-3', '#Step-4'],
                'S10': ['#Step-1', '#Step-2', '#Step-3', '#Step-4', '#Step-5']
            };

            function setStepStatus(status) {
                // Deactivate all steps
                document.querySelectorAll('.step').forEach(step => {
                    step.classList.remove('active');
                    step.querySelector('.step-trigger').setAttribute('aria-selected', 'false');
                });

                // Activate the correct steps based on status
                const activeSteps = status_id[status];
                if (activeSteps) {
                    activeSteps.forEach(step => {
                        const activeStep = document.querySelector(step);
                        if (activeStep) {
                            activeStep.parentElement.classList.add('active');
                            activeStep.setAttribute('aria-selected', 'true');
                        }
                    });
                }
            }

            // Check if proposals exist and get the status, otherwise default to 'S01'
            let initialStatus = 'S00';
            @if (isset($proposals) && $proposals->isNotEmpty())
                const firstStatus = '{{ $proposals->first()->statuses->id ?? '' }}';
                const secondStatus = '{{ $proposals[1]->statuses->id ?? '' }}';
                initialStatus = (firstStatus === 'S04') ? secondStatus : firstStatus;
            @endif

            // Call the function with the initial status
            setStepStatus(initialStatus);
        });
    </script>



@endsection
