<?php

namespace App\Helpers;

class Mailer {
    /**
     * Send mail
     *
     * @return void
     */
    public function send($to_email, $urlVerify) {
        $subject = "Rejestracja konta";
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

        $body = "<h1>siema</h1><p><strong>This is strong text</strong> while this is not.</p><a href='http://$urlVerify'>verify email</a>";
        
        if (mail($to_email, $subject, $body, $headers)) {
            echo "Email successfully sent to $to_email...";
        } else {
            echo "Email sending failed...";
        }
    }
}