@extends('layouts.master')

@section('title', 'Manajemen Proposal Ketua LPPM')
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
@endsection

@section('style')
    <style>
        .margin-right {
            margin-right: 20px;
        }

        .margin-left {
            margin-left: 20px;
        }

        .layout-page,
        .content-wrapper,
        .content-wrapper>*,
        .layout-menu {
            min-height: unset;
        }
    </style>
@endsection

@section('content')


    <div class="app-academy">
        <div class="card p-0 mb-2">
            <div class="card-body d-flex flex-column flex-md-row justify-content-between p-0 pt-4">
                <div class="app-academy-md-25 card-body py-0">
                    {{-- <img src="" class="img-fluid app-academy-img-height scaleX-n1-rtl" alt="Bulb in hand"
                        data-app-light-img="illustrations/bulb-light.png" data-app-dark-img="illustrations/bulb-dark.png"
                        height="90"> --}}
                </div>
                <div class="app-academy-md-50 card-body d-flex align-items-md-center flex-column text-md-center">
                    <h2 class="card-title mb-4 lh-sm px-md-5 text-center ">
                        <strong>Halaman Manajemen.</strong>
                        <span class="text-primary fw-medium text-nowrap">Ketua LPPM</span>.
                    </h2>
                    <p class="mb-4">
                        Proses persetujuan untuk Ketua LPPM melibatkan pengelolaan dan peninjauan proposal. Sebagai
                        Ketua LPPM, Anda memiliki wewenang untuk menyetujui atau menolak proposal penelitian.
                    </p>
                </div>
                {{-- <div class="app-academy-md-25 d-flex align-items-end justify-content-end">
                    <img src="" alt="pencil rocket" height="188" class="scaleX-n1-rtl">
                </div> --}}
            </div>
        </div>
        <div class="card mb-2">
            <div class="card-body">
                <div class="col-12 col-md-12 p-3">
                    <div class="col-12 col-lg-7">
                    </div>
                    <div class="d-flex justify-content-between flex-wrap gap-3 me-5">
                        <div class="d-flex align-items-center gap-3 me-4 me-sm-0">
                            <span class=" bg-label-primary p-2 rounded">
                                <i class="bx bx-laptop bx-sm"></i>
                            </span>
                            <div class="content-right">
                                <p class="mb-0">Jumlah Proposal yang <strong>Tidak Direkomendasikan
                                    </strong>{{ $notRecommended }} </p>
                                <h4 class="text-primary mb-0"></h4>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <span class="bg-label-warning p-2 rounded">
                                <i class="bx bx-check-circle bx-sm"></i>
                            </span>
                            <div class="content-right">
                                <p class="mb-0">Jumlah Proposal yang <strong>Direkomendasikan
                                    </strong>{{ $recommended }} </p>
                                <h4 class="text-warning mb-0"></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card p-2">
            <div class="card-header gap-3">
                <div class="card-title mb-0 me-1">
                    <h5 class="mb-1">List Proposal</h5>
                    <p class="text-muted mb-5">Total <strong>{{ $totalProposal }}</strong> proposal pengajuan yang
                        tersedia.</p>
                    <div class="row mb-3">
                        <div class="col-12 pt-3 pt-md-0">
                            <div class="col-12 ">
                                <div class="row">
                                    <div class=" col-md-3 mb-3">
                                        <select id="select_category" class="select2 form-select"
                                            data-placeholder="Kategori">
                                            <option value="">Kategori</option>
                                            @foreach ($researchcategories as $d)
                                                <option value="{{ $d->id }}">{{ $d->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class=" col-md-3 mb-3">
                                        <select id="select_tkt_type" class="select2 form-select" data-placeholder="TKT">
                                            <option value="">TKT</option>
                                            @foreach ($tktTypes as $d)
                                                <option value="{{ $d->id }}">{{ $d->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class=" col-md-3 mb-3">
                                        <select id="select_main_research_target" class="select2 form-select"
                                            data-placeholder="Terget Utama Riset">
                                            <option value="">Terget Utama Riset</option>
                                            @foreach ($mainresearchtargets as $d)
                                                <option value="{{ $d->id }}">{{ $d->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container mb-3">
                        <table class="table table-hover table-lg" id="datatable">
                            <thead>
                                <tr>
                                    <th width="20px">No.</th>
                                    <th data-priority="1">Peneliti</th>
                                    <th data-priority="4">Judul</th>
                                    <th>Kategori</th>
                                    <th>TKT</th>
                                    <th>Target Utama Riset</th>
                                    <th data-priority="3">Status</th>
                                    <th></th>
                                    <th data-priority="2" style="width: 10%;">Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script src="{{ asset('assets/vendor/libs/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables/datatables.responsive.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables/responsive.bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables/datatables.checkboxes.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables/datatables-buttons.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables/buttons.bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('msg'))
        <script type="text/javascript">
            //swall message notification
            $(document).ready(function() {
                swal(`{!! session('msg') !!}`, {
                    icon: "info",
                });
            });
        </script>
    @endif
    <script>
        "use strict";
        setTimeout(function() {
            (function($) {
                "use strict";
                $(".select2").select2({
                    allowClear: true,
                    minimumResultsForSearch: 7
                });
            })(jQuery);
        }, 350);
        setTimeout(function() {
            (function($) {
                "use strict";
                $(".select2-modal").select2({
                    dropdownParent: $('#newrecord'),
                    allowClear: true,
                    minimumResultsForSearch: 5
                });
            })(jQuery);
        }, 350);
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#datatable').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ordering: false,
                searching: true,
                language: {
                    searchPlaceholder: 'Search..',
                    url: "{{ asset('assets/vendor/libs/datatables/id.json') }}"
                },
                ajax: {
                    url: "{{ route('headoflppm.proposals.data') }}",
                    data: function(d) {
                        d.select_category = $('#select_category').val(),
                            d.select_tkt_type = $('#select_tkt_type').val(),
                            d.select_main_research_target = $('#select_main_research_target').val(),
                            d.search = $('#datatable_filter input[type="search"]').val()
                    },
                },
                columnDefs: [{
                    "defaultContent": "-",
                    "targets": "_all"
                }],
                columns: [{
                        render: function(data, type, row, meta) {
                            var no = (meta.row + meta.settings._iDisplayStart + 1);
                            return no;
                        },
                        className: "text-center"
                    },
                    {
                        render: function(data, type, row, meta) {
                            var html = `
                                <div class="d-flex align-items-center">
                                    <img src="${row.users.image ? row.users.image : '{{ asset('/assets/img/avatars/user.png') }}'}" alt="User Image" class="rounded-circle me-2" width="30" height="30">
                                    <strong>${row.users.name.charAt(0).toUpperCase() + row.users.name.slice(1)}</strong>
                                </div>`;
                            return html;
                        }
                    },
                    {
                        render: function(data, type, row, meta) {
                            var html =
                                `<a href="${row.documents[0].proposal_doc}" style="color: primary;">${row.research_title}</a>`;
                            return html;
                        }
                    },
                    {
                        render: function(data, type, row, meta) {
                            var html = row.research_topic.research_theme.research_category.name;
                            return html;
                        }
                    },
                    {
                        render: function(data, type, row, meta) {
                            var html = row.tkt_type.title;
                            return html;
                        }
                    },
                    {
                        render: function(data, type, row, meta) {
                            var html = row.main_research_target.title;
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
                            if (row.is_recommended === null) {
                                html =
                                    '<span class="badge rounded-pill bg-label-secondary">Menunggu Review</span>';
                            } else if (row.is_recommended === true || row.is_recommended === 1) {
                                html =
                                    '<span class="badge rounded-pill bg-label-success">Rekomendasi</span>';
                            } else if (row.is_recommended === false || row.is_recommended === 0) {
                                html =
                                    '<span class="badge rounded-pill bg-label-danger">Tidak Di Rekomendasi</span>';
                            }
                            return html;
                        }
                    },
                    {
                        render: function(data, type, row, meta) {
                            var html = '';
                            if (row.statuses.id === 'S05') {
                                html +=
                                    `<a class="badge badge-center rounded-pill bg-warning mb-1" title="Detail Proposal" href="{{ url('headoflppm/proposals/show/${row.id}') }}"><i class="bx bx-show" style="color:#ffff"></i></a>`;
                            } else if (row.is_recommended !== null) {
                                html +=
                                    `<button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                     <div class="dropdown-menu">
                                       <a class="dropdown-item" href="{{ url('headoflppm/proposals/show/${row.id}') }}"><i class="bx bx-show me-2"></i>Detail Proposal</a>
                                       <a class="dropdown-item" href="{{ url('headoflppm/proposals/download/${row.id}') }}"><i class="bx bx-download me-2"></i>Unduh Hasil Penilaian</a>
                                       <a class="dropdown-item" href="{{ url('headoflppm/proposals/revision/${row.id}') }}"><i class="bx bx-revision me-2"></i>Revisi</a>
                                       <a class="dropdown-item" href="{{ url('headoflppm/proposals/reject/${row.id}') }}"><i class="bx bx-x me-2"></i>Tolak</a>
                                       <a class="dropdown-item" onclick="approve(${row.id})"><i class="bx bx-check me-2"></i>Setujui</a>
                                     </div>`;
                            } else {
                                html +=
                                    `<a class="badge badge-center rounded-pill bg-warning mb-1" title="Detail Proposal" href="{{ url('headoflppm/proposals/show/${row.id}') }}"><i class="bx bx-show" style="color:#ffff"></i></a>`;
                            }
                            return html;
                        },
                        "orderable": false,
                        className: "text-md-center"
                    },
                ]

            });
            $('#select_category').change(function() {
                table.draw();
            });
            $('#select_tkt_type').change(function() {
                table.draw();
            });
            $('#select_main_research_target').change(function() {
                table.draw();
            });

        });

        function approve(id) {
            Swal.fire({
                title: "Apakah proposal ini disetujui?",
                text: "Proposal akan ditandai sebagai disetujui (lolos).",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Sudah!',
                customClass: {
                    confirmButton: 'btn btn-primary me-1',
                    cancelButton: 'btn btn-label-secondary'
                },
                buttonsStyling: false
            }).then(function(result) {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('headoflppm.approve') }}",
                        type: "POST",
                        data: {
                            id: id,
                            _token: "{{ csrf_token() }}" // Sertakan token CSRF untuk keamanan
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Disetujui!',
                                    text: 'Proposal telah disetujui.',
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
    </script>




@endsection
