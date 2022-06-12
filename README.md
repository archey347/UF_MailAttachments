# UF_MailAttachments
 
This sprinkle adds support for mail attachments to UserFrosting

## Deprecation Notice for v2

Due to some weird PHP reasons, it can't seem to accept paremter types that are children of  paremeter types of the parent class' method definition. I'm not sure what PHP version this became a problem in. I don't know if it's just something that I've done wrong, but for some reason the zend compiler barfs at it. As a cheap fix, for v2 of this sprinkle, you now have to call the `sendWithAttachments` or `sendDistinctWithAttachments` instead rather than the normal functions. I'll probably try and get it implemented in UF's mailer directly rather than having an extension.

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

$extendedMailer->sendDistinctWithAttachments($message);
```

## Options

The attachment object has four options which can be set in the constructor.

* `$file` - The contents of the file
* `$fileName` - The name of the file
* `$encoding` - How the file should be encoded (defaults to `PHPMailer::ENCODING_BASE64`)
* `$mimeType` - The mime type of the file (if left blank, PHPMailer will automatically detect the mime type)
