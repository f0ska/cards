<?if(!$this->input->is_ajax_request()){?>
<h3>Cards management
    <a class="js_modal btn btn-primary pull-right" href="<?=site_url('cards_management/purchase_form')?>">
            Add test purchase
    </a>
</h3>
<table class="table table-hovered">
    <thead>
        <tr>
            <th>Series</th>
            <th>Number</th>
            <th>Created</th>
            <th>Expiration</th>
            <th>Status</th>
            <th></th>
        </tr>
        <tr>
            <th>
                <div class="input-group">
                    <input size="4" autocomplete="off" type="text" name="series" class="form-control js_search" value="" placeholder="type series..." />
                    <span class="input-group-btn">
                        <button class="btn btn-default js_reset" type="button"><span class="glyphicon glyphicon-remove"></span></button>
                    </span>
                </div>
            </th>
            <th>
                <div class="input-group">
                    <input autocomplete="off" type="text" name="number" class="form-control js_search" value="" placeholder="type cart number..." />
                    <span class="input-group-btn">
                        <button class="btn btn-default js_reset" type="button"><span class="glyphicon glyphicon-remove"></span></button>
                    </span>
                </div>
            </th>
            <th>
                <div class="input-group">
                    <input size="10" autocomplete="off" type="text" name="created" class="form-control js_search js_datepicker" value="" placeholder="created..." />
                    <span class="input-group-btn">
                        <button class="btn btn-default js_reset" type="button"><span class="glyphicon glyphicon-remove"></span></button>
                    </span>
                </div>
            </th>
            <th>
                <div class="input-group">
                    <input size="10" autocomplete="off" type="text" name="expiration" class="form-control js_search js_datepicker" value="" placeholder="expire(d)..." />
                    <span class="input-group-btn">
                        <button class="btn btn-default js_reset" type="button"><span class="glyphicon glyphicon-remove"></span></button>
                    </span>
                </div>
            </th>
            <th>
                <select autocomplete="off" class="form-control js_search" name="status">
                    <option value="">All</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                    <option value="-1">Expired</option>
                </select>
            </th>
            <th>
                
            </th>
        </tr>
    </thead>
<?}?>
    <tbody class="js_replace_list">
    <?if($message){?>
        <tr>
            <td colspan="6">
                <div class="alert alert-<?=$message_type?>" role="alert"><?=$message?></div>
            </td>
        </tr>
    <?}?>
    <?if($list){
        foreach($list as $row){
    ?>
        <tr>
            <td><?=$row->series?></td>
            <td><?=preg_replace('/^([0-9]{4})([0-9]{4})([0-9]{4})([0-9]{4})$/','$1&nbsp;$2&nbsp;$3&nbsp;$4',$row->number)?></td>
            <td><?=$row->created?></td>
            <td><?=$row->expiration?></td>
            <td>
            <?
                switch($row->status){
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
            ?>
            </td>
            <td>
                <div class="btn-group btn-group-xs" role="group" aria-label="...">
                    <a href="<?=site_url('cards_management/card_details/'.$row->id)?>" class="btn btn-default js_modal">
                        <span class="glyphicon glyphicon-info-sign"></span>
                    </a>
                    <?if($row->status >=0){?>
                    <a href="<?=site_url('cards_management/card_status/'.$row->id.'/'.(1-$row->status))?>" class="btn btn-default js_request">
                        <span class="glyphicon glyphicon-<?=$row->status?'ban-circle':'ok'?>"></span>
                    </a>
                    <?}?>
                    <a href="<?=site_url('cards_management/card_remove/'.$row->id)?>" class="btn btn-default js_request">
                        <span class="glyphicon glyphicon-remove-circle"></span>
                    </a>
                </div>
            </td>
        </tr>
    <?
        }
    }else{?>
        <tr>
            <td colspan="6">
                <div class="alert alert-warning" role="alert">Entries not found...</div>
            </td>
        </tr>
    <?}?>
        <tr>
            <td colspan="1">
                <a class="js_modal btn btn-success btn-block" href="<?=site_url('cards_management/create_form')?>">
                    Generate Cards
                </a>
            </td>
            <td colspan="5">
                <?=$pagination?>
                <span class="total-ent"><strong><?=$list_total?></strong> found</span>
            </td>
        </tr>
    </tbody>
<?if(!$this->input->is_ajax_request()){?>
</table>

<hr />


<?}?>
