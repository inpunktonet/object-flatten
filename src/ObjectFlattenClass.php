<?php

namespace InPunktoNET\ObjectFlatten;

class ObjectFlattenClass
{
    private $keyValueSeparator = ';';

    private $keySeparator = '.';

    /**
     * Convert an array to a flatten CSV string
     *
     * @param array|object $data
     *
     * @return string
     */
    public function toFlattenString(array|object $data): string
    {
        $output = '';
        $flatten = $this->flatten($data);

        foreach ($flatten as $key => $value) {
            $output .= $key.$this->keyValueSeparator.$value.PHP_EOL;
        }

        return $output;
    }

    /**
     * Convert an array of flatten strings to an array
     * @param array $flattenedStrings
     *
     * @return false|string
     */
    public function toObject(array $flattenedStrings): string
    {
        $result = [];

        foreach ($flattenedStrings as $flattenedString) {
            if (str_contains($flattenedString, $this->keyValueSeparator) === false) {
                continue;
            }

            list($key, $value) = explode($this->keyValueSeparator, $flattenedString);

            $keys = explode($this->keySeparator, $key);
            $current = &$result;

            foreach ($keys as $k) {
                if (! isset($current[$k])) {
                    $current[$k] = [];
                }
                $current = &$current[$k];
            }

            $current = str_replace("\\".PHP_EOL, "\n", $value);
        }

        return json_encode($result);
    }

    /**
     * Set delemiter
     *
     * @param string $delemiter
     * @return ObjectFlattenClass
     */
    public function setkeyValueSeparator(string $delemiter): self
    {
        $this->keyValueSeparator = $delemiter;

        return $this;
    }

    /**
     * Set separator
     *
     * @param string $separator
     * @return ObjectFlattenClass
     */
    public function setKeySeparator(string $separator): self
    {
        $this->keySeparator = $separator;

        return $this;
    }

    /**
     * Flatten object
     *
     * @param array|object $data
     * @param string $prefix
     *
     * @return array
     */
    private function flatten(array|object $data, string $prefix = ''): array
    {
        $flatten = [];

        if (! is_array($data)) {
            $data = (array) $data;
        }

        foreach ($data as $key => $value) {
            $flattenKey = ltrim($prefix.$this->keySeparator.$key, $this->keySeparator);

            if (is_array($value) || is_object($value)) {
                $flatten = array_merge($flatten, $this->flatten($value, $flattenKey));

                continue;
            }

            $flatten[$flattenKey] = $value;
        }

        return $flatten;
    }
}
