<?php

/**
 * @file
 * Support for testing sparql_entity_storage_update_8001().
 */

declare(strict_types = 1);

use Drupal\Core\Database\Database;

$config = [
  'third_party_settings' => [
    'sparql_entity_storage' => [
      'mapping' => [
        'target_id' => [
          'predicate' => 'http://purl.org/dc/terms/relation',
          'format' => 'resource',
        ],
        'arbitrary' => [
          'predicate' => 'http://example.com/arbitrary',
          'format' => 'literal',
        ],
      ],
    ],
  ],
  'id' => 'sparql_test.reference',
  'field_name' => 'reference',
  'entity_type' => 'sparql_test',
  'type' => 'entity_reference',
  'settings' => [
    'target_type' => 'sparql_test',
  ],
  'module' => 'core',
  'cardinality' => -1,
];

Database::getConnection()
  ->insert('config')
  ->fields([
    'collection' => '',
    'name' => 'field.storage.sparql_test.reference',
    'data' => serialize($config),
  ])
  ->execute();
