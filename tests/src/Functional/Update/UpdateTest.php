<?php

declare(strict_types = 1);

namespace Drupal\Tests\sparql_entity_storage\Functional\Update;

use Drupal\FunctionalTests\Update\UpdatePathTestBase;
use Drupal\Tests\sparql_entity_storage\Traits\SparqlConnectionTrait;

/**
 * Tests module updates.
 *
 * @group sparql_entity_storage
 */
class UpdateTest extends UpdatePathTestBase {

  use SparqlConnectionTrait;

  /**
   * {@inheritdoc}
   */
  protected function setDatabaseDumpFiles(): void {
    $this->databaseDumpFiles = [
      DRUPAL_ROOT . '/core/modules/system/tests/fixtures/update/drupal-8.8.0.bare.standard.php.gz',
      __DIR__ . '/../../../fixtures/update/install_module.sparql_entity_storage.php',
      __DIR__ . '/../../../fixtures/update/install_module.sparql_test.php',
      __DIR__ . '/../../../fixtures/update/update.8001.php',
      __DIR__ . '/../../../fixtures/update/update.8002.php',
    ];
  }

  /**
   * Tests updates 8001 and 8002.
   *
   * @see sparql_entity_storage_update_8001()
   * @see sparql_entity_storage_update_8002()
   */
  public function testUpdates8001And8002(): void {
    $config_factory = \Drupal::configFactory();

    // Initial field storage.
    $config = $config_factory->get('field.storage.sparql_test.reference');
    $trail = 'third_party_settings.sparql_entity_storage.mapping';
    $this->assertCount(2, $config->get($trail));
    $this->assertSame('http://purl.org/dc/terms/relation', $config->get("{$trail}.target_id.predicate"));
    $this->assertSame('resource', $config->get("{$trail}.target_id.format"));
    $this->assertSame('http://example.com/arbitrary', $config->get("{$trail}.arbitrary.predicate"));
    $this->assertSame('literal', $config->get("{$trail}.arbitrary.format"));

    // Initial SPARQL mapping.
    $config = $config_factory->get('sparql_entity_storage.mapping.sparql_test.vegetable');
    $this->assertCount(5, $config->get('base_fields_mapping'));
    $this->assertSame([
      'predicate' => 'http://www.w3.org/1999/02/22-rdf-syntax-ns#type',
      'format' => 'resource',
    ], $config->get('base_fields_mapping.type.target_id'));
    $this->assertSame([
      'predicate' => 'http://example.com/vegetable/name',
      'format' => 't_literal',
    ], $config->get('base_fields_mapping.title.value'));
    $this->assertSame([
      'predicate' => 'http://purl.org/dc/terms/issued',
      'format' => 'xsd:dateTime',
    ], $config->get('base_fields_mapping.created.value'));
    $this->assertSame([
      'predicate' => 'http://example.com/modified',
      'format' => 'xsd:dateTime',
    ], $config->get('base_fields_mapping.changed.value'));
    $this->assertSame([
      'predicate' => 'http://example.com/language',
      'format' => 't_literal',
    ], $config->get('base_fields_mapping.langcode.value'));

    $this->runUpdates();

    // Updated field storage.
    $config = $config_factory->get('field.storage.sparql_test.reference');
    $this->assertCount(2, $config->get($trail));
    $this->assertArrayHasKey('field', $config->get($trail));
    $this->assertNull($config->get("{$trail}.field"));
    $this->assertCount(2, $config->get("{$trail}.columns"));
    $this->assertSame('http://purl.org/dc/terms/relation', $config->get("{$trail}.columns.target_id.predicate"));
    $this->assertSame('resource', $config->get("{$trail}.columns.target_id.format"));
    $this->assertSame('http://example.com/arbitrary', $config->get("{$trail}.columns.arbitrary.predicate"));
    $this->assertSame('literal', $config->get("{$trail}.columns.arbitrary.format"));

    // Updated SPARQL mapping.
    $config = $config_factory->get('sparql_entity_storage.mapping.sparql_test.vegetable');
    $this->assertCount(5, $config->get('base_fields_mapping'));
    $this->assertArrayHasKey('field', $config->get('base_fields_mapping.type'));
    $this->assertNull($config->get('base_fields_mapping.type.field'));
    $this->assertSame([
      'predicate' => 'http://www.w3.org/1999/02/22-rdf-syntax-ns#type',
      'format' => 'resource',
    ], $config->get('base_fields_mapping.type.columns.target_id'));
    $this->assertArrayHasKey('field', $config->get('base_fields_mapping.title'));
    $this->assertNull($config->get('base_fields_mapping.title.field'));
    $this->assertSame([
      'predicate' => 'http://example.com/vegetable/name',
      'format' => 't_literal',
    ], $config->get('base_fields_mapping.title.columns.value'));
    $this->assertArrayHasKey('field', $config->get('base_fields_mapping.created'));
    $this->assertNull($config->get('base_fields_mapping.created.field'));
    $this->assertSame([
      'predicate' => 'http://purl.org/dc/terms/issued',
      'format' => 'xsd:dateTime',
    ], $config->get('base_fields_mapping.created.columns.value'));
    $this->assertArrayHasKey('field', $config->get('base_fields_mapping.changed'));
    $this->assertNull($config->get('base_fields_mapping.changed.field'));
    $this->assertSame([
      'predicate' => 'http://example.com/modified',
      'format' => 'xsd:dateTime',
    ], $config->get('base_fields_mapping.changed.columns.value'));
    $this->assertArrayHasKey('field', $config->get('base_fields_mapping.langcode'));
    $this->assertNull($config->get('base_fields_mapping.langcode.field'));
    $this->assertSame([
      'predicate' => 'http://example.com/language',
      'format' => 't_literal',
    ], $config->get('base_fields_mapping.langcode.columns.value'));
  }

}
