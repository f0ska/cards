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
					Card details
				</h4>
			</div>
			<div class="modal-body">
				<table class="table">
                    <thead>
                        <tr>
                            <th>Card:</th>
                            <th><?=$card->series?> <?=preg_replace('/^([0-9]{4})([0-9]{4})([0-9]{4})([0-9]{4})$/','$1&nbsp;$2&nbsp;$3&nbsp;$4',$card->number)?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Creation date:</td>
                            <td><?=$card->created?></td>
                        </tr>
                        <tr>
                            <td>Expiration date:</td>
                            <td><?=$card->expiration?></td>
                        </tr>
                        <tr>
                            <td>Last usage date</td>
                            <td><?=$card->used?></td>
                        </tr>
                        <tr>
                            <td>Card sum:</td>
                            <td>$<?=number_format($card->sum,2,'.',' ')?></td>
                        </tr>
                        <tr>
                            <td>Card status:</td>
                            <td><?
                                switch($card->status){
                                    case 0:
                                        echo 'Inactive';
                                        break;
                                    case 1:
                                        echo 'Active';
                                        break;
                                    case -1:
                                        echo 'Expired';
                                        break;
                                }
                            ?></td>
                        </tr>
                    </tbody>
                </table>
    
            <?if($transactions){?>
    
                <h4>Card history</h4>
                <table class="table table-condensed">
                    <tr>
                        <th>Transaction date</th>
                        <th>Transaction sum</th>
                        <th>Transaction description</th>
                    </tr>
                    <?foreach($transactions as $row){?>
                    <tr>
                        <td><?=$row->created?></td>
                        <td>$<?=number_format($row->sum,2,'.',' ')?></td>
                        <td><?=$row->description?></td>
                    </tr>
                    <?}?>
                </table>
            
            <?}?>
            
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">
					Close
				</button>
			</div>
		</div>
	</div>
</div>