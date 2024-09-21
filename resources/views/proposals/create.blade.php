@extends('layouts.master')
@section('title', 'Submit Proposal')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/dropzone/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/typography.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.css') }}"> --}}
    <link rel="stylesheet"
        href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/documentation/assets/vendor/libs/bs-stepper/bs-stepper.css">
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
{{-- @section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="card mb-4 p-4">
            <div class="card-header d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">Lengkapi Data Penelitian dibawah ini!</h4> <small class="text-muted float-end">Pengajuan Proposal</small>
            </div>
            <div class="card-body">
                <form id="form-add-new-record" method="POST" action="{{ route('user-proposals.create') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col sm mb-4">
                            <label class="form-label">Jenis Penelitian</label>
                            <div class="input-group input-group-merge has-validation">
                                <select @error('research_type') is-invalid @enderror class="select2"
                                    name="research_type" id="research_type" data-style="btn-default">
                                    <option value=""> Pilih Jenis Penelitian </option>
                                    @foreach ($researchtypes as $d)
                                        <option value="{{ $d->id }}"
                                            {{ $d->id == old('research_type') ? 'selected' : '' }}>
                                            {{ $d->title }}</option>
                                    @endforeach
                                </select>
                                @error('research_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col sm mb-4">
                            <label class="form-label">Total Dana</label>
                            <div class="input-group input-group-merge has-validation">
                                <input type="text" class="form-control" id="researchtypesId"
                                    aria-describedby="defaultFormControlHelp" readonly disabled />
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Kategori
                            Penelitian</label>
                        <div class="input-group input-group-merge has-validation">
                            <select class="form-select @error('research_categories') is-invalid @enderror select2"
                                name="research_categories" id="research_categories"
                                data-placeholder=" Pilih Kategori Penelitian">
                                <option value=""> Pilih Kategori Penelitian </option>
                                @foreach ($researchcategories as $d)
                                    <option value="{{ $d->id }}"
                                        {{ $d->id == old('research_categories') ? 'selected' : '' }}>
                                        {{ $d->name }}</option>
                                @endforeach
                            </select>
                            @error('research_categories')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Tema
                            Penelitian</label>
                        <div class="input-group input-group-merge has-validation">
                            <select class="form-select @error('research_themes') is-invalid @enderror select2"
                                name="research_themes" id="research_themes"
                                data-placeholder=" Pilih Tema Penelitian">
                                <option value=""> Pilih Tema Penelitian </option>
                                @foreach ($researchthemes as $d)
                                    <option value="{{ $d->id }}"
                                        {{ $d->id == old('research_themes') ? 'selected' : '' }}>
                                        {{ $d->name }}</option>
                                @endforeach
                            </select>
                            @error('research_themes')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="" class="form-label">Topik
                                Penelitian</label>
                            <div class="input-group input-group-merge has-validation">
                                <select class="form-select @error('research_topics') is-invalid @enderror select2"
                                    name="research_topics" id="research_topics"
                                    data-placeholder=" Pilih Topik Penelitian">
                                    <option value=""> Pilih Topik Penelitian </option>
                                    @foreach ($researchtopics as $d)
                                        <option value="{{ $d->id }}"
                                            {{ $d->id == old('research_topics') ? 'selected' : '' }}>
                                            {{ $d->name }}</option>
                                    @endforeach
                                </select>
                                @error('research_topics')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="title">Judul Penelitian</label>
                            <div class="input-group input-group-merge has-validation">
                                <input type="text" class="form-control @error('research_title') is-invalid @enderror"
                                    name="research_title" placeholder=" Judul Penelitian"
                                    value="{{ old('research_title') }}">
                                @error('research_title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="input-group input-group-merge has-validation">
                                <label for="select2Multiple" class="form-label">Tim Peneliti</label>
                                <select id="select2Multiple"
                                    class="select2 form-select @error('researcher_id') is-invalid @enderror"
                                    name="researcher_id[]" id="researcher_id" multiple>
                                    <option value="" disabled selected> Pilih Tim Peneliti </option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            {{ in_array($user->id, old('researcher_id', [])) ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('researcher_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div id="defaultFormControlHelp" class="form-text">Silahkan Pilih Tim Peneliti Max 2.
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col sm mb-4">
                                <label for="" class="form-label">Jenis
                                    TKT</label>
                                <div class="input-group input-group-merge has-validation">
                                    <select class="form-select @error('tkt_type') is-invalid @enderror select2"
                                        name="tkt_type" id="tkt_type" data-placeholder=" Pilih Jenis TKT">
                                        <option value=""> Pilih Jenis TKT </option>
                                        @foreach ($tkttype as $d)
                                            <option value="{{ $d->id }}"
                                                {{ $d->id == old('tkt_type') ? 'selected' : '' }}>
                                                {{ $d->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('tkt_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col sm mb-4">
                                <label for="" class="form-label">Target Utama
                                    Riset</label>
                                <div class="input-group input-group-merge has-validation">
                                    <select
                                        class="form-select @error('main_research_target') is-invalid @enderror select2"
                                        name="main_research_target" id="main_research_target"
                                        data-placeholder=" Pilih Target Utama Riset">
                                        <option value=""> Target Utama Riset </option>
                                        @foreach ($mainresearch as $d)
                                            <option value="{{ $d->id }}"
                                                {{ $d->id == old('main_research_target') ? 'selected' : '' }}>
                                                {{ $d->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('main_research_target')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Upload File<i class="text-danger">*</i></label>
                            <div class="input-group mb-4">
                                <input class="form-control @error('proposal_doc') is-invalid @enderror"
                                    name="proposal_doc" type="file" accept=".pdf" title="PDF">
                                @error('proposal_doc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="basicDate">Catatan</label>
                            <div class="input-group input-group-merge has-validation">
                                <textarea type="text" class="form-control @error('notes') is-invalid @enderror" name="notes"
                                    value="{{ old('notes') }}"> </textarea>
                                @error('notes')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection --}}

@section('content')
    <div id="wizard-validation" class="bs-stepper mt-2 p-3">
        <div class="bs-stepper-header">
            <div class="step" data-target="#account-details-validation">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-circle">1</span>
                    <span class="bs-stepper-label mt-1">
                        <span class="bs-stepper-title">Detail Penelitian</span>
                        <span class="bs-stepper-subtitle">Tambah Data Proposal</span>
                    </span>
                </button>
            </div>
            <div class="line">
                <i class="bx bx-chevron-right"></i>
            </div>
            <div class="step" data-target="#personal-info-validation">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-circle">2</span>
                    <span class="bs-stepper-label mt-1">
                        <span class="bs-stepper-title">Tim Peneliti</span>
                        <span class="bs-stepper-subtitle">Tambah Tim Penelitian</span>
                    </span>
                </button>
            </div>
            <div class="line">
                <i class="bx bx-chevron-right"></i>
            </div>
            <div class="step" data-target="#social-links-validation">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-circle">3</span>
                    <span class="bs-stepper-label mt-1">
                        <span class="bs-stepper-title">Dokumen</span>
                        <span class="bs-stepper-subtitle">Unggah Dokumen</span>
                    </span>
                </button>
            </div>
        </div>
        <div class="bs-stepper-content">
            <form id="wizard-validation-form" method="POST" action="{{ route('user-proposals.create') }}"
                enctype="multipart/form-data">
                @csrf
                <!-- Account Details -->
                <div id="account-details-validation" class="content">
                    <div class="content-header mb-3">
                        <h6 class="mb-0">Detail Penelitian</h6>
                        <small>Lengkapi Data Penelitian.</small>
                    </div>
                    <div class="row g-6">
                        <div class="col-sm-6 mb-3">
                            <label class="form-label mb-1" for="research_type">Jenis Penelitian<i
                                    class="text-danger">*</i></label>
                            <select class="form-select select2" name="research_type" id="research_type">
                                <option value=""> Pilih Jenis Penelitian </option>
                                @foreach ($researchtypes as $d)
                                    <option value="{{ $d->id }}"
                                        {{ $d->id == old('research_type') ? 'selected' : '' }}>
                                        {{ $d->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6 mb-3 form-password-toggle">
                            <label class="form-label mb-1" for="formValidationEmail">Total Dana<i
                                    class="text-danger">*</i></label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text" class="form-control" name="total_fund" id="total_fund"
                                    placeholder="Total Dana" value="{{ old('total_fund') }}">
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3 form-password-toggle">
                            <label class="form-label mb-1" for="formValidationEmail">Kategori Penelitian<i
                                    class="text-danger">*</i></label>
                            <select class="form-select select2" name="research_categories" id="research_categories"
                                data-placeholder=" Pilih Kategori Penelitian">
                                <option value=""> Pilih Kategori Penelitian </option>
                                @foreach ($researchcategories as $d)
                                    <option value="{{ $d->id }}"
                                        {{ $d->id == old('research_categories') ? 'selected' : '' }}>
                                        {{ $d->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6 mb-3 form-password-toggle">
                            <label class="form-label mb-1">Tema Penelitian<i class="text-danger">*</i></label>
                            <select class="form-select select2" name="research_themes" id="research_themes"
                                data-placeholder=" Pilih Tema Penelitian">
                                <option value=""> Pilih Tema Penelitian </option>
                                @foreach ($researchthemes as $d)
                                    <option value="{{ $d->id }}"
                                        {{ $d->id == old('research_themes') ? 'selected' : '' }}>
                                        {{ $d->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6 mb-3 form-password-toggle">
                            <label class="form-label mb-1">Topik Penelitian<i class="text-danger">*</i></label>
                            <select class="form-select select2" name="research_topics" id="research_topics"
                                data-placeholder=" Pilih Topik Penelitian">
                                <option value=""> Pilih Topik Penelitian </option>
                                @foreach ($researchtopics as $d)
                                    <option value="{{ $d->id }}"
                                        {{ $d->id == old('research_topics') ? 'selected' : '' }}>
                                        {{ $d->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6 mb-3 form-password-toggle">
                            <label class="form-label mb-1" for="formValidationEmail">Judul Penelitian<i
                                    class="text-danger">*</i></label>
                            <input type="text" class="form-control" name="research_title" id="research_title"
                                placeholder=" Judul Penelitian" value="{{ old('research_title') }}">
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label class="form-label mb-1" for="formValidationLastName">Tingkat Kesiapan Teknologi<i
                                    class="text-danger">*</i></label>
                            <select class="form-select select2" name="tkt_type" id="tkt_type"
                                data-placeholder=" Pilih Jenis TKT">
                                <option value=""> Pilih Jenis TKT </option>
                                @foreach ($tkttype as $d)
                                    <option value="{{ $d->id }}"
                                        {{ $d->id == old('tkt_type') ? 'selected' : '' }}>
                                        {{ $d->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label class="form-label mb-1" for="formValidationLastName">Target Utama Riset<i
                                    class="text-danger">*</i></label>
                            <select class="form-select select2" name="main_research_target" id="main_research_target"
                                data-placeholder=" Pilih Target Utama Riset">
                                <option value=""> Target Utama Riset </option>
                                @foreach ($mainresearch as $d)
                                    <option value="{{ $d->id }}"
                                        {{ $d->id == old('main_research_target') ? 'selected' : '' }}>
                                        {{ $d->title }} | {{ $d->description }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 d-flex justify-content-between">
                            <button class="btn btn-label-secondary btn-prev" disabled>
                                <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                                <span class="align-middle d-sm-inline-block d-none">Kembali</span>
                            </button>
                            <button type="button" class="btn btn-primary btn-next">
                                <span class="align-middle d-sm-inline-block d-none me-sm-1">Lanjut</span>
                                <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div id="personal-info-validation" class="content">
                    <div class="content-header mb-4">
                        <h6 class="mb-0">Tim Penelitian</h6>
                        <small>Tambah Tim Penelitian.</small>
                    </div>
                    <div class="row g-6">
                        <div class="col-sm-6 mb-3">
                            <label class="form-label mb-1">Tim Penelitian</label>
                            <select class="select2 form-select" name="researcher_id[]" id="researcher_id" multiple>
                                <option value="" disabled selected> Pilih Tim Peneliti </option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ in_array($user->id, old('researcher_id', [])) ? 'selected' : '' }}>
                                        {{ ucfirst($user->name) }}
                                    </option>
                                @endforeach
                            </select>
                            <div id="defaultFormControlHelp" class="form-text">Silahkan Pilih Tim Peneliti Max 2.</div>
                        </div>
                        <div class="col-12 d-flex justify-content-between">
                            <button type="button" class="btn btn-primary btn-prev">
                                <i class="bx bx-left-arrow-alt bx-sm ms-sm-n2 me-sm-2"></i>
                                <span class="align-middle d-sm-inline-block d-none">Kembali</span>
                            </button>
                            <button type="button" class="btn btn-primary btn-next">
                                <span class="align-middle d-sm-inline-block d-none me-sm-1">Lanjut</span>
                                <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div id="social-links-validation" class="content">
                    <div class="content-header mb-4">
                        <h6 class="mb-0">Dokumen</h6>
                        <small>Unggah Dokumen Proposal</small>
                    </div>
                    <div class="row g-6">
                        <div class="col-sm-12 mb-3">
                            <label class="form-label mb-1" for="proposal_doc">Upload Dokumen<i
                                    class="text-danger">*</i></label>
                            <input class="form-control" name="proposal_doc" type="file" accept=".pdf"
                                title="PDF">
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label class="form-label mb-1" for="notes">Catatan</label>
                            <div id="editor-container" class="form-control"></div>
                            <textarea class="form-control d-none" id="notes" name="notes" placeholder="Tuliskan isi pikiranmu...">{{ old('notes') }}</textarea>
                        </div>
                    </div>

                    <div class="col-12 d-flex justify-content-between">
                        <button type="button" class="btn btn-primary btn-prev">
                            <i class="bx bx-left-arrow-alt bx-sm ms-sm-n2 me-sm-2"></i>
                            <span class="align-middle d-sm-inline-block d-none">Kembali</span>
                        </button>
                        <button type="button" class="btn btn-primary btn-submit" onclick="return confirmSubmit(event)">
                            <span class="align-middle d-sm-inline-block d-none me-sm-1">Kirim</span>
                            <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
                        </button>
                    </div>
                </div>
        </div>
        </form>
    </div>
    </div>


@endsection


@section('script')
    <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>

    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- <script src="{{asset('assets/vendor/libs/bs-stepper/bs-stepper.js')}}"></script> --}}
    <script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/dropzone/dropzone.js') }}"></script>
    <script
        src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/documentation/assets/vendor/libs/bs-stepper/bs-stepper.js">
    </script>
    <script
        src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/documentation/assets/vendor/libs/@form-validation/popular.js">
    </script>
    <script
        src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/documentation/assets/vendor/libs/@form-validation/bootstrap5.js">
    </script>
    <script
        src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/documentation/assets/vendor/libs/@form-validation/auto-focus.js">
    </script>
    <script src="{{ asset('assets/vendor/libs/form-wizard-validation/form-wizard-validation.js') }}"></script>
    <script src="{{ asset('assets/js/forms-file-upload.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/quill/katex.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/quill/quill.js') }}"></script>
    <script src="{{ asset('assets/js/forms-editors.js') }}"></script>
    <script>
        document.getElementById('total_fund').addEventListener('input', function (e) {
            let value = e.target.value.replace(/[^,\d]/g, '').toString();
            let split = value.split(',');
            let remainder = split[0].length % 3;
            let rupiah = split[0].substr(0, remainder);
            let thousands = split[0].substr(remainder).match(/\d{3}/gi);

            if (thousands) {
                let separator = remainder ? '.' : '';
                rupiah += separator + thousands.join('.');
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            e.target.value = rupiah;
        });
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

        $(document).ready(function() {
            if ($('#research_categories').val() == '') {
                $("#research_themes").prop('disabled', true).attr('data-placeholder',
                    'Pilih Kategori Penelitian terlebih dahulu');
                $("#research_topics").prop('disabled', true).attr('data-placeholder',
                    'Pilih Kategori Penelitian terlebih dahulu');
            }

            if ($('#research_themes').val() == '') {
                $("#research_topics").prop('disabled', true).attr('data-placeholder',
                    'Pilih Tema Penelitian terlebih dahulu');
            }
            // ketika category dirubah, theme di isi

            $('#research_categories').change(function() {
                var categoryId = this.value;
                $("#research_themes").html('');
                $("#research_topics").html('');
                $.ajax({
                    url: "{{ route('DOC.get_research_themes_by_id') }}",
                    type: "GET",
                    data: {
                        id: categoryId,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#research_themes').html('<option value="">Select Theme</option>');
                        $.each(result, function(key, value) {
                            $("#research_themes").append('<option value="' + value.id +
                                '">' + value.name + '</option>');
                        });
                        $("#research_themes").prop('disabled', false).attr('data-placeholder',
                            'Pilih Tema Penelitian');
                    }
                });
            });

            // ketika theme dirubah, topic di isi
            $('#research_themes').change(function() {
                var themeId = this.value;
                $("#research_topics").html('');
                $.ajax({
                    url: "{{ route('DOC.get_research_topics_by_id') }}",
                    type: "GET",
                    data: {
                        id: themeId,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#research_topics').html('<option value="">Select Topic</option>');
                        $.each(result, function(key, value) {
                            $("#research_topics").append('<option value="' + value.id +
                                '">' + value.name + '</option>');
                        });
                        $("#research_topics").prop('disabled', false);
                    }
                });
            });
        });
        //     $('#research_themes').change(function() {
        //         var themeId = this.value;
        //         $("#research_topics").html('');
        //         $.ajax({
        //             url: "{{ route('DOC.get_research_topics_by_id') }}",
        //             type: "GET",
        //             data: {
        //                 id: themeId,
        //                 _token: '{{ csrf_token() }}'
        //             },
        //             dataType: 'json',
        //             success: function(result) {
        //                 $('#research_topics').html('<option value="">Select Topic</option>');
        //                 $.each(result, function(key, value) {
        //                     $("#research_topics").append('<option value="' + value.id +
        //                         '">' + value.name + '</option>');
        //                 });
        //             }
        //         });
        //     });
    </script>
    <script>
        $(document).ready(function() {
            $('#research_type').change(function() {
                var researchtypesId = $(this).val();

                // Kirim AJAX request untuk mendapatkan harga paket
                $.ajax({
                    url: '/user-proposals/research_type_funds/' +
                        researchtypesId, // Ganti URL dengan endpoint yang sesuai
                    type: 'GET',
                    success: function(response) {
                        var formattedFunds = new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR'
                        }).format(response.total_funds);
                        $('#researchtypesId').val(formattedFunds);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>

    <script>
        function confirmSubmit(event) {
            event.preventDefault(); // Prevent the default form submission
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Anda ingin mengirim proposal ini!",
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
                    $('#wizard-validation-form').submit();
                }
            });
        }

        $(document).ready(function() {
            if ($('#research_type').val() == '') {
                $("#tkt_type").prop('disabled', true).attr('data-placeholder',
                    'Pilih Jenis Penelitian terlebih dahulu');
            }

            // ketika category dirubah, theme di isi

            $('#research_type').change(function() {
                var tktTypes = this.value;
                $("#tkt_type").html('');
                $.ajax({
                    url: "{{ route('DOC.get_tkt_types_by_id') }}",
                    type: "GET",
                    data: {
                        id: tktTypes,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#tkt_type').html('<option value="">Select Theme</option>');
                        $.each(result, function(key, value) {
                            $("#tkt_type").append('<option value="' + value.id +
                                '">' + value.title + '</option>');
                        });
                        $("#tkt_type").prop('disabled', false).attr('data-placeholder',
                            'Pilih Jenis TKT');
                    }
                });
            });
        });

    </script>



@endsection
