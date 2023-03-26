PHP Send Mail
ตัวอย่าง function
<?php
function sendEmail($recipient,$subject,$message,$from,$replyto)
{
$array = array ("’" => "’");
$message = strtr($message, $array);
$message = ‘’.$message.’’." ";
$extra = ‘From: ‘.$from.’ <’.$replyto.’>’." ";
    $extra .= ‘Content-Type ; text/html; charset="tis-620"." ";
    $extra .= ‘Content-Transfer-Encoding; quoted-printable’." ";
    mail ($recipient, $subject, $message, $extra);
    }


    // multiple recipients
    $to = 'aidan@example.com' . ', '; // note the comma
    $to .= 'wez@example.com';

    // subject
    $subject = 'Birthday Reminders for August';

    // message
    $message = '
    <html><br />

    <head><br />
        <title>Birthday Reminders for August</title><br />
    </head><br />

    <body><br />
        <p>Here are the birthdays upcoming in August!</p><br />
        <table><br />
            <tr><br />
                <th>Person</th>
                <th>Day</th>
                <th>Month</th>
                <th>Year</th><br />
            </tr><br />
            <tr><br />
                <td>Joe</td>
                <td>3rd</td>
                <td>August</td>
                <td>1970</td><br />
            </tr><br />
            <tr><br />
                <td>Sally</td>
                <td>17th</td>
                <td>August</td>
                <td>1973</td><br />
            </tr><br />
        </table><br />
    </body><br />

    </html>
    ';

    // To send HTML mail, the Content-type header must be set
    $headers = 'MIME-Version: 1.0' . " ";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . " ";

    // Additional headers
    $headers .= 'To: Mary , Kelly ' . " ";
    $headers .= 'From: Birthday Reminder ' . " ";
    $headers .= 'Cc: birthdayarchive@example.com' . " ";
    $headers .= 'Bcc: birthdaycheck@example.com' . " ";

    // Mail it
    mail($to, $subject, $message, $headers);
    ?>
PHP Send Mail