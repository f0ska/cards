<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">
						&times;
					</span>
				</button>
				<h4 class="modal-title" id="exampleModalLabel">
					Generate new cards collection
				</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal js_generate_form" action="<?=site_url('cards_management/create_action')?>">
					<div class="form-group">
						<label for="series-inp" class="col-sm-4 control-label">
							Series
						</label>
						<div class="col-sm-8">
							<input type="text" name="g_series" maxlength="20" class="form-control" id="series-inp" />
						</div>
					</div>
					<div class="form-group">
						<label for="expiration-inp" class="col-sm-4 control-label">
							Expiration after
						</label>
						<div class="col-sm-8">
							<select class="form-control" id="expiration-inp" name="g_expiration">
								<option value="12">
									One year
								</option>
								<option value="6">
									6 months
								</option>
								<option value="1">
									1 month
								</option>
							</select>
						</div>
					</div>
                    <div class="form-group">
						<label for="count-inp" class="col-sm-4 control-label">
							Number of cards
						</label>
						<div class="col-sm-8">
							<input type="text" name="g_count" maxlength="10" class="form-control" id="count-inp" value="100" />
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-8">
							<div class="checkbox">
								<label>
									<input type="checkbox" checked="" name="g_status" value="1" />
									Activate cards
								</label>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">
					Cancel
				</button>
				<button type="button" class="btn btn-primary js_submit" data-target=".js_generate_form">
					Generate
				</button>
			</div>
		</div>
	</div>
</div>