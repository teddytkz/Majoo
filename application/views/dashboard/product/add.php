<main class="col-md-12" style="padding:5px 10px 10px 10px">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h5>Add Product</h5>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<form id="formAddProduct">
								<div class="mb-3 row">
									<label for="NamaProduk" class="col-sm-5 col-form-label">Nama Produk</label>
									<div class="col-sm-10">
										<input type="text" class="form-control form-control-sm" id="nama_produk"
											name="nama_produk" />
									</div>
								</div>
								<div class="mb-3 row">
									<label for="DeskripsiProduk" class="col-sm-5 col-form-label">Deskripsi
										Produk</label>
									<div class="col-sm-10">
										<input type="text" class="form-control form-control-sm" id="deskripsi_produk"
											name="deskripsi_produk" />
									</div>
								</div>
								<div class="mb-3 row">
									<label for="Harga" class="col-sm-5 col-form-label">Harga</label>
									<div class="col-sm-10">
										<input type="text" class="form-control form-control-sm" id="harga_produk"
											name="harga_produk" />
									</div>
								</div>
								<div class="mb-3 row">
									<label for="KategoriProduk" class="col-sm-5 col-form-label">Kategori Produk</label>
									<div class="col-sm-10">
										<select class="form-control" name="kategori_produk" id="kategori_produk">

										</select>
									</div>
								</div>
								<div class="mb-3 row">
									<label for="Image Produk" class="col-sm-5 col-form-label">Image Produk</label>
									<div class="col-sm-10">
										<input type="file" class="form-control form-control-sm" id="image_produk"
											name="image_produk" />
									</div>
								</div>

								<progress id="progressBar" value="0" max="100"
									style="width:100%; display: none; margin:2px"></progress>

								<div class="mb-3 row">
									<div class="col-sm-10">
										<button type="submit" href="#" class="btn btn-primary" id="btnAddProduk"
											name="btnAddProduk">Add
											Product</button>
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
		$('#kategori_produk').select2({
			placeholder: '--- Category ---',
			ajax: {
				url: "<?php echo base_url() ?>api/product/list_category_select",
				dataType: 'json',
				delay: 250,
				processResults: function (data) {
					return {
						results: data
					};
				},
				cache: true
			}
		})

		$('#formAddProduct').submit(function (e) {
			e.preventDefault()
			$.ajax({
				url: "<?php echo base_url()?>api/product/add_product",
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
						document.getElementById("progressBar").value = "50";
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
								'<?php echo base_url()?>dashboard/product'
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

				},
				beforeSend: function () {
					document.getElementById("progressBar").style.display = "block";
					document.getElementById("progressBar").value = "0";
				},
				complete: function (data) {
					if (data.code == 200) {
						document.getElementById("progressBar").value = "100";
					}
				},

			})
		})
	});

</script>
