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
			<a class="navbar-brand" href="#">MAJOO TEKNOLOGI INDONESIA</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
				data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
				aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

		</div>
	</nav>

	<main class="col-md-12" style="padding:5px 10px 10px 10px">
		<div class="row">
			<div class="col-md-12">
				<h2>Product</h2>
			</div>
			<div class="col-md-12">
				<div class="row" id="listProductFront">
				</div>
			</div>
		</div>
	</main>

	<script>
		$(document).ready(function () {
			getListProduct()
		})

		async function getListProduct() {
			await $.ajax({
				url: "<?php echo base_url()?>api/product/get_product_front",
				type: "GET",
				dataType: "JSON",
				data: {},
				success: function (data) {
					console.log(data)
					htmls = ''
					data.forEach((result) => {
						htmls += '<div class="col-md-3">'
						htmls += '<div class="card mb-4 rounded-3 shadow-sm">'
						htmls += '<div class="card-body">'
						htmls += '<center>'
						htmls += '<img width="50%" src="' + result.images + '" />'
						htmls += '<h4>' + result.namaProduk + '</h4>'
						htmls += '<h5>' + result.harga + '</h5>'
						htmls += '</center>'
						htmls += '<ul class="list-unstyled mt-3 mb-4">'
						htmls += '<li>' + result.descriptionProduk + '</li>'
						htmls += '<ul>'
						htmls +=
							'<a href="<?php echo base_url()?>product/details/' + result.id +
							'" style="margin-top:15px" class="w-100 btn btn-lg btn-outline-primary">Beli</a>'
						htmls += '</div>'
						htmls += '</div>'
						htmls += '</div>'
					})
					$('#listProductFront').html(htmls)
				}
			})
		}

	</script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
	</script>
</body>

</html>
