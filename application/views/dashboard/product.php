<main class="col-md-12" style="padding:5px 10px 10px 10px">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h5>Product</h5>
				</div>
				<div class="card-body">
					<a href="#" class="btn btn-primary" style="margin:10px">Add Product</a>
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<h5>Data Product</h5>
							</div>
							<div class="card-body">
								<div class="table-responsive" id="tableProduct"></div>
								<div id="pagination_link"></div>
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
		getListProduct(1)
	})

	async function getListProduct(page) {
		await $.ajax({
			url: "<?php echo base_url()?>api/product/get_product",
			type: "GET",
			dataType: "JSON",
			data: {
				page: page
			},
			success: function (data) {
				$('#tableProduct').html(data.tableProduct)
				$('#pagination_link').html(data.pagenationLink)
			}
		})
	}

	$(document).on("click", ".pagination li a", function (event) {
		event.preventDefault();
		var page = $(this).data("ci-pagination-page");
		getListProduct(page);
	});

</script>
