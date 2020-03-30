<?php
/**
 * ALRC Spanner
 *
 * @license   All rights reserved.
 */
namespace UserFrosting\Sprinkle\MailAttachments\ServicesProvider;


use UserFrosting\Sprinkle\MailAttachments\Mail\ExtendedMailer;

/**
 * Registers services for my site Sprinkle
 *
 * @author Archey Barrell
 */
class ServicesProvider
{
    /**
     * Register my site services.
     *
     * @param Container $container A DI container implementing ArrayAccess and container-interop.
     */
    public function register($container)
    {
        $container['extendedMailer'] = function ($c) {
            $mailer = new ExtendedMailer($c->mailLogger, $c->config['mail']);

            // Use UF debug settings to override any service-specific log settings.
            if (!$c->config['debug.smtp']) {
                $mailer->getPhpMailer()->SMTPDebug = 0;
            }

            return $mailer;
        };
    }
}

