
    <div class="row-fluid text-center mt-4">
      <h3>Laporan Riwayat Pengembalian</h3>
      <table class="table table-bordered mt-3">
        <thead>
          <tr class="table-dark">
            <td>Kode Transaksi</td>
            <td>Nama</td>
            <td>Kelas</td>
            <td>Judul</td>
            <td>Tgl. Pinjam</td>
            <td>Tgl. Kembali</td>
            <td>Status</td>
            <td>Kondisi</td>
            <td>Sanksi</td>
          </tr>
        </thead>
        <tbody>

            <?php foreach ( $data["riwayatPengembalianBuku"] as $pengembalian ) { ?>

          <tr>
            <td><?php echo $pengembalian["kodeTransaksi"]; ?></td>
            <td><?php echo $pengembalian["nama"]; ?></td>
            <td><?php echo $pengembalian["kelas"]; ?></td>
            <td><?php echo $pengembalian["judul"]; ?></td>
            <td><?php echo $pengembalian["tanggalPeminjaman"]; ?></td>
            <td><?php echo $pengembalian["tanggalPengembalian"]; ?></td>
            <td><?php echo $pengembalian["status"]; ?></td>
            <td><?php echo $pengembalian["kondisiBuku"]; ?></td>
            <td><?php echo $pengembalian["sanksi"]; ?></td>
          </tr>

            <?php } ?>

        </tbody>
      </table>
    </div>

  </div> 
