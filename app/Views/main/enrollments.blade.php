@extends('main.master.main')

@section('page-heading')
Data Enrollments
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
                <button class="btn btn-sm btn-primary mb-3" type="button" onclick="showPanel('','create')"><i
                        class="fas fa-plus"></i> Tambah</button>
                <div class="row">
                    <table class="table table-striped" id="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Mahasiswa</th>
                                <th>Matkul</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $enrollment)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $enrollment->users->name }}</td>
                                <td>{{ $enrollment->courses->course_name }}</td>
                                <td>
                                    <button class="btn btn-sm btn-primary" type="button"
                                        onclick="showPanel('{{ $enrollment->enrollment_id }}','edit')"><i
                                            class="fas fa-pen"></i></button>
                                    <button class="btn btn-sm btn-danger" type="button"
                                        onclick="deleteData('{{ $enrollment->enrollment_id }}')"><i
                                            class="fas fa-trash"></i></button>
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

<!-- Modal -->
<div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ModalLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="userForm">
                    <div class="form-group">
                        <label for="name">Mahasiswa</label>
                        <select class="form-control" id="mahasiswa" name="mahasiswa">
                            <option value="">-- Pilih Mahasiswa --</option>
                            @foreach ($students as $mhs)
                            <option value="{{ $mhs->user_id }}">{{ $mhs->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name">Matkul</label>
                        <select class="form-control" id="matkul" name="matkul">
                            <option value="">-- Pilih Matkul --</option>
                            @foreach ($courses as $mat)
                            <option value="{{ $mat->course_id }}">{{ $mat->course_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->
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
        $('#mahasiswa').val('').change();
        $('#matkul').val('').change();

        if (type == 'create') {
            $('#ModalLabel').html('Tambah Data');
            $('#Modal').modal('show');
            $('#userForm').attr('action', "{{ route('enrollment.post') }}");
        } else if (type == 'edit') {
            $('#ModalLabel').html('Edit Data');
            $('#Modal').modal('show');
            $('#userForm').attr('action', "{{ route('enrollment.edit.post',['id' => ':id']) }}".replace(':id', id));
            getData(id, function (data) {
                console.log(data);
                $('#ModalLabel').html('Edit Data');
                $('#mahasiswa').val(data.user_id).change();
                $('#matkul').val(data.course_id).change();
            });
        }
    }


    function getData(id, callback) {
        $.ajax({
            url: "{{ route('enrollment.edit').':id' }}".replace(':id', id),
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                callback(data);
            },
            beforeSend: function () {
                $('#ModalLabel').html('Loading...');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                callback(null);
            }
        });
    }

    $('#userForm').submit(function (e) {
        e.preventDefault();

        var data = $(this).serialize();
        var url = $(this).attr('action');
        $.ajax({
            url: url,
            type: "POST",
            data: data,
            success: function (data) {
                swal({
                    title: "Berhasil!",
                    text: "Data berhasil disimpan!",
                    icon: "success",
                    button: "OK",
                }).then((value) => {
                    location.reload();
                });
            },
            error: function (err) {
                swal({
                    title: "Gagal!",
                    text: err.responseJSON.message,
                    icon: "error",
                    button: "OK",
                });
            }
        });
    })

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
                    url: "{{ route('courses.delete',['id' => ':id']) }}".replace(':id', id),
                    type: "GET",
                    success: function (data) {
                        swal({
                            title: "Berhasil!",
                            text: "Data berhasil dihapus!",
                            icon: "success",
                            button: "OK",
                        }).then((value) => {
                            location.reload();
                        });
                    },
                    error: function (err) {
                        swal({
                            title: "Gagal!",
                            text: err.responseJSON.message,
                            icon: "error",
                            button: "OK",
                        });
                    }
                });
            }
        });
    }
</script>
@endsection