@extends('layouts.master')

@section('title', 'Review Proposal')
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
        .layout-page,
        .content-wrapper,
        .content-wrapper>*,
        .layout-menu {
            min-height: unset;
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="flex-grow-1 container-p-y">
            <!-- Hour chart  -->
            <div class="card">
                <div class="card-body">
                    <div class="col-12 col-md-12 p-3">
                        <h2><strong>Halaman Review Pengajuan</strong></h2>
                        <div class="col-12 col-lg-7">
                        </div>
                        <div class="d-flex justify-content-between flex-wrap gap-3 me-5">
                            <div class="d-flex align-items-center gap-3 me-4 me-sm-0">
                                <span class=" bg-label-primary p-2 rounded">
                                    <i class="bx bx-laptop bx-sm"></i>
                                </span>
                                <div class="content-right">
                                    <p class="mb-0">Jumlah Proposal yang Belum Direview</p>
                                    <h4 class="text-primary mb-0">{{ $dataCount }}</h4>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <span class="bg-label-warning p-2 rounded">
                                    <i class="bx bx-check-circle bx-sm"></i>
                                </span>
                                <div class="content-right">
                                    <p class="mb-0">Jumlah Proposal yang Telah Direview</p>
                                    <h4 class="text-warning mb-0">{{ $dataCount2 }}</h4>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <span class="bg-label-info p-2 rounded">
                                    <i class="bx bx-bulb bx-sm"></i>
                                </span>
                                <div class="content-right">
                                    <p class="mb-0">Total Proposal</p>
                                    <h4 class="text-info mb-0">{{ $totalData }}</h4>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



















        {{-- <div class="row">
                <div class="col-md-6 col-lg-4 mb-4 order-lg-1 order-2">
                    <div class="card">
                    </div>
                </div>
                <div class="col-lg-8 order-lg-3 col-12 align-self-end order-4 mb-4 full-width">
                    <div class="card">
                        <div class="d-flex align-items-end row">
                            <div class="col-sm-5 text-center text-sm-left">
                                <div class="card-body pb-0">
                                    <img src="../../assets/img/sitting-girl-with-laptop-light.png" height="140"
                                        alt="Target User" data-app-dark-img="/sitting-girl-with-laptop-light.png"
                                        data-app-light-img="/sitting-girl-with-laptop-light.png">
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="card-body">
                                    <h5 class="card-title">Hi Reviewers!</h5>
                                    <p class="mb-4">You have {{ $dataCount }} tasks to finish today, you have already
                                        completed {{ $dataCount2 }} tasks. Good job.</p>

                                    <span class="badge bg-label-primary">78% of target</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        <div class="card p-3 mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="mb-0">List Pengajuan Proposal</h3>
            </div>
            <div class="container mb-3">
                <table class="table table-hover table-sm" id="datatable" width="100%">
                    <thead>
                        <tr>
                            <th data-priority="1">No</th>
                            <th>Nama Peneliti</th>
                            <th>Tim Peneliti</th>
                            <th>Judul Penelitian</th>
                            <th>Tanggal Mulai Review</th>
                            <th>Tanggal Selesai Review</th>
                            <th>Status</th>
                            <th data-priority="2" style="width: 15%;"></th>
                        </tr>
                    </thead>
                </table>
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
    <script src="https://cdn.jsdelivr.net/npm/@floating-ui/dom@1.6.10"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    @if (session('msg'))
        <script type="text/javascript">
            //swall message notification
            $(document).ready(function() {
                swal(`{!! session('msg') !!}`, {
                    icon: "info",
                });
            });
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
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
                    url: "{{ route('reviewers.data') }}",
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
                            var html = '<strong>' + row.users.name.charAt(0).toUpperCase() + row
                                .users.name.slice(1) + '</strong>';
                            return html;
                        }
                    },
                    {
                        render: function(data, type, row, meta) {
                            var html =
                                '<ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">';
                            if (row.proposal_teams && row.proposal_teams.length > 0) {
                                row.proposal_teams.forEach(function(team) {
                                    if (team.researcher) {
                                        var imageUrl = team.researcher.image ? team
                                            .researcher.image :
                                            "{{ asset('/assets/img/avatars/user.png') }}";
                                        html +=
                                            '<li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="' +
                                            team.researcher.name + '">';
                                        html += '<img src="' + imageUrl +
                                            '" alt="Avatar" class="rounded-circle">';
                                        html += '</li>';
                                    }
                                });
                            }
                            html += '</ul>';
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
                            var reviewDateStart = new Date(row.review_date_start);
                            var options = {
                                timeZone: 'Asia/Jakarta',
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric'
                            };
                            var formattedDate = reviewDateStart.toLocaleDateString('id-ID',
                                options);
                            var html = '<em>' + formattedDate + '</em>';
                            return html;
                        }
                    },
                    {
                        render: function(data, type, row, meta) {
                            var reviewDateEnd = new Date(row.review_date_end);
                            var options = {
                                timeZone: 'Asia/Jakarta',
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric'
                            };
                            var formattedDate = reviewDateEnd.toLocaleDateString('id-ID', options);
                            var html = '<em>' + formattedDate + '</em>';
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
                            if (row.documents && row.documents.some(doc => doc
                                    .doc_type_id ===
                                    'DC2')) {
                                html +=
                                    `<a  class="badge badge-center rounded-pill bg-warning mb-1" title="Detail Proposal" href="{{ url('reviewer/show/${row.id}') }}"><i class="bx bx-show" style="color:#ffff"></i></a>`;
                            } else {
                                html +=
                                    `<a  class="badge badge-center rounded-pill bg-warning mb-1" title="Detail Proposal" href="{{ url('reviewer/show/${row.id}') }}"><i class="bx bx-show" style="color:#ffff"></i></a>
                                    <a class="badge badge-center rounded-pill bg-warning"title="Upload form" href="{{ url('reviewer/assessment/${row.id}') }}"><i class="bx bx-upload"  style="color:#ffff"></i></a>`;
                            }
                            return html;
                        },
                        "orderable": false,
                        className: "text-md-center"
                    }
                ]
            });

        });

        //Lolos Reviewer
        function approval_reviewer(id) {
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
                        url: "{{ route('reviewers.approval_reviewer') }}",
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


        // Tidak Lolos Reviewer
        function rejectId(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda ingin menolak Proposal ini!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, tolak!',
                customClass: {
                    confirmButton: 'btn btn-danger me-1',
                    cancelButton: 'btn btn-label-secondary'
                },
                buttonsStyling: false
            }).then(function(result) {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('reviewers.reject') }}",
                        type: "POST",
                        data: {
                            id: id,
                            _token: "{{ csrf_token() }}" // Sertakan token CSRF untuk keamanan
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Ditolak!',
                                    text: 'Proposal telah ditolak.',
                                    customClass: {
                                        confirmButton: 'btn btn-success'
                                    }
                                }).then(function() {
                                    location.reload(); // Muat ulang halaman setelah penolakan
                                });
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
                        error: function(xhr, status, error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Terjadi kesalahan saat menolak Proposal.',
                                customClass: {
                                    confirmButton: 'btn btn-danger'
                                }
                            });
                        }
                    });
                }
            });
        }


        function presentasi(id) {
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Anda akan Menyetujui proposal ini untuk presentasi!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Setujui!',
                customClass: {
                    confirmButton: 'btn btn-primary me-1',
                    cancelButton: 'btn btn-label-secondary'
                },
                buttonsStyling: false
            }).then(function(result) {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('reviewers.presentation') }}",
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

        function mark_as_presented(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda ingin menandai pengaju sudah melakukan presentasi!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Tandai!',
                customClass: {
                    confirmButton: 'btn btn-primary me-1',
                    cancelButton: 'btn btn-label-secondary'
                },
                buttonsStyling: false
            }).then(function(result) {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('reviewers.mark_as_presented') }}",
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
                                    text: 'Proposal telah dipresentasikan.',
                                    customClass: {
                                        confirmButton: 'btn btn-success'
                                    }
                                }).then(function() {
                                    location.reload(); // Muat ulang halaman setelah persetujuan
                                });
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
                        error: function(xhr, status, error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Terjadi kesalahan saat menyetujui Proposal.',
                                customClass: {
                                    confirmButton: 'btn btn-danger'
                                }
                            });
                        }
                    });
                }
            });
        }
    </script>

@endsection
