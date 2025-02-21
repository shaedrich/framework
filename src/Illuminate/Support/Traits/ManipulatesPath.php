<?php

namespace Illuminate\Support\Traits;

use Illuminate\Support\UriPath;

trait ManipulatesPath
{
    /**
     * Get the URI's path.
     *
     * Empty or missing paths are returned as a single "/".
     */
    public function path(): ?string
    {
        $path = trim((string) $this->uri->getPath(), '/');

        $uriPath = new UriPath($path);
        dd(
            path: $path,
            uriPath: $uriPath,
            filename: $uriPath->filename(),
            file: $uriPath->file(),
            directory: $uriPath->directory(),
            pathToArray: $uriPath->toArray(),
            pathToString: (string) $uriPath,
            up: $uriPath->up(),
            withFilename: $uriPath->withFilename('test.php'),
            withFilename2: $uriPath->withFilename('index.php'),
            file2: $uriPath->withFilename('index.php')->file(),
        );

        return $path === '' ? '/' : $path;
    }

    /**
     * @return string
     */
    public function directory()
    {
        return $this->path()->directory();
    }

    /**
     * @return string
     */
    public function filename()
    {
        return $this->path()->filename();
    }

    public function file(): File
    {
        //
    }
}
