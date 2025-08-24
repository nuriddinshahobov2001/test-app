<?php

namespace App\Handlers;

use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageHandler
{
    private const ALLOWED_MIME_TYPES = [
        'image/jpeg',
        'image/png',
        'image/jpg',
    ];

    private const MAX_FILE_SIZE = 5242880; // 5MB

    public function processProductImages(Product $product, array $images): array
    {
        $processedImages = [];

        foreach ($images as $image) {
            try {
                if ($processedImage = $this->processSingleImage($product, $image)) {
                    $processedImages[] = $processedImage;
                }
            } catch (\Exception $e) {
                continue;
            }
        }

        return $processedImages;
    }

    public function processSingleImage(Product $product, UploadedFile $image): ?array
    {
        $this->validateImage($image);

        $fileName = $this->generateFileName($image);
        $path = $this->storeImage($image, $product->id, $fileName);

        return [
            'product_id' => $product->id,
            'path' => $path,
            'filename' => $fileName,
            'original_name' => $image->getClientOriginalName(),
            'mime_type' => $image->getMimeType(),
            'size' => $image->getSize(),
            'disk' => 'public',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    private function validateImage(UploadedFile $image): void
    {
        if (!$image->isValid()) {
            throw new \InvalidArgumentException('Invalid image file');
        }

        if (!in_array($image->getMimeType(), self::ALLOWED_MIME_TYPES)) {
            throw new \InvalidArgumentException(
                'Invalid image type. Allowed: ' . implode(', ', self::ALLOWED_MIME_TYPES)
            );
        }

        if ($image->getSize() > self::MAX_FILE_SIZE) {
            throw new \InvalidArgumentException(
                'Image size too large. Maximum: ' . (self::MAX_FILE_SIZE / 1024 / 1024) . 'MB'
            );
        }
    }

    private function generateFileName(UploadedFile $image): string
    {
        $extension = $image->getClientOriginalExtension();
        $baseName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);

        // Генерируем уникальное имя: originalname-randomhash.extension
        $randomHash = Str::random(10);

        return Str::slug($baseName) . '-' . $randomHash . '.' . $extension;
    }

    private function storeImage(UploadedFile $image, int $productId, string $fileName): string
    {
        $directory = "products/{$productId}";

        return Storage::disk('public')->putFileAs(
            $directory,
            $image,
            $fileName
        );
    }

    public function deleteImage(string $path, string $disk = 'public'): bool
    {
        return Storage::disk($disk)->delete($path);
    }

    public function getImageUrl(string $path, string $disk = 'public'): ?string
    {
        return Storage::disk($disk)->exists($path)
            ? Storage::disk($disk)->url($path)
            : null;
    }
}
