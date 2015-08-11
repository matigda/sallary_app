<?php

namespace PayrollBundle\Service;


class CsvGenerator
{
    /**
     * Creates file in given path
     * If path does not exists - it creates directory
     * @param string $path
     * @param string $filename
     * @param array $csvData
     */
    public function createCsvFile($path, $filename, array $csvData)
    {
        $this->checkSchema($csvData);

        $headers = $csvData['headers'];

        if(!is_dir($path)) {
            mkdir($path);
        }

        $fullPath = $path . $filename;

        $handle = fopen($fullPath, 'w+');

        fputcsv($handle, $headers);

        foreach ($csvData['data'] as $row) {
            fputcsv($handle, $row);
        }

        fclose($handle);
    }

    private function checkSchema($data)
    {
        if(!isset($data['headers']) || !isset($data['data'])) {
            throw new \InvalidArgumentException('Data passed to createCsvFile method has to has "headers" and "data" keys.');
        }
    }

}