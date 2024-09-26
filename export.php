<?php

require 'function.php';

$tamu = query("SELECT * FROM tamu ORDER BY nama DESC");


$filename = "data tamu-" . date('Ymd') . ".xls";


header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Tamu.xls");

?>
<table class="text-center" border="1">
    <thead class="text-center">
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Tanggal Temu</th>
            <th>Kepentingan</th>
            <th>No. HandPhone</th>
            <th>Keperluan</th>
        </tr>
    </thead>
    <tbody class="text-center">
        <?php $no = 1; ?>
        <?php foreach ($tamu as $row) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['nama']; ?></td>
                <td><?= $row['tgl_Temu']; ?></td>
                <?php
                $now = time();
                $timeTahun = strtotime($row['tgl_Temu']);
                $setahun = 31536000;
                $hitung = ($now - $timeTahun) / $setahun;
                ?>
                <td><?= $row['kepentingan']; ?></td>
                <td><?= $row['telp']; ?></td>
                <td><?= $row['keperluan']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>