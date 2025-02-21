<?php

namespace Illuminate\Support;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\File;
use Illuminate\Support\Collection;
use Stringable;

class UriPath implements Stringable, Arrayable
{
    const DELIMITER = '/';

    protected Collection $path;

    public function __construct(string|array $path)
    {
        if (is_string($path)) {
            $segments = explode(self::DELIMITER, $path);
        }

        // $segments = array_map(fn (string $segment) => trim($segment, self::DELIMITER), $segments);
        $segments = array_map(fn (string $segment) => trim($segment, self::DELIMITER), $segments);
        $this->path = new Collection($segments);
    }

    /**
     * Returns a tuple of either
     * – The path up until the penultimate segment + the last segment
     *   if the last segment is a filename
     * – The full path + null if the last segment is not a filename
     * 
     * @return [ string, string|null ]
     */
    protected function splitPathIntoDirectoryAndFilename(): array
    {
        if (str_contains(($filename = $this->path->last()), '.')) {
            return [ $this->path->slice(0, -1)->join(self::DELIMITER), $filename ];
        }

        return [ $this->path->join(self::DELIMITER), null ];
    }

    public function directory()
    {
        return $this->splitPathIntoDirectoryAndFilename()[0];
    }

    public function filename()
    {
        return $this->splitPathIntoDirectoryAndFilename()[1];
    }

    public function file(): ?object
    {
        [, $filename] = $this->splitPathIntoDirectoryAndFilename();

        if ($filename === null) {
            return null;
        }

        return (object) pathinfo($filename);
    }

    public function up()
    {
        return new self($this->path->slice(0, -1)->join(self::DELIMITER));
    }

    public function withFilename(string $filename)
    {
        return new self($this->directory() . self::DELIMITER . $filename);
    }

    public function toArray()
    {
        return $this->path->toArray();
    }

    public function __toString(): string
    {
        return $this->path->join(self::DELIMITER);
    }
}
