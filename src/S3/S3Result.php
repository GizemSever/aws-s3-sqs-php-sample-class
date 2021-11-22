<?php
/**
 * @author Gizem Sever <gizemsever68@gmail.com>
 *
 */

namespace App\AWS\S3;

use AWS\Result;

/**
 * Class S3Result
 * @package App\AWS\S3
 */
class S3Result
{

    /**
     * @var bool|null
     */
    public ?bool $BucketKeyEnabled;
    /**
     * @var string|null
     */
    public ?string $ETag;
    /**
     * @var string|null
     */
    public ?string $Expiration;
    /**
     * @var string|null
     */
    public ?string $ObjectURL;
    /**
     * @var string|null
     */
    public ?string $SSECustomerAlgorithm;
    /**
     * @var string|null
     */
    public ?string $SSECustomerKeyMD5;
    /**
     * @var string|null
     */
    public ?string $SSEKMSEncryptionContext;
    /**
     * @var string|null
     */
    public ?string $SSEKMSKeyId;
    /**
     * @var string|null
     */
    public ?string $VersionId;

    /**
     * S3Result constructor.
     * @param Result $result
     */
    public function __construct(Result $result)
    {

        foreach ($result as $key => $value) {
            $this->{$key} = $value;
        }

    }


}