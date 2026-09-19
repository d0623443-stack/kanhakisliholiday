<?php

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the framework's
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @see: https://codeigniter.com/user_guide/extending/common.html
 */

if (! function_exists('get_mail_config')) {
    function get_mail_config(): array
    {
        $adminMail = (function_exists('get_site_setting') && ! empty(get_site_setting('notification_mail')))
            ? get_site_setting('notification_mail')
            : (defined('RECIEVER_MAIL') ? RECIEVER_MAIL : 'danishkhan989@gmail.com');

        return [
            'protocol'       => 'smtp',
            'SMTPHost'       => 'mail.kanhakisliholiday.in',
            'SMTPUser'       => 'noreply@kanhakisliholiday.in',
            'SMTPPass'       => 'z@zHc*^uuymDGD7a',
            'SMTPPort'       => 587,
            'SMTPCrypto'     => 'tls',
            'SMTPAuth'       => true,
            'SMTPAutoTLS'    => true,
            'fromEmail'      => 'noreply@kanhakisliholiday.in',
            'fromName'       => 'Kanha Kisli Holiday',
            'receiverEmail'  => $adminMail,
            'mailType'       => 'html',
            'charset'        => 'UTF-8',
            'timeout'        => 15,
            'SMTPDebug'      => 0,
            'verifyPeer'     => false,
            'verifyPeerName' => false,
            'allowSelfSigned'=> true,
        ];
    }
}

if (! function_exists('send_mail_notification')) {
    /**
     * Send email notification via SMTP with custom SSL/TLS context & AUTH PLAIN
     */
    function send_mail_notification(string $subject, string $htmlBody, ?string $replyToEmail = null, ?string $replyToName = null, bool $bypassSetting = false, ?string $toOverride = null): bool
    {
        if (! $bypassSetting && get_site_setting('auto_email_lead', '1') !== '1') {
            log_message('info', 'send_mail_notification skipped: auto_email_lead is disabled in settings.');
            return false;
        }

        $config = get_mail_config();
        $port = (int) $config['SMTPPort'];
        $timeout = (int) ($config['timeout'] ?? 15);

        $context = stream_context_create([
            'ssl' => [
                'verify_peer'       => $config['verifyPeer'] ?? false,
                'verify_peer_name'  => $config['verifyPeerName'] ?? false,
                'allow_self_signed' => $config['allowSelfSigned'] ?? true,
            ],
        ]);

        $candidateHosts = array_unique(array_filter([
            $config['SMTPHost'] ?? 'mail.kanhakisliholiday.in',
            'mail.kanhakisliholiday.in',
            '127.0.0.1',
        ]));

        $socket = null;
        $connectedHost = null;

        foreach ($candidateHosts as $h) {
            $sock = @stream_socket_client(
                "tcp://{$h}:{$port}",
                $errno,
                $errstr,
                $timeout,
                STREAM_CLIENT_CONNECT,
                $context
            );
            if ($sock) {
                $socket = $sock;
                $connectedHost = $h;
                break;
            }
        }

        if (! $socket) {
            log_message('error', "SMTP Connection failed to candidate hosts on port {$port}");
            return false;
        }

        $getResp = function ($s) {
            $r = '';
            while ($line = fgets($s, 512)) {
                $r .= $line;
                if (isset($line[3]) && $line[3] === ' ') {
                    break;
                }
            }
            return $r;
        };

        $sendCmd = function ($s, $cmd) use ($getResp) {
            fputs($s, $cmd . "\r\n");
            return $getResp($s);
        };

        $getResp($socket); // Server banner
        $sendCmd($socket, 'EHLO ' . gethostname());
        $tlsResp = $sendCmd($socket, 'STARTTLS');

        if (! str_starts_with($tlsResp, '220')) {
            fclose($socket);
            return false;
        }

        $crypto = stream_socket_enable_crypto(
            $socket,
            true,
            STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT | STREAM_CRYPTO_METHOD_TLSv1_3_CLIENT
        );

        if (! $crypto) {
            fclose($socket);
            return false;
        }

        $sendCmd($socket, 'EHLO ' . gethostname());

        // AUTH PLAIN: "\0" . username . "\0" . password
        $authStr = base64_encode("\0" . $config['SMTPUser'] . "\0" . $config['SMTPPass']);
        $authResp = $sendCmd($socket, 'AUTH PLAIN ' . $authStr);

        if (! str_starts_with($authResp, '235')) {
            fclose($socket);
            return false;
        }

        $from = $config['fromEmail'];
        $rawTo = $toOverride ?: $config['receiverEmail'];
        $toEmails = array_map('trim', preg_split('/[,;]+/', $rawTo));
        $toEmails = array_filter($toEmails, fn($e) => filter_var($e, FILTER_VALIDATE_EMAIL));
        if (empty($toEmails)) {
            $toEmails = [$config['receiverEmail']];
        }

        $sendCmd($socket, "MAIL FROM:<{$from}>");
        foreach ($toEmails as $recipient) {
            $sendCmd($socket, "RCPT TO:<{$recipient}>");
        }
        $sendCmd($socket, 'DATA');

        $headers = [
            'Date: ' . date('r'),
            'From: ' . '=?UTF-8?B?' . base64_encode($config['fromName']) . "?= <{$from}>",
            'To: ' . implode(', ', array_map(fn($r) => "<{$r}>", $toEmails)),
            'Subject: ' . '=?UTF-8?B?' . base64_encode($subject) . '?=',
            'MIME-Version: 1.0',
            'Content-Type: text/html; charset=UTF-8',
            'Content-Transfer-Encoding: 8bit',
        ];
        if ($replyToEmail) {
            $replyName = $replyToName ? '=?UTF-8?B?' . base64_encode($replyToName) . '?= ' : '';
            $headers[] = "Reply-To: {$replyName}<{$replyToEmail}>";
        }

        $raw = implode("\r\n", $headers) . "\r\n\r\n" . $htmlBody . "\r\n.\r\n";
        fputs($socket, $raw);
        $dataResp = $getResp($socket);

        $sendCmd($socket, 'QUIT');
        fclose($socket);

        return str_starts_with($dataResp, '250');
    }
}

if (! function_exists('get_site_setting')) {
    /**
     * Retrieve a website setting from the database with in-memory request caching
     */
    function get_site_setting(string $key, string $default = ''): string
    {
        static $settings = null;
        if ($settings === null) {
            try {
                $model = new \App\Models\SettingModel();
                $settings = $model->getAllSettings();
            } catch (\Throwable $e) {
                $settings = [];
            }
        }
        return (string) ($settings[$key] ?? $default);
    }
}

if (! function_exists('parse_map_embed_url')) {
    /**
     * Extracts a clean embed src URL whether the user provided a full iframe tag or a direct URL.
     */
    function parse_map_embed_url(?string $input, string $default = ''): string
    {
        if (empty($input)) {
            return $default;
        }
        $trimmed = trim($input);
        // If user pasted an entire <iframe ... src="..." ...> tag
        if (preg_match('/<iframe\b[^>]*\bsrc=["\']([^"\']+)["\']/i', $trimmed, $matches)) {
            return htmlspecialchars_decode($matches[1]);
        }
        // Direct URL or already parsed
        return htmlspecialchars_decode($trimmed);
    }
}

if (! function_exists('is_admin_link_enabled')) {
    /**
     * Checks if the admin portal / link is enabled in settings.
     * When value is '1', admin routes work; otherwise returns false (triggering 404).
     */
    function is_admin_link_enabled(): bool
    {
        $val = get_site_setting('admin_enabled', '');
        if ($val === '') {
            $val = get_site_setting('admin_link', '');
        }
        if ($val === '') {
            $val = get_site_setting('admin_status', '');
        }
        // If not explicitly set in database, default to enabled ('1')
        if ($val === '') {
            return true;
        }
        return trim((string)$val) === '1';
    }
}


