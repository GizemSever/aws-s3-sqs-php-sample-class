<?php
/**
 * @author Gizem Sever <gizemsever68@gmail.com>
 */

namespace App\AWS\SQS;

class Message{

    public Int $DelaySeconds;
    public array $MessageAttributes;
    public string $MessageBody;
    public string $QueueUrl;

    /**
     * Message constructor.
     * @param Int $DelaySeconds
     * @param array $MessageAttributes
     * @param string $MessageBody
     * @param string $QueueUrl
     */
    public function __construct(int $DelaySeconds, array $MessageAttributes, string $MessageBody, string $QueueUrl)
    {
        $this->DelaySeconds = $DelaySeconds;
        $this->MessageAttributes = $MessageAttributes;
        $this->MessageBody = $MessageBody;
        $this->QueueUrl = $QueueUrl;
    }


}
