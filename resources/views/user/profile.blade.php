@extends('layouts.admin')
<link rel="stylesheet" href="{{ url('/') }}/assets/css/demo.css" />
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
@section('content')
    <main class="page-content">
        <div class="container">
            <div class="page-header">
                <h1 class="page-header__title">Profile {{ auth()->user()->name ?? 'User' }}</h1>
            </div>
            <div class="page-tools">
                <div class="page-tools__breadcrumbs">
                    <div class="breadcrumbs">
                        <div class="breadcrumbs__container">
                            <ol class="breadcrumbs__list">
                                <li class="breadcrumbs__item">
                                    <a class="breadcrumbs__link" href="index.html">
                                        <svg class="icon-icon-home breadcrumbs__icon">
                                            <use xlink:href="#icon-home"></use>
                                        </svg>
                                        <svg class="icon-icon-keyboard-right breadcrumbs__arrow">
                                            <use xlink:href="#icon-keyboard-right"></use>
                                        </svg>
                                    </a>
                                </li>
                                <li class="breadcrumbs__item active"><span class="breadcrumbs__link">Profile
                                        {{ auth()->user()->name ?? 'User' }}</span>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4 p-0">
                        <div class="card__wrapper">
                            <div class="card__container p-0">
                                <div class="card__body">
                                    <div class="profile-cover">
                                        <div class="profile-cover-wrap">
                                            <img class="profile-cover-img"
                                                src="{{ url($user->cover_photo ? 'img-profile/' . $user->cover_photo : 'https://source.unsplash.com/800x200?black') }}"
                                                alt="Profile Cover">
                                            <div class="cover-content">
                                                <div class="custom-file-btn">
                                                    <form action="{{ route('profile.save_profile') }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="cover" value="cover">
                                                        <input type="file" class="custom-file-btn-input" name="image"
                                                            id="cover_upload">
                                                        <label class="custom-file-btn-label btn btn-sm btn-white"
                                                            style="color: white" for="cover_upload">
                                                            <i class="fas fa-camera"></i>
                                                            <span class="d-none d-sm-inline-block ms-1">Update Cover</span>
                                                        </label>
                                                        <button type="submit" id="submit_cover"
                                                            style="display: none;"></button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center mb-1">
                                        <label class="avatar avatar-xxl profile-cover-avatar" for="avatar_upload">
                                            <img class="avatar-img avatar-img-custom"
                                                src="{{ url($user->photo ? 'img-profile/' . $user->photo : 'https://billing.tokalink.id/JDNN.png') }}"
                                                alt="Profile Image">
                                            <form action="{{ route('profile.save_profile') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="file" id="image_profile" name="image">
                                                <label class="avatar-edit" for="image_profile">
                                                    <i class="fas fa-pen"></i>
                                                </label>
                                                <button type="submit" id="submit_profile" style="display: none;"></button>
                                            </form>
                                        </label>
                                    </div>
                                    <div
                                        class="user-profile-header d-flex flex-column flex-sm-row text-sm-center text-center mb-4 mt-4">
                                        <div class="flex-grow-1">
                                            <div
                                                class="align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                                                <div class="user-profile-info">
                                                    <h4>{{ $user->name ?? 'User' }} ( {{ $user->role->name ?? 'Client' }} )
                                                    </h4>
                                                    <ul
                                                        class="list-inline mb-0 align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                                        <li class="list-inline-item"><i
                                                                class="ti ti-phone-call"></i>{{ $user->phone ?? '' }}</li>
                                                        <li class="list-inline-item"><i
                                                                class="ti ti-map-pin"></i>{{ $user->kota ?? '' }}</li>
                                                        <li class="list-inline-item"><i
                                                                class="ti ti-mail"></i>{{ $user->email ?? '-' }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Profile Content -->
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-xl-8 col-lg-8 col-md-5">
                    <div class="card mb-4">
                        <div class="card__wrapper">
                            <div class="card__container">
                                <div class="card__body">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6">
                                            <h6 class="card-text text-uppercase">About</h6>
                                        </div>
                                        <div class="col-lg-6 text-right">
                                            <a class="button-icon" href="#" data-modal="#accountEdit"><span
                                                    class="button-icon__icon">
                                                    <svg class="icon-icon-task">
                                                        <use xlink:href="#icon-task"></use>
                                                    </svg></span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="dropdown-menu__divider"></div>
                                    <ul class="list-unstyled mb-4 mt-3">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <li class="d-flex align-items-center mb-3">
                                                    <i class="ti ti-user"></i><span class="fw-bold mx-2">Nama Lengkap
                                                        :</span>
                                                    <span>{{ $user->name ?? 'User' }}</span>
                                                </li>
                                                <li class="d-flex align-items-center mb-3">
                                                    <i class="ti ti-phone"></i><span class="fw-bold mx-2">Nomor Handphone
                                                        :</span>
                                                    <span>{{ $user->phone }}</span>
                                                </li>
                                                <li class="d-flex align-items-center mb-3">
                                                    <i class="ti ti-mail"></i><span class="fw-bold mx-2">Email :</span>
                                                    <span>{{ $user->email }}</span>
                                                </li>
                                                <li class="d-flex align-items-center mb-3">
                                                    <i class="ti ti-crown"></i><span class="fw-bold mx-2">Role :</span>
                                                    <span>{{ $user->role->name ?? 'Member' }}</span>
                                                </li>
                                            </div>
                                            <div class="col-lg-6">
                                                <li class="d-flex align-items-center mb-3">
                                                    <i class="ti ti-user"></i><span class="fw-bold mx-2">Provinsi :</span>
                                                    <span>{{ $user->provinsi }}</span>
                                                </li>
                                                <li class="d-flex align-items-center mb-3">
                                                    <i class="ti ti-phone"></i><span class="fw-bold mx-2">Kota :</span>
                                                    <span>{{ $user->kota }}</span>
                                                </li>
                                                <li class="d-flex align-items-center mb-3">
                                                    <i class="ti ti-mail"></i><span class="fw-bold mx-2">Kecamatan
                                                        :</span>
                                                    <span>{{ $user->kecamatan }}</span>
                                                </li>
                                            </div>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ User Profile Content -->
        </div>
    </main>

    <div class="modal modal-account modal-compact scrollbar-thin" id="accountEdit" data-simplebar>
        <div class="modal__overlay" data-dismiss="modal"></div>
        <div class="modal__wrap">
            <div class="modal__window">
                <div class="modal__content">
                    <button class="modal__close" data-dismiss="modal">
                        <svg class="icon-icon-cross">
                            <use xlink:href="#icon-cross"></use>
                        </svg>
                    </button>
                    <div class="modal__body">
                        <div class="">
                            <div class="modal-account__right tab-content">
                                <div class="modal-account__pane tab-pane fade show active" id="accountDetails">
                                    <div class="modal-account__pane-header">
                                        <h2 id="title-credit">Edit Profile</h2>
                                    </div>
                                    <form id="editUserForm" class="row g-3" onsubmit="return false">
                                        <input type="hidden" name="idUser" value="{{ $user->id }}" id="idUser"
                                            class="form-control">
                                        <div class="col-12 col-md-6 mb-3">
                                            <label class="form-label" for="modalEditUserFirstName">Sapaan</label>
                                            <input type="text" id="sapaan" name="sapaan"
                                                class="form-control input" placeholder="Sapaan"
                                                value="{{ $user->sapaan }}" />
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <label class="form-label" for="panggilan">Nama Panggilan</label>
                                            <input type="text" id="panggilan" name="panggilan"
                                                class="form-control input" placeholder="Doe"
                                                value="{{ $user->panggilan }}" />
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="form-label" for="username">Nama Lengkap</label>
                                            <input type="text" id="name" name="name"
                                                class="form-control input" placeholder="john.doe.007"
                                                value="{{ $user->name }}" />
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="text" id="email" name="email"
                                                class="form-control input" placeholder="example@domain.com"
                                                value="{{ $user->email }}" />
                                        </div>
                                        {{-- <div class="col-12 col-md-6 mb-3">
                                            <label class="form-label" for="status">Status</label>
                                            <select id="status" name="status" class="form-select input"
                                                aria-label="Default select example">
                                                <option value="Aktif">Aktif</option>
                                                <option value="Nonaktif">Nonaktif</option>
                                                <option value="Suspended">Suspended</option>
                                            </select>
                                        </div> --}}
                                        <div class="col-12 col-md-6 mb-3">
                                            <label class="form-label" for="phone">Phone Number</label>
                                            <input type="text" id="phone" name="phone"
                                                class="form-control input phone-number-mask" placeholder="+628xxx"
                                                value="{{ $user->phone }}" />
                                        </div>
                                        <div class="col-12 col-md-4 mb-3">
                                            <label class="form-label" for="provinsi">Provinsi</label>
                                            <select id="prov" name="provinsi" class="form-select input"></select>
                                        </div>
                                        <div class="col-12 col-md-4 mb-3">
                                            <label class="form-label" for="kota">Kota/Kabupaten</label>
                                            <select id="kab" name="kota" class="form-select input"></select>
                                        </div>
                                        <div class="col-12 col-md-4 mb-3">
                                            <label class="form-label" for="kecamatan">Kecamatan</label>
                                            <select id="kec" name="kecamatan" class="form-select input"></select>
                                        </div>
                                        <div class="col-12 text-center">
                                            <button type="submit" id="submit-btn"
                                                class="btn btn-primary me-sm-3 me-1">Simpan</button>
                                            <button type="reset" class="btn btn-label-secondary"
                                                data-bs-dismiss="modal" aria-label="Close">
                                                Cancel
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Password -->
    <div class="modal fade" id="editPassword" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple modal-edit-user">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h4 class="mb-2">Edit Profil</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Edit Password -->
@endsection
@section('js')
    <script>
        //update profile
        $('#image_profile').change(function() {
            $('#submit_profile').click();
        });
        //update cover
        $('#cover_upload').change(function() {
            $('#submit_cover').click();
        });

        async function oke(val) {
            const {
                value: file
            } = await Swal.fire({
                title: 'Select image',
                input: 'file',
                inputAttributes: {
                    'accept': 'image/*',
                    'aria-label': 'Upload your profile picture'
                }
            })
            if (file) {
                const reader = new FileReader()
                reader.onload = (e) => {
                    Swal.fire({
                        title: 'Your uploaded picture',
                        imageUrl: e.target.result,
                        imageAlt: 'The uploaded picture'
                    })
                }
                reader.readAsDataURL(file)
            }
        }

        async function pass() {
            const {
                value: password
            } = await Swal.fire({
                title: 'Masukan Password Baru',
                input: 'password',
                inputPlaceholder: 'Enter your password',
                confirmButtonText: 'Simpan',
                cancelButtonText: 'Batal',
                showCancelButton: true,
                inputAttributes: {
                    maxlength: 10,
                    autocapitalize: 'off',
                    autocorrect: 'off'
                }
            })
            if (password) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('profile.edit_password') }}",
                    data: {
                        password: password,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(result) {
                        $('#form_password').hide();
                        $('#password').val('');
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Password diperbarui',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    },
                    error: function(result) {
                        Swal.fire({
                            position: 'center',
                            icon: 'danger',
                            title: 'Password tidak valid',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });
            }
        }

        $(document).ready(function(e) {
            $('#imageupload').on('submit', (function(e) {
                e.preventDefault();
                var image = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: image,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        console.log("success");
                        console.log(data);
                    },
                    error: function(data) {
                        console.log("error");
                        console.log(data);
                    }
                });
            }));
            $("#ImageBrowse").on("change", function() {
                $("#imageUploadForm").submit();
            });
        });

        $('#submit-btn').on('click', function() {
            let url = location.origin + '/profile/store'
            let data = {
                id: $('#idUser').val(),
                sapaan: $('#sapaan').val(),
                panggilan: $('#panggilan').val(),
                name: $('#name').val(),
                email: $('#email').val(),
                phone: $('#phone').val(),
                // status: $('#status').val(),
                provinsi: $('#prov').val(),
                kota: $('#kab').val(),
                kecamatan: $('#kec').val(),
            }
            console.log(url, data);
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    data: data
                },
                success: function(res) {
                    $('#accountEdit').modal('hide')
                    toastr.success(res);
                    window.location.reload()
                },
                error: function(err) {
                    toastr.error(err.responseJSON.message ?? 'Something went wrong');
                    console.log(err)
                }
            })
        })

        const apiDaerah = new ApiDaerah({
            provinsi: {
                id: 'prov',
                selected: '{{ $user->provinsi }}' || null,
                value: 'name',
            },
            kabupaten: {
                id: 'kab',
                selected: '{{ $user->kota }}' || null,
                value: 'full_name',
                text: 'full_name'
            },
            kecamatan: {
                id: 'kec',
                selected: '{{ $user->kecamatan }}' || null,
                value: 'name',
            },
        })

        async function pass() {
            const {
                value: password
            } = await Swal.fire({
                title: 'Masukan Password Baru',
                input: 'password',
                inputPlaceholder: 'Enter your password',
                confirmButtonText: 'Simpan',
                showCancelButton: true,
                inputAttributes: {
                    maxlength: 10,
                    autocapitalize: 'off',
                    autocorrect: 'off'
                }
            })
            if (password) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('profile.edit_password') }}",
                    data: {
                        password: password,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(result) {
                        $('#form_password').hide();
                        $('#password').val('');
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Password diperbarui',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    },
                    error: function(result) {
                        Swal.fire({
                            position: 'center',
                            icon: 'danger',
                            title: 'Password tidak valid',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });
            }
        }
    </script>
@endsection
