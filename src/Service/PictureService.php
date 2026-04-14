<?php

namespace App\Service;

use Exception;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PictureService
{
    public function __construct(
        private ParameterBagInterface $parameter
    ) {}

    // Resizing images to fit into the 60 by 60 square of character index
    public function square(UploadedFile $image, ?string $folder = '', ?int $width = 60): string
    {
        // Giving new name to image file as 'file'
        $file = md5(uniqid(rand(), true)) . '.webp';

        // Getting picture informations
        $imageInfos = getimagesize($image);
        if($imageInfos === false){
            throw new Exception('Format d\'image invalide');
        }

        //Checking mime type 
        switch($imageInfos['mime']){
            case 'image/png':
                $imageSource = imagecreatefrompng($image);
                break;
                case 'image/jpeg':
                $imageSource = imagecreatefromjpeg($image);
                break;
                case 'image/gif':
                $imageSource = imagecreatefromgif($image);
                break;
                case 'image/webp':
                $imageSource = imagecreatefromwebp($image);
                break;
                default:
                throw new Exception('Format de fichier invalide');
        }

        // Resizing images
        $imageWidth = $imageInfos[0];
        $imageHeight = $imageInfos[1];

        // Use of <=> operator to allow triple comparison of picture dimensions
        // 
        switch($imageWidth <=> $imageHeight){
            case -1: // Portrait format
                $squareSize = $imageWidth;
                $srcX = 0;
                $srcY = ($imageHeight - $imageWidth) / 2;
                break;
                case 0: // Square format
                $squareSize = $imageWidth;
                $srcX = 0;
                $srcY = 0;
                break;
                case 1: // Landscape format
                $squareSize = $imageHeight;
                $srcX = ($imageWidth - $imageHeight) / 2;
                $srcY = 0;
                break;
        }

        // Generating new blank image
        $resizedImage = imagecreatetruecolor($width, $width);
        imagecopyresampled($resizedImage, $imageSource, 0, 0, $srcX, $srcY, $width, $width, $squareSize, $squareSize);

        // Generating path 
        $path = $this->parameter->get('uploads_directory') . $folder;

        // Generating folder if it doesn't already exists
        if(!file_exists($path . '/mini/')){
            mkdir($path . '/mini/', 0755, true);
        }

        // Stocking resized images
        imagewebp($resizedImage, $path . '/mini/' . $width . 'x' . $width . '-' . $file);

        // Stocking original images
        $image->move($path . '/', $file);

        return $file;
    }

    public function rectangle(UploadedFile $image, ?string $folder = '', ?int $width = 300, ?int $height = 500): string
    {
        // Giving new name to image file as 'file'
        $file = md5(uniqid(rand(), true)) . '.webp';

        // Getting picture informations
        $imageInfos = getimagesize($image);
        if($imageInfos === false){
            throw new Exception('Format de fichier invalide');
        }

        //Checking mime type 
        switch($imageInfos['mime']){
            case 'image/png':
                $imageSource = imagecreatefrompng($image);
                break;
                case 'image/jpeg':
                $imageSource = imagecreatefromjpeg($image);
                break;
                case 'image/gif':
                $imageSource = imagecreatefromgif($image);
                break;
                case 'image/webp':
                $imageSource = imagecreatefromwebp($image);
                break;
                default:
                throw new Exception('Format de fichier invalide');
        }

        // Resizing images
        $imageWidth = $imageInfos[0];
        $imageHeight = $imageInfos[1];

        // Use of <=> operator to allow triple comparison of picture dimensions
        // 
        switch($imageWidth <=> $imageHeight){
            case -1: // Portrait format
                $rectangleSize = $imageWidth;
                $srcX = 0;
                $srcY = ($imageHeight - $imageWidth) / 2;
                break;
                case 0: // Square format
                $rectangleSize = $imageWidth;
                $srcX = 0;
                $srcY = 0;
                break;
                case 1: // Landscape format
                $rectangleSize = $imageHeight;
                $srcX = ($imageWidth - $imageHeight) / 2;
                $srcY = 0;
                break;
        }

        // Generating new blank image
        $resizedImage = imagecreatetruecolor($width, $height);
        imagecopyresampled($resizedImage, $imageSource, 0, 0, $srcX, $srcY, $width, $height, $rectangleSize, $rectangleSize);

        // Generating path 
        $path = $this->parameter->get('uploads_directory') . $folder;

        // Generating folder if it doesn't already exists
        if(!file_exists($path . '/')){
            mkdir($path . '/', 0755, true);
        }

        // Stocking resized images
        imagewebp($resizedImage, $path . '/' . $width . 'x' . $height . '-' . $file);

        // Stocking original images
        $image->move($path . '/', $file);

        return $file;
    }
}
