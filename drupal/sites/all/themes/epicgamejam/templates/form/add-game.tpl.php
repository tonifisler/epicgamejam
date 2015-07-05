<?php hide($form['field_2014_members']) ?>

<div class="row">
  <div class="col-sm-8 col-sm-offset-2">
    <?php print render($form['field_epic_points']); ?>
    <?php print render($form['field_badges']); ?>

    <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active"><a href="#game" aria-controls="game" role="tab" data-toggle="tab">Game</a></li>
      <li role="presentation"><a href="#images" aria-controls="images" role="tab" data-toggle="tab">Images</a></li>
      <li role="presentation"><a href="#team_info" aria-controls="team_info" role="tab" data-toggle="tab">Team info</a></li>
    </ul>

    <div class="tab-content">
      <div role="tabpanel" class="tab-pane active well well-white" id="game">
        <?php print render($form['title_field']); ?>
        <?php print render($form['field_genre']); ?>
        <p>Please indicate if it's a webplayer, .exe or anything else ;)</p>
        <?php print render($form['field_links']); ?>
        <?php print render($form['body']); ?>
      </div>
      <div role="tabpanel" class="tab-pane well well-white" id="images">
        <?php print render($form['field_image']); ?>
        <?php print render($form['field_screenshots']); ?>
      </div>
      <div role="tabpanel" class="tab-pane well well-white" id="team_info">
        <?php print render($form['field_team_name']); ?>
        <?php print render($form['field_members']); ?>
        <p class="text-muted small">Your fellow teammates should have created their account to appear in this list ;)</p>
        <?php print render($form['field_contact_email']); ?>
        <?php print render($form['field_country']); ?>
        <?php print render($form['field_city']); ?>
        <hr>
        <p>If you were at a live event or gathering to make this game, please <strong>tell us where</strong> below.</p>
        <?php print render($form['field_live_event']); ?>
      </div>
    </div>

    <?php print drupal_render_children($form); ?>
  </div>
</div>
