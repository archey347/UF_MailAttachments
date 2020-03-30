<?php

namespace UserFrosting\Sprinkle\MailAttachments\Mail;
use PHPMailer\PHPMailer\PHPMailer;


class MailAttachment
{
    protected $fileName = "";

    protected $mimeType = "";

    protected $encoding = "";

    protected $file = "";

    public function __construct($file, $fileName, $encoding = PHPMailer::ENCODING_BASE64, $mimeType = "")
    {
        $this->file = $file;
        $this->fileName = $fileName;
        $this->encoding = $encoding;

        if ($mimeType != "") {
            $this->mimeType = $mimeType;
        }
    }

    public function getFileName()
    {
        return $this->fileName;
    }

    public function getMimeType()
    {
        return $this->mimeType;
    }

    public function getEncoding()
    {
        return $this->encoding;
    }

    public function getFileContents()
    {
        return $this->file;
    }
}