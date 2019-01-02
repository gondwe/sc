<div class="col-md-3 border-right">

<div class="form-group">
  <label for=""></label>
  <select class="form-control" name="subject" id="subjectList">
        <option value="0">SELECT SUBJECT</option>
        <?php foreach($subjects as $subj): $active = $subj->code == $sub ? "selected=true" : null?>
            <option <?=$active?> value='<?=$subj->code?>'><?=$subj->name?></option>
        <?php endforeach ?>
  </select>
</div>

</div>