<section class="content-header">
    <div>
        <h1 style="padding-left: 10px;"><i class="fa fa-book" style="padding-right: 5px;"></i> Daftar Dokumen </h1>
    </div>

</section>

<!---konten--->
<section class="content">

    <div class="card">
        <div class="card-header">

            <h5 class="card-title">Daftar Dokumen Arsip</h5>

        </div>

        <div class="card-body table-responsive">
            <table class="table  table-bordered table-striped text-center" id="table1">
                <thead style="background-color: #343a40;">
                    <tr>
                        <th style="color: white;">No</th>
                        <th style="color: white;">Nama Dokumen</th>
                        <th style="color: white;">Ukuran File</th>
                        <th style="color: white;">Tanggal</th>
                        <th style="color: white;">Status</th>
                        <?php if ($this->fungsi->user_login()->level == 1) { ?>
                            <th style="color: white;">Hapus</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($row->result() as $key => $data) {
                    ?>
                        <tr>
                            <td><?= $no++; ?>.</td>
                            <td><?= ucfirst($data->file_name_source) ?></td>
                            <td><?= ucfirst($data->file_size) ?> KB</td>
                            <td><?= ucfirst($data->tgl_upload) ?></td>
                            <td><?php if ($data->status == 1) {
                                    echo "<a href='deskripsi' class='btn btn-danger'>TERENKRIPSI</a>";
                                } elseif ($data->status == 2) { ?>
                                    <a href="<?php echo base_url('file_decrypt/' . $data->file_name_source); ?>" target="blank" class='btn btn-primary'>PREVIEW</a>
                                <?php } else {
                                    echo "<span class='btn btn-danger'>Status Tidak Diketahui</span>";
                                }
                                ?></td>
                            <?php if ($this->fungsi->user_login()->level == 1) { ?>
                                <td>
                                    <a href="<?= site_url('daftar/del/' . $data->file_id) ?>" onclick="return confirm('yakin ingin dihapus?')" class="btn btn-danger">
                                        Delete
                                    </a>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            </>
        </div>
    </div>
</section>