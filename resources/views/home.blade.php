<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Security Head Office</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="Admin Dashboard" name="description" />
    <meta content="ThemeDesign" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">
    <!--Morris Chart CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/morris/morris.css') }}"> --}}
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/styleh.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css">
    <!-- jQuery  -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
    <script src="{{ asset('assets/js/detect.js') }}"></script>
    <script src="{{ asset('assets/js/fastclick.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.blockUI.js') }}"></script>
    <script src="{{ asset('assets/js/waves.js') }}"></script>
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.nicescroll.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.scrollTo.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
    <style>
      .dropdown-item.active,
      .dropdown-item:active
      {
        background: #007bff !important;
      }
    </style>
  </head>
  <body>
    <div class="header-bg">
      <!-- Navigation Bar-->
      <header id="topnav" style="background-color: #3d3343;">
        <div class="topbar-main">
          <div class="container-fluid">
            <!-- Logo-->
            <div>
              <a href="{{ url('/') }}" class="logo">
                <h5 class="text-white mt-4">Security Head Office</h5>
              </a>
            </div>
            <!-- End Logo-->
            <div class="float-right">
              <img src="{{ asset('assets/images/pertamina-logo.png') }}" class="logo-lg" alt="" height="52">
              <img src="{{ asset('assets/images/pertamina-logo.png') }}" class="logo-sm" alt="" height="56">
            </div>
          </div>
          <!-- end container -->
        </div>
        <!-- end topbar-main -->
      </header>
      <!-- End Navigation Bar-->
    </div>
    <!-- header-bg -->
    <div class="wrapper"  style="margin-top: 90px;">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12 col-md-12" id="col-daftar">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title text-dark">Masukkan Identitas Kamu</h4>
              </div>
              <div class="card-body">
                <form id="f-daftar">
                  @csrf
                  <div class="form-group row">
                    <label for="nama" class="col-12 col-md-2 col-form-label">Nama <span class="text-danger">*</span></label>
                    <div class="col-12 col-md-10">
                      <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama Kamu">
                      <span class="invalid-feedback" id="nama-error"></span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="email" class="col-12 col-md-2 col-form-label">Email <span class="text-danger">*</span></label>
                    <div class="col-12 col-md-10">
                      <input type="text" name="email" id="email" class="form-control" placeholder="Masukkan Nomor HP Kamu">
                      <span class="invalid-feedback" id="email-error"></span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="phone" class="col-12 col-md-2 col-form-label">Nomor HP <span class="text-danger">*</span></label>
                    <div class="col-12 col-md-10">
                      <input type="text" name="phone" id="phone" class="form-control" placeholder="Masukkan Nomor HP Kamu" maxlength="15">
                      <span class="invalid-feedback" id="phone-error"></span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="no_pekerja" class="col-12 col-md-2 col-form-label">Nomor Pekerja <span class="text-danger">*</span></label>
                    <div class="col-12 col-md-10">
                      <input type="text" name="no_pekerja" id="no_pekerja" class="form-control" placeholder="Masukkan Nomor Pekerja Kamu">
                      <span class="invalid-feedback" id="no_pekerja-error"></span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="lokasi_kerja" class="col-12 col-md-2 col-form-label">Lokasi Kerja <span class="text-danger">*</span></label>
                    <div class="col-12 col-md-10">
                      <select name="lokasi_kerja" id="lokasi_kerja" class="form-control selectpicker" data-live-search="true">
                        <option value="">Pilih Lokasi Kerja</option>
                        @foreach ($lokasi as $item)
                        <option value="{{ $item->id }}">{{ $item->lokasi_kerja }}</option>
                        @endforeach
                      </select>
                      <span class="invalid-feedback" id="lokasi_kerja-error"></span>
                    </div>
                  </div>
                </form>
              </div>
              <div class="card-footer">
                <button type="button" class="btn btn-primary float-right" id="btn-daftar">Simpan</button>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-12" id="col-video">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title text-dark">Tonton Video</h4>
              </div>
              <div class="card-body">
                <video class="w-100" id="training-video" controls>
                  <source src="{{ asset('videos/video_training.mp4') }}" type="video/mp4" autoplay>
                  Browser kamu tidak mendukung video.
                </video>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-12" id="col-posttest">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title text-dark">Post-Test</h4>
              </div>
              <div class="card-body">
                <em>Pilihlah jawaban yang paling tepat.</em>
                <form id="f-posttest" class="mt-4">
                  @csrf
                  <input type="hidden" name="id_pengunjung" id="id_pengunjung">
                  @foreach ($soal as $i => $s)
                  <div class="form-group">
                    <input type="hidden" name="id_soal[]" value="{{ $s['id'] }}">
                    <h5>Soal {{ $i + 1 }}</h5>
                    <label class="form-label">{{ $s['soal'] }}</label>
                    <div>
                    @foreach ($s['pilihan'] as $pil)
                    <div class="form-check">
                      <input type="radio" name="pilihan_{{ $s['id'] }}" class="form-check-input" value="{{ $pil['id'] }}">
                      <label for="pilihan_{{ $s['id'] }}" class="form-check-label">{{ $pil['pilihan'] }}</label>
                    </div>
                    @endforeach
                    </div>
                  </div>
                  @endforeach
                </form>
              </div>
              <div class="card-footer">
                <button type="button" class="btn btn-primary float-right" id="btn-submit">Kumpulkan</button>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-12" id="col-testresult">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title text-dark">Hasil Post Test</h4>
              </div>
              <div class="card-body">
                <h4>Skor Anda adalah : <span id="skor"></span></h4>
                <div id="rekap-soal"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end wrapper -->

    <!-- Footer -->
    <footer class="footer">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            © {{ date('Y') }} Security Head Office</span>
          </div>
        </div>
      </div>
    </footer>
    <script>
      const urlScript = 'https://script.google.com/macros/s/AKfycbyrWGHHAxLy-falxQDY_QPNWGs9V3z0cPJjMDQeHcx3prKVfXGBbYR-5HPJ-TgqqBrGYg/exec';

      $('#btn-daftar').click(function() {
        $.post("{{ url('daftar') }}", $('#f-daftar').serialize()).done(res => {
          if (res.success) {
            $('#id_pengunjung').val(res.pengunjung_id);
            $('#col-daftar').hide();
            $('#col-video').show();

            const video = document.getElementById('training-video');
            // Remove controls and force autoplay again
            // video.controls = false;
            video.currentTime = 0;
            video.play();

            // Prevent pausing/stopping
            video.addEventListener('pause', function () {
              if (!video.ended) video.play();
            });

            // Step 2: After video ends, move to post-test
            video.addEventListener('ended', function () {
              $.put(`{{ url('start_test') }}/${$('#id_pengunjung').val()}`, {
                _token: "{{ csrf_token() }}"
              }).done(res => {
                $('#col-video').hide();
                $('#col-posttest').show();
              });
            });
          }
        }).fail(res => {
          if (res.status == 422) setErrorValidation(res);
        });
      });

      $('#btn-submit').click(function() {
        Swal.fire({
          type: "warning",
          title: "Yakin ingin menyelesaikan test?",
          text: 'Anda tidak akan dapat mengedit jawaban yang sudah dikumpulkan',
          showCancelButton: true,
          confirmButtonText: "Ya",
          cancelButtonText: "Tidak",
        }).then((res) => {
          if (res.value) {
            $.put(`{{ url('submit_test') }}/${$('#id_pengunjung').val()}`, $('#f-posttest').serialize()).done(res => {
              let totalSkor = 0;
              let htmlRekapSoal = '';
              (res.data.jawaban).forEach((data, i) => {
                const spanAnswer = data.is_benar == 1 ? `<span class="text-success"><i class="fas fa-check"></i></span>` : `<span class="text-danger"><i class="fas fa-times"></i></span>`;
                let answerChoices = '';

                (data.pilihan_jawaban).forEach(pilihan => {
                  answerChoices += `<div class="form-check">
                    <input type="radio" name="pilihan_${data.id}" class="form-check-input" value="${pilihan.id}" disabled ${pilihan.id == data.id_pilihan_jawaban ? 'checked' : ''}>
                    <label for="pilihan_${data.id}" class="form-check-label">${pilihan.pilihan} ${pilihan.benar == 1 ? `<span class="text-success"><i class="fas fa-check"></i></span>` : ''}</label>
                  </div>`;
                });

                htmlRekapSoal += `<div class="form-group">
                  <h5>Soal ${i + 1} ${spanAnswer}</h5>
                  <label class="form-label">${data.soal}</label>
                  <div>${answerChoices}</div>
                </div>`;

                totalSkor += parseInt(data.poin);
              });
              $('#rekap-soal').html(htmlRekapSoal);
              $('#skor').html(totalSkor);

              $('#col-posttest').hide();
              $('#col-testresult').show();

              $.post(urlScript, {
                'Nama': res.data.nama,
                'Email': res.data.email,
                'No. HP': res.data.phone,
                'Nomor Pekerja': res.data.no_pekerja,
                'Lokasi Kerja': res.data.lokasi.lokasi_kerja,
                'Total Skor': totalSkor,
                'Waktu Mulai': res.data.start_test,
                'Waktu Selesai': res.data.end_test
              });
            });
          }
        });
      });

      $(document).ready(function() {
        $('#col-daftar').show();
        $('#col-video').hide();
        $('#col-posttest').hide();
        $('#col-testresult').hide();
        $('#video-training').prop('controls', false);

        $('.selectpicker').selectpicker();
      });
    </script>
    <!-- End Footer -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('scripts/secptmho.js') }}"></script>
  </body>

</html>
