<?php

/**
 * Provides a 'Product QR Code' Block
 *
 * @Block(
 *   id = "product_qr_code",
 *   admin_label = @Translation("Product QR Code"),
 *   category = @Translation("QR Code")
 * )
 */

namespace Drupal\qr_code_generation\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Mpdf\QrCode\QrCode;
use Mpdf\QrCode\Output;

class ProductQRCodeBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {

    $current_path = \Drupal::service('path.current')->getPath();
    $url = \Drupal\Core\Url::fromUserInput($current_path, ['absolute' => TRUE])->toString();
    $qrCode = new QrCode($url);
    $output = new Output\Svg();
    $result = $output->output($qrCode, 100, 'white', 'black');

    $build['block'] = array(
      '#type' => 'markup',
      '#markup' => $result
    );
    return $build;
  }

  public function getCacheMaxAge() {
    return 0;
  }

}