<?php
namespace App\Core;

abstract class Controller {
    protected function view(string $path, array $data = []): void {
        extract($data);
        include __DIR__ . '/../Views/' . $path;
    }
}