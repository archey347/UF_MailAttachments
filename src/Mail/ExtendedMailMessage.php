<?php

/*
 * UserFrosting (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/UserFrosting
 * @copyright Copyright (c) 2019 Alexander Weissman
 * @license   https://github.com/userfrosting/UserFrosting/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\MailAttachments\Mail;

use UserFrosting\Sprinkle\Core\Mail\MailMessage;

/**
 * ExtendedMailMessage Class.
 *
 * Represents a basic mail message, containing a static subject and body.
 *
 * @author Alex Weissman (https://alexanderweissman.com)
 */
abstract class ExtendedMailMessage extends MailMessage
{

    protected $attachments = array();

    public function addAttachment(MailAttachment $attachment)
    {
        array_push($this->attachments, $attachment);
    }

    public function getAttachments()
    {
        return $this->attachments;
    }
}