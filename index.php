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
        <div class="px-4 py-4 my-5 text-center">
            <h1>CRUD Mahasiswa</h1>

            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <a href="<?= baseUrl("/tambah.php"); ?>" class="btn btn-primary px-4">Tambah Data</a>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">NO</th>
                    <th scope="col">NPM</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Jurusan</th>
                    <th scope="col">No.Hp</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    /**
                     * fetch endpoint `/api/mahasiswa.php` untuk mendapatkan data mahasiswa dalam format json
                     */
                    $raw = file_get_contents(baseUrl("/api/mahasiswa.php"));
                    $data = json_decode($raw);

                    $nomor = 1;

                    foreach ($data as $row) {
                        echo "
                            <tr>
                                <th scope='row'>". $nomor ."</th>
                                <td>". $row->npm ."</td>
                                <td>". $row->nama ."</td>
                                <td>". $row->kelas ."</td>
                                <td>". $row->jurusan ."</td>
                                <td>". $row->nohp ."</td>
                                <td>
                                    <a href='".baseUrl("/edit.php?npm=". $row->npm)."'>edit</button>
                                    <button type='button' onclick='hapusData(`". $row->npm ."`)'>hapus</button>
                                </td>
                            </tr>
                        ";

                        $nomor += 1;
                    }
                ?>
                
            </tbody>
        </table>
    </main>

    <script type="text/javascript">
        async function hapusData(npm) {
            await fetch(`<?= baseUrl("/api/mahasiswa.php"); ?>?npm=${npm}`, {
                method: "DELETE"
            }).then(() => {
                window.location.reload();
            });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>