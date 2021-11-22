<?php
/**
 * @author Gizem Sever <gizemsever68@gmail.com>
 */

namespace App\AWS\S3;

/**
 * Class ACL
 * @package App\AWS\S3
 */
class ACL{

    const _PRIVATE = 'private';
    const PUBLIC_READ = 'public-read';
    const PUBLIC_READ_WRITE = 'public-read-write';
    const AWS_EXEC_READ = 'aws-exec-read';
    const AUTHENTICATED_READ = 'authenticated-read';
    const BUCKET_OWNER_READ = 'bucket-owner-read';
    const BUCKET_OWNER_FULL_CONTROL = 'bucket-owner-full-control';

}