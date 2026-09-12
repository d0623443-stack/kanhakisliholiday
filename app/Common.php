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
        return [
            'protocol'       => 'smtp',
            'SMTPHost'       => 'mail.kanhawild.in',
            'SMTPUser'       => 'noreply@kanhawild.in',
            'SMTPPass'       => '5Bjp8@wiirw^^-a7',
            'SMTPPort'       => 587,
            'SMTPCrypto'     => 'tls',
            'SMTPAuth'       => true,
            'SMTPAutoTLS'    => true,
            'fromEmail'      => 'noreply@kanhawild.in',
            'fromName'       => 'Kanha Wild',
            'receiverEmail'  => defined('RECIEVER_MAIL') ? RECIEVER_MAIL : 'danishkhan989@gmail.com',
            'mailType'       => 'html',
            'charset'        => 'UTF-8',
            'timeout'        => 30,
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
    function send_mail_notification(string $subject, string $htmlBody, ?string $replyToEmail = null, ?string $replyToName = null): bool
    {
        $config = get_mail_config();
        $host = $config['SMTPHost'];
        $port = (int) $config['SMTPPort'];
        $timeout = (int) ($config['timeout'] ?? 30);

        $context = stream_context_create([
            'ssl' => [
                'verify_peer'       => $config['verifyPeer'] ?? false,
                'verify_peer_name'  => $config['verifyPeerName'] ?? false,
                'allow_self_signed' => $config['allowSelfSigned'] ?? true,
            ],
        ]);

        $socket = @stream_socket_client(
            "tcp://{$host}:{$port}",
            $errno,
            $errstr,
            $timeout,
            STREAM_CLIENT_CONNECT,
            $context
        );

        if (! $socket) {
            log_message('error', "SMTP Connection failed to {$host}:{$port} - {$errstr} ({$errno})");
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
        $to = $config['receiverEmail'];

        $sendCmd($socket, "MAIL FROM:<{$from}>");
        $sendCmd($socket, "RCPT TO:<{$to}>");
        $sendCmd($socket, 'DATA');

        $headers = [
            'Date: ' . date('r'),
            'From: ' . '=?UTF-8?B?' . base64_encode($config['fromName']) . "?= <{$from}>",
            'To: <' . $to . '>',
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


