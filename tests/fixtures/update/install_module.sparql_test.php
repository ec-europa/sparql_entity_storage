<?php

/**
 * @file
 * Installs sparql_test module for testing updates.
 */

declare(strict_types = 1);

use Drupal\Core\Database\Database;

$db = Database::getConnection();

// Enable the 'sparql_entity_storage' module.
$extensions = unserialize($db->select('config')
  ->fields('config', ['data'])
  ->condition('collection', '')
  ->condition('name', 'core.extension')
  ->execute()
  ->fetchField());
$extensions['module']['sparql_test'] = 0;
$db->update('config')
  ->fields(['data' => serialize($extensions)])
  ->condition('collection', '')
  ->condition('name', 'core.extension')
  ->execute();

$db->insert('key_value')
  ->fields(['collection', 'name', 'value'])
  ->values([
    'collection' => 'system.schema',
    'name' => 'sparql_test',
    'value' => 'i:8000;',
  ])
  ->values([
    'collection' => 'entity.definitions.installed',
    'name' => 'sparql_test.entity_type',
    'value' => 'O:36:"Drupal\Core\Entity\ContentEntityType":40:{s:25:"' . chr(0) . '*' . chr(0) . 'revision_metadata_keys";a:1:{s:16:"revision_default";s:16:"revision_default";}s:15:"' . chr(0) . '*' . chr(0) . 'static_cache";b:1;s:15:"' . chr(0) . '*' . chr(0) . 'render_cache";b:1;s:19:"' . chr(0) . '*' . chr(0) . 'persistent_cache";b:1;s:14:"' . chr(0) . '*' . chr(0) . 'entity_keys";a:7:{s:2:"id";s:2:"id";s:6:"bundle";s:4:"type";s:5:"label";s:5:"title";s:8:"langcode";s:8:"langcode";s:8:"revision";s:0:"";s:16:"default_langcode";s:16:"default_langcode";s:29:"revision_translation_affected";s:29:"revision_translation_affected";}s:5:"' . chr(0) . '*' . chr(0) . 'id";s:11:"sparql_test";s:16:"' . chr(0) . '*' . chr(0) . 'originalClass";s:36:"Drupal\sparql_test\Entity\SparqlTest";s:11:"' . chr(0) . '*' . chr(0) . 'handlers";a:3:{s:7:"storage";s:49:"\Drupal\sparql_entity_storage\SparqlEntityStorage";s:6:"access";s:45:"Drupal\Core\Entity\EntityAccessControlHandler";s:12:"view_builder";s:36:"Drupal\Core\Entity\EntityViewBuilder";}s:19:"' . chr(0) . '*' . chr(0) . 'admin_permission";N;s:25:"' . chr(0) . '*' . chr(0) . 'permission_granularity";s:11:"entity_type";s:8:"' . chr(0) . '*' . chr(0) . 'links";a:4:{s:9:"canonical";s:26:"/sparql_test/{sparql_test}";s:9:"edit-form";s:31:"/sparql_test/{sparql_test}/edit";s:11:"delete-form";s:33:"/sparql_test/{sparql_test}/delete";s:10:"collection";s:17:"/sparql_test/list";}s:21:"' . chr(0) . '*' . chr(0) . 'bundle_entity_type";s:16:"sparql_type_test";s:12:"' . chr(0) . '*' . chr(0) . 'bundle_of";N;s:15:"' . chr(0) . '*' . chr(0) . 'bundle_label";N;s:13:"' . chr(0) . '*' . chr(0) . 'base_table";N;s:22:"' . chr(0) . '*' . chr(0) . 'revision_data_table";N;s:17:"' . chr(0) . '*' . chr(0) . 'revision_table";N;s:13:"' . chr(0) . '*' . chr(0) . 'data_table";N;s:11:"' . chr(0) . '*' . chr(0) . 'internal";b:0;s:15:"' . chr(0) . '*' . chr(0) . 'translatable";b:1;s:19:"' . chr(0) . '*' . chr(0) . 'show_revision_ui";b:0;s:8:"' . chr(0) . '*' . chr(0) . 'label";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:"' . chr(0) . '*' . chr(0) . 'string";s:18:"SPARQL test entity";s:12:"' . chr(0) . '*' . chr(0) . 'arguments";a:0:{}s:10:"' . chr(0) . '*' . chr(0) . 'options";a:0:{}}s:19:"' . chr(0) . '*' . chr(0) . 'label_collection";s:0:"";s:17:"' . chr(0) . '*' . chr(0) . 'label_singular";s:0:"";s:15:"' . chr(0) . '*' . chr(0) . 'label_plural";s:0:"";s:14:"' . chr(0) . '*' . chr(0) . 'label_count";a:0:{}s:15:"' . chr(0) . '*' . chr(0) . 'uri_callback";N;s:8:"' . chr(0) . '*' . chr(0) . 'group";s:7:"content";s:14:"' . chr(0) . '*' . chr(0) . 'group_label";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:"' . chr(0) . '*' . chr(0) . 'string";s:7:"Content";s:12:"' . chr(0) . '*' . chr(0) . 'arguments";a:0:{}s:10:"' . chr(0) . '*' . chr(0) . 'options";a:1:{s:7:"context";s:17:"Entity type group";}}s:22:"' . chr(0) . '*' . chr(0) . 'field_ui_base_route";N;s:26:"' . chr(0) . '*' . chr(0) . 'common_reference_target";b:0;s:22:"' . chr(0) . '*' . chr(0) . 'list_cache_contexts";a:0:{}s:18:"' . chr(0) . '*' . chr(0) . 'list_cache_tags";a:1:{i:0;s:16:"sparql_test_list";}s:14:"' . chr(0) . '*' . chr(0) . 'constraints";a:2:{s:13:"EntityChanged";N;s:26:"EntityUntranslatableFields";N;}s:13:"' . chr(0) . '*' . chr(0) . 'additional";a:1:{s:9:"fieldable";b:1;}s:8:"' . chr(0) . '*' . chr(0) . 'class";s:36:"Drupal\sparql_test\Entity\SparqlTest";s:11:"' . chr(0) . '*' . chr(0) . 'provider";s:11:"sparql_test";s:14:"' . chr(0) . '*' . chr(0) . '_serviceIds";a:0:{}s:18:"' . chr(0) . '*' . chr(0) . '_entityStorages";a:0:{}s:20:"' . chr(0) . '*' . chr(0) . 'stringTranslation";N;}',
  ])
  ->values([
    'collection' => 'entity.definitions.installed',
    'name' => 'sparql_test.field_storage_definitions',
    'value' => 'a:8:{s:2:"id";O:37:"Drupal\Core\Field\BaseFieldDefinition":5:{s:7:"' . chr(0) . '*' . chr(0) . 'type";s:3:"uri";s:9:"' . chr(0) . '*' . chr(0) . 'schema";N;s:10:"' . chr(0) . '*' . chr(0) . 'indexes";a:0:{}s:17:"' . chr(0) . '*' . chr(0) . 'itemDefinition";O:51:"Drupal\Core\Field\TypedData\FieldItemDataDefinition":2:{s:18:"' . chr(0) . '*' . chr(0) . 'fieldDefinition";r:2;s:13:"' . chr(0) . '*' . chr(0) . 'definition";a:2:{s:4:"type";s:14:"field_item:uri";s:8:"settings";a:2:{s:10:"max_length";i:2048;s:14:"case_sensitive";b:0;}}}s:13:"' . chr(0) . '*' . chr(0) . 'definition";a:5:{s:5:"label";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:"' . chr(0) . '*' . chr(0) . 'string";s:2:"ID";s:12:"' . chr(0) . '*' . chr(0) . 'arguments";a:0:{}s:10:"' . chr(0) . '*' . chr(0) . 'options";a:0:{}}s:8:"provider";s:11:"sparql_test";s:10:"field_name";s:2:"id";s:11:"entity_type";s:11:"sparql_test";s:6:"bundle";N;}}s:8:"langcode";O:37:"Drupal\Core\Field\BaseFieldDefinition":5:{s:7:"' . chr(0) . '*' . chr(0) . 'type";s:8:"language";s:9:"' . chr(0) . '*' . chr(0) . 'schema";N;s:10:"' . chr(0) . '*' . chr(0) . 'indexes";a:0:{}s:17:"' . chr(0) . '*' . chr(0) . 'itemDefinition";O:51:"Drupal\Core\Field\TypedData\FieldItemDataDefinition":2:{s:18:"' . chr(0) . '*' . chr(0) . 'fieldDefinition";r:22;s:13:"' . chr(0) . '*' . chr(0) . 'definition";a:2:{s:4:"type";s:19:"field_item:language";s:8:"settings";a:0:{}}}s:13:"' . chr(0) . '*' . chr(0) . 'definition";a:7:{s:5:"label";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:"' . chr(0) . '*' . chr(0) . 'string";s:8:"Language";s:12:"' . chr(0) . '*' . chr(0) . 'arguments";a:0:{}s:10:"' . chr(0) . '*' . chr(0) . 'options";a:0:{}}s:7:"display";a:2:{s:4:"view";a:1:{s:7:"options";a:1:{s:6:"region";s:6:"hidden";}}s:4:"form";a:1:{s:7:"options";a:2:{s:4:"type";s:15:"language_select";s:6:"weight";i:2;}}}s:12:"translatable";b:1;s:8:"provider";s:11:"sparql_test";s:10:"field_name";s:8:"langcode";s:11:"entity_type";s:11:"sparql_test";s:6:"bundle";N;}}s:4:"type";O:37:"Drupal\Core\Field\BaseFieldDefinition":5:{s:7:"' . chr(0) . '*' . chr(0) . 'type";s:16:"entity_reference";s:9:"' . chr(0) . '*' . chr(0) . 'schema";N;s:10:"' . chr(0) . '*' . chr(0) . 'indexes";a:0:{}s:17:"' . chr(0) . '*' . chr(0) . 'itemDefinition";O:51:"Drupal\Core\Field\TypedData\FieldItemDataDefinition":2:{s:18:"' . chr(0) . '*' . chr(0) . 'fieldDefinition";r:49;s:13:"' . chr(0) . '*' . chr(0) . 'definition";a:2:{s:4:"type";s:27:"field_item:entity_reference";s:8:"settings";a:3:{s:11:"target_type";s:16:"sparql_type_test";s:7:"handler";s:7:"default";s:16:"handler_settings";a:0:{}}}}s:13:"' . chr(0) . '*' . chr(0) . 'definition";a:7:{s:5:"label";s:21:"Testing bundle entity";s:8:"required";b:1;s:9:"read-only";b:1;s:8:"provider";s:11:"sparql_test";s:10:"field_name";s:4:"type";s:11:"entity_type";s:11:"sparql_test";s:6:"bundle";N;}}s:5:"title";O:37:"Drupal\Core\Field\BaseFieldDefinition":5:{s:7:"' . chr(0) . '*' . chr(0) . 'type";s:6:"string";s:9:"' . chr(0) . '*' . chr(0) . 'schema";N;s:10:"' . chr(0) . '*' . chr(0) . 'indexes";a:0:{}s:17:"' . chr(0) . '*' . chr(0) . 'itemDefinition";O:51:"Drupal\Core\Field\TypedData\FieldItemDataDefinition":2:{s:18:"' . chr(0) . '*' . chr(0) . 'fieldDefinition";r:69;s:13:"' . chr(0) . '*' . chr(0) . 'definition";a:2:{s:4:"type";s:17:"field_item:string";s:8:"settings";a:3:{s:10:"max_length";i:255;s:8:"is_ascii";b:0;s:14:"case_sensitive";b:0;}}}s:13:"' . chr(0) . '*' . chr(0) . 'definition";a:7:{s:5:"label";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:"' . chr(0) . '*' . chr(0) . 'string";s:5:"Title";s:12:"' . chr(0) . '*' . chr(0) . 'arguments";a:0:{}s:10:"' . chr(0) . '*' . chr(0) . 'options";a:0:{}}s:12:"translatable";b:1;s:8:"required";b:1;s:8:"provider";s:11:"sparql_test";s:10:"field_name";s:5:"title";s:11:"entity_type";s:11:"sparql_test";s:6:"bundle";N;}}s:7:"created";O:37:"Drupal\Core\Field\BaseFieldDefinition":5:{s:7:"' . chr(0) . '*' . chr(0) . 'type";s:7:"created";s:9:"' . chr(0) . '*' . chr(0) . 'schema";N;s:10:"' . chr(0) . '*' . chr(0) . 'indexes";a:0:{}s:17:"' . chr(0) . '*' . chr(0) . 'itemDefinition";O:51:"Drupal\Core\Field\TypedData\FieldItemDataDefinition":2:{s:18:"' . chr(0) . '*' . chr(0) . 'fieldDefinition";r:92;s:13:"' . chr(0) . '*' . chr(0) . 'definition";a:2:{s:4:"type";s:18:"field_item:created";s:8:"settings";a:0:{}}}s:13:"' . chr(0) . '*' . chr(0) . 'definition";a:5:{s:5:"label";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:"' . chr(0) . '*' . chr(0) . 'string";s:11:"Authored on";s:12:"' . chr(0) . '*' . chr(0) . 'arguments";a:0:{}s:10:"' . chr(0) . '*' . chr(0) . 'options";a:0:{}}s:8:"provider";s:11:"sparql_test";s:10:"field_name";s:7:"created";s:11:"entity_type";s:11:"sparql_test";s:6:"bundle";N;}}s:7:"changed";O:37:"Drupal\Core\Field\BaseFieldDefinition":5:{s:7:"' . chr(0) . '*' . chr(0) . 'type";s:7:"changed";s:9:"' . chr(0) . '*' . chr(0) . 'schema";N;s:10:"' . chr(0) . '*' . chr(0) . 'indexes";a:0:{}s:17:"' . chr(0) . '*' . chr(0) . 'itemDefinition";O:51:"Drupal\Core\Field\TypedData\FieldItemDataDefinition":2:{s:18:"' . chr(0) . '*' . chr(0) . 'fieldDefinition";r:110;s:13:"' . chr(0) . '*' . chr(0) . 'definition";a:2:{s:4:"type";s:18:"field_item:changed";s:8:"settings";a:0:{}}}s:13:"' . chr(0) . '*' . chr(0) . 'definition";a:5:{s:5:"label";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:"' . chr(0) . '*' . chr(0) . 'string";s:7:"Changed";s:12:"' . chr(0) . '*' . chr(0) . 'arguments";a:0:{}s:10:"' . chr(0) . '*' . chr(0) . 'options";a:0:{}}s:8:"provider";s:11:"sparql_test";s:10:"field_name";s:7:"changed";s:11:"entity_type";s:11:"sparql_test";s:6:"bundle";N;}}s:16:"default_langcode";O:37:"Drupal\Core\Field\BaseFieldDefinition":5:{s:7:"' . chr(0) . '*' . chr(0) . 'type";s:7:"boolean";s:9:"' . chr(0) . '*' . chr(0) . 'schema";N;s:10:"' . chr(0) . '*' . chr(0) . 'indexes";a:0:{}s:17:"' . chr(0) . '*' . chr(0) . 'itemDefinition";O:51:"Drupal\Core\Field\TypedData\FieldItemDataDefinition":2:{s:18:"' . chr(0) . '*' . chr(0) . 'fieldDefinition";r:128;s:13:"' . chr(0) . '*' . chr(0) . 'definition";a:2:{s:4:"type";s:18:"field_item:boolean";s:8:"settings";a:2:{s:8:"on_label";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:"' . chr(0) . '*' . chr(0) . 'string";s:2:"On";s:12:"' . chr(0) . '*' . chr(0) . 'arguments";a:0:{}s:10:"' . chr(0) . '*' . chr(0) . 'options";a:0:{}}s:9:"off_label";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:"' . chr(0) . '*' . chr(0) . 'string";s:3:"Off";s:12:"' . chr(0) . '*' . chr(0) . 'arguments";a:0:{}s:10:"' . chr(0) . '*' . chr(0) . 'options";a:0:{}}}}}s:13:"' . chr(0) . '*' . chr(0) . 'definition";a:9:{s:5:"label";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:"' . chr(0) . '*' . chr(0) . 'string";s:19:"Default translation";s:12:"' . chr(0) . '*' . chr(0) . 'arguments";a:0:{}s:10:"' . chr(0) . '*' . chr(0) . 'options";a:0:{}}s:11:"description";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:"' . chr(0) . '*' . chr(0) . 'string";s:58:"A flag indicating whether this is the default translation.";s:12:"' . chr(0) . '*' . chr(0) . 'arguments";a:0:{}s:10:"' . chr(0) . '*' . chr(0) . 'options";a:0:{}}s:12:"translatable";b:1;s:12:"revisionable";b:1;s:13:"default_value";a:1:{i:0;a:1:{s:5:"value";b:1;}}s:8:"provider";s:11:"sparql_test";s:10:"field_name";s:16:"default_langcode";s:11:"entity_type";s:11:"sparql_test";s:6:"bundle";N;}}s:5:"graph";O:37:"Drupal\Core\Field\BaseFieldDefinition":5:{s:7:"' . chr(0) . '*' . chr(0) . 'type";s:16:"entity_reference";s:9:"' . chr(0) . '*' . chr(0) . 'schema";N;s:10:"' . chr(0) . '*' . chr(0) . 'indexes";a:0:{}s:17:"' . chr(0) . '*' . chr(0) . 'itemDefinition";O:51:"Drupal\Core\Field\TypedData\FieldItemDataDefinition":2:{s:18:"' . chr(0) . '*' . chr(0) . 'fieldDefinition";r:163;s:13:"' . chr(0) . '*' . chr(0) . 'definition";a:2:{s:4:"type";s:27:"field_item:entity_reference";s:8:"settings";a:3:{s:11:"target_type";s:12:"sparql_graph";s:7:"handler";s:7:"default";s:16:"handler_settings";a:0:{}}}}s:13:"' . chr(0) . '*' . chr(0) . 'definition";a:6:{s:10:"field_name";s:5:"graph";s:5:"label";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:"' . chr(0) . '*' . chr(0) . 'string";s:37:"The graph where the entity is stored.";s:12:"' . chr(0) . '*' . chr(0) . 'arguments";a:0:{}s:10:"' . chr(0) . '*' . chr(0) . 'options";a:0:{}}s:11:"entity_type";s:11:"sparql_test";s:14:"custom_storage";b:1;s:8:"provider";s:11:"sparql_test";s:6:"bundle";N;}}}',
  ])
  ->values([
    'collection' => 'entity.definitions.installed',
    'name' => 'sparql_type_test.entity_type',
    'value' => 'O:42:"Drupal\Core\Config\Entity\ConfigEntityType":43:{s:16:"' . chr(0) . '*' . chr(0) . 'config_prefix";s:4:"type";s:15:"' . chr(0) . '*' . chr(0) . 'static_cache";b:0;s:14:"' . chr(0) . '*' . chr(0) . 'lookup_keys";a:1:{i:0;s:4:"uuid";}s:16:"' . chr(0) . '*' . chr(0) . 'config_export";a:2:{i:0;s:2:"id";i:1;s:4:"name";}s:21:"' . chr(0) . '*' . chr(0) . 'mergedConfigExport";a:0:{}s:15:"' . chr(0) . '*' . chr(0) . 'render_cache";b:1;s:19:"' . chr(0) . '*' . chr(0) . 'persistent_cache";b:1;s:14:"' . chr(0) . '*' . chr(0) . 'entity_keys";a:8:{s:2:"id";s:2:"id";s:5:"label";s:4:"name";s:8:"revision";s:0:"";s:6:"bundle";s:0:"";s:8:"langcode";s:8:"langcode";s:16:"default_langcode";s:16:"default_langcode";s:29:"revision_translation_affected";s:29:"revision_translation_affected";s:4:"uuid";s:4:"uuid";}s:5:"' . chr(0) . '*' . chr(0) . 'id";s:16:"sparql_type_test";s:16:"' . chr(0) . '*' . chr(0) . 'originalClass";s:40:"Drupal\sparql_test\Entity\SparqlTypeTest";s:11:"' . chr(0) . '*' . chr(0) . 'handlers";a:2:{s:6:"access";s:45:"Drupal\Core\Entity\EntityAccessControlHandler";s:7:"storage";s:45:"Drupal\Core\Config\Entity\ConfigEntityStorage";}s:19:"' . chr(0) . '*' . chr(0) . 'admin_permission";N;s:25:"' . chr(0) . '*' . chr(0) . 'permission_granularity";s:11:"entity_type";s:8:"' . chr(0) . '*' . chr(0) . 'links";a:0:{}s:21:"' . chr(0) . '*' . chr(0) . 'bundle_entity_type";N;s:12:"' . chr(0) . '*' . chr(0) . 'bundle_of";s:11:"sparql_test";s:15:"' . chr(0) . '*' . chr(0) . 'bundle_label";N;s:13:"' . chr(0) . '*' . chr(0) . 'base_table";N;s:22:"' . chr(0) . '*' . chr(0) . 'revision_data_table";N;s:17:"' . chr(0) . '*' . chr(0) . 'revision_table";N;s:13:"' . chr(0) . '*' . chr(0) . 'data_table";N;s:11:"' . chr(0) . '*' . chr(0) . 'internal";b:0;s:15:"' . chr(0) . '*' . chr(0) . 'translatable";b:0;s:19:"' . chr(0) . '*' . chr(0) . 'show_revision_ui";b:0;s:8:"' . chr(0) . '*' . chr(0) . 'label";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:"' . chr(0) . '*' . chr(0) . 'string";s:21:"Testing bundle entity";s:12:"' . chr(0) . '*' . chr(0) . 'arguments";a:0:{}s:10:"' . chr(0) . '*' . chr(0) . 'options";a:0:{}}s:19:"' . chr(0) . '*' . chr(0) . 'label_collection";s:0:"";s:17:"' . chr(0) . '*' . chr(0) . 'label_singular";s:0:"";s:15:"' . chr(0) . '*' . chr(0) . 'label_plural";s:0:"";s:14:"' . chr(0) . '*' . chr(0) . 'label_count";a:0:{}s:15:"' . chr(0) . '*' . chr(0) . 'uri_callback";N;s:8:"' . chr(0) . '*' . chr(0) . 'group";s:13:"configuration";s:14:"' . chr(0) . '*' . chr(0) . 'group_label";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:"' . chr(0) . '*' . chr(0) . 'string";s:13:"Configuration";s:12:"' . chr(0) . '*' . chr(0) . 'arguments";a:0:{}s:10:"' . chr(0) . '*' . chr(0) . 'options";a:1:{s:7:"context";s:17:"Entity type group";}}s:22:"' . chr(0) . '*' . chr(0) . 'field_ui_base_route";N;s:26:"' . chr(0) . '*' . chr(0) . 'common_reference_target";b:0;s:22:"' . chr(0) . '*' . chr(0) . 'list_cache_contexts";a:0:{}s:18:"' . chr(0) . '*' . chr(0) . 'list_cache_tags";a:1:{i:0;s:28:"config:sparql_type_test_list";}s:14:"' . chr(0) . '*' . chr(0) . 'constraints";a:0:{}s:13:"' . chr(0) . '*' . chr(0) . 'additional";a:0:{}s:8:"' . chr(0) . '*' . chr(0) . 'class";s:40:"Drupal\sparql_test\Entity\SparqlTypeTest";s:11:"' . chr(0) . '*' . chr(0) . 'provider";s:11:"sparql_test";s:14:"' . chr(0) . '*' . chr(0) . '_serviceIds";a:0:{}s:18:"' . chr(0) . '*' . chr(0) . '_entityStorages";a:0:{}s:20:"' . chr(0) . '*' . chr(0) . 'stringTranslation";N;}',
  ])
  ->execute();