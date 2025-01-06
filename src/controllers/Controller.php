<?php
abstract class Controller
{
    private string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function getPath()
    {
        return $this->path;
    }

    public abstract function call($requestMethod);
}
