
    <div class="row-fluid text-center mt-4">
      <h3>Laporan Riwayat Peminjaman</h3>
      <table class="table table-bordered mt-3">
        <thead>
          <tr class="table-dark">
            <td>Kode Transaksi</td>
            <td>Nama</td>
            <td>Judul Buku</td>
            <td>Tanggal Peminjaman</td>
            <td>Dikembalikan Sebelum Tanggal</td>
          </tr>
        </thead>
        <tbody>

            <?php foreach ( $data["riwayatPeminjaman"] as $riwayatPeminjaman ) { ?>

          <tr>
            <td><?php echo $riwayatPeminjaman["kodeTransaksi"]; ?></td>
            <td><?php echo $riwayatPeminjaman["nama"]; ?></td>
            <td><?php echo $riwayatPeminjaman["judul"]; ?></td>
            <td><?php echo $riwayatPeminjaman["tanggalPeminjaman"]; ?></td>
            <td><?php echo $riwayatPeminjaman["tanggalPengembalian"]; ?></td>
          </tr>

            <?php } ?>

        </tbody>
      </table>
    </div>

  </div> 

