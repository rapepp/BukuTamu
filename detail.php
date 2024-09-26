<?php

require 'function.php';


if (isset($_POST['dataTamu'])) {
    $output = '';

    $sql = "SELECT * FROM tamu WHERE nama = '" . $_POST['dataTamu'] . "'";
    $result = mysqli_query($koneksi, $sql);

    $output .= '<div class="table-responsive">
                        <table class="table table-bordered">';
    foreach ($result as $row) {
        $output .= '<tr align="center">
                            <td colspan="2"><img src="img/' . $row['gambar'] . '" width="50%"></td>
                        </tr>
                        <tr>
                            <th width="40%">Nama</th>
                            <td width="60%">' . $row['nama'] . '</td>
                        </tr>
                        <tr>
                            <th width="40%">Tanggal Temu</th>
                            <td width="60%">' . date("d M Y", strtotime($row['tgl_Temu'])) . '</td>
                        </tr>
                        <tr>
                            <th width="40%">Kepentingan</th>
                            <td width="60%">' . $row['kepentingan'] . '</td>
                        </tr>
                         <tr>
                            <th width="40%">No. HandPhone</th>
                            <td width="60%">' . $row['telp'] . '</td>
                        </tr>
                           <tr>
                            <th width="40%">Keperluan</th>
                            <td width="60%">' . $row['keperluan'] . '</td>
                        </tr>
                        ';
    }
    $output .= '</table></div>';

    echo $output;
}
