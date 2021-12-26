<?php load_templates('layouts/top') ?>
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Panel Peminjaman</h2>
                        <h5 class="text-white op-7 mb-2">Panel Pendataan Peminjaman Buku</h5>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                        <a href="index.php?r=book-takes/index" class="btn btn-warning btn-round">Kembali</a>
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
                            <!-- <form action="" method="post" onsubmit="submitForm(this); return false;"> -->
                            <div class="form-group">
                                <label for="">Barcode Pengunjung</label>
                                <input type="text" name="book_takes[visitor_id]" id="barcode" class="form-control" onkeyup="getVisitor(event)">
                            </div>
                            <div class="form-group">
                                <label for="">Barcode Buku</label>
                                <input type="text" name="book_takes[book_id]" id="book_barcode" class="form-control" onkeyup="getBook(event)">
                                <!-- <img src="" id="book_image" alt="" width="150px"> -->
                            </div>
                            <!-- </form> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    var barcode = document.querySelector('#barcode')
    var book_barcode = document.querySelector('#book_barcode')
    barcode.focus()
    var visitor = {}
    async function getVisitor(ev)
    {
        if(ev.key.toLowerCase() == 'enter')
        {
            var request = await fetch('https://api.stikes-assyifa.ac.id/site/get-civity?barcode='+barcode.value)
            var response = await request.json()
            if(response.data)
            {
                visitor = response
                var success = document.querySelector('.alert-success')
                success.classList.remove('d-none')
                success.innerHTML = 'Pengunjung : '+response.data.nama
                var audio = new Audio('sounds/success.wav');
                audio.play();
                book_barcode.focus()
                setTimeout(e => {
                    success.classList.add('d-none')
                },5000)
            }
            else
            {
                var success = document.querySelector('.alert-danger')
                success.classList.remove('d-none')
                success.innerHTML = 'Data '+barcode.value+' Tidak ditemukan'
                var audio = new Audio('sounds/error.wav');
                audio.play();
                setTimeout(e => {
                    success.classList.add('d-none')
                },5000)
            }
        }
    }
    async function getBook(ev)
    {
        if(ev.key.toLowerCase() == 'enter')
        {
            var request = await fetch('index.php?r=api/get-book&barcode='+book_barcode.value)
            var response = await request.json()
            if(response)
            {
                var success = document.querySelector('.alert-success')
                success.classList.remove('d-none')
                success.innerHTML = 'Buku : '+response.title
                // document.querySelector('#book_image').src = response.pic
                var audio = new Audio('sounds/success.wav');
                audio.play();

                var formData = new FormData()
                formData.append('book_takes[book_id]',response.id)
                formData.append('book_takes[visitor_id]',barcode.value)
                formData.append('book_takes[visitor_name]',visitor.data.nama)
                formData.append('book_takes[visitor_role]',visitor.role)
                fetch('index.php?r=book-takes/create',{
                    method:'POST',
                    body:formData
                }).then(e => {
                    alert('Peminjaman Berhasil di simpan')
                    book_barcode.value = ''
                    success.classList.add('d-none')
                })
            }
            else
            {
                var success = document.querySelector('.alert-danger')
                success.classList.remove('d-none')
                success.innerHTML = 'Data '+book_barcode.value+' Tidak ditemukan'
                var audio = new Audio('sounds/error.wav');
                audio.play();
                setTimeout(e => {
                    success.classList.add('d-none')
                },5000)
            }
        }
    }
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