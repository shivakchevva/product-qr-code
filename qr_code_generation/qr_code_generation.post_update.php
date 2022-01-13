<?php

use \Drupal\node\Entity\Node;
use \Drupal\file\Entity\File;

/**
 * @file
 * Post update functions for QR Code generation module.
 */

/**
 * First update
 */
function qr_code_generation_post_update_create_products(&$sandbox = NULL) {

  // Create file object from remote URL.
  $data = file_get_contents('https://www.drupal.org/files/cta/graphic/DA_MEM_Badge_HPS_24.png');
  $file = file_save_data($data, 'public://druplicon.png', FILE_EXISTS_RENAME);

  $description = 'Product description will display here......';
  // Create node object with attached file.
  $node = Node::create([
    'type' => 'product',
    'title' => 'Product Title',
    'uid' => 1,
    'status' => 1,
    'created' => time(),
    'changed' => time(),
    'field_product_image' => [
      'target_id' => $file->id(),
      'alt' => 'Product',
      'title' => 'Product'
    ],
    'body' => array('value' => $description, 'format' => 'full_html'),
  ]);
  $node->save();
}