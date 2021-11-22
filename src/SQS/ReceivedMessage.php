<?php
/**
 * @author Gizem Sever <gizemsever68@gmail.com>
 */

namespace App\AWS\SQS;

use AWS\Result;

class ReceivedMessage{

    public ?array $Attributes;
    public ?string $Body;
    public ?string $MD5OfBody;
    public ?string $MD5OfMessageAttributes;
    public ?array $MessageAttributes;
    public ?string $MessageId;
    public ?string $ReceiptHandle;

    public function __construct($result)
    {

        foreach ($result as $key => $value) {
            $this->{$key} = $value;
        }

    }

}
