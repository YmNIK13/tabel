<?php

/**
 * @file
 * Hooks for dummy module.
 */

/**
 * Adds message to page
 *
 * @return array|string
 *  Return string or array for strings with additional message
 */
function hook_dummy_page_message() {
  return [
    'First message',
    'Second message',
  ];
}

/**
 * Alter messages being added to page.
 *
 * @param array $messages
 *  Array with messages.
 */
function hook_dummy_page_messages_alter(&$messages) {
  $messages[0] = 'Replaced!';
}