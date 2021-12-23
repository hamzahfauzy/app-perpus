<?php load_templates('layouts/top') ?>
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Edit Buku : <?=$data->title?></h2>
                        <h5 class="text-white op-7 mb-2">Memanajemen data buku</h5>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                        <a href="index.php?r=books/index" class="btn btn-warning btn-round">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <div class="row row-card-no-pd">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="">Kode</label>
                                    <input type="text" name="books[barcode]" class="form-control" value="<?=$data->barcode?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" name="books[title]" class="form-control" value="<?=$data->title?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Deskripsi Singkat</label>
                                    <input type="text" name="books[description]" class="form-control" value="<?=$data->description?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Deskripsi Singkat</label>
                                    <input type="text" name="books[description]" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Penulis</label>
                                    <input type="text" name="books[author]" class="form-control" required value="<?=$data->author?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Penerbit</label>
                                    <input type="text" name="books[publisher]" class="form-control" required value="<?=$data->publisher?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Tahun Terbit</label>
                                    <input type="number" name="books[publish_year]" class="form-control" required  value="<?=$data->publish_year?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Stok / Jumlah</label>
                                    <input type="number" min="0" name="books[amount]" class="form-control" required  value="<?=$data->amount?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Kategori</label>
                                    <select name="books[category_id]" class="form-control" id="" required>
                                        <option value="">- Pilih -</option>
                                        <?php foreach($categories as $category): ?>
                                        <option value="<?=$category->id?>" <?=$category->id==$data->category_id?'selected=""':''?>><?=$category->name?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Gambar</label>
                                    <input type="file" name="books[pic]" class="form-control">
                                    <img src="<?=$data->pic?>" alt="" width="300px" style="object-fit:cover">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php load_templates('layouts/bottom') ?>