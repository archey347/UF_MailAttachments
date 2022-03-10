<?php

namespace UserFrosting\Sprinkle\MailAttachments\Mail;

use UserFrosting\Sprinkle\Core\Mail\Mailer;
use UserFrosting\Sprinkle\Core\Mail\MailMessage;
use UserFrosting\Sprinkle\MailAttachments\Mail\ExtendedMailMessage;

class ExtendedMailer extends Mailer 
{
    /**
     * @deprecated
     */
    public function send(MailMessage $message, $clearRecipients = true)
    {
        throw new \Exception("DEPRECATED. Call sendWithAttachments instead");
    }

    /**
     * @deprecated
     */
    public function sendDistinct(MailMessage $message, $clearRecipients = true)
    {
        throw new \Exception("DEPRECATED. Call sendDistinctWithAttachments instead");     
    }


    public function sendWithAttachments(ExtendedMailMessage $message, $clearRecipients = true)
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

    public function sendDistinctWithAttachments(ExtendedMailMessage $message, $clearRecipients = true)
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
