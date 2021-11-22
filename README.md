
## AWS S3 SQS  - PHP examples

#### **SQS - send message to queue**


    
    $sqs = new \App\AWS\SQS\SQS();
    $sqs->setQueueName('AWS_SQS_QUEUE_NAME');
    $sqs->setDelaySeconds(20); // optional
    $sqs->send([    
    'yourAttributeName' => [    
        'DataType' => 'String',    
        'StringValue' => 'Your attribute value'    
	  ]    
	 // ...    
	]);
    
 

#### **SQS - receive message and delete message from queue**

    $sqs = new \App\AWS\SQS\SQS();
    $sqs->setQueueName('AWS_SQS_QUEUE_NAME');
    $sqs->setMaxReceivableMessage(10); // optional
    $messages = $sqs->receive();
    foreach($messages as $message){
	    $attributes = $message->Attributes;
	    
	    // ... your operations
	    
	    $sqs->delete($message->ReceiptHandle)
    }

#### **S3 - generate pre signed put object url for client with timeout**

    $s3 = new \App\AWS\S3\S3();
    $uploadUri = $s3->generateSignedPutUrl('path\file', 'image\png', \App\AWS\S3\ACL::PUBLIC_READ, 20);


#### **S3 - put object**

    $s3 = new \App\AWS\S3\S3();
    $result = $s3->putObject('path\file', 'yourbase64data', 'image\png', \App\AWS\S3\ACL::AUTHENTICATED_READ);
    $objectUrl = $result->ObjectURL;

#### **S3 - delete object**

    $s3 = new \App\AWS\S3\S3();
    $s3->deleteObject('path\file');

