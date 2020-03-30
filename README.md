# UF_MailAttachments
 
This sprinkle adds support for mail attachments to UserFrosting

## Usage

Usage is similar, you just need to use differenct classes and a different service.



First, create a message

```
// Add this to the top
use UserFrosting\Sprinkle\MailAttachments\Mail\ExtendedTwigMailMessage;

$message = new ExtendedTwigMailMessage($this->ci->view, "mail/booking-confirmation.html.twig");    
```

Usage of the `ExtendenTwigMailMessage` is the same as the standard [`TwigMailMessage`](https://learn.userfrosting.com/mail/the-mailer-service#senders-recipients-and-customized-content)

To add an atachment, create a `MailAttachment` Object

```
// Add this to the top
use UserFrosting\Sprinkle\MailAttachments\Mail\MailAttachment;

$attachment = New MailAttachment("Hello World","hello.txt");
// OR using UF's disk storage
$fs = $this->ci->filesystem;
$disk = $fs->disk("diskName");
$file = new MailAttachment($disk->get('hello.txt'), 'hello.txt');

// Then add to the message
$message->addAttachment($attachment);
```
To send the message use the `extendedMailer` service

```
$extendedMailer = $this->ci->extendedMailer;

$extendedMailer->sendDistinct($message);
```

## Options

The attachment object has four options which can be set in the constructor.

* `$file` - The contents of the file
* `$fileName` - The name of the file
* `$encoding` - How the file should be encoded (defaults to `PHPMailer::ENCODING_BASE64`)
* `$mimeType` - The mime type of the file (if left blank, PHPMailer will automatically detect the mime type)