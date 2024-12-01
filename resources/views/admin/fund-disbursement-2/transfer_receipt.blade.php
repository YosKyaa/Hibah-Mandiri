@extends('layouts.master')
@section('title', 'Unggah Bukti Transfer Dana')

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
                <h3 class="mb-0"><strong>Unggah Bukti Pendanaan Tahap 2</strong></h3>
                <span class="text-muted">Dokumen Kontrak.</span>

            </div>
            <hr class="my-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <iframe src="{{ $documentUrl }}" class="iframe mb-3"
                                onerror="this.onerror=null; this.outerHTML='Cannot load PDF.';"></iframe>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <h6 class="mb-0 text-muted" style="font-size: 15px;">Nama Peneliti</h6>
                            <p style="font-size: 18px;">{{ ucfirst($proposals->users->name) }}</p>
                        </div>
                        <div class="mb-3">
                            <h6 class="mb-0 text-muted" style="font-size: 15px;">Judul Penelitian</h6>
                            <p>{{ $proposals->research_title }}</p>
                        </div>
                        <div class="mb-3">
                            <h6 class="mb-0 text-muted" style="font-size: 15px;">Nomor Rekening</h6>
                            <p><strong style="font-size: 18px;">{{ $proposals->bank_account_number }}
                                    ({{ $proposals->bank->name }})</strong></p>
                        </div>
                        <div class="mb-3">
                            <h6 class="mb-0 text-muted" style="font-size: 15px;">Atas Nama</h6>
                            <p><strong style="font-size: 18px;">{{ $proposals->bank_account_name }}</strong></p>
                        </div>
                        <div class="mb-3">
                            <h6 class="mb-0 text-muted" style="font-size: 15px;">Total Pendanaan Tahap 1</h6>
                            <p><strong><em style="font-size: 18px;" id="seventyPercentDisplay"></em></strong></p>
                        </div>
                        <div class="col-md-6"> <a href="{{ $documentUrl }}" class="btn btn-primary" target="_blank">Lihat
                                Kontrak</a></div>
                    </div>


                </div>
                <div class="mb-3">
                    <form id="form-add-new-record" method="POST"
                        action="{{ route('fund-disbursement-2.transfer_receipt_update', $proposals->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Bukti Transfer PEndanaan<i class="text-danger">*</i></label>
                            <div class="input-group mb-4">
                                <input class="form-control @error('proposal_doc') is-invalid @enderror" name="proposal_doc"
                                    type="file" accept=".pdf, .jpg, .png" title="PDF, JPG, PNG">
                                @error('proposal_doc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary"
                                onclick="return confirmSubmit(event)">Kirim</button>
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
                    text: "Anda akan mengirim bukti transfer ini!",
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
            document.addEventListener("DOMContentLoaded", function() {
                // Assuming the value is coming from the server-side and rendered in a hidden input
                let totalFunds = parseFloat("{{ $proposals->total_fund }}");

                // Calculate 70% of total funds
                let seventyPercent = totalFunds * 0.3;

                // Format and display the value
                document.getElementById('seventyPercentDisplay').textContent = formatRupiah(seventyPercent) + ' (' +
                    terbilang(seventyPercent) + ')';
            });

            function formatRupiah(value) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(value);
            }

            function terbilang(value) {
                const units = ["", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan"];
                const scales = ["", "Ribu", "Juta", "Miliar", "Triliun"];

                if (value === 0) return "nol";

                let words = [];
                let i = 0;

                while (value > 0) {
                    let chunk = value % 1000;

                    if (chunk) {
                        let chunkWords = [];
                        if (chunk > 99) {
                            chunkWords.push(units[Math.floor(chunk / 100)] + " Ratus");
                            chunk %= 100;
                        }
                        if (chunk > 19) {
                            chunkWords.push(units[Math.floor(chunk / 10)] + " Puluh");
                            chunk %= 10;
                        }
                        if (chunk > 0) {
                            chunkWords.push(units[chunk]);
                        }
                        words.unshift(chunkWords.join(" ") + " " + scales[i]);
                    }
                    value = Math.floor(value / 1000);
                    i++;
                }
                return words.join(" ") + " Rupiah";
            }
        </script>
    @endsection
