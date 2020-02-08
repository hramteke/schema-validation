<?php

use Opis\JsonSchema\Schema;
use Opis\JsonSchema\Validator;
use PHPUnit\Framework\TestCase;

class ListValidationTest extends TestCase {
  public function testIsArray() {
    $data = <<<JSON
[1, "a"]
JSON;

    $data = json_decode($data);
    $schema = Schema::fromJsonString(file_get_contents("./schema/list-validation-schema.json"));

    $validator = new Validator();
    $result = $validator->schemaValidation($data, $schema);
    $this->assertTrue($result->isValid());

    $data = <<<JSON
[1]
JSON;

    $result = $validator->schemaValidation($data, $schema);
    $this->assertFalse($result->isValid());
  }
}