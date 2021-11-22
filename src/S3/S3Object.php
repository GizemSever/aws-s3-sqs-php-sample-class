<?php
/**
 * @author Gizem Sever <gizemsever68@gmail.com>
 */

namespace App\AWS\S3;

class S3Object{

    public string $Bucket;
    public string $Key;
    public ?string $Body;
    public ?string $ContentType;
    public ?string $ACL;

    /**
     * S3Object constructor.
     * @param string $Bucket
     * @param string $Key
     * @param string $Body
     * @param string $ContentType
     * @param string $ACL
     */
    public function __construct(string $Bucket, string $Key, ?string $Body = NULL, ?string $ContentType = NULL , ?string $ACL = NULL)
    {
        $this->Bucket = $Bucket;
        $this->Key = $Key;
        $this->Body = $Body;
        $this->ContentType = $ContentType;
        $this->ACL = $ACL;
    }


}