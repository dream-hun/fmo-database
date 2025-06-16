<?php

declare(strict_types=1);

namespace App\Models\Traits;

use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use SpreadsheetReader;

trait CsvImport
{
    /**
     * @throws Exception
     */
    public function processCsvImport(Request $request): object
    {
        $config = $this->extractImportConfig($request);
        $data = $this->readCsvData($config);
        $this->insertDataInBatches($data, $config['model']);
        $this->cleanupAndFlashMessage($config, count($data));

        return redirect($request->input('redirect'));
    }

    /**
     * @throws Exception
     */
    public function parseCsvImport(Request $request): View|Factory|\Illuminate\View\View
    {
        $this->validateCsvFile($request);

        $parseConfig = $this->extractParseConfig($request);
        $csvData = $this->extractCsvPreview($parseConfig);
        $viewData = $this->prepareViewData($parseConfig, $csvData, $request);

        return view('csvImport.parseInput', $viewData);
    }

    /**
     * Extract configuration from request
     */
    private function extractImportConfig(Request $request): array
    {
        $filename = $request->input('filename', false);
        $path = storage_path('app/private/csv_import/'.$filename);
        $hasHeader = (bool) $request->input('hasHeader', false);
        $fields = array_flip(array_filter($request->input('fields', [])));
        $modelName = $request->input('modelName', false);
        $model = "App\Models\\".$modelName;

        return compact('filename', 'path', 'hasHeader', 'fields', 'modelName', 'model');
    }

    /**
     * Read and process CSV data
     *
     * @throws Exception
     */
    private function readCsvData(array $config): array
    {
        // Check if file exists and is readable
        if (! file_exists($config['path'])) {
            throw new Exception('SpreadsheetReader: File ('.$config['path'].') does not exist');
        }

        // Try to make the file readable if it's not
        if (! is_readable($config['path'])) {
            chmod($config['path'], 0644);

            // Check again after attempting to fix permissions
            if (! is_readable($config['path'])) {
                throw new Exception('SpreadsheetReader: File ('.$config['path'].') exists but is not readable. Please check file permissions.');
            }
        }

        $reader = new SpreadsheetReader($config['path']);
        $data = [];

        foreach ($reader as $key => $row) {
            if ($this->shouldSkipRow($key, $config['hasHeader'])) {
                continue;
            }

            $processedRow = $this->processRow($row, $config['fields']);

            if ($this->isValidRow($processedRow)) {
                $data[] = $processedRow;
            }
        }

        return $data;
    }

    /**
     * Check if row should be skipped
     */
    private function shouldSkipRow(int $key, bool $hasHeader): bool
    {
        return $hasHeader && $key === 0;
    }

    /**
     * Process a single row
     */
    private function processRow(array $row, array $fields): array
    {
        $processedRow = [];

        foreach ($fields as $header => $columnIndex) {
            if (isset($row[$columnIndex])) {
                $processedRow[$header] = $row[$columnIndex];
            }
        }

        return $processedRow;
    }

    /**
     * Check if processed row is valid (not empty)
     */
    private function isValidRow(array $processedRow): bool
    {
        return count($processedRow) > 0 && count(array_filter($processedRow, fn ($value) => $value !== null && $value !== '')) > 0;
    }

    /**
     * Insert data in batches
     */
    private function insertDataInBatches(array $data, string $model): void
    {
        $batches = array_chunk($data, 100);

        foreach ($batches as $batch) {
            $model::insert($batch);
        }
    }

    /**
     * Cleanup file and flash success message
     */
    private function cleanupAndFlashMessage(array $config, int $rowCount): void
    {
        File::delete($config['path']);

        $table = Str::plural($config['modelName']);
        session()->flash('message', trans('global.app_imported_rows_to_table', [
            'rows' => $rowCount,
            'table' => $table,
        ]));
    }

    /**
     * Validate uploaded CSV file
     */
    private function validateCsvFile(Request $request): void
    {
        $request->validate([
            'csv_file' => 'mimes:csv,txt',
        ]);
    }

    /**
     * Extract parsing configuration
     */
    private function extractParseConfig(Request $request): array
    {
        $file = $request->file('csv_file');
        $path = $file->path();
        $hasHeader = (bool) $request->input('header', false);
        $filename = Str::random(10).'.csv';

        $file->storeAs('csv_import', $filename);

        return compact('file', 'path', 'hasHeader', 'filename');
    }

    /**
     * Extract CSV preview data
     *
     * @throws Exception
     */
    private function extractCsvPreview(array $config): array
    {
        // Check if file exists and is readable
        if (! file_exists($config['path'])) {
            throw new Exception('SpreadsheetReader: File ('.$config['path'].') does not exist');
        }

        // Try to make the file readable if it's not
        if (! is_readable($config['path'])) {
            chmod($config['path'], 0644);

            // Check again after attempting to fix permissions
            if (! is_readable($config['path'])) {
                throw new Exception('SpreadsheetReader: File ('.$config['path'].') exists but is not readable. Please check file permissions.');
            }
        }

        $reader = new SpreadsheetReader($config['path']);
        $headers = $reader->current();
        $lines = [];

        // If file doesn't have a header row, include the first row in the preview data
        if (! $config['hasHeader']) {
            $lines[] = $headers;
        }

        $previewCount = 0;
        while ($reader->next() !== false && $previewCount < 5) {
            $lines[] = $reader->current();
            $previewCount++;
        }

        return compact('headers', 'lines');
    }

    /**
     * Prepare data for view
     */
    private function prepareViewData(array $parseConfig, array $csvData, Request $request): array
    {
        $modelName = $request->input('model', false);
        $fullModelName = "App\Models\\".$modelName;

        $model = new $fullModelName();
        $fillables = $model->getFillable();

        $redirect = url()->previous();
        $routeName = 'admin.'.mb_strtolower(Str::plural(Str::kebab($modelName))).'.processCsvImport';

        return array_merge($csvData, [
            'filename' => $parseConfig['filename'],
            'fillables' => $fillables,
            'hasHeader' => $parseConfig['hasHeader'],
            'modelName' => $modelName,
            'redirect' => $redirect,
            'routeName' => $routeName,
        ]);
    }
}
