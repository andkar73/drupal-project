<?php
/**
 * Created by PhpStorm.
 * User: ldc-aks
 * Date: 2017-09-12
 * Time: 12:42
 */

namespace Drupal\Tests\one_two\Kernel;

use Drupal\Component\Utility\Unicode;
use Drupal\KernelTests\KernelTestBase;
use Drupal\block_content\Entity\BlockContent;
use Drupal\block_content\Entity\BlockContentType;

/**
 * Class KernelTest
 * @package Drupal\Tests\one_two\Kernel
 *
 * @group one_two
 */
class KernelTest extends KernelTestBase {
  public static $modules = ['system', 'block', 'block_content', 'user'];

  protected $entityTypeManager;

  public function setUp() {
    parent::setUp();
    $this->installEntitySchema('block_content');
    $this->installEntitySchema('user');

    $this->entityTypeManager = $this->container->get('entity_type.manager');
  }

  /**
   * Tests creation of custom blocks.
   */
  public function testBlockCreation() {
    // Create a block entity type.
    $bundle = Unicode::strtolower($this->randomMachineName());
    BlockContentType::create([
      'id' => $bundle,
      'label' => $this->randomString(),
    ])->save();

    // Create a block.
    $info = $this->randomMachineName();
    $block = BlockContent::create([
      'info' => $info,
      'type' => $bundle,
    ]);
    $block->save();
    // Load the block from storage and check if the values were saved correctly
    // (not cached).
    $block = $this->entityTypeManager->getStorage('block_content')->loadUnchanged($block->id());
    $this->assertEquals($info, $block->label());
    $this->assertEquals($bundle, $block->bundle());
  }

}