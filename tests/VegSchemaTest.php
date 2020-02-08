<?php

use Opis\JsonSchema\Schema;
use Opis\JsonSchema\Validator;
use PHPUnit\Framework\TestCase;

class EnumTest extends TestCase {
  public function testVegSchema(): void {
    $data = <<<JSON
{
  "fruits": [ "apple", "orange", "pear" ],
  "vegetables": [
    {
      "veggieName": "potato",
      "veggieLike": true
    },
    {
      "veggieName": "broccoli",
      "veggieLike": false
    }
  ]
}
JSON;
    $data = json_decode($data);
    $schema = Schema::fromJsonString(file_get_contents("./schema/veg-schema.json"));

    $validator = new Validator();
    $result = $validator->schemaValidation($data, $schema);

    $this->assertTrue($result->isValid());

  }
}