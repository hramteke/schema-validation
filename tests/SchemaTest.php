<?php

namespace Opis\JsonSchema\Test;

use Opis\JsonSchema\Schema;
use Opis\JsonSchema\Validator;
use PHPUnit\Framework\TestCase;

class SchemaTest extends TestCase {

  public function testSchema() {
    $data = <<<'JSON'
{
    "name": "John Doe",
    "age": 31,
    "email": "john@example.com",
    "website": null,
    "location": {
        "country": "US",
        "address": "Sesame Street, no. 5"
    },
    "available_for_hire": true,
    "interests": ["php", "html", "css", "javascript", "programming", "web design"],
    "skills": [
        {
            "name": "HTML",
            "value": 100
        },
        {
            "name": "PHP",
            "value": 55
        },
        {
            "name": "CSS",
            "value": 99.5
        },
        {
            "name": "JavaScript",
            "value": 75
        }
    ]
}
JSON;
    $data   = json_decode($data);
    $schema = Schema::fromJsonString(file_get_contents('./schema/test-schema-data.json'));

    $validator = new Validator();


    $result = $validator->schemaValidation($data, $schema);

    $this->assertTrue($result->isValid());
    if ($result->isValid()) {
      echo '$data is valid', PHP_EOL;
    } else {

      $error = $result->getFirstError();
      echo '$data is invalid', PHP_EOL;
      echo "Error: ", $error->keyword(), PHP_EOL;
      echo json_encode($error->keywordArgs(), JSON_PRETTY_PRINT), PHP_EOL;

    }
  }

}




