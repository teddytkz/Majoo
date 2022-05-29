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
			url: "<?php echo base_url()?>api/get_product_front",
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
