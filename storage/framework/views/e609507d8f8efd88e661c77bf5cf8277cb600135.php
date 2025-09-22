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
              <table class="table table-bordered table-hover w-100" id="tbl-hasil">
                <thead>
                  <tr>
                    <th class="text-center">Nama</th>
                    <th class="text-center">No. HP</th>
                    <th class="text-center">No. Pekerja</th>
                    <th class="text-center">Lokasi Kerja</th>
                    <th class="text-center">Durasi Test</th>
                    <th class="text-center">Total Skor</th>
                    <th class="text-center">Detail</th>
                  </tr>
                </thead>
                <tbody id="dt-hasil"></tbody>
              </table>
            </div>
            <?php echo $__env->make('components.pagination', ['id' => 'pagination'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="jawaban-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Jawaban Pengunjung</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="rekap-soal"></div>
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

    $.get("<?php echo e(url('hasil/data')); ?>", {
      page: currentPage,
      row_per_page: currentRowPerPage,
      search: currentSearchKeyword,
      type: 'data'
    }).done(res => {
      let html = '';
      (res.data).forEach(data => {
        let durasi = '';
        const startTest = moment(data.start_test);
        const endTest = moment(data.end_test);
        const duration = endTest.diff(startTest, 'seconds');
        const hours = Math.floor(duration / 3600);
        const minutes = Math.floor((duration % 3600) / 60);
        const seconds = duration % 60;

        if (hours > 0) {
          durasi = `${hours} jam ${minutes} menit ${seconds} detik`;
        } else if (hours == 0 && minutes > 0) {
          durasi = `${minutes} menit ${seconds} detik`;
        } else {
          durasi = `${seconds} detik`;
        }

        html += `<tr>
          <td>${data.nama}</td>
          <td>${data.phone}</td>
          <td>${data.no_pekerja}</td>
          <td>${data.lokasi_kerja}</td>
          <td class="text-center">${durasi}</td>
          <td class="text-center">${data.total_poin}</td>
          <td class="text-center">
            <button type="button" class="btn btn-xs btn-warning" onclick="detail(${data.id})"><i class="fas fa-edit"></i></button>
          </td>
        </tr>`;
      });
      initDatatable('#tbl-hasil', '#dt-hasil', html, 400);

      renderPagination(res, '#pagination', 'getData');
    });
  }

  function detail(id) {
    $.get("<?php echo e(url('hasil/data')); ?>", { id: id, type: 'detail' }).done(res => {
      let htmlRekapSoal = '';
      res.forEach(data => {
        const spanAnswer = data.is_benar == 1 ? `<span class="text-success"><i class="fas fa-check"></i></span>` : `<span class="text-danger"><i class="fas fa-times"></i></span>`;
        let answerChoices = '';

        (data.pilihan_jawaban).forEach(pilihan => {
          answerChoices += `<div class="form-check">
            <input type="radio" name="pilihan_${data.id}" class="form-check-input" value="${pilihan.id}" disabled ${pilihan.id == data.id_pilihan_jawaban ? 'checked' : ''}>
            <label for="pilihan_${data.id}" class="form-check-label">${pilihan.pilihan} ${pilihan.benar == 1 ? `<span class="text-success"><i class="fas fa-check"></i></span>` : ''}</label>
          </div>`;
        });

        htmlRekapSoal += `<div class="form-group">
          <h5>${spanAnswer} ${data.soal}</h5>
          <div>${answerChoices}</div>
        </div>`;
      });
      $('#rekap-soal').html(htmlRekapSoal);
      $('#jawaban-modal').modal('toggle');
    });
  }

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

<?php echo $__env->make('template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u543412378/domains/secptmho.online/public_html/resources/views/admin/hasil.blade.php ENDPATH**/ ?>