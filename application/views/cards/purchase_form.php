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
					Add test purchase
				</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal js_generate_form" action="<?=site_url('cards_management/purchase_action')?>">
					<div class="form-group">
						<label for="series-inp" class="col-sm-4 control-label">
							Card
						</label>
						<div class="col-sm-2">
							<input value="<?=$card?$card->series:''?>" type="text" name="p_series" maxlength="20" class="form-control" id="series-inp" placeholder="series..." />
						</div>
                        <div class="col-sm-6">
							<input value="<?=$card?$card->number:''?>" type="text" name="p_number" maxlength="20" class="form-control" id="number-inp" placeholder="number..." />
						</div>
					</div>
					<div class="form-group">
						<label for="sum-inp" class="col-sm-4 control-label">
							Sum
						</label>
						<div class="col-sm-8">
							<input value="100" type="text" name="p_sum" maxlength="10" class="form-control" id="sum-inp" placeholder="sum..." />
						</div>
					</div>
                    <div class="form-group">
						<label for="description-inp" class="col-sm-4 control-label">
							Order description
						</label>
						<div class="col-sm-8">
							<textarea id="description-inp" rows="4" class="form-control" name="p_description" placeholder="some information about transaction..."></textarea>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">
					Cancel
				</button>
				<button type="button" class="btn btn-primary js_submit" data-target=".js_generate_form">
					Add
				</button>
			</div>
		</div>
	</div>
</div>