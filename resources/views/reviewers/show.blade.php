@extends('layouts.master')
@section('title', 'Detail Proposal')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="assets/vendor/libs/bootstrap-select/bootstrap-select.css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/typography.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
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

        i {
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

        li {
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

        .iframe {
            height: 350px;
            width: 100%;
            border: none;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
        }

        .timeline .timeline-item .timeline-point-wrapper {
            position: absolute;
            top: 1rem;
            left: 0rem;
            z-index: 2;
            display: block;
        }
    </style>
@endsection

@section('content')
    @if (session('proposals'))
        <div class="alert alert-primary alert-dismissible" role="alert">
            {{ session('proposals') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    <div class="row mb-3 g-4">
        <div class="col-12 col-xl-8">
            <div class="card p-3">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="d-flex justify-content-start align-items-center mt-lg-4">
                        <div class="avatar me-3" style="width: 50px; height: 50px;">
                            @if ($proposals->users->image)
                                <img src="{{ asset($proposals->users->image) }}" alt="Avatar" class="rounded-circle"
                                    style="width: 100%; height: 100%;">
                            @else
                                <img src="{{ asset('/assets/img/avatars/user.png') }}" alt="Avatar"
                                    class="rounded-circle" style="width: 100%; height: 100%;">
                            @endif
                        </div>
                        <div class="d-flex flex-column">
                            <h6 class="mb-1 text-truncate" style="font-size: 20px;">{{ ucfirst($proposals->users->name) }}
                            </h6>
                            @if ($proposals->users->roles->isNotEmpty())
                                <small class="text-truncate text-muted"
                                    style="font-size: 15px;">{{ $proposals->users->roles->first()->name }}</small>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card-body mb-4">
                    <p>
                        @if ($proposals->documents->isNotEmpty() && $documentUrl)
                            <iframe src="{{ $documentUrl }}" class="iframe mb-3"
                                onerror="this.onerror=null; this.outerHTML='Cannot load PDF.';"></iframe><br>
                        @else
                            <p>Tidak ada dokumen yang tersedia.</p>
                        @endif
                    </p>
                    <div class="row g-2 mb-3">
                        <div class="col-sm">
                            <span for="inputAddress2" class="form-label"> JENIS PENELITIAN</span>
                            <input type="text" class="form-control" value="{{ $proposals->researchtype->title }}"
                                readonly disabled>
                        </div>
                        <div class="col-sm">
                            <span for="inputAddress2" class="form-label">TOTAL DANA</span>
                            <input type="text" class="form-control" value="Rp {{ number_format($proposals->total_fund, 0, ',', '.') }}" readonly disabled>
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="inputAddress2" class="form-label mb-0"> KETEGORI PENELITIAN</label>
                        <input type="text" class="form-control"
                            value="{{ $proposals->researchTopic->researchTheme->researchCategory->name }}" readonly
                            disabled>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="inputAddress2" class="form-label mb-0">TEMA PENELITIAN</label>
                        <input type="text" class="form-control"
                            value=" {{ $proposals->researchTopic->researchTheme->name }}" readonly disabled>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="inputAddress2" class="form-label mb-0">TOPIK PENELITIAN</label>
                        <input type="text" class="form-control" value=" {{ $proposals->researchTopic->name }}" readonly
                            disabled>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="inputAddress2" class="form-label mb-0">JUDUL PENELITIAN</label>
                        <input type="text" class="form-control" value=" {{ $proposals->research_title }}" readonly
                            disabled>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-sm">
                            <span for="inputAddress2" class="form-label mb-0">TARGET UTAMA RISET</span>
                            <input type="text" class="form-control"
                                value=" {{ $proposals->mainResearchTarget->title }}" readonly disabled>
                        </div>
                        <div class="col-sm mb-2">
                            <span for="inputAddress2" class="form-label mb-0">JENIS TKT</span>
                            <input type="text" class="form-control" value=" {{ $proposals->tktType->title }}"
                                readonly disabled>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="inputAddress2" class="form-label mb-0">CATATAN</label>
                        <p>{!! $proposals->notes !!}</p>
                    </div>
                    <a href="{{ route('reviewers.index') }}" class="btn btn-primary">Kembali</a>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-4 col-md-6">
            <div class="card mb-4 p-4 " data-aos="fade-left" data-aos-duration="2000">
                <div class="table">
                    <table class="table table-borderless border-top">
                        <thead class="border-bottom">
                            <tr>
                                <th>Tim Peneliti</th>
                                <th class="text-end"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    @foreach ($proposals->proposalTeams as $r)
                                        <div class="d-flex justify-content-start align-items-center mt-lg-2 mb-2">
                                            <div class="avatar me-3">
                                                @if ($r->researcher->image)
                                                    <img src="{{ asset($r->researcher->image) }}" alt="Avatar"
                                                        class="rounded-circle">
                                                @else
                                                    <img src="{{ asset('assets/img/avatars/user.png') }}" alt="Avatar"
                                                        class="rounded-circle">
                                                @endif
                                            </div>
                                            <div class="d-flex flex-column">
                                                <h6 class="mb-1 text-truncate">
                                                    {{ ucfirst($r->researcher->username) }}
                                                </h6>
                                                @if ($r->researcher->roles->isNotEmpty())
                                                    <small
                                                        class="text-truncate text-muted">{{ $r->researcher->roles->first()->name }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach

                                </td>
                                <td class="text-end">
                                    <div class="user-progress mt-lg-4">
                                        <h6 class="mb-0"></h6>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <br>
                <!--  -->
                <div class="table">
                    <table class="table table-borderless border-top">
                        <thead class="border-bottom">
                            <tr>
                                <th>Reviewer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    @if ($proposals->reviewer)
                                        <div class="d-flex justify-content-start align-items-center mt-lg-2 mb-2">
                                            <div class="avatar me-3">
                                                @if ($proposals->reviewer->image)
                                                    <img src="{{ asset($proposals->reviewer->image) }}" alt="Avatar"
                                                        class="rounded-circle">
                                                @else
                                                    <img src="{{ asset('assets/img/avatars/user.png') }}" alt="Avatar"
                                                        class="rounded-circle">
                                                @endif
                                            </div>
                                            <div class="d-flex flex-column">
                                                <h6 class="mb-1 text-truncate">
                                                    {{ ucfirst($proposals->reviewer->username) }}
                                                </h6>
                                                @if ($proposals->reviewer->roles->isNotEmpty())
                                                    <small
                                                        class="text-truncate text-muted">{{ $proposals->reviewer->roles->first()->name }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        <p>-</p>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="user-progress mt-lg-4">
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <br>
                {{-- <div class="table-responsive">
                    <table class="table table-borderless border-top">
                        <thead class="border-bottom">
                            <tr>
                                <th>Timeline</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <ul class="timeline">
                                        <li class="timeline-item timeline-item-transparent">
                                            <span class="timeline-point-wrapper"><span
                                                    class="timeline-point timeline-point-success"></span></span>
                                            <div>
                                                <div class="timeline-header mb-sm-0 mb-3">
                                                    <h6 class="mb-0">Pengajuan</h6>
                                                    <span class="text-muted"> </span>
                                                    <span class="text-muted">21/2/2024</span>
                                                </div>
                                                <p>
                                                    Approved
                                                </p>
                                            </div>
                </div>

                </li>

                </ul>
                </td>
            </div>
            </td>
            </tr>
            </tbody>
            </table>
        </div> --}}
                <div class="table">
                    <table class="table table-borderless border-top">
                        <thead class="border-bottom">
                            <tr>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Hasil Penilaian
                                </td>
                                <td class="text-end">
                                    <div class="user-progress">
                                        <h6 class="mb-0">
                                            @if ($proposals->approval_reviewer)
                                                <span class="badge bg-label-success">Lolos</span>
                                            @elseif ($proposals->status_id == 'S04')
                                                <span class="badge bg-label-danger">Ditolak</span>
                                            @else
                                                <span class="badge bg-label-secondary">-</span>
                                            @endif
                                        </h6>
                                    </div>
                                </td>
                            </tr>
                            </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Persetujuan LPPM
                                </td>
                                <td class="text-end">
                                    <div class="user-progress">
                                        <h6 class="mb-0">
                                            @if ($proposals->approval_vice_rector_1)
                                                <span class="badge bg-label-success">Telah Terverifikasi</span>
                                            @else
                                                <span class="badge bg-label-secondary">-</span>
                                            @endif
                                        </h6>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <td>
                                    Verifikasi Warek II
                                </td>
                                <td class="text-end">
                                    <div class="user-progress">
                                        <h6 class="mb-0">
                                            @if ($proposals->approval_vice_rector_2)
                                                <span class="badge bg-label-success">Telah Terverifikasi</span>
                                            @else
                                                <span class="badge bg-label-secondary">-</span>
                                            @endif
                                        </h6>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <br>
                <div class="table">
                    <table class="table table-borderless border-top">
                        <thead class="border-bottom">
                            <tr>
                                <th>Dokumen</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <h6>Proposal</h6>
                                </td>
                                <td class="text-end">
                                    <div class="user-progress">
                                        <h6 class="mb-0">
                                            @if ($proposals->documents->first())
                                                <a class="btn btn-primary" href="{{ $documentUrl }}" target="_blank">
                                                    <i class="bx bx-download align-middle" style="cursor:pointer"></i>
                                                </a>
                                            @else
                                                <span class="badge bg-label-warning">Tidak Tersedia</span>
                                            @endif
                                        </h6>
                                    </div>
                                </td>
                            </tr>
                            </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <h6>LOA</h6>
                                </td>
                                <td class="text-end">
                                    <div class="user-progress">
                                        <h6 class="mb-0">
                                            @if ($proposals->approval_reviewer)
                                                <a class="btn btn-primary" href="../print_loa/{{ $proposals->id }}"
                                                    target="_blank">
                                                    <i class="bx bx-download align-middle" style="cursor:pointer"></i>
                                                </a>
                                            @elseif($proposals->status_id == 'S04')
                                                <a class="btn btn-primary"
                                                    href="../print_loa_reject/{{ $proposals->id }}" target="_blank">
                                                    <i class="bx bx-download align-middle" style="cursor:pointer"></i>
                                                </a>
                                            @else
                                                <span class="badge bg-label-warning">Tidak Tersedia</span>
                                            @endif
                                        </h6>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <td>
                                    <h6>Kontrak</h6>
                                </td>
                                <td class="text-end">
                                    <div class="user-progress">
                                        <h6 class="mb-0">
                                            @if ($proposals->bank_id)
                                                <a class="btn btn-primary" href="../print_pdf/{{ $proposals->id }}"
                                                    target="_blank">
                                                    <i class="bx bx-download align-middle" style="cursor:pointer"></i>
                                                </a>
                                            @else
                                                <span class="badge bg-label-warning">tidak tersedia</span>
                                            @endif
                                        </h6>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!--  -->
        </div>
    </div>
    </div>

@endsection

@section('script')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('assets/vendor/libs/quill/katex.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/quill/quill.js') }}"></script>
    <script src="{{ asset('assets/js/forms-editors.js') }}"></script>
    <script>
        AOS.init();
    </script>
    <script>
        var quill = new Quill('#editor-container', {
            theme: 'snow'
            readOnly: true
        });

        // Memuat konten yang ada ke dalam editor Quill
        var notesContent = {!! json_encode($proposals->notes) !!};
        quill.root.innerHTML = notesContent;

        // Sinkronisasi konten editor Quill dengan textarea
        quill.on('text-change', function() {
            var notes = document.querySelector('textarea[name=notes]');
            notes.value = quill.root.innerHTML;
        });
    </script>
@endsection
