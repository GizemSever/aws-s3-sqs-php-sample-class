<?php
/**
 * @author Gizem Sever <gizemsever68@gmail.com>
 */

namespace App\AWS\SQS;

use Aws\Sqs\Exception\SqsException;
use Aws\Sqs\SqsClient;

class SQS{

    const VERSION = 'latest';

    /**
     * @var SqsClient
     */
    private SqsClient $client;
    /**
     * @var string
     */
    private string $queueName;
    /**
     * @var string
     */
    private string $queueUrl;
    /**
     * @var Int
     */
    private Int $delaySeconds = 1;
    /**
     * @var Int
     */
    private Int $maxReceivableMessage = 1;

    /**
     * SQS constructor.
     */
    public function __construct()
    {
        $this->config($_ENV['SQS_KEY'], $_ENV['SQS_SECRET'], $_ENV['SQS_REGION']);
    }


    /**
     * @param string $key
     * @param string $secret
     * @param string $region
     */
    private function config(string $key, string $secret, string $region)
    {

        $this->client = new SqsClient([
            'version' => self::VERSION,
            'region' => $region,
            'credentials' => [
                'key' => $key,
                'secret' => $secret
            ]
        ]);
    }

    /**
     * @param Int $seconds
     */
    public function setDelaySeconds(Int $seconds){

        $this->delaySeconds = $seconds;

    }

    /**
     * @param Int $maxReceivableMessage
     */
    public function setMaxReceivableMessage(int $maxReceivableMessage)
    {
        $this->maxReceivableMessage = $maxReceivableMessage;
    }


    /**
     * @param string $name
     */
    private function setQueueName(string $name){

        $this->queueName = $name;
        $this->setQueueUrl();

    }

    private function setQueueUrl(){

        $result = $this->client->getQueueUrl([
            'QueueName' => $this->queueName
        ]);

        if ($result){
            $this->queueUrl = $result['QueueUrl'];
        }

    }

    /**
     * @param array $attributes
     * @return SqsResult|bool
     */
    public function send(array $attributes){

        if ($this->queueUrl != NULL){

            $message = new Message($this->delaySeconds, $attributes, $this->queueUrl, $this->queueUrl);

            try {

                $send = $this->client->sendMessage((array) $message);
                return new SqsResult($send);

            }catch (SqsException $e){

                return FALSE;

            }

        }else{

            return FALSE;

        }


    }

    /**
     * @return ReceivedMessage[]|bool
     */
    public function receive(){

        if ($this->queueUrl != NULL){

            $result = $this->client->receiveMessage([
                'AttributeNames' => ['SentTimestamp'],
                'MaxNumberOfMessages' => $this->maxReceivableMessage,
                'MessageAttributeNames' => ['All'],
                'QueueUrl' => $this->queueUrl,
                'WaitTimeSeconds' => 0,
            ]);

            if (! empty($result['Messages'])){

                return array_map(function ($m){

                    return new ReceivedMessage($m);

                }, $result['Messages']);

            }
        }

        return FALSE;
    }

    /**
     * @param string $receiptHandle
     */
    public function delete(string $receiptHandle){

        $this->client->deleteMessage([
            'QueueUrl' => $this->queueUrl,
            'ReceiptHandle' => $receiptHandle
        ]);

    }
}