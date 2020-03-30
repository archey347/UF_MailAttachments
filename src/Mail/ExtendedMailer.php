<?php

namespace UserFrosting\Sprinkle\MailAttachments\Mail;

use UserFrosting\Sprinkle\Core\Mail\Mailer;

class ExtendedMailer extends Mailer 
{
    public function send(ExtendedMailMessage $message, $clearRecipients = true)
    {
        $attachments = $message->getAttachments();

        foreach($attachments as $attachment)
        {   
            
            $this->phpMailer->addStringAttachment(
                $attachment->getFileContents(),
                $attachment->getFileName(),
                $attachment->getEncoding(),
                $attachment->getMimeType()
            );
        }

        parent::send($message, $clearRecipients);
    }

    public function sendDistinct(ExtendedMailMessage $message, $clearRecipients = true)
    {
        $attachments = $message->getAttachments();

        foreach($attachments as $attachment)
        {
            $this->phpMailer->addStringAttachment(
                $attachment->getFileContents(),
                $attachment->getFileName(),
                $attachment->getEncoding(),
                $attachment->getMimeType()
            );
        }

        parent::sendDistinct($message, $clearRecipients);
    }
}