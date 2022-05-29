<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Hello, world!</title>

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
	<nav class="navbar navbar-expand-md navbar-dark bg-dark">
		<div class="container-fluid">
			<a class="navbar-brand" href="<?php echo base_url()?>">MAJOO TEKNOLOGI INDONESIA</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
				data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
				aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

		</div>
	</nav>

	<main class="flex-shrink-0">
		<div class="col-md-12">
			<div class="p-3 m-5 border rounded-3">
				<div class="row">
					<div class="col-md-4">
						<img id="imageProduct" width="100%" src="#" />
					</div>
					<div class="col-md-8">
						<div class="col-md-12" id="productName" style="margin:5px">Nama</div>
						<div class="col-md-12" id="productPrice" style="margin:5px">Harga</div>
						<div class="col-md-12">
							<a class="btn btn-outline-secondary" type="button" style="margin:5px;margin-top:20px">Buy
								Now</a>
						</div>
					</div>
				</div>
				<h5>Description</h5>
				<hr>
				<p id="productDescription"></p>
			</div>
		</div>
	</main>

	<script>
		$(document).ready(function () {
			getDataProduct()
		})

		async function getDataProduct() {
			await $.ajax({
				url: "<?php echo base_url()?>api/product/get_data_product",
				type: "GET",
				dataType: "JSON",
				data: {
					id_product: "<?php echo $id_product;?>"
				},
				success: function (data) {
					console.log(data)
					$('#imageProduct').attr("src", data.images)
					$('#productName').html('<h2>' + data.namaProduk + '</h2>')
					$('#productPrice').html('<h5>' + data.harga + '</h5>')
					$('#productDescription').html(data.descriptionProduk)
				}
			})
		}

	</script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
	</script>
</body>

</html>
