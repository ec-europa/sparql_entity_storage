<?php

/**
 * @file
 * Support for testing sparql_entity_storage_update_8002().
 */

declare(strict_types = 1);

use Drupal\Core\Database\Database;

$config = [
  'id' => 'sparql_test.vegetable',
  'entity_type_id' => 'sparql_test',
  'bundle' => 'vegetable',
  'rdf_type' => 'http://example.com/vegetable',
  'base_fields_mapping' => [
    'type' => [
      'target_id' => [
        'predicate' => 'http://www.w3.org/1999/02/22-rdf-syntax-ns#type',
        'format' => 'resource',
      ],
    ],
    'title' => [
      'value' => [
        'predicate' => 'http://example.com/vegetable/name',
        'format' => 't_literal',
      ],
    ],
    'created' => [
      'value' => [
        'predicate' => 'http://purl.org/dc/terms/issued',
        'format' => 'xsd:dateTime',
      ],
    ],
    'changed' => [
      'value' => [
        'predicate' => 'http://example.com/modified',
        'format' => 'xsd:dateTime',
      ],
    ],
    'langcode' => [
      'value' => [
        'predicate' => 'http://example.com/language',
        'format' => 't_literal',
      ],
    ],
  ],
  'graph' => [
    'default' => 'http://example.com/vegetable/graph/published',
  ],
  'entity_id_plugin' => 'default',
];

Database::getConnection()
  ->insert('config')
  ->fields([
    'collection' => '',
    'name' => 'sparql_entity_storage.mapping.sparql_test.vegetable',
    'data' => serialize($config),
  ])
  ->execute();
