<?php

namespace Drupal\sparql_entity_storage\Entity\Query\Sparql;

use Drupal\Core\Entity\Query\ConditionInterface;

/**
 * Defines the entity query condition interface for SPARQL.
 */
interface SparqlConditionInterface extends ConditionInterface {

  /**
   * A list of allowed operators for the id and bundle key.
   */
  const ID_BUNDLE_ALLOWED_OPERATORS = [
    '=',
    '!=',
    '<',
    '>',
    '<=',
    '>=',
    '<>',
    'IN',
    'NOT IN',
  ];

  /**
   * The subject variable name.
   */
  const ID_KEY = '?entity';

  /**
   * Handle the id and bundle keys.
   *
   * @param string $field
   *   The field name. Should be either the id or the bundle key.
   * @param array $value
   *   A string or an array of strings.
   * @param string $operator
   *   The operator.
   *
   * @return \Drupal\sparql_entity_storage\Entity\Query\Sparql\SparqlConditionInterface
   *   The current object.
   *
   * @throws \Exception
   *    Thrown if the value is NULL or the operator is not allowed.
   */
  public function keyCondition(string $field, array $value, string $operator): self;

  /**
   * Adds a mapping requirement to the condition list.
   *
   * The field mapping requirement can be used either to add a field with
   * multiple mappings or external requirements like a mapping for sort or group
   * arguments.
   *
   * @param string $entity_type_id
   *   The entity type id.
   * @param string $field
   *   The field name.
   * @param string $column
   *   (optional) The field column. If empty, the main property will be used.
   */
  public function addFieldMappingRequirement(string $entity_type_id, string $field, string $column = NULL): void;

  /**
   * Returns the string version of the conditions.
   *
   * @return string
   *   The string version of the conditions.
   */
  public function toString(): string;

}
