@extends('layouts.master')
@section('title', 'Revisi Anggaran')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/quill.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/typography.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}">
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Layout -->
        <div class="row">
            <div class="card mb-3 p-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2 class="mb-0">Berikan Catatan!</h2>
                    <small class="text-muted float-end">Revisi Anggaran Proposal</small>
                </div>
                <hr class="my-">
                <div class="card-body">
                    <form id="form-add-new-record" method="POST" action="{{ route('headoflppm.update', $proposal->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label mb-1" for="review_notes">Alasan revisi:</label>
                            <div id="editor-container" class="form-control"></div>
                            <textarea class="form-control d-none @error('review_notes') is-invalid @enderror" id="review_notes" name="review_notes"
                                placeholder="Tuliskan isi pikiran Anda..." style="height: 150px;">{{ old('review_notes') }}</textarea>
                            @error('review_notes')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <a href="{{ route('headoflppm.proposals.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/forms-file-upload.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/quill/katex.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/quill/quill.js') }}"></script>
    <script src="{{ asset('assets/js/forms-editors.js') }}"></script>
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
    </script>
@endsection
