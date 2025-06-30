<?php

namespace App\Repository;

use App\Entity\Link;

class LinkRepository
{
    private string $projectDir;

    public function __construct(string $projectDir)
    {
        $this->projectDir = $projectDir . '\..\linksData.json';
    }

    private function getAll(): array
    {
        return json_decode(
            file_get_contents($this->projectDir), true
        ) ?: [];
    }

    public function save(Link $link): void
    {
        $linksData = $this->getAll();

        $linksData[$link->getSlag()] = $link->getOriginalUrl();

        file_put_contents(
            $this->projectDir, json_encode($linksData)
        );
    }

    public function getOriginalUrl(string $slag): string
    {
        return $this->getAll()[$slag] ?? '';
    }

}
