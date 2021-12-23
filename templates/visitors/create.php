<?php load_templates('layouts/top') ?>
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Panel Pengunjung</h2>
                        <h5 class="text-white op-7 mb-2">Panel Pendataan Pengunjung</h5>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                        <a href="index.php?r=visitors/index" class="btn btn-warning btn-round">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <div class="row row-card-no-pd">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-success d-none"></div>
                            <div class="alert alert-danger d-none"></div>
                            <form action="" method="post" onsubmit="submitForm(this); return false;">
                                <div class="form-group">
                                    <label for="">Barcode</label>
                                    <input type="text" name="visitors[barcode]" id="barcode" class="form-control" required>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    var barcode = document.querySelector('#barcode')
    barcode.focus()
    async function submitForm(frm)
    {
        var request = await fetch('https://api.stikes-assyifa.ac.id/site/get-civity?barcode='+barcode.value)
        var response = await request.json()
        if(response.data)
        {
            var formData = new FormData()
            formData.append('visitors[visitor_id]',barcode.value)
            formData.append('visitors[name]',response.data.nama)
            formData.append('visitors[visitor_role]',response.role)

            var success = document.querySelector('.alert-success')
            success.classList.remove('d-none')
            success.innerHTML = 'Selamat Datang '+response.data.nama

            var audio = new Audio('sounds/success.wav');
            audio.play();

            fetch('index.php?r=visitors/create',{
                method:'POST',
                body:formData
            })

            setTimeout(e => {
                success.classList.add('d-none')
            },5000)
        }
        else
        {
            // alert('Maaf! Data tidak ditemukan')
            var success = document.querySelector('.alert-danger')
            success.classList.remove('d-none')
            success.innerHTML = 'Data '+barcode.value+' Tidak ditemukan'
            var audio = new Audio('sounds/error.wav');
            audio.play();
            setTimeout(e => {
                success.classList.add('d-none')
            },5000)
        }
        barcode.value = ""
        barcode.focus()
    }
    </script>
<?php load_templates('layouts/bottom') ?>