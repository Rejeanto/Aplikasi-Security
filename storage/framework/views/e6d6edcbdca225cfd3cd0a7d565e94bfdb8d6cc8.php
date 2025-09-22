<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <form id="f-soal">
          <?php echo csrf_field(); ?>
          <div class="table-responsive-md">
            <table class="table table-bordered table-striped w-100" id="tbl-soal">
              <thead>
                <tr>
                  <th class="text-center">Soal</th>
                  <th class="text-center">Pilihan 1</th>
                  <th class="text-center">Pilihan 2</th>
                  <th class="text-center">Pilihan 3</th>
                </tr>
              </thead>
              <tbody id="dt-soal"></tbody>
            </table>
          </div>
          <button class="btn btn-primary float-right" type="button" id="btn-simpan"><i class="fas fa-save"></i> Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  function getData() {
    $.get("<?php echo e(url('soal/data')); ?>").done(res => {
      let html = '';

      res.forEach(data => {
        let pilihanJawaban = '';
        (data.pilihan_jawaban).forEach((pil, i) => {
          pilihanJawaban += `<td>
            <div class="form-check">
              <input type="radio" class="form-check-input mt-2" name="benar_${data.id}" value="${pil.id}" ${pil.benar == 1 ? 'checked' : ''}>
              <input type="text" class="form-control" name="pilihan_${pil.id}" id="pilihan_${pil.id}" value="${pil.pilihan}">
              <span class="invalid-feedback" id="pilihan_${data.id}.${i}-error">Test feedback</span>
            </div>
          </td>`;
        });

        html += `<tr>
          <td>
            <input type="text" class="form-control" name="soal_${data.id}" id="soal_${data.id}" value="${data.soal}">
            <span class="invalid-feedback" id="soal_${data.id}-error"></span>
          </td>
          ${pilihanJawaban}
        </tr>`;
      });

      $('#dt-soal').html(html);
    });
  }

  $('#btn-simpan').click(function() {
    Swal.fire({
      type: "warning",
      title: "Simpan Data?",
      showCancelButton: true,
      confirmButtonText: "Ya",
      cancelButtonText: "Tidak",
    }).then((res) => {
      if (res.value) {
        var id = $('#id').val();
        var formData = $('#f-soal').serialize();
        $.put(`<?php echo e(url('soal')); ?>/1`, formData).done(res => {
          swal(res.success ? 'success' : 'error', res.msg);
          if (res.success) getData();
        }).fail(res => {
          setErrorValidation(res);
        });
      }
    });
  });

  $(document).ready(function() {
    getData();
  });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u543412378/domains/secptmho.online/public_html/resources/views/admin/soal.blade.php ENDPATH**/ ?>