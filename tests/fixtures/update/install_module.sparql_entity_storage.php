<?php

/**
 * @file
 * Installs sparql_entity_storage module for testing updates.
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
$extensions['module']['sparql_entity_storage'] = 0;
$db->update('config')
  ->fields(['data' => serialize($extensions)])
  ->condition('collection', '')
  ->condition('name', 'core.extension')
  ->execute();

$db->insert('config')
  ->fields([
    'collection' => '',
    'name' => 'sparql_entity_storage.graph.default',
    'data' => 'a:10:{s:4:"uuid";s:36:"223c4410-153d-4075-927a-3910b16bd920";s:8:"langcode";s:2:"en";s:6:"status";b:1;s:12:"dependencies";a:0:{}s:5:"_core";a:1:{s:19:"default_config_hash";s:43:"grIFHOqFY9LqIWajYHiqT8zA6dUz4WpTR9xnpefkmTM";}s:2:"id";s:7:"default";s:6:"weight";i:0;s:4:"name";s:7:"Default";s:11:"description";s:66:"Default graph. This is available for all entity types and bundles.";s:12:"entity_types";N;}',
  ])
  ->execute();

$db->insert('key_value')
  ->fields(['collection', 'name', 'value'])
  ->values([
    'collection' => 'system.schema',
    'name' => 'sparql_entity_storage',
    'value' => 'i:8000;',
  ])
  ->values([
    'collection' => 'entity.definitions.installed',
    'name' => 'sparql_graph.entity_type',
    'value' => 'O:42:"Drupal\Core\Config\Entity\ConfigEntityType":43:{s:16:"' . chr(0) . '*' . chr(0) . 'config_prefix";s:5:"graph";s:15:"' . chr(0) . '*' . chr(0) . 'static_cache";b:0;s:14:"' . chr(0) . '*' . chr(0) . 'lookup_keys";a:1:{i:0;s:4:"uuid";}s:16:"' . chr(0) . '*' . chr(0) . 'config_export";a:5:{i:0;s:2:"id";i:1;s:6:"weight";i:2;s:4:"name";i:3;s:11:"description";i:4;s:12:"entity_types";}s:21:"' . chr(0) . '*' . chr(0) . 'mergedConfigExport";a:0:{}s:15:"' . chr(0) . '*' . chr(0) . 'render_cache";b:1;s:19:"' . chr(0) . '*' . chr(0) . 'persistent_cache";b:1;s:14:"' . chr(0) . '*' . chr(0) . 'entity_keys";a:10:{s:2:"id";s:2:"id";s:5:"label";s:4:"name";s:6:"status";s:6:"status";s:6:"weight";s:6:"weight";s:8:"revision";s:0:"";s:6:"bundle";s:0:"";s:8:"langcode";s:8:"langcode";s:16:"default_langcode";s:16:"default_langcode";s:29:"revision_translation_affected";s:29:"revision_translation_affected";s:4:"uuid";s:4:"uuid";}s:5:"' . chr(0) . '*' . chr(0) . 'id";s:12:"sparql_graph";s:16:"' . chr(0) . '*' . chr(0) . 'originalClass";s:47:"Drupal\sparql_entity_storage\Entity\SparqlGraph";s:11:"' . chr(0) . '*' . chr(0) . 'handlers";a:4:{s:6:"access";s:60:"Drupal\sparql_entity_storage\SparqlGraphAccessControlHandler";s:4:"form";a:3:{s:3:"add";s:49:"Drupal\sparql_entity_storage\Form\SparqlGraphForm";s:4:"edit";s:49:"Drupal\sparql_entity_storage\Form\SparqlGraphForm";s:6:"delete";s:35:"Drupal\Core\Entity\EntityDeleteForm";}s:12:"list_builder";s:51:"Drupal\sparql_entity_storage\SparqlGraphListBuilder";s:7:"storage";s:45:"Drupal\Core\Config\Entity\ConfigEntityStorage";}s:19:"' . chr(0) . '*' . chr(0) . 'admin_permission";s:29:"administer site configuration";s:25:"' . chr(0) . '*' . chr(0) . 'permission_granularity";s:11:"entity_type";s:8:"' . chr(0) . '*' . chr(0) . 'links";a:5:{s:9:"edit-form";s:48:"/admin/config/sparql/graph/manage/{sparql_graph}";s:11:"delete-form";s:55:"/admin/config/sparql/graph/manage/{sparql_graph}/delete";s:10:"collection";s:26:"/admin/config/sparql/graph";s:6:"enable";s:55:"/admin/config/sparql/graph/manage/{sparql_graph}/enable";s:7:"disable";s:56:"/admin/config/sparql/graph/manage/{sparql_graph}/disable";}s:21:"' . chr(0) . '*' . chr(0) . 'bundle_entity_type";N;s:12:"' . chr(0) . '*' . chr(0) . 'bundle_of";N;s:15:"' . chr(0) . '*' . chr(0) . 'bundle_label";N;s:13:"' . chr(0) . '*' . chr(0) . 'base_table";N;s:22:"' . chr(0) . '*' . chr(0) . 'revision_data_table";N;s:17:"' . chr(0) . '*' . chr(0) . 'revision_table";N;s:13:"' . chr(0) . '*' . chr(0) . 'data_table";N;s:11:"' . chr(0) . '*' . chr(0) . 'internal";b:0;s:15:"' . chr(0) . '*' . chr(0) . 'translatable";b:0;s:19:"' . chr(0) . '*' . chr(0) . 'show_revision_ui";b:0;s:8:"' . chr(0) . '*' . chr(0) . 'label";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:"' . chr(0) . '*' . chr(0) . 'string";s:12:"SPARQL graph";s:12:"' . chr(0) . '*' . chr(0) . 'arguments";a:0:{}s:10:"' . chr(0) . '*' . chr(0) . 'options";a:0:{}}s:19:"' . chr(0) . '*' . chr(0) . 'label_collection";s:0:"";s:17:"' . chr(0) . '*' . chr(0) . 'label_singular";s:0:"";s:15:"' . chr(0) . '*' . chr(0) . 'label_plural";s:0:"";s:14:"' . chr(0) . '*' . chr(0) . 'label_count";a:0:{}s:15:"' . chr(0) . '*' . chr(0) . 'uri_callback";N;s:8:"' . chr(0) . '*' . chr(0) . 'group";s:13:"configuration";s:14:"' . chr(0) . '*' . chr(0) . 'group_label";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:"' . chr(0) . '*' . chr(0) . 'string";s:13:"Configuration";s:12:"' . chr(0) . '*' . chr(0) . 'arguments";a:0:{}s:10:"' . chr(0) . '*' . chr(0) . 'options";a:1:{s:7:"context";s:17:"Entity type group";}}s:22:"' . chr(0) . '*' . chr(0) . 'field_ui_base_route";N;s:26:"' . chr(0) . '*' . chr(0) . 'common_reference_target";b:0;s:22:"' . chr(0) . '*' . chr(0) . 'list_cache_contexts";a:0:{}s:18:"' . chr(0) . '*' . chr(0) . 'list_cache_tags";a:1:{i:0;s:24:"config:sparql_graph_list";}s:14:"' . chr(0) . '*' . chr(0) . 'constraints";a:0:{}s:13:"' . chr(0) . '*' . chr(0) . 'additional";a:0:{}s:8:"' . chr(0) . '*' . chr(0) . 'class";s:47:"Drupal\sparql_entity_storage\Entity\SparqlGraph";s:11:"' . chr(0) . '*' . chr(0) . 'provider";s:21:"sparql_entity_storage";s:14:"' . chr(0) . '*' . chr(0) . '_serviceIds";a:0:{}s:18:"' . chr(0) . '*' . chr(0) . '_entityStorages";a:0:{}s:20:"' . chr(0) . '*' . chr(0) . 'stringTranslation";N;}',
  ])
  ->values([
    'collection' => 'entity.definitions.installed',
    'name' => 'sparql_mapping.entity_type',
    'value' => 'O:42:"Drupal\Core\Config\Entity\ConfigEntityType":43:{s:16:"' . chr(0) . '*' . chr(0) . 'config_prefix";s:7:"mapping";s:15:"' . chr(0) . '*' . chr(0) . 'static_cache";b:0;s:14:"' . chr(0) . '*' . chr(0) . 'lookup_keys";a:1:{i:0;s:4:"uuid";}s:16:"' . chr(0) . '*' . chr(0) . 'config_export";a:7:{i:0;s:2:"id";i:1;s:14:"entity_type_id";i:2;s:6:"bundle";i:3;s:8:"rdf_type";i:4;s:5:"graph";i:5;s:19:"base_fields_mapping";i:6;s:16:"entity_id_plugin";}s:21:"' . chr(0) . '*' . chr(0) . 'mergedConfigExport";a:0:{}s:15:"' . chr(0) . '*' . chr(0) . 'render_cache";b:1;s:19:"' . chr(0) . '*' . chr(0) . 'persistent_cache";b:1;s:14:"' . chr(0) . '*' . chr(0) . 'entity_keys";a:8:{s:2:"id";s:2:"id";s:6:"status";s:6:"status";s:8:"revision";s:0:"";s:6:"bundle";s:0:"";s:8:"langcode";s:8:"langcode";s:16:"default_langcode";s:16:"default_langcode";s:29:"revision_translation_affected";s:29:"revision_translation_affected";s:4:"uuid";s:4:"uuid";}s:5:"' . chr(0) . '*' . chr(0) . 'id";s:14:"sparql_mapping";s:16:"' . chr(0) . '*' . chr(0) . 'originalClass";s:49:"Drupal\sparql_entity_storage\Entity\SparqlMapping";s:11:"' . chr(0) . '*' . chr(0) . 'handlers";a:2:{s:6:"access";s:45:"Drupal\Core\Entity\EntityAccessControlHandler";s:7:"storage";s:45:"Drupal\Core\Config\Entity\ConfigEntityStorage";}s:19:"' . chr(0) . '*' . chr(0) . 'admin_permission";N;s:25:"' . chr(0) . '*' . chr(0) . 'permission_granularity";s:11:"entity_type";s:8:"' . chr(0) . '*' . chr(0) . 'links";a:0:{}s:21:"' . chr(0) . '*' . chr(0) . 'bundle_entity_type";N;s:12:"' . chr(0) . '*' . chr(0) . 'bundle_of";N;s:15:"' . chr(0) . '*' . chr(0) . 'bundle_label";N;s:13:"' . chr(0) . '*' . chr(0) . 'base_table";N;s:22:"' . chr(0) . '*' . chr(0) . 'revision_data_table";N;s:17:"' . chr(0) . '*' . chr(0) . 'revision_table";N;s:13:"' . chr(0) . '*' . chr(0) . 'data_table";N;s:11:"' . chr(0) . '*' . chr(0) . 'internal";b:0;s:15:"' . chr(0) . '*' . chr(0) . 'translatable";b:0;s:19:"' . chr(0) . '*' . chr(0) . 'show_revision_ui";b:0;s:8:"' . chr(0) . '*' . chr(0) . 'label";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:"' . chr(0) . '*' . chr(0) . 'string";s:14:"SPARQL Mapping";s:12:"' . chr(0) . '*' . chr(0) . 'arguments";a:0:{}s:10:"' . chr(0) . '*' . chr(0) . 'options";a:0:{}}s:19:"' . chr(0) . '*' . chr(0) . 'label_collection";s:0:"";s:17:"' . chr(0) . '*' . chr(0) . 'label_singular";s:0:"";s:15:"' . chr(0) . '*' . chr(0) . 'label_plural";s:0:"";s:14:"' . chr(0) . '*' . chr(0) . 'label_count";a:0:{}s:15:"' . chr(0) . '*' . chr(0) . 'uri_callback";N;s:8:"' . chr(0) . '*' . chr(0) . 'group";s:13:"configuration";s:14:"' . chr(0) . '*' . chr(0) . 'group_label";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:"' . chr(0) . '*' . chr(0) . 'string";s:13:"Configuration";s:12:"' . chr(0) . '*' . chr(0) . 'arguments";a:0:{}s:10:"' . chr(0) . '*' . chr(0) . 'options";a:1:{s:7:"context";s:17:"Entity type group";}}s:22:"' . chr(0) . '*' . chr(0) . 'field_ui_base_route";N;s:26:"' . chr(0) . '*' . chr(0) . 'common_reference_target";b:0;s:22:"' . chr(0) . '*' . chr(0) . 'list_cache_contexts";a:0:{}s:18:"' . chr(0) . '*' . chr(0) . 'list_cache_tags";a:1:{i:0;s:26:"config:sparql_mapping_list";}s:14:"' . chr(0) . '*' . chr(0) . 'constraints";a:0:{}s:13:"' . chr(0) . '*' . chr(0) . 'additional";a:0:{}s:8:"' . chr(0) . '*' . chr(0) . 'class";s:49:"Drupal\sparql_entity_storage\Entity\SparqlMapping";s:11:"' . chr(0) . '*' . chr(0) . 'provider";s:21:"sparql_entity_storage";s:14:"' . chr(0) . '*' . chr(0) . '_serviceIds";a:0:{}s:18:"' . chr(0) . '*' . chr(0) . '_entityStorages";a:0:{}s:20:"' . chr(0) . '*' . chr(0) . 'stringTranslation";N;}',
  ])
  ->execute();
