@extends('admin.master.main')

@section('page-heading')
Data Mahasiswa
@endsection
@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<style>
    .panel {
        animation: hidePanel 0.7s ease-in-out;
        position: fixed;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgb(246, 246, 246);
        border-radius: 10px 10px 0 0;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        border-top: 4px solid #435ebe !important;
        display: none;
        z-index: 999;
    }

    .panel.card {
        width: 50%;
        height: 50% !important;
    }

    .panel.active {
        animation: showPanel 0.7s ease-in-out;
        display: block;
        width: 100%;
        height: 95%;
        padding: 20px;
        overflow-y: auto;
    }

    @keyframes showPanel {
        0% {
            transform: translateY(100%);
        }

        100% {
            transform: translateY(0%);
        }
    }

    @keyframes hidePanel {
        0% {
            transform: translateY(0%);
        }

        100% {
            transform: translateY(100%);
        }
    }


    .closePanel {
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 99999;
    }
</style>
@endsection
@section('page-content')
<section class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body px-4 py-4-5">
                <div class="row">
                    <button class="btn btn-sm btn-primary" type="button" onclick="showPanel('','create')"><i
                            class="fas fa-plus"></i> Tambah</button>
                    <table class="table table-striped" id="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nrp</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $mhs)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $mhs->nrp }}</td>
                                <td>{{ $mhs->nama }}</td>
                                <td>{{ $mhs->gender }}</td>
                                <td>
                                    <button class="btn btn-sm btn-primary" type="button"
                                        onclick="showPanel('{{ $mhs->id }}','edit')"><i class="fas fa-pen"></i></button>
                                    <button class="btn btn-sm btn-success" type="button"
                                        onclick="showPanel('{{ $mhs->id }}','detail')"><i
                                            class="fas fa-eye"></i></button>
                                    <button class="btn btn-sm btn-danger" type="button"
                                        onclick="deleteData('{{ $mhs->id }}')"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="panel" class="panel">
    <button class="btn btn-sm btn-danger closePanel" onclick="closePanel()"><i class="fas fa-times"></i></button>
    <div class="row">
        <div class="col-md-6">
            <form id="edit">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="panel-title">Detail Mahasiswa</h4>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" name="nama" id="nama" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Nrp</label>
                                    <input type="text" name="nrp" id="nrp" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Prodi</label>
                                    <input type="text" name="prodi" id="prodi" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" name="alamat" id="alamat" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Hobi</label>
                                    <input type="text" name="hobi" id="hobi" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ukm</label>
                                    <input type="text" name="ukm" id="ukm" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Gender</label>
                                    <select name="gender" id="gender" class="form-control">
                                        <option value="" disabled>-- Pilih Gender --</option>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" id="email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="foto" class="form-label">Foto</label>
                                    <input class="form-control" type="file" id="foto" name="foto">
                                </div>
                                <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6 text-center">
            <div class="card">
                <div class="card-header">
                    Foto Mahasiswa
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <img src="{{ asset('assets/img/undraw_profile.svg') }}" alt="" class="img-fluid"
                                id="foto-preview">
                            <br>
                            <button class="btn btn-sm btn-primary mt-4" type="button" id="download"><i
                                    class="fas fa-download"></i> Download</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"
    integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous">
    </script>
<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(document).ready(function () {
        $('#table').DataTable();
    });

    function showPanel(id, type) {
        $('#panel').addClass('active');

        if (type != 'create') {
            $.ajax({
                method: 'GET',
                url: '{{ route("admin.data-mahasiswa.get", ["id" => ""]) }}' + id,
                success: function (response) {
                    var resp = JSON.parse(response);
                    $('#nama').val(resp.nama);
                    $('#nrp').val(resp.nrp);
                    $('#prodi').val(resp.prodi);
                    $('#alamat').val(resp.alamat);
                    $('#hobi').val(resp.hobi);
                    $('#ukm').val(resp.ukm);
                    $('#gender').val(resp.gender);
                    $('#email').val(resp.email);
                    $('#foto-preview').attr('src', '{{ asset("uploads/") }}' + resp.foto);
                }
            })
            if (type == 'edit') {
                $('#panel-title').html('Edit Mahasiswa');
                $('#submit').html('Edit');
                $('#edit').attr('action', '{{ route("admin.data-mahasiswa.update", ["id" => ""]) }}' + id);
                $('#edit').append('<input type="hidden" name="id" value="' + id + '">');
                $('#submit').attr('style', 'display:block');
            } else {
                $('#panel-title').html('Detail Mahasiswa');
                $('#submit').attr('style', 'display:none');
            }

            $('#edit').submit(function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                console.log(formData);
                $.ajax({
                    method: 'POST',
                    url: '{{ route("admin.data-mahasiswa.edit") }}',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        swal({
                            title: "Berhasil!",
                            text: "Data berhasil diubah!",
                            icon: "success",
                            button: "OK",
                        }).then((value) => {
                            location.reload();
                        });
                    },
                    error: function (response) {
                        swal({
                            title: "Gagal!",
                            text: "Data gagal diubah!",
                            icon: "error",
                            button: "OK",
                        });
                    },
                    beforeSend: function () {
                        swal({
                            title: "Mohon Tunggu!",
                            text: "Sedang memproses data!",
                            icon: "info",
                            button: false,
                            closeOnClickOutside: false,
                            closeOnEsc: false,
                        });
                    },
                })
            })
        } else {
            $('#panel-title').html('Tambah Mahasiswa');
            $('#submit').html('Tambah');
            $('#edit').submit(function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                console.log(formData);
                $.ajax({
                    method: 'POST',
                    url: '{{ route("admin.data-mahasiswa.create") }}',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        swal({
                            title: "Berhasil!",
                            text: "Data berhasil diubah!",
                            icon: "success",
                            button: "OK",
                        }).then((value) => {
                            location.reload();
                        });
                    },
                    error: function (response) {
                        swal({
                            title: "Gagal!",
                            text: "Data gagal diubah!",
                            icon: "error",
                            button: "OK",
                        });
                    },
                    beforeSend: function () {
                        swal({
                            title: "Mohon Tunggu!",
                            text: "Sedang memproses data!",
                            icon: "info",
                            button: false,
                            closeOnClickOutside: false,
                            closeOnEsc: false,
                        });
                    },
                })
            })
        }
    }

    function closePanel() {
        $('#panel').removeClass('active');
        $('#nama').val('');
        $('#nrp').val('');
        $('#prodi').val('');
        $('#alamat').val('');
        $('#hobi').val('');
        $('#ukm').val('');
        $('#gender').val('');
        $('#email').val('');
        $('#foto-preview').attr('src', '{{ asset("assets/img/undraw_profile.svg") }}');
        // $('#edit').attr('action', '');
        $('#edit').find('input[name="id"]').remove();
    }

    function deleteData(id) {
        swal({
            title: "Apakah anda yakin?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((value) => {
            if (value) {
                $.ajax({
                    method: 'POST',
                    url: '{{ route("admin.data-mahasiswa.delete") }}',
                    data: {
                        id: id,
                    },
                    success: function (response) {
                        swal({
                            title: "Berhasil!",
                            text: "Data berhasil dihapus!",
                            icon: "success",
                            button: "OK",
                        }).then((value) => {
                            location.reload();
                        });
                    },
                    error: function (response) {
                        swal({
                            title: "Gagal!",
                            text: "Data gagal dihapus!",
                            icon: "error",
                            button: "OK",
                        });
                    },
                    beforeSend: function () {
                        swal({
                            title: "Mohon Tunggu!",
                            text: "Sedang memproses data!",
                            icon: "info",
                            button: false,
                            closeOnClickOutside: false,
                            closeOnEsc: false,
                        });
                    },
                })
            }
        });
    }
</script>
@endsection