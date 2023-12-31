<?php
namespace App\Services;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    public function __construct(private readonly string $targetDirectory)
    {
    }
    public function upload(UploadedFile $file): string
    {
        $fileName = uniqid().'.'.$file->guessExtension();
        try {
            $file->move($this->getTargetDirectory(), $fileName);
        } catch (FileException $e) {
// ... handle exception if something happens during file upload
        }
        return $fileName;
    }
    public function getTargetDirectory(): string
    {
        return $this->targetDirectory;
    }
    public function delete(?string $filename, string $rep): void
    {
        if (null != $filename) {
            if (file_exists($rep . '/' . $filename)) {
                unlink($rep . '/' . $filename);
            }
        }
    }
}

