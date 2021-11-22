<?php
/**
 * @author Gizem Sever <gizemsever68@gmail.com>
 */

namespace App\AWS\S3;

use Aws\S3\Exception\S3Exception;
use Aws\S3\S3Client;
use Exception;

class S3
{

    const VERSION = 'latest';

    /**
     * @var S3Client
     */
    private S3Client $client;
    /**
     * @var string
     */
    private string $bucket;

    /**
     * S3 constructor.
     */
    public function __construct()
    {
        $this->config($_ENV['S3_KEY'], $_ENV['S3_SECRET'], $_ENV['S3_REGION']);
    }

    /**
     * @param string $key
     * @param string $secret
     * @param string $region
     */
    private function config(string $key, string $secret, string $region)
    {

        $this->client = new S3Client([
            'version' => self::VERSION,
            'region' => $region,
            'credentials' => [
                'key' => $key,
                'secret' => $secret
            ]
        ]);

        $this->setBucket($_ENV['S3_BUCKET']);

    }

    /**
     * @param string $Bucket
     */
    public function setBucket(string $Bucket)
    {

        $this->bucket = $Bucket;

    }

    /**
     * @param string $file
     * @param string $content
     * @param string $contentType
     * @param string $acl
     * @return S3Result|S3Exception|Exception
     */
    public function putObject(string $file, string $content, string $contentType, string $acl)
    {

        try {

            $object = new S3Object($this->bucket, $file, $content, $contentType, $acl);
            $putObject = $this->client->putObject((array)$object);

            return new S3Result($putObject);
        } catch (S3Exception $e) {
            return $e;
        }

    }

    /**
     * @param String $key
     * @return bool
     */
    public function deleteObject(string $key)
    {

        $object = new S3Object($this->bucket, $key);

        try {

            $this->client->deleteObject((array)$object);
            return TRUE;

        } catch (S3Exception $e) {

            return FALSE;

        }

    }

    /**
     * @param String $key
     * @param String $contentType
     * @param String $ACL
     * @param Int $timeout
     * @return bool|string
     */
    public function generateSignedPutUrl(string $key, string $contentType, string $ACL, int $timeout)
    {

        $object = new S3Object($this->bucket, $key, '', $contentType, $ACL);

        try {

            $command = $this->client->getCommand('PutObject', (array)$object);
            $request = $this->client->createPresignedRequest($command, '+' . $timeout . ' minutes')->withMethod('PUT');

            return (string) $request->getUri();

        } catch (S3Exception $e) {
            return FALSE;
        }


    }
}
