<? require_once 'E:\openserver\domains\mysite\local\yandex-master\vendor/autoload.php';

$oauth = new Arhitector\Yandex\Client\OAuth();

error_reporting(E_ALL);

$disk = new Arhitector\Yandex\Disk();
$disk->setAccessToken('y0_AgAAAABkFLLnAAhjfwAAAADOKu6M7N5fhBwSRGyBuaHabWrtnFIei6I');

$DirectoryOnYandexDisk = 'app:';
$DirectoryOnLocalDisk = __DIR__ . '/YandexDisk';
