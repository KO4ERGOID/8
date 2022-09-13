<?php

require_once 'main.php';

function scandirWithIndex($dir)
{
	return array_values(array_diff(scandir($dir), array('..', '.')));
}

//Интерфейс загрузки файла с Локального диска на Яндекс диск
$files = scandir($DirectoryOnLocalDisk);
$filter = array_diff(scandirWithIndex($DirectoryOnLocalDisk), array('.', '..'));

$i = 0;
?>
<h4>Загрузить файлы на Яндекс диск</h4>
<form action='test-class.php' method='GET'>
	<select name='LocalFilesList'>
		<?
		foreach ($filter as $file) {
			$i++; ?>
			<option name='<? echo $i; ?>'><? echo $file ?></option><br>
		<? } ?>
	</select>
	<input type='submit' value='Отправить'>
</form>
<?

$FileOnLocalDisk = '/' . $_GET['LocalFilesList'];

$resource = $disk->getResource($DirectoryOnYandexDisk . $FileOnLocalDisk);

$has = $resource->has(); // проверить есть ли ресурс на диске.

if (!$has) {
	$resource->upload($DirectoryOnLocalDisk . $FileOnLocalDisk);
	print_r('Файл ' . $_GET['LocalFilesList'] . ' успешно загружен');
} else {
	if ($FileOnLocalDisk != '/')
		echo 'Ошибка! Файл "' . $_GET['LocalFilesList'] . '" уже есть на Яндекс диске';
}
//=================================================================

$resources = $disk->getResources(20, 0)
	->setLimit(10) // количество файлов, getResources может принять "limit" первым параметром.
	->setOffset(0) // смещениеб пуеКуыщгксуы vj;tn ghbyznm "offset" вторым параметром.
	->setMediaType('image') // мультимедиа тип файлов, все типы $resources->getMediaTypes()
	->setPreview('100x250') // размер превью изображений
	->setPreviewCrop(true) // обрезать превью согласно размеру
	->setSort('name', true) // способ сортировки, второй параметр TRUE означает "в обратном порядке"
;

//Интерфейс загрузки файла с Яндекс диска на Локальный диск
$resources = $disk->getResources();
$i = 0;
?>
<h4>Загрузить файлы на Локальный диск</h4>
<form action='test-class.php' method='GET'>
	<select name='YandexFilesList'>
		<?
		foreach ($resources as $resource) {
			$i++; ?>
			<option name='<? echo $i; ?>'><? print_r($resource['name']); ?></option><br>
		<? } ?>
	</select>
	<input type='submit' value='Скачать'>
</form>
<?

$FileOnYandexDisk = '/' . $_GET['YandexFilesList'];

$resource = $disk->getResource($DirectoryOnYandexDisk . $FileOnYandexDisk);

if (!file_exists($DirectoryOnLocalDisk . $FileOnYandexDisk)) {
	$resource->download($DirectoryOnLocalDisk . $FileOnYandexDisk);
	print_r('Файл ' . $_GET['YandexFilesList'] . ' успешно загружен');
} elseif ($FileOnYandexDisk != '/') {
	echo 'Ошибка! Файл"' . $_GET['YandexFilesList'] . '"уже есть на локальном диске.';
}

//Интерфейс удаления файлов с Яндекс диска
$resources = $disk->getResources();
$i = 0;
?>
<h4>Удалить файлы с Яндекс диска</h4>
<form action='test-class.php' method='GET'>
	<select name='YandexFilesListDelete'>
		<?
		foreach ($resources as $resource) {
			$i++; ?>
			<option name='<? echo $i; ?>'><? print_r($resource['name']); ?></option><br>
		<? } ?>
	</select>
	<input type='submit' value='Удалить'>
</form>
<?

$FileOnYandexDiskDelete = '/' . $_GET['YandexFilesListDelete'];
if ($FileOnYandexDiskDelete != '/') {
	$ResourceDelete = $disk->getResource($DirectoryOnYandexDisk . $FileOnYandexDiskDelete);
	$hasDelete = $ResourceDelete->has();
	if ($hasDelete) {
		$ResourceDelete->delete();
		print_r('Файл ' . $_GET['YandexFilesListDelete'] . ' успешно удалён');
	}
}

//Интерфейс просмотра файлов с Яндекс диска
$resources = $disk->getResources();
$i = 0;
?>
<h4>Просмотреть файлы с Яндекс диска</h4>
<form action='udalenie.php' method='GET'>
	<select name='YandexFilesListView'>
		<?
		foreach ($resources as $resource) {
			$i++; ?>
			<option name='<? echo $i; ?>'><? print_r($resource['name']); ?></option><br>
		<? } ?>
	</select>
	<input type='submit' value='Просмотреть'>
</form>
<?



//-----------------------------------------------------------------------


		//$has_moved = $resource->move('image2.jpg'); // переместить, boolean
		//$result = $resource->upload('http://<..>file.zip');
		//var_dump($result->getStatus(), $result->getIdentifier());

		//$resource->custom_index_1 = 'value'; // добавить метаинформацию в "custom_properties"
		//$resource->set('custom_index_2', 'value'); // добавить метаинформацию в "custom_properties"
		//$resource['custom_index_3'] = 'value'; // добавить метаинформацию в "custom_properties"
		//unset($resource['custom_index_3']); // удалить метаинформацию, или передать NULL в "set" чтобы удалить

		//echo '<a href="'.$resource->docviewer.'" target="_blank">View</a>';



		//var_dump($has, $resource->getProperties(), $resource->toObject());
		//$resource = $disk->getPublishResource('https://yadi.sk/d/WSS6bK_ksQ5ck');
		//var_dump($resource->items->get(0)->getLink(), $resource->toArray());
		//var_dump($resource->download(__DIR__.'/down.zip', true));
		//var_dump($resource->items->getFirst()->toArray(), $resource->toArray());

		//$resources = $disk->getTrashResources(5);
		//$resources = $disk->getTrashResource('trash:/image2.jpg');
		//var_dump($resources->toArray());

		/*
$disk->addListener('operation', function ($event, $operation) {
	var_dump($operation->getStatus(), func_get_args());
});*/

		//var_dump($disk->toArray());


		//$resources = $disk->getTrashResources();
		//$resources = $disk->cleanTrash();
		//$resources = $disk->uploaded();

		//$resources = $disk->getResource('disk:/applu.mp3');
		//$resources = $disk->getResource('rich.txt');

		//$resources = $disk->getTrashResources(1);
		//$resources->setSort('deleted', true);
		//$resources->setLimit(1, 1);

		//$resources = $disk->getTrashResource('/', 10);
		//$resources->setSort('deleted', false);

		/*$resources->addListener('operation', function () {
	var_dump('$resources', func_get_args());
});*/

		//$result = $resources->create();
		//$result = $resources->delete(false);
		//$resources->set('nama', rand());
		//$resources->rollin = 'bakc';
		//unset($resources['rollin']);
		//echo $resources->docviewer;
		//var_dump($disk->getOperation('0ec0c6a835b72b8860261cc2d5aaf26968b83b7f8eac3118b240eedd')->getStatus());
		//$result = $resources->move('rich');
		//$result = $resources->setPublish(true);

		//$result = $resources->download(__DIR__.'/data_big');
		//$result = $resources->upload(__DIR__.'/data_big.data', true);
		//var_dump($result, $resources->toArray());
		//var_dump($resources->toArray());
		//var_dump($disk);
