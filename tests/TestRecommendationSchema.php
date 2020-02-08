<?php

use Opis\JsonSchema\Schema;
use Opis\JsonSchema\Validator;
use PHPUnit\Framework\TestCase;

class TestRecommendationSchema extends TestCase {
  public function testSchema() : void {
    $data = <<<'JSON'
{
  "$namespace": "wizards",
  "$resolutions": [
    "all-set",
    "change-shipping-address-or-info",
    "open-a-ticket",
    "internal-escalation-eu-only",
    "send-parts",
    "provide-repair",
    "provide-discount",
    "send-unit",
    "provide-refund",
    "return",
    "cancel",
    "warm-transfer"
  ],
  "$issues": {
    "wrong-product": {
      "$metrics": {}
    },
    "damage-and-defect": {
      "$metrics": ""
    },
    "wims": {
      "$metrics": {}
    }
  }
}
JSON;

    $data = json_decode($data);

    $schema = Schema::fromJsonString(file_get_contents("./schema/recommendation-schema.json"));
    $validator = new Validator();
    $result = $validator->schemaValidation($data, $schema);

    $this->assertTrue($result->isValid());
  }
}