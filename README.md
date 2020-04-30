# wasabi-storage

A [Wasabi](https://wasabi.com/) storage driver for Laravel.

This packages uses the AWS S3 storage driver but changes it to use Wasabi endpoints. It should work exactly the same way and support all the same features.

## Installation

```bash
composer require probablyrational/wasabi-storage
```

If you are on Laravel 5.4 or earlier, then register the service provider in app.php
```php
'providers' => [
    // ...
    ProbablyRational\Wasabi\WasabiServiceProvider::class,
]
```

If you are on Laravel 5.5 or higher, composer will have registered the provider automatically for you.

Add a new disk to your `filesystems.php` config

```php
'wasabi' => [
    'driver' => 'wasabi',
    'key' => env('WASABI_ACCESS_KEY_ID'),
    'secret' => env('WASABI_SECRET_ACCESS_KEY'),
    'region' => env('WASABI_DEFAULT_REGION', 'eu-central-1'),
    'bucket' => env('WASABI_BUCKET'),
    'root' => env('WASABI_ROOT', '/'),
],
```

## Usage

```php
$disk = Storage::disk('wasabi');

// list all files
$files = $disk->files('/');

// create a file
$disk->put('avatars/1', $fileContents);

// check if a file exists
$exists = $disk->exists('file.jpg');

// get file modification date
$time = $disk->lastModified('file1.jpg');

// copy a file
$disk->copy('old/file1.jpg', 'new/file1.jpg');

// move a file
$disk->move('old/file1.jpg', 'new/file1.jpg');

// get url to file
$url = $disk->url('folder/my_file.txt');

// Set the visibility of file to public
$disk->setVisibility('folder/my_file.txt', 'public');


// See https://laravel.com/docs/5.3/filesystem for full list of available functionality
```
