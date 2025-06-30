<?php

namespace App\Entity;

class Link
{
    private string $original_url;
    private string $slag;

    public function __construct(string $original_url)
    {
        $this->original_url = $original_url;
        $this->slag = $this->generateSlag();
    }

    private function generateSlag(): string
    {
        $slag = '';
        $chars = '0123456789abcdefghijklmnopqrstuvwxyz';

        for ($i = 0; $i < 6; ++$i) {
            $slag .= $chars[rand(0, strlen($chars) - 1)];
        }

        return $slag;
    }

    public function getSlag(): string
    {
        return $this->slag;
    }

    public function getOriginalUrl(): string {
        return $this->original_url;
    }
}
