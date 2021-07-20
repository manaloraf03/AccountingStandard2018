<?php foreach($entries as $entry){ ?>
    <tr>
        <td>
            <select name="accounts[]" class="<?php if($entry->cr_amount > 0){ ?> enable <?php } ?> selectpicker show-tick form-control selectpicker_accounts" data-live-search="true" >
                <?php foreach($accounts as $account){ ?>
                    <option value='<?php echo $account->account_id; ?>' <?php echo ($entry->account_id==$account->account_id?'selected':''); ?> data-cib="<?php echo $account->for_cib; ?>"><?php echo $account->account_title; ?></option>
                <?php } ?>
            </select>
        </td>
        <td><input type="text" name="memo[]" class="form-control"  value="<?php echo $entry->memo; ?>"></td>
        <td><input type="text" name="dr_amount[]" class="form-control numeric" value="<?php echo number_format($entry->dr_amount,2); ?>"></td>
        <td><input type="text" name="cr_amount[]" class="form-control numeric"  value="<?php echo number_format($entry->cr_amount,2);?>"></td>
        <td>       
            <select  name="department_id_line[]" class="selectpicker show-tick form-control dept" data-live-search="true" >
                <option value="0">[ None ]</option>
                <?php foreach($departments as $department){ ?>
                    <option value='<?php echo $department->department_id; ?>' <?php echo ($entry->department_id==$department->department_id?'selected':''); ?>  ><?php echo $department->department_name; ?></option>
                <?php } ?>
            </select>
        </td>
        <td>
            <button type="button" class="btn btn-default add_account"><i class="fa fa-plus-circle" style="color: green;"></i></button>
            <button type="button" class="btn btn-default remove_account"><i class="fa fa-times-circle" style="color: red;"></i></button>
        </td>
    </tr>
<?php } ?>
