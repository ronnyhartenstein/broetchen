<?php

declare(strict_types=1);

namespace Oqq\Broetchen\Service;

use Oqq\Broetchen\Domain\EmailAddress;
use Oqq\Broetchen\Domain\MailContent;
use Zend\Mail\Message;
use Zend\Mail\Transport\TransportInterface;
use Zend\Mime\Mime;
use Zend\Mime\Part;
use Zend\Mime\Message as MimeMessage;

final class TransportMailService implements MailServiceInterface
{
    private $transport;

    public function __construct(TransportInterface $transport)
    {
        $this->transport = $transport;
    }

    public function sendMailTo(MailContent $content, EmailAddress $recipient): void
    {
        $bodyPart = $this->getBodyMimePartFromContent($content);

        $mime = new MimeMessage();
        $mime->setParts([$bodyPart]);

        $message = new Message();
        $message->setBody($mime);

        $message->setSubject($content->subject());
        $message->setTo($recipient->toString());

        $this->transport->send($message);
    }

    private function getBodyMimePartFromContent(MailContent $content): Part
    {
        $body = $content->body();

        $part = new Part($body);
        $part->setType(Mime::TYPE_TEXT);
        $part->setCharset('UTF-8');
        $part->setEncoding(Mime::ENCODING_QUOTEDPRINTABLE);

        return $part;
    }
}
