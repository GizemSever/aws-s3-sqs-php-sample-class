<?php
/**
 * @author Gizem Sever <gizemsever68@gmail.com>
 */

namespace App\AWS\SQS;

use AWS\Result;

class SqsResult{

    /**
     * @var string|null
     */
    public ?string $MD5OfMessageAttributes;
    /**
     * @var string|null
     */
    public ?string $MD5OfMessageBody;
    /**
     * @var string|null
     */
    public ?string $MD5OfMessageSystemAttributes;
    /**
     * @var string|null
     */
    public ?string $MessageId;
    /**
     * @var string|null
     */
    public ?string $SequenceNumber;


    /**
     * SqsResult constructor.
     * @param Result $result
     */
    public function __construct(Result $result)
    {

        foreach ($result as $key => $value) {
            $this->{$key} = $value;
        }

    }


}