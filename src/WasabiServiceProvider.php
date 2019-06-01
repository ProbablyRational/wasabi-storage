<?php

namespace ProbablyRational\Wasabi;

use Storage;
use Aws\S3\S3Client;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use League\Flysystem\Filesystem;
use Illuminate\Support\ServiceProvider;

class WasabiServiceProvider extends ServiceProvider
{
	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Bootstrap services.
	 *
	 * @return void
	 */
	public function boot()
	{
		Storage::extend('wasabi', function ($app, $config) {
			$conf = [
				'endpoint' => "https://" . $config['bucket'] . ".s3." . $config['region'] . ".wasabisys.com/",
				'bucket_endpoint' => true,
				'credentials' => [
					'key' => $config['key'],
					'secret' => $config['secret'],
				],
				'region' => $config['region'],
				'version' => 'latest',
			];

			$client = new S3Client($conf);

			$adapter = new AwsS3Adapter($client, $config['bucket'], $config['root']);

			$filesystem = new Filesystem($adapter);

			return $filesystem;
		});
	}
}
