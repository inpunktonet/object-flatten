<?php

namespace InPunktoNET\ObjectFlatten\Tests;

use InPunktoNET\ObjectFlatten\ObjectFlattenClass;
use PHPUnit\Framework\TestCase;

class FlattenTest extends TestCase
{
    private $testData = [
        'keySeparator' => '_',
        'columnDelimiter' => '\t',
    ];

    /**
     * Test flatten object
     *
     * @return void
     */
    public function testToFlattenString(): void
    {
        $objectFlatten = new ObjectFlattenClass();
        $objectFlatten->setColumnDelemiter($this->testData['columnDelimiter']);
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

        $expectedCsv = "company".$this->testData['keySeparator']."name".$this->testData['columnDelimiter']."InPunktoNET\ncompany".$this->testData['keySeparator']."depth".$this->testData['keySeparator']."level".$this->testData['columnDelimiter']."1\ncompany".$this->testData['keySeparator']."depth".$this->testData['keySeparator']."level2".$this->testData['keySeparator']."level3".$this->testData['columnDelimiter']."3\n";

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
        $objectFlatten->setColumnDelemiter($this->testData['columnDelimiter']);
        $objectFlatten->setKeySeparator($this->testData['keySeparator']);
        $flattenedStrings = [
            "company".$this->testData['keySeparator']."name".$this->testData['columnDelimiter']."InPunktoNET",
            "company".$this->testData['keySeparator']."depth".$this->testData['keySeparator']."level".$this->testData['columnDelimiter']."1",
            "company".$this->testData['keySeparator']."depth".$this->testData['keySeparator']."level2".$this->testData['keySeparator']."level3".$this->testData['columnDelimiter']."3",
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