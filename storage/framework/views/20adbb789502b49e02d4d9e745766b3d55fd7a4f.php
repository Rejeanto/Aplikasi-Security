<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-md-9">
            <?php echo $__env->make('components/search', ['id' => 'search', 'class' => 'filter'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          </div>
          <div class="col-md-2">
            <?php echo $__env->make('components/row_per_page', ['id' => 'row_per_page', 'class' => 'filter'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          </div>
          <div class="col-md-1">
            <?php echo $__env->make('components/reload', ['id' => 'btn-reload'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          </div>
        </div>
        <div class="row mt-2">
          <div class="col-md-12">
            <div class="table-responsive-md">
              <table class="table table-bordered text-xs w-100" id="tbl-lokasi">
                <thead>
                  <tr>
                    <th class="text-center">Lokasi Kerja</th>
                    <th class="text-center">
                      <button type="button" class="btn btn-xs btn-primary" id="btn-add"><i class="fas fa-plus"></i></button>
                    </th>
                  </tr>
                </thead>
                <tbody id="dt-lokasi"></tbody>
              </table>
            </div>
            <?php echo $__env->make('components.pagination', ['id' => 'pagination'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="lokasi-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Data Lokasi Kerja</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="f-lokasi">
          <?php echo csrf_field(); ?>
          <input type="hidden" name="id" id="id">
          <div class="form-group">
            <input type="text" name="lokasi_kerja" id="lokasi_kerja" class="form-control" placeholder="Masukkan Lokasi Kerja. Contoh : PT. XYZ.">
            <span class="invalid-feedback" id="lokasi_kerja-error"></span>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btn-save">Simpan Data</button>
      </div>
    </div>
  </div>
</div>
<script>
  let currentPage = 1;
  let currentRowPerPage = 10;
  let currentSearchKeyword = '';

  function getData(page = 1) {
    currentPage = page;
    currentRowPerPage = $('#row_per_page').val();
    currentSearchKeyword = $('#search').val();

    $.get("<?php echo e(url('lokasi_kerja/data')); ?>", {
      page: currentPage,
      row_per_page: currentRowPerPage,
      search: currentSearchKeyword
    }).done(res => {
      let html = '';
      (res.data).forEach(data => {
        html += `<tr>
          <td>${data.lokasi_kerja}</td>
          <td class="text-center">
            <button type="button" class="btn btn-xs btn-warning" onclick="editData(${data.id})"><i class="fas fa-edit"></i></button>
            <button type="button" class="btn btn-xs btn-danger" onclick="deleteData(${data.id})"><i class="fas fa-trash-alt"></i></button>
          </td>
        </tr>`;
      });
      initDatatable('#tbl-lokasi', '#dt-lokasi', html, 400);

      renderPagination(res, '#pagination', 'getData');
    });
  }

  function resetForm() {
    resetValidation();
    $('#id').val('');
    $('#lokasi_kerja').val('');
  }

  function editData(id) {
    resetValidation();
    $('#id').val(id);
    $.get(`<?php echo e(url('lokasi_kerja')); ?>/${id}`).done(res => {
      $('#lokasi_kerja').val(res.lokasi_kerja);
      $('#lokasi-modal').modal('toggle');
    });
  }

  function deleteData(id) {
    Swal.fire({
      type: "warning",
      title: "Apakah Anda yakin?",
      text: "Anda tidak akan dapat mengembalikan data Anda!",
      showCancelButton: true,
      confirmButtonText: "Ya",
      cancelButtonText: "Tidak",
    }).then((res) => {
      if (res.value) {
        $.delete(`<?php echo e(url('lokasi_kerja')); ?>/${id}`).done(res => {
          swal(res.success ? 'success' : 'error', res.msg);
          if (res.success) getData();
        });
      }
    });
  }

  $('#btn-add').click(function() {
    resetForm();
    $('#lokasi-modal').modal('toggle');
  });

  $('#btn-save').click(function() {
    Swal.fire({
      type: "warning",
      title: "Simpan Data?",
      showCancelButton: true,
      confirmButtonText: "Ya",
      cancelButtonText: "Tidak",
    }).then((res) => {
      if (res.value) {
        const id = $('#id').val();
        const data = $('#f-lokasi').serialize();
        const promise = id == '' ? $.post("<?php echo e(url('lokasi_kerja')); ?>", data) : $.put(`<?php echo e(url('lokasi_kerja')); ?>/${id}`, data);
        promise.done(res => {
          swal(res.success ? 'success' : 'error', res.msg);
          if (res.success) {
            $('#lokasi-modal').modal('toggle');
            getData();
          }
        });
      }
    });
  });

  $('.filter').change(function() {
    getData();
  });

  $('#btn-reload').click(function() {
    getData();
  });

  $(document).ready(function() {
    getData();
  });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u543412378/domains/secptmho.online/public_html/resources/views/admin/lokasi.blade.php ENDPATH**/ ?>