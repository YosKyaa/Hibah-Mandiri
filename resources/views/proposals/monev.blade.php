@extends('layouts.master')
@section('title', 'Monev')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/quill.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/typography.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
    <div class="col-xl">
        <div class="card mb-4 p-4">
            <div class="card-header justify-content-between align-items-center">
                <h3 class="mb-0">Laporan Monitoring dan Evaluasi</h3>
                <span class="text-muted">Silahkan unggah dokumen dengan format PDF </span>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    {{-- <h4>Silakan lengkapi formulir di bawah ini!</h4> --}}
                    <div class="mb-3">
                        <a href="{{ $pdfFilePath }}" class="btn btn-info">
                            <i class="fas fa-file-download"></i> &nbsp;Ketentuan Laporan MONEV
                        </a>
                    </div>
                <form id="form-add-new-record" method="POST"
                    action="{{ route('user-proposals-monev.update', $proposal->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Laporan Monev<i class="text-danger">*</i></label>
                        <div class="input-group mb-4">
                            <input class="form-control @error('proposal_doc') is-invalid @enderror" name="proposal_doc"
                                type="file" accept=".pdf" title="PDF">
                            @error('proposal_doc')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Comment</label>
                        <div id="editor-container" class="form-control"></div>
                        <textarea class="form-control d-none @error('monev_comment') is-invalid @enderror" id="monev_comment" name="monev_comment"
                            placeholder="Tuliskan isi pikiranmu..." style="height: 150px;">{{ old('monev_comment') }}</textarea>
                            @error('monev_comment')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    <button type="submit" class="btn btn-primary" onclick="return confirmSubmit(event)">Send</button>
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
        function confirmSubmit(event) {
            event.preventDefault(); // Prevent the default form submission
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Anda akan mengirimkan Laporan ini!",
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
    <script>
        var quill = new Quill('#editor-container', {
            theme: 'snow'
        });

        // Sync the content of the Quill editor with the textarea
        quill.on('text-change', function() {
            var monev_comment = document.querySelector('textarea[name=monev_comment]');
            monev_comment.value = quill.root.innerHTML;
        });

        // If the textarea already has content, load it into Quill
        var monev_comment = document.querySelector('textarea[name=monev_comment]').value;
        if (monev_comment) {
            quill.root.innerHTML = monev_comment;
        }
    </script>
@endsection
