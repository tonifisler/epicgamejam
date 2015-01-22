<?php

interface CompleteProfileControllerInterface {

  public static function hasEmptyRequiredFields($account);

  public static function getFieldsForm($account, array &$form_state);
}
