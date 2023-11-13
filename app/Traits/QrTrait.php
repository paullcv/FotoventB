<?php

namespace App\Traits;

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\ValidationException;
use Illuminate\Support\Facades\Storage;

trait QrTrait
{
    public function generateQr($content)
    {
        //Libreria: https://github.com/endroid/qr-code

        $qrCode = QrCode::create($content)
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(ErrorCorrectionLevel::Low)
            ->setSize(250)
            ->setMargin(10)
            ->setRoundBlockSizeMode(RoundBlockSizeMode::Margin)
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));

        $writer = new PngWriter();
        $result = $writer->write($qrCode);
        $file = $result->getString();
        $folder = 'qr/';

        $fileName = uniqid();
        $extension = '.png';
        $url = $this->file_to_storage($file, $folder, $fileName, $extension);
        return $url;
    }
    public function file_to_storage($file, $folder, $fileName, $extension  = null)
    {
        try {
            $path = $folder . $fileName . $extension;
            Storage::disk('public')->put($path, $file);
            $url = "/storage/" . $path;
            return $url;
        } catch (\Throwable $th) {
            return "";
        }
    }
}
