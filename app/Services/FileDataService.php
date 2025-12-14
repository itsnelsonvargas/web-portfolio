<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class FileDataService
{
    protected $dataPath;

    public function __construct()
    {
        $this->dataPath = base_path('data');
    }

    /**
     * Read data from a JSON file
     */
    public function read(string $filename): Collection
    {
        $filePath = $this->dataPath . '/' . $filename;

        if (!file_exists($filePath)) {
            return collect();
        }

        $data = json_decode(file_get_contents($filePath), true);

        // Handle single object (like profile) vs array of objects
        if ($this->isAssociativeArray($data)) {
            return collect([$data]);
        }

        return collect($data ?? []);
    }

    /**
     * Write data to a JSON file
     */
    public function write(string $filename, $data): bool
    {
        $filePath = $this->dataPath . '/' . $filename;

        // Ensure directory exists
        $directory = dirname($filePath);
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        // Convert to array if it's a single object
        if (is_object($data)) {
            $data = [$data];
        } elseif (!is_array($data)) {
            $data = [$data];
        }

        $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        $result = file_put_contents($filePath, $json);

        // Clear any cached data
        Cache::forget("file_data_{$filename}");

        return $result !== false;
    }

    /**
     * Get a single record by ID
     */
    public function find(string $filename, $id): ?array
    {
        return $this->read($filename)->firstWhere('id', $id);
    }

    /**
     * Get the first record (useful for profile)
     */
    public function first(string $filename): ?array
    {
        return $this->read($filename)->first();
    }

    /**
     * Update a record
     */
    public function update(string $filename, $id, array $data): bool
    {
        $records = $this->read($filename);

        $updated = false;
        $records = $records->map(function ($record) use ($id, $data, &$updated) {
            if ($record['id'] == $id) {
                $record = array_merge($record, $data);
                $updated = true;
            }
            return $record;
        });

        if ($updated) {
            return $this->write($filename, $records->toArray());
        }

        return false;
    }

    /**
     * Create a new record
     */
    public function create(string $filename, array $data): bool
    {
        $records = $this->read($filename)->toArray();

        // Generate ID if not provided
        if (!isset($data['id'])) {
            $maxId = collect($records)->max('id') ?? 0;
            $data['id'] = $maxId + 1;
        }

        // Add timestamps
        $data['created_at'] = now()->toISOString();
        $data['updated_at'] = now()->toISOString();

        $records[] = $data;

        return $this->write($filename, $records);
    }

    /**
     * Delete a record
     */
    public function delete(string $filename, $id): bool
    {
        $records = $this->read($filename)->filter(function ($record) use ($id) {
            return $record['id'] != $id;
        });

        return $this->write($filename, $records->toArray());
    }

    /**
     * Get data with caching
     */
    public function readCached(string $filename, int $minutes = 60): Collection
    {
        return Cache::remember("file_data_{$filename}", $minutes, function () use ($filename) {
            return $this->read($filename);
        });
    }

    /**
     * Process dates in data (convert date strings to Carbon instances)
     */
    public function processDates(Collection $data): Collection
    {
        return $data->map(function ($item) {
            foreach ($item as $key => $value) {
                if (in_array($key, ['started_at', 'ended_at', 'acquired_at', 'date', 'created_at', 'updated_at']) && $value) {
                    try {
                        $item[$key] = Carbon::parse($value);
                    } catch (\Exception $e) {
                        // Keep original value if parsing fails
                    }
                }
            }
            return $item;
        });
    }

    /**
     * Check if array is associative
     */
    private function isAssociativeArray($array): bool
    {
        if (!is_array($array)) {
            return false;
        }

        // Check if it's a single object (associative array) or array of objects
        return array_keys($array) !== range(0, count($array) - 1);
    }

    /**
     * Get file path for a given filename
     */
    public function getFilePath(string $filename): string
    {
        return $this->dataPath . '/' . $filename;
    }

    /**
     * Check if file exists
     */
    public function fileExists(string $filename): bool
    {
        return file_exists($this->getFilePath($filename));
    }
}
