@extends('layouts.master')

@section('title', 'Edit Profil')
@section('breadcrumb-items')
    <span class="text-muted fw-light">Akun / </span>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}">
@endsection
@section('style')
    <style>
        .img {
            height: 120px;
            width: 120px;
            border-radius: 0%;
            object-fit: cover;
            background: #dfdfdf
        }
        .layout-page,
        .content-wrapper,
        .content-wrapper>*,
        .layout-menu {
            min-height: unset;
        }
        
    </style>
@section('content')
        <div class="nav-align-top mb-4">
    <div class="col-xl-6">
                    <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                      <li class="nav-item">
                        <button
                          type="button"
                          class="nav-link active"
                          role="tab"
                          data-bs-toggle="tab"
                          data-bs-target="#navs-pills-justified-home"
                          aria-controls="navs-pills-justified-home"
                          aria-selected="true"
                        >
                          <i class="tf-icons bx bx-user"></i> Personal Info
                        </button>
                      </li>
                      <li class="nav-item">
                        <button
                          type="button"
                          class="nav-link"
                          role="tab"
                          data-bs-toggle="tab"
                          data-bs-target="#navs-pills-justified-profile"
                          aria-controls="navs-pills-justified-profile"
                          aria-selected="false"
                        >
                          <i class="tf-icons bx bx-id-card"></i> Foto Profile
                        </button>
                      </li>
                      <li class="nav-item">
                        <button
                          type="button"
                          class="nav-link"
                          role="tab"
                          data-bs-toggle="tab"
                          data-bs-target="#navs-pills-justified-messages"
                          aria-controls="navs-pills-justified-messages"
                          aria-selected="false"
                        >
                          <i class="tf-icons bx bx bx-dialpad"></i> Password
                        </button>
                      </li>
                    </ul>
    </div>
                    <div class="tab-content">
                      <div class="tab-pane fade show active" id="navs-pills-justified-home" role="tabpanel">
                      <form action="" method="POST" enctype="multipart/form-data" id="form-add-new-record">
            <div class="row g-6">
            <h4>Update Profil</h4>
          <div class="row g-6">
            <div class="col-md-6 fv-plugins-icon-container">
                <label class="form-label">Nama</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::user()->name }}" placeholder="Nama Lengkap" autofocus />
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
            <div class="col-md-6 fv-plugins-icon-container">
                <label class="form-label">Username</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ Auth::user()->username }}" placeholder="NIK/NIM"
                @if (Auth::user()->username != null) readonly title="Silahkan hubungi Admin" @endif />
                    @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                            @if (Auth::user()->username == null)
                                <span class="text-danger">
                                    <strong>Isi Username/NIM Anda</strong>
                                </span>
                            @endif
            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
            <div class="col-md-6">
            <label class="form-label">Gelar Depan</label>
            <input type="text" class="form-control @error('front_title') is-invalid @enderror" name="front_title" value="{{ Auth::user()->front_title }}" />
                            @error('front_title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
            </div>
            <div class="col-md-6">
            <label class="form-label">Gelar Belakang</label>
            <input type="text" class="form-control @error('back_title') is-invalid @enderror" name="back_title" value="{{ Auth::user()->back_title }}" />
                            @error('back_title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
            </div>
            <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') == null ? Auth::user()->email : old('email') }}" />
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
            </div>
            <div class="col-md-6">
            <label for="nidn" class="form-label">NIDN</label>
            <input type="nidn" class="form-control @error('nidn') is-invalid @enderror" id="nidn" name="nidn" value="{{ old('nidn') == null ? Auth::user()->nidn : old('nidn') }}" />
                            @error('nidn')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
            </div>
            <div class="col-md-6">
            <label class="form-label">Program Studi</label>
                            <select
                                class="select2 form-select col-sm-12 @error('study_programs') is-invalid @enderror"
                                name="study_programs">
                                <option value="" {{ Auth::user()->studyProgram == null ? 'selected' : '' }}
                                    disabled>
                                    Select</option>
                                @foreach ($studiprogram as $g)
                                    <option value="{{ $g->id }}"
                                        {{ Auth::user()->study_program_id == $g->id ? 'selected' : '' }}>
                                        {{ $g->name }}</option>
                                @endforeach
                            </select>
                            @error('study_programs')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
            </div>
            <div class="col-md-6">
            <label class="form-label">Department</label>
                            <select
                                class="select2 form-select col-sm-12 @error('departement') is-invalid @enderror"
                                name="department">
                                <option value="" {{ Auth::user()->department == null ? 'selected' : '' }}
                                    disabled>
                                    Select</option>
                                @foreach ($dept as $g)
                                    <option value="{{ $g->id }}"
                                        {{ Auth::user()->departments_id == $g->id ? 'selected' : '' }}>
                                        {{ $g->name }}</option>
                                @endforeach
                            </select>
                            @error('departement')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
            </div>
            <div class="col-md-6">
            <label class="form-label">Google Schoolar</label>
                            <input type="text" class="form-control @error('schoolar') is-invalid @enderror"
                                name="schoolar" value="{{ Auth::user()->schoolar }}" placeholder="Masukan Link Google Schoolar Anda"/>
                            @error('schoolar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
            </div>
          </div>
            </div>
            <br><hr>
            <div class="pt-6">
            <button type="submit" class="btn btn-primary me-2" onclick="return confirmSubmit(event)">Simpan</button>
            <a class="btn btn-outline-secondary" href="{{ route('dashboard') }}">Kembali</a>
            </div>
          </form>
                      </div>
                      <div class="tab-pane fade" id="navs-pills-justified-profile" role="tabpanel">
                      <div class="row g-6">
            <div class="card-body">
      @if(session('msg'))
        <div class="alert alert-primary alert-dismissible" role="alert">
            {{session('msg')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="d-flex align-items-start align-items-sm-center gap-6 pb-4 border-bottom">
        @csrf
                    <div class="mb-2 col-md-2">
                        @if ($user->image)
                        <img src="{{ asset($user->image) }}" alt="user-avatar" class="img" id="uploadedAvatar">
                    @else
                        <img src="{{ asset('/assets/img/avatars/user.png') }}" alt="user-avatar" class="img"
                            id="uploadedAvatar">
                    @endif
                    </div>
          <div class="button-wrapper">
            <label for="image" class="btn btn-primary me-2 mb-4" tabindex="0">
                <span class="d-none d-sm-block">Upload new photo</span>
                <i class="bx bx-upload d-block d-sm-none"></i>
                <input type="file" id="image" name="image" class="account-file-input" hidden="" accept="image/png, image/jpeg">
                </label>
                <button type="button" class="btn btn-label-secondary account-image-reset mb-4">
                    <i class="bx bx-reset d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Reset</span>
                </button>
            <div>Allowed JPG, GIF or PNG. Max size of 800K</div>
          </div>
        </div>
      </div>
            </div>
            <br>
            <div class="pt-6">
            <button type="submit" class="btn btn-primary me-2" onclick="return confirmSubmit(event)">Simpan</button>
            <a class="btn btn-outline-secondary" href="{{ route('dashboard') }}">Kembali</a>
            </div>
                      </div>
                      <div class="tab-pane fade" id="navs-pills-justified-messages" role="tabpanel">
                      <form action="" method="POST" enctype="multipart/form-data" id="form-add-new-record">
            <div class="row g-6">
            <h4>Ganti Password</h4>
                <div class="row g-6">
                    <div class="col-md-6">
                        <label class="form-label">Password Baru</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            name="password" placeholder="Masukkan password baru" />
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                            name="password_confirmation" placeholder="Konfirmasi password baru" />
                                        @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                    </div>
                </div>
            </div>
            <br><hr>
            <div class="pt-6">
            <button type="submit" class="btn btn-primary me-2" onclick="return confirmSubmit(event)">Simpan</button>
            <a class="btn btn-outline-secondary" href="{{ route('dashboard') }}">Kembali</a>
            </div>
          </form>
                      </div>
                    </div>
                  </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>

    <script>
        function confirmSubmit(event) {
            event.preventDefault(); // Prevent the default form submission
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Anda akan memperbarui profil ini!",
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
    <script>
        $(document).ready(function() {
            const image = document.getElementById('uploadedAvatar');
            const input = document.querySelector('input[type="file"]');
            const resetButton = document.querySelector('.account-image-reset');

            // Handle image upload
            input.addEventListener('change', () => {
                if (input.files.length > 0) {
                    image.src = URL.createObjectURL(input.files[0]);
                }
            });

            // Handle reset button click
            resetButton.addEventListener('click', () => {
                input.value = ""; // Clear the input
                image.src = "{{ asset('/assets/img/avatars/user.png') }}"; // Set to default image
            });
        });

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


@endsection
