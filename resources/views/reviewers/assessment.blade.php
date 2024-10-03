@extends('layouts.master')
@section('title', 'Form Penilaian Proposal')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert2.css') }}">
@endsection
@section('style')
    <style>
        .iframe {
            height: 400px;
            width: 100%;
            border: none;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
        }
    </style>
@endsection
@section('content')
    <div class="col-xl">
        <div class="card mb-3 p-4">
            <div class="card-header justify-content-between align-items-center">
                <h3 class="mb-0">Form Penilaian Proposal</h3>
                <span class="text-muted">Silahkan unduh form dibawah ini, lengkapi dan upload form ini. </span>
            </div>
            <hr class="my-0">
            <div class="card-body">
                <form id="form-add-new-record" method="POST" enctype="multipart/form-data"
                    action="{{ route('reviewers.assessment_update', $proposals->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <div class="mb-3">
                            <iframe src="{{ $documentUrl }}" class="iframe mb-3"
                                onerror="this.onerror=null; this.outerHTML='Cannot load PDF.';">
                            </iframe>
                            <a href="{{ $documentUrl }}" class="btn btn-secondary" download>Download Form</a>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-company">Form Penilaian</label>
                        <input class="form-control" name="proposal_doc" type="file" accept=".pdf" title="PDF">
                        <div id="defaultFormControlHelp" class="form-text">Unggah file PDF yang telah diisi
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md mb-md-0 mb-5">
                                <div class="form-check custom-option custom-option-basic">
                                    <label class="form-check-label custom-option-content" for="customRadioTemp1">
                                        <input name="is_recommended" class="form-check-input" type="radio" value="1" id="customRadioTemp1" checked>
                                        <span class="custom-option-header">
                                            <span class="h6 mb-0">Rekomendasi</span>
                                            <small class="text-muted">✔️</small>
                                        </span>
                                        <span class="custom-option-body">
                                            <small>Proposal ini direkomendasikan untuk masuk tahap selanjutnya.</small>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-check custom-option custom-option-basic">
                                    <label class="form-check-label custom-option-content" for="customRadioTemp2">
                                        <input name="is_recommended" class="form-check-input" type="radio" value="0" id="customRadioTemp2">
                                        <span class="custom-option-header">
                                            <span class="h6 mb-0">Tidak Rekomendasi</span>
                                            <small class="text-muted">❌</small>
                                        </span>
                                        <span class="custom-option-body">
                                            <small>Proposal ini tidak direkomendasikan untuk masuk tahap selanjutnya.</small>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary" onclick="return confirmSubmit(event)">Kirim</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script>
        function confirmSubmit(event) {
            event.preventDefault(); // Prevent the default form submission
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Anda akan mengirimkan Form ini!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Kirim!',
                cancelButtonText: 'Batal',
                customClass: {
                    confirmButton: 'btn btn-primary me-1',
                    cancelButton: 'btn btn-label-secondary'
                },
                buttonsStyling: false
            }).then(function(result) {
                if (result.isConfirmed) {
                    // Submit the form via AJAX or standard form submission
                    $('#form-add-new-record').submit();
                }
            });
        }

        // "use strict";
        // setTimeout(function() {
        //     (function($) {
        //         "use strict";
        //         $(".select2").select2({
        //             allowClear: true,
        //             minimumResultsForSearch: 7
        //         });
        //     })(jQuery);
        // }, 350);
        // setTimeout(function() {
        //     (function($) {
        //         "use strict";
        //         $(".select2-modal").select2({
        //             dropdownParent: $('#newrecord'),
        //             allowClear: true,
        //             minimumResultsForSearch: 5
        //         });
        //     })(jQuery);
        // }, 350);
    </script>
@endsection
