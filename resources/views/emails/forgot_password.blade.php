<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Forgot Password</title>
    <style>
        body {
            background-color: #FFFFFF; padding: 0; margin: 0;
        }
    </style>
</head>
<body style="background-color: #FFFFFF; padding: 0; margin: 0;">
<table border="0" cellpadding="0" cellspacing="10" height="100%" bgcolor="#FFFFFF" width="100%" style="max-width: 650px;" id="bodyTable">
    <tr>
        <td align="center" valign="top">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" id="emailContainer" style="font-family:Arial; color: #333333;">
                <!-- Title -->
                <tr>
                    <td align="left" valign="top" colspan="2" style="border-bottom: 1px solid #CCCCCC; padding: 20px 0 10px 0;">
                        <span style="font-size: 18px; font-weight: normal;">FORGOT PASSWORD</span>
                    </td>
                </tr>
                <!-- Messages -->
                <tr>
                    <td align="left" valign="top" colspan="2" style="padding-top: 10px;">
                        <span style="font-size: 12px; line-height: 1.5; color: #333333;">
                            We have sent you this email in response to your request to reset your password on . After you reset your password, any credit card information stored in My Account will be deleted as a security measure.
                            <br/><br/>
                            To reset your password for <a href="{{url('/')}}">{{url('/')}}</a>, please follow the link below:
                            <p>
                                <a style="text-decoration:none; background: #09a8e1; color: #fff; border-radius: 5px; padding:10px;" href="{{url('/admin/reset-password/')}}/{{$emailData['token']}}">Click Hear</a>
                            </p>
                            <br/><br/>
                        </span>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>