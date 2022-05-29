<main class="col-md-12" style="padding:5px 10px 10px 10px">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h5>Update Product</h5>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<form id="formUpdateProduct">
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
									<div class="col-sm-10">
										<input type="hidden" class="form-control form-control-sm" id="id" name="id" />
										<button type="submit" href="#" class="btn btn-primary" id="btnUpdateProduk"
											name="btnUpdateProduk">Update
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
		getDataProduct()
		$('#formUpdateProduct').submit(function (e) {
			e.preventDefault()
			$.ajax({
				url: "<?php echo base_url()?>api/product/update_product",
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

				}
			})
		})
	});

	function getDataProduct() {
		$.ajax({
			url: "<?php echo base_url()?>api/product/get_data_product_id",
			type: "POST",
			dataType: "JSON",
			data: {
				id: '<?php echo $id;?>'
			},
			success: function (data) {
				console.log(data)
				$('#id').val(data.id)
				$('#nama_produk').val(data.nama)
				$('#deskripsi_produk').val(data.deskripsi)
				$('#harga_produk').val(data.harga)
			}
		})
	}

</script>
