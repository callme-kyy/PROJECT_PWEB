<?php

include(__DIR__ . "/config.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="<?= baseUrl("/assets/style.css"); ?>" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>CRUD Mahasiswa</title>
</head>
<body>
    <main class="container-md p-2">
        <?php
        
        /**
         * fetch endpoint `/api/mahasiswa.php` untuk mendapatkan data mahasiswa dalam format json
         */
        $npm = $_GET["npm"];
        $raw = file_get_contents(baseUrl("/api/mahasiswa.php?npm=". $npm));
        $data = json_decode($raw);

        if ($data) {
        ?>
            <form action="<?= baseUrl("/api/mahasiswa.php?npm=". $data->npm); ?>" method="post">
                <div class="row w-100">
                    <div class="col-12 col-md-6 mb-3 p-2">
                        <label for="inputNPM" class="form-label">NPM</label>
                        <input type="text" name="npm" value="<?= $data->npm; ?>" id="inputNPM" class="form-control" disable readonly>
                    </div>
                    <div class="col-12 col-md-6 mb-3 p-2">
                        <label for="inputNama" class="form-label">Nama</label>
                        <input type="text" name="nama" value="<?= $data->nama; ?>" id="inputNama" class="form-control">
                    </div>
                </div>  
                
                <div class="row w-100">
                    <div class="col-12 col-md-6 mb-3 p-2">
                        <label for="inputKelas" class="form-label">Kelas</label>
                        <input type="text" name="kelas" value="<?= $data->kelas; ?>" id="inputKelas" class="form-control">
                    </div>
                    <div class="col-12 col-md-6 mb-3 p-2">
                        <label for="inputJurusan" class="form-label">Jurusan</label>
                        <input type="text" name="jurusan" value="<?= $data->jurusan; ?>" id="inputJurusan" class="form-control">
                    </div>
                </div>

                <div class="mb-3 w-100">
                    <label for="inputNoHP" class="form-label">No.Hp</label>
                    <input type="text" name="nohp" id="inputNoHP" value="<?= $data->nohp; ?>" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary px-4">Update</button>
            </form>
        <?php
        } else {
        ?>
            <p>Error</p>
        <?php
        }
        ?>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>