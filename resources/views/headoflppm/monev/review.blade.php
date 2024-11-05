@extends('layouts.master')
@section('title', 'Form Penilaian Proposal')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/typography.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection
@section('style')
    <style>
        .iframe {
            height: 100vh;
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
                <h3 class="mb-0">Form Penilaian Laporan Kemajuan</h3>
                <span class="text-muted">Silahkan unduh form dibawah ini, lengkapi dan upload form ini. </span>
            </div>
            <hr class="my-0">
            <div class="card-body">
                <form id="form-add-new-record" method="POST" enctype="multipart/form-data"
                    action="{{ route('monev.update', $proposals->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <div class="mb-3">
                                <iframe src="{{ $documentUrl }}" class="iframe mb-3"
                                    onerror="this.onerror=null; this.outerHTML='Cannot load PDF.';">
                                </iframe>
                                {{-- <a href="{{ $documentUrl }}" class="btn btn-secondary" download>Download Form</a> --}}
                            </div>
                        </div>
                        <div class="col-md-4 mb-3 p-3">
                            {{-- <h4>Silakan lengkapi formulir di bawah ini!</h4> --}}
                            <div class="mb-3">
                                <a href="{{ $documentUrl }}" class="btn btn-info">
                                    <i class="fas fa-file-download"></i> &nbsp;Formulir Penilaian MONEV
                                </a>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-company">Form Penilaian</label>
                                <input class="form-control" name="proposal_doc" type="file" accept=".pdf"
                                    title="PDF">
                                <div id="defaultFormControlHelp" class="form-text">Unggah file PDF yang telah diisi
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label mb-1" for="notes">Catatan</label>
                                <div id="editor-container" class="form-control"></div>
                                <textarea class="form-control d-none" id="notes" name="notes" placeholder="Tuliskan isi pikiranmu...">{{ old('notes') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <a href="{{ route('monev.index') }}" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary"
                                    onclick="return confirmSubmit(event)">Kirim</button>
                            </div>
                        </div>

                    </div>
                    {{-- <a href="{{ route('reviewers.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary" onclick="return confirmSubmit(event)">Kirim</button> --}}
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
    <script src="{{ asset('assets/js/forms-file-upload.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/quill/katex.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/quill/quill.js') }}"></script>
    <script src="{{ asset('assets/js/forms-editors.js') }}"></script>
    <script>
        // document.getElementById('total_fund').addEventListener('input', function(e) {
        //     let value = e.target.value.replace(/[^,\d]/g, '').toString();
        //     let split = value.split(',');
        //     let remainder = split[0].length % 3;
        //     let rupiah = split[0].substr(0, remainder);
        //     let thousands = split[0].substr(remainder).match(/\d{3}/gi);

        //     if (thousands) {
        //         let separator = remainder ? '.' : '';
        //         rupiah += separator + thousands.join('.');
        //     }

        //     rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        //     e.target.value = rupiah;
        // });
        var quill = new Quill('#editor-container', {
            theme: 'snow'
        });

        // Sync the content of the Quill editor with the textarea
        quill.on('text-change', function() {
            var notes = document.querySelector('textarea[name=notes]');
            notes.value = quill.root.innerHTML;
        });

        // If the textarea already has content, load it into Quill
        var notes = document.querySelector('textarea[name=notes]').value;
        if (notes) {
            quill.root.innerHTML = notes;
        }
    </script>
    @if (session('success'))
        <script type="text/javascript">
            //swall message notification
            $(document).ready(function() {
                Swal.fire({
                    title: 'Info!',
                    text: '{!! session('success') !!}',
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
