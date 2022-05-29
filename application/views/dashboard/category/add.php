<main class="col-md-12" style="padding:5px 10px 10px 10px">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h5>Add Category</h5>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<form id="formAddCategory">
								<div class="mb-3 row">
									<label for="NamaProduk" class="col-sm-5 col-form-label">Nama Category</label>
									<div class="col-sm-10">
										<input type="text" class="form-control form-control-sm" id="nama_category"
											name="nama_category" />
									</div>
								</div>
								<div class="mb-3 row">
									<label for="DeskripsiProduk" class="col-sm-5 col-form-label">Deskripsi
									</label>
									<div class="col-sm-10">
										<input type="text" class="form-control form-control-sm" id="deskripsi_category"
											name="deskripsi_category" />
									</div>
								</div>
								<div class="mb-3 row">
									<div class="col-sm-10">
										<button type="submit" href="#" class="btn btn-primary" id="btnAddCategory"
											name="btnAddCategory">Add
											Category</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
</main>
<script>
	$(document).ready(function () {
		$('#formAddCategory').submit(function (e) {
			e.preventDefault()
			$.ajax({
				url: "<?php echo base_url()?>api/product/add_category",
				type: "POST",
				data: new FormData(this),
				processData: false,
				contentType: false,
				cache: false,
				async: false,
				success: function (data) {
					console.log(data)
					data = JSON.parse(data)
					if (data.code == 200) {
						swal({
							title: "Success",
							text: data.message,
							icon: "success",
							buttons: {
								catch: {
									text: "Ya",
									value: "catch",
								},
							},
						}).then(function () {
							window.location =
								'<?php echo base_url()?>dashboard/category'
						})
					} else if (data.code == 400) {
						swal({
							title: "ERROR",
							text: data.message,
							icon: "error",
							buttons: {
								catch: {
									text: "Ya",
									value: "catch",
								},
							},
						})
					}

				}

			})
		})
	});

</script>
