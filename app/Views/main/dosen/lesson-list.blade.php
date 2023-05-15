@extends('main.master.main')

@section('page-heading')
List Materi
@endsection

@section('page-content')
<section class="row">
   <div class="col-12">
      <button class="btn btn-sm btn-primary mb-3" type="button" onclick="showPanel('','create')"><i class="fas fa-plus"></i> Materi</button>
      <div class="row">
         @foreach ($lessons as $val)
         <div class="col-6 col-lg-3 col-md-6">
            <a href="">
               <div class="card">
                  <div class="card-body px-4 py-4-5">
                     <div class="row">
                        <div class="col-md-3 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                           <div class="stats-icon purple mb-2">
                              <img src="https://ui-avatars.com/api/?name={{ $val->lesson_name }}&color=ffffff&background=9694ff" alt="avatar" class="img-fluid rounded shadow-sm" />
                           </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                           <h5 class="text-muted mb-1">{{ $val->lesson_name }} </h5>
                           <p class="mb-0 text-sm"><small>{{ $val->content }}</small></p>
                           <button class="btn btn-sm btn-primary" type="button" onclick="showPanel('{{ $val->id }}','edit')"><i class="fas fa-pen"></i></button>
                           <button class="btn btn-sm btn-danger" type="button" onclick="deleteData('{{ $val->id }}')"><i class="fas fa-trash"></i></button>
                        </div>
                     </div>
                  </div>
               </div>
            </a>
         </div>
         @endforeach
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
               <div class="mb-3">
                  <label for="judul" class="form-label">Judul Materi</label>
                  <input type="text" class="form-control" id="judul" name="judul" required>
               </div>
               <div class="mb-3">
                  <label for="content" class="form-label">content</label>
                  <textarea class="form-control" id="content" name="content" required cols="30" rows="6"></textarea>
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
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous">
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
   function showPanel(id, type) {
      $('#judul').val();
      $('#content').val('');

      if (type == 'create') {
         $('#ModalLabel').html('Tambah Data');
         $('#Modal').modal('show');
         $('#userForm').attr('action', "{{ route('list-course.lesson.post',['id' => $id_course]) }}");
      } else if (type == 'edit') {
         $('#ModalLabel').html('Edit Data');
         $('#Modal').modal('show');
         $('#userForm').attr('action', "{{ route('list-course.lesson.post',['id' => $id_course]) }}");
         getData(id, function(data) {
            console.log(data);
            $('#ModalLabel').html('Edit Data');
            $('#name').val(data.course_name);
            $('#description').val(data.description);
            $('#dosen').val(data.instructor_id).change();
         });
      }
   }


   function getData(id, callback) {
      $.ajax({
         url: "{{ route('courses.edit').':id' }}".replace(':id', id),
         type: "GET",
         dataType: "JSON",
         success: function(data) {
            callback(data);
         },
         beforeSend: function() {
            $('#ModalLabel').html('Loading...');
         },
         error: function(jqXHR, textStatus, errorThrown) {
            callback(null);
         }
      });
   }

   $('#userForm').submit(function(e) {
      e.preventDefault();

      var data = $(this).serialize();
      var url = $(this).attr('action');
      $.ajax({
         url: url,
         type: "POST",
         data: data,
         success: function(data) {
            swal({
               title: "Berhasil!",
               text: "Data berhasil disimpan!",
               icon: "success",
               button: "OK",
            }).then((value) => {
               location.reload();
            });
         },
         error: function(err) {
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
               success: function(data) {
                  swal({
                     title: "Berhasil!",
                     text: "Data berhasil dihapus!",
                     icon: "success",
                     button: "OK",
                  }).then((value) => {
                     location.reload();
                  });
               },
               error: function(err) {
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