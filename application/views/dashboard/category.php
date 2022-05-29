<main class="col-md-12" style="padding:5px 10px 10px 10px">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h5>Product</h5>
				</div>
				<div class="card-body">
					<a href="<?php echo base_url()?>dashboard/add_category" class="btn btn-primary"
						style="margin:10px">Add
						Category</a>
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<h5>Data Category</h5>
							</div>
							<div class="card-body">
								<div class="table-responsive" id="tableCategory"></div>
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
		getListCategory(1)
	})

	$(document).on('click', '#btnDeleteCategory', function () {
		let id_category = $(this).attr('ids')
		$.ajax({
			url: "<?php echo base_url()?>api/product/delete_category",
			type: "POST",
			dataType: "JSON",
			data: {
				id_category: id_category
			},
			success: function (data) {
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
					getListCategory(1)
				})
			}
		})
	})

	async function getListCategory(page) {
		await $.ajax({
			url: "<?php echo base_url()?>api/product/get_category",
			type: "GET",
			dataType: "JSON",
			data: {
				page: page
			},
			success: function (data) {
				$('#tableCategory').html(data.tableCategory)
				$('#pagination_link').html(data.pagenationLink)
			}
		})
	}

	$(document).on("click", ".pagination li a", function (event) {
		event.preventDefault();
		var page = $(this).data("ci-pagination-page");
		getListCategory(page);
	});

</script>
