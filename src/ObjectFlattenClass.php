<?php

namespace InPunktoNET\ObjectFlatten;

class ObjectFlattenClass
{
    private $columnDelemiter = ';';

    private $keySeparator = '.';

    /**
     * Convert an array or object to a flatten CSV string
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
            $output .= $key.$this->columnDelemiter.$value.PHP_EOL;
        }

        return $output;
    }

    /**
     * Convert an array of flatten strings to an object
     * @param $flattenedStrings
     *
     * @return false|string
     */
    public function toObject($flattenedStrings): string
    {
        $result = [];

        foreach ($flattenedStrings as $flattenedString) {
            if (str_contains($flattenedString, $this->columnDelemiter) === false) {
                continue;
            }

            list($key, $value) = explode($this->columnDelemiter, $flattenedString);

            $keys = explode($this->keySeparator, $key);
            $current = &$result;

            foreach ($keys as $k) {
                if (! isset($current[$k])) {
                    $current[$k] = [];
                }
                $current = &$current[$k];
            }

            $current = str_replace("\\n", "\n", $value);
        }

        return json_encode($result);
    }

    /**
     * Set delemiter
     *
     * @param string $delemiter
     * @return ObjectFlattenClass
     */
    public function setColumnDelemiter(string $delemiter): self
    {
        $this->columnDelemiter = $delemiter;

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
