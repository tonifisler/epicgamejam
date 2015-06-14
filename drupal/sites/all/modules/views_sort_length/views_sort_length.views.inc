<?php
/**
 * Implements hook_field_views_data_alter().
 */
function views_sort_length_field_views_data_alter(&$result, $field, $module) {
  if($field['field_name'] == 'title_field'){
    $name = $field['field_name'];
    foreach ($result as $table_name => $table_data) {
      if (isset($table_data[$field['field_name']]['field'])) {
        $result[$table_name][$field['field_name'] . '_value']['filter']['handler'] = 'views_sort_length';
      }
    }
  }
}
