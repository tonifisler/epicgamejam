<?php dpm($form); ?>

<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <?php print render($form['form_build_id']); ?>
    <?php print render($form['form_token']); ?>
    <?php print render($form['form_id']); ?>
    <?php print render($form['title_field']); ?>
  </div>
</div>
<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <?php print render($form['options']); ?>
    <?php print render($form['additional_settings']); ?>
    <?php print render($form['actions']); ?>
  </div>
</div>