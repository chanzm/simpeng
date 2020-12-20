<form action="" method="post" enctype="multipart/form-data">

							<input type="hidden" name="id" value="" />

							<div class="form-group">
								<label for="name">Name*</label>
								<input class="form-control"
								 type="text" name="name" placeholder="Product name" value="" />
								<div class="invalid-feedback">
								</div>
							</div>

							<div class="form-group">
								<label for="price">Price</label>
								<input class="form-control"
								 type="number" name="price" min="0" placeholder="Product price" value="" />
								<div class="invalid-feedback">
							
								</div>
							</div>


							<div class="form-group">
								<label for="name">Photo</label>
								<input class="form-control-file "
								 type="file" name="image" />
								<input type="hidden" name="old_image" value="" />
								<div class="invalid-feedback">
								</div>
							</div>


							<input class="btn btn-success" type="submit" name="btn" value="Save" />
						</form>
