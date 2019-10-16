<?php

namespace App\Entity;

interface ImageEntityInterface
{
    public function getImagePath(): ?string;

    public function setImagePath(?string $imagePath): ImageEntityInterface;
}
