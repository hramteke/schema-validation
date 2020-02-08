<?php

use Opis\JsonSchema\Schema;
use Opis\JsonSchema\Validator;
use PHPUnit\Framework\TestCase;

class UserSchemaTest extends TestCase {
  public function testUserInfo() {
    $data = <<<'JSON'
{
  "name": "First Last",
  "email": "test@test.com",
  "age": 30
}
JSON;

    $data = json_decode($data);
    $schema = Schema::fromJsonString(file_get_contents("./schema/user-schema.json"));
    $validator = new Validator();

    $result = $validator->schemaValidation($data, $schema);

    $this->assertTrue($result->isValid());

  }

  public function testInvalidUserInfo() {
    $data = <<<'JSON'
{
  "name": "First Last",
  "age": 30
}
JSON;

    $data = json_decode($data);
    $schema = Schema::fromJsonString(file_get_contents("./schema/user-schema.json"));
    $validator = new Validator();

    $result = $validator->schemaValidation($data, $schema);

    $this->assertFalse($result->isValid());

  }
}