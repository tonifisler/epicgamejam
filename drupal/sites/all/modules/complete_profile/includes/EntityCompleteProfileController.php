<?php

class EntityCompleteProfileController {

  public static function isFieldEmpty($entity_type, $entity, array $field) {
    if (!isset($entity->{$field['field_name']})) {
      return TRUE;
    }

    $items = field_get_items($entity_type, $entity, $field['field_name']);
    // @todo Do we need to run filtering on values?
    //$items = _field_filter_items($field, $items);
    return empty($items);
  }

  public static function hasEmptyRequiredFields($entity_type, $entity) {
    list(, , $bundle) = entity_extract_ids($entity_type, $entity);
    $instances = field_info_instances($entity_type, $bundle);

    foreach ($instances as $instance) {
      // Only check required fields.
      if (!empty($instance['required'])) {
        // Check if the required field is empty.
        $field = field_info_field($instance['field_name']);
        if (self::isFieldEmpty($entity_type, $entity, $field)) {
          // Check that the user can actually edit their missing field.
          if (field_access('edit', $field, $entity_type, $entity)) {
            return TRUE;
          }
        }
      }
    }
  }
}
