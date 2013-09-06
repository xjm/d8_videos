<?php

/**
 * @file
 * Contains \Drupal\testme\Tests\InsureImportantTextExistsTest.
 */

namespace Drupal\testme\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Tests for the existence of critical pieces of text.
 */
class EnsureImportantTextExistsTest extends WebTestBase {
  /**
   * Modules to enable.
   *
   * @var array
   */
  public static $modules = array('testme');

  /**
   * The installation profile to use with this test.
   *
   * @var string
   */
  protected $profile = 'standard';
  
  public static function getInfo() {
    return array(
      'name' => 'Ensure critical text exists',
      'description' => 'Tests to make sure George has not rewritten my poetry again.',
      'group' => 'Testme',
    );
  }

  /**
   * Tests our page for certain text.
   */
  public function testCheckForImportantText() {
    $this->drupalGet('testme-page');
    $this->assertText('One of these days');
    $this->assertText('really rescue you');
  }
}
