<?
require_once('main.php');
$DirectoryOnLocalDisk = 'E:\openserver\domains\mysite\cash';
$FileOnYandexDiskView = '/' . $_GET['YandexFilesListView'];

$resource = $disk->getResource($DirectoryOnYandexDisk . $FileOnYandexDiskView);
$resource->download($DirectoryOnLocalDisk . $FileOnYandexDiskView);

$filename = $resource['name'];

$mystring = $filename;
$findme   = '.';
$pos = strpos($mystring, $findme);
$rest = substr($filename, $pos);

if ($rest == '.jpg') {
    Header("Content-type: image/jpeg");
    $im = imagecreatefromjpeg($DirectoryOnLocalDisk . $FileOnYandexDiskView);
    imagejpeg($im);
}

if ($rest == '.txt') {
    $text = $DirectoryOnLocalDisk . $FileOnYandexDiskView;
    Header("Content-type: text/plain");
    $content = file_get_contents($text);
    print_r($content);
}

unlink($DirectoryOnLocalDisk . $FileOnYandexDiskView);
