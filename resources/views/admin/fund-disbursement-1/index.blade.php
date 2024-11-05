@extends('layouts.master')
@section('title', 'Settings/Manage Lookup/Manage Proposal')


@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />

@endsection

@section('style')
    <style>
        table.dataTable tbody td {
            vertical-align: middle;
        }

        table.dataTable td:nth-child(2) {
            max-width: 150px;
        }

        table.dataTable th {
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
            word-wrap: break-word;
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
    @if (session('msg'))
        <div class="alert alert-primary alert-dismissible" role="alert">
            {{ session('msg') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card mb-4">
        <div class="card-widget-separator-wrapper">
            <div class="card-body card-widget-separator">
                <div class="row gy-4 gy-sm-1">
                    <div class="col-sm-6 col-lg-3">
                        <div class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-3 pb-sm-0">
                            <div>
                                <h3 class="mb-1">{{ $totalUsers }}</h3>
                                <p class="mb-0">User</p>
                            </div>
                            <div class="avatar me-sm-4">
                                <span class="avatar-initial rounded bg-label-secondary">
                                    <i class="bx bx-user bx-sm"></i>
                                </span>
                            </div>
                        </div>
                        <hr class="d-none d-sm-block d-lg-none me-4">
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-3 pb-sm-0">
                            <div>
                                <h3 class="mb-1">{{ $proposalCount }}</h3>
                                <p class="mb-0">Total Proposal</p>
                            </div>
                            <div class="avatar me-lg-4">
                                <span class="avatar-initial rounded bg-label-secondary">
                                    <i class="bx bx-file bx-sm"></i>
                                </span>
                            </div>
                        </div>
                        <hr class="d-none d-sm-block d-lg-none">
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="d-flex justify-content-between align-items-start border-end pb-3 pb-sm-0 card-widget-3">
                            <div>
                                <h3 class="mb-1">{{ $proposalApproved }}</h3>
                                <p class="mb-0">Total Proposal diterima</p>
                            </div>
                            <div class="avatar me-sm-4">
                                <span class="avatar-initial rounded bg-label-secondary">
                                    <i class="bx bx-check-double bx-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h3 class="mb-1">{{ $proposalDisapprove }}</h3>
                                <p class="mb-0">Total Proposal ditolak</p>
                            </div>
                            <div class="avatar">
                                <span class="avatar-initial rounded bg-label-secondary">
                                    <i class="bx bx-x-circle bx-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="nav-align-top mb-4">
        <ul class="nav nav-tabs nav-fill" role="tablist">
            <li class="nav-item">
                <a type="button" class="nav-link" data-bs-target="#dataproposal" href="../admin/proposals">
                    <i class="tf-icons bx bx-add-to-queue me-1"></i> Data
                </a>
            </li>
            <li class="nav-item" href="../admin/addreviewer">
                <a type="button" class="nav-link" data-bs-target="#tambahreviewers" href="../admin/addreviewer">
                    <i class="tf-icons bx bx-chart me-1"></i> Reviewer
                    <span class="badge bg-danger badge-notifications" id="Reviewer" style="display: none;"></span>
                </a>
            </li>
            {{-- <li class="nav-item">
                <a type="button" class="nav-link" data-bs-target="#presentasi" href="../admin/presentation">
                    <i class="tf-icons bx bx-chart me-1"></i> Presentasi
                    <span class="badge bg-danger badge-notifications" id="Presentasi" style="display: none;"></span>
                </a>
            </li>
            <li class="nav-item">
                <a type="button" class="nav-link" data-bs-target="#dana" href="../admin/fundsfinalization">
                    <i class="tf-icons bx bx-bar-chart-alt-2 me-1"></i> Finalisasi Dana
                    <span class="badge bg-danger badge-notifications" id="AdminFundFinalization"
                        style="display: none;"></span>
                </a>
            </li> --}}
            <!-- <li class="nav-item">
                                            <a type="button" class="nav-link" data-bs-target="#loa" href="../admin/loa">
                                                <i class="tf-icons bx bx-task me-1"></i> LoA & Kontrak
                                            </a>
                                        </li> -->
            <li class="nav-item">
                <a type="button" class="nav-link active" data-bs-target="#fund-disbursement-1"
                    href="../admin/fund-disbursement-1">
                    <i class="tf-icons bx bx-select-multiple me-1"></i> Dana Tahap 1
                </a>
            </li>
            <li class="nav-item">
                <a type="button" class="nav-link" data-bs-target="#fund-disbursement-2"
                    href="../admin/fund-disbursement-2">
                    <i class="tf-icons bx bx-select-multiple me-1"></i> Dana Tahap 2
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade" id="dataproposal" role="tabpanel">

            </div>
            <div class="tab-pane fade show active" id="tambahreviewers" role="tabpanel">
                <div class="table-responsive">
                    <div class="card-datatable table-responsive">
                        <table class="table table-hover table-sm" id="datatable" width="100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th data-priority="1">Nama Peneliti</th>
                                    <th data-priority="3" style="width: 30%;">Judul Proposal</th>
                                    <th>Status</th>
                                    <th data-priority="2"></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="presentasi" role="tabpanel">

            </div>
            <div class="tab-pane fade" id="dana" role="tabpanel">

            </div>
            <!-- <div class="tab-pane fade" id="loa" role="tabpanel">

                                        </div> -->
            <div class="tab-pane fade" id="monev" role="tabpanel">

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
    <script src="{{ asset('assets/vendor/libs/select2/id.js') }}"></script>
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
        $(document).ready(function() {
            // Fungsi untuk mengambil jumlah totalNullReviewers
            function fetchTotalNullReviewers() {
                $.ajax({
                    url: '{{ route('getTotalNullReviewers') }}',
                    method: 'GET',
                    success: function(response) {
                        if (response.totalNullReviewers > 0) {
                            $('#Reviewer').text(response.totalNullReviewers).show();
                        } else {
                            $('#Reviewer').hide();
                        }
                    },
                    error: function() {
                        console.error('Gagal mengambil data totalNullReviewers.');
                    }
                });
            }

            // Panggil fungsi saat halaman dimuat
            fetchTotalNullReviewers();

            // Anda dapat memanggil fungsi ini secara berkala jika diperlukan
            setInterval(fetchTotalNullReviewers, 500); // Memanggil setiap 30 detik
        });
        // Fungsi untuk mengambil jumlah totalS05Proposals
        function fetchTotalS05Proposals() {
            $.ajax({
                url: '{{ route('getTotalS05Proposals') }}',
                method: 'GET',
                success: function(response) {
                    if (response.totalS05Proposals > 0) {
                        $('#Presentasi').text(response.totalS05Proposals).show();
                    } else {
                        $('#Presentasi').hide();
                    }
                },
                error: function() {
                    console.error('Gagal mengambil data totalS05Proposals.');
                }
            });
        }

        // Panggil fungsi saat halaman dimuat
        fetchTotalS05Proposals();

        // Anda dapat memanggil fungsi ini secara berkala jika diperlukan
        // setInterval(fetchTotalS05Proposals, 30000); // Memanggil setiap 30 detik

        // Fungsi untuk mengambil jumlah totalNullAdminFundFinalization
        function fetchTotalNullAdminFundFinalization() {
            $.ajax({
                url: '{{ route('getTotalNullAdminFundFinalization') }}',
                method: 'GET',
                success: function(response) {
                    if (response.totalNullAdminFundFinalization > 0) {
                        $('#AdminFundFinalization').text(response.totalNullAdminFundFinalization).show();
                    } else {
                        $('#AdminFundFinalization').hide();
                    }
                },
                error: function() {
                    console.error('Gagal mengambil data totalNullAdminFundFinalization.');
                }
            });
        }

        // Panggil fungsi saat halaman dimuat
        fetchTotalNullAdminFundFinalization();

        // Anda dapat memanggil fungsi ini secara berkala jika diperlukan
        // setInterval(fetchTotalNullAdminFundFinalization, 30000); // Memanggil setiap 30 detik
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
                    url: "{{ route('proposals.data') }}",
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
                            var no = (meta.row + meta.settings._iDisplayStart + 1);
                            return no;
                        },
                        className: "text-center"
                    },
                    {
                        render: function(data, type, row, meta) {
                            var html =
                                `<strong>${row.users.name.charAt(0).toUpperCase() + row.users.name.slice(1)}</strong>`;
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
                            var html =
                                `<span class="badge rounded-pill bg-label-${row.statuses.color}">
                                <span class="badge badge-dot bg-${row.statuses.color} me-1"></span>${row.statuses.status} </span>`;
                            return html;
                        }
                    },
                    {
                        render: function(data, type, row, meta) {
                            var html = "";
                            if (row.documents && row.documents.some(doc => doc
                                    .doc_type_id ===
                                    'DC3')) {
                                html =
                                    `<a class="badge badge-center rounded-pill bg-warning" title="Show" href="{{ url('admin/proposals/show/${row.id}') }}"><i class="bx bx-show" style="color:#ffff"></i></a>`;
                            } else {
                                html =
                                    `<a class="badge badge-center rounded-pill bg-warning" title="Show" href="{{ url('admin/proposals/show/${row.id}') }}"><i class="bx bx-show" style="color:#ffff"></i></a>
                                    <a class="badge badge-center rounded-pill bg-info" title="Unggah Bukti Tahap 1" href="{{ url('admin/fund-disbursement-1/transfer_receipt/${row.id}') }}"><i class="bx bx-upload" style="color:#ffff"></i></a>`;
                            }
                            return html;
                        },
                        "orderable": false,
                        className: "text-md-center"
                    }
                ]

            });

        });
    </script>
@endsection
