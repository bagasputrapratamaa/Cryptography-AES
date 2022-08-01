<section class="content-header">
	<div class="container-fluid">
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-lg-4 col-6">
				<!-- small box -->
				<div class="small-box bg-info">
					<div class="inner">
						<h3><?= $this->db->query('SELECT * FROM users')->num_rows(); ?></h3>
						<b>
							<p>Total Pengguna</p>
						</b>
					</div>
					<div class="icon">
						<i class="fa fa-users"></i>
					</div>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-4 col-6">
				<!-- small box -->
				<div class="small-box bg-danger">
					<div class="inner">


						<h3><?= $this->db->query('SELECT * FROM file WHERE status = 1')->num_rows(); ?></h3>
						<b>

							<p>Total Enkripsi</p>
						</b>
					</div>
					<div class="icon">
						<i class="fa fa-lock"></i>
					</div>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-4 col-6">
				<!-- small box -->
				<div class="small-box bg-success">
					<div class="inner">
						<h3 style="color: white;"><?= $this->db->query('SELECT * FROM file WHERE status = 2')->num_rows(); ?></h3>
						<b>
							<p style="color: white;">Total Deskripsi</p>
						</b>
					</div>
					<div class="icon">
						<i class="fa fa-unlock"></i>
					</div>
				</div>
			</div>
</section>