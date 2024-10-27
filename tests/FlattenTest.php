<?php

namespace InPunktoNET\ObjectFlatten\Tests;

use InPunktoNET\ObjectFlatten\ObjectFlattenClass;
use PHPUnit\Framework\TestCase;

class FlattenTest extends TestCase
{
    private $testData = [
        'keySeparator' => '_',
        'keyValueSeparator' => '\t',
    ];

    /**
     * Test flatten object
     *
     * @return void
     */
    public function testToFlattenString(): void
    {
        $objectFlatten = new ObjectFlattenClass();
        $objectFlatten->setKeyValueSeparator($this->testData['keyValueSeparator']);
        $objectFlatten->setKeySeparator($this->testData['keySeparator']);

        $data = [
            'company' => [
                'name' => 'InPunktoNET',
                'depth' => [
                    'level' => 1,
                    'level2' => [
                        'level3' => 3,
                    ],
                ],
            ],
        ];

        $expectedCsv = "company".$this->testData['keySeparator']."name".$this->testData['keyValueSeparator']."InPunktoNET".PHP_EOL."company".$this->testData['keySeparator']."depth".$this->testData['keySeparator']."level".$this->testData['keyValueSeparator']."1".PHP_EOL."company".$this->testData['keySeparator']."depth".$this->testData['keySeparator']."level2".$this->testData['keySeparator']."level3".$this->testData['keyValueSeparator']."3".PHP_EOL;

        $this->assertEquals($expectedCsv, $objectFlatten->toFlattenString($data));
    }

    /**
     * Test unflatten
     *
     * @return void
     */
    public function testToObject(): void
    {
        $objectFlatten = new ObjectFlattenClass();
        $objectFlatten->setKeyValueSeparator($this->testData['keyValueSeparator']);
        $objectFlatten->setKeySeparator($this->testData['keySeparator']);
        $flattenedStrings = [
            "company".$this->testData['keySeparator']."name".$this->testData['keyValueSeparator']."InPunktoNET",
            "company".$this->testData['keySeparator']."depth".$this->testData['keySeparator']."level".$this->testData['keyValueSeparator']."1",
            "company".$this->testData['keySeparator']."depth".$this->testData['keySeparator']."level2".$this->testData['keySeparator']."level3".$this->testData['keyValueSeparator']."3",
        ];

        $expectedObject = json_encode([
            'company' => [
                'name' => 'InPunktoNET',
                'depth' => [
                    'level' => "1",
                    'level2' => [
                        'level3' => "3",
                    ],
                ],
            ],
        ]);

        $this->assertEquals($expectedObject, $objectFlatten->toObject($flattenedStrings));
    }
}
