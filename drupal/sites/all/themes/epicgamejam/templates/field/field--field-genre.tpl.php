<?php
/**
 * @file field--fences-ul.tpl.php
 * Wrap each field value in the <li> element and all of them in the <ul> element.
 *
 * @see http://developers.whatwg.org/grouping-content.html#the-ul-element
 */
?>
<?php if ($element['#label_display'] == 'above'): ?>
  <h3 class="field-label"<?php print $title_attributes; ?>>
    <?php print $label; ?>
  </h3>
<?php endif; ?>

<ul class="field-genre list-inline"<?php print $attributes; ?>>

  <?php if ($element['#label_display'] == 'inline'): ?>
    <li class="field-label"<?php print $title_attributes; ?>>
      <b><?php print $label; ?>:</b>
    </li>
  <?php endif; ?>

  <?php foreach ($items as $delta => $item): ?>
    <li<?php print $item_attributes[$delta]; ?>>
      <?php print render($item); ?>
    </li>
  <?php endforeach; ?>

</ul>
