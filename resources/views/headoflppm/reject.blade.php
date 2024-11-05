@extends('layouts.master')
@section('title', 'Tolak Proposal')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/quill.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/typography.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}">
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
        <div class="card mb-3 p-4">
            <div class="card-header justify-content-between align-items-center">
                <h3 class="mb-0">Berikan Catatan untuk Menolak Proposal</h3>
                <span class="text-muted">Silahkan berikan catatan untuk menolak proposal di bawah ini.</span>
            </div>
            <hr class="my-0">
            <div class="card-body">
                <form id="form-add-new-record" method="POST" enctype="multipart/form-data"
                    action="{{ route('headoflppm.rejectUpdate', $proposal->id) }}">
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
                            <div class="mb-3">
                                <label class="form-label mb-1" for="review_notes">Catatan <span class="text-danger">*</span></label>
                                <div id="editor-container" class="form-control"></div>
                                <textarea class="form-control d-none @error('review_notes') is-invalid @enderror" id="review_notes" name="review_notes"
                                    placeholder="Tuliskan isi pikiranmu..." style="height: 150px;" required>{{ old('review_notes') }}</textarea>
                                @error('review_notes')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <a href="{{ route('headoflppm.proposals.index') }}" class="btn btn-secondary">Kembali</a>
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
    <script src="{{ asset('assets/js/forms-file-upload.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/quill/katex.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/quill/quill.js') }}"></script>
    <script src="{{ asset('assets/js/forms-editors.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        var quill = new Quill('#editor-container', {
            theme: 'snow'
        });

        // Sync the content of the Quill editor with the textarea
        quill.on('text-change', function() {
            var review_notes = document.querySelector('textarea[name=review_notes]');
            review_notes.value = quill.root.innerHTML;
        });

        // If the textarea already has content, load it into Quill
        var review_notes = document.querySelector('textarea[name=review_notes]').value;
        if (review_notes) {
            quill.root.innerHTML = review_notes;
        }


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
    </script>
@endsection
