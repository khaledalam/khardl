<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('New form request.')}}</title>
</head>
<body style="background-color:#f9f9f9">
<!-- © 2018 Shift Technologies. All rights reserved. -->
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout:fixed;background-color:#f9f9f9" id="bodyTable">
    <tbody>
    <tr>
        <td style="padding-right:10px;padding-left:10px;" align="center" valign="top" id="bodyCell">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperWebview" style="max-width:600px">
                <tbody>
                <tr>
                    <td align="center" valign="top">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tbody>
                            <tr>
                                <td style="padding-top: 20px; padding-bottom: 20px; padding-right: 0px;" align="right" valign="middle" class="webview"> <a href="#" style="color:#bbb;font-family:'Open Sans',Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:20px;text-transform:none;text-align:right;text-decoration:underline;padding:0;margin:0" target="_blank" class="text hideOnMobile"></a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperBody" style="max-width:600px">
                <tbody>
                <tr>
                    <td align="center" valign="top">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableCard" style="background-color:#fff;border-color:#e5e5e5;border-style:solid;border-width:0 1px 1px 1px;">
                            <tbody>
                            <tr>
                                <td style="background-color:#00d2f4;font-size:1px;line-height:3px" class="topBorder" height="3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="padding-bottom: 20px;" align="center" valign="top" class="imgHero">
                                    <a href="#" style="text-decoration:none" target="_blank">
                                        <img alt="" border="0" src="http://email.aumfusion.com/vespro/img/hero-img/blue/heroGradient/user-account.png" style="width:100%;max-width:600px;height:auto;display:block;color: #f9f9f9;" width="600">
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td style="padding-left:20px;padding-right:20px" align="center" valign="top" class="containtTable ui-sortable">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableDescription" style="">
                                        <tbody>
                                            <p class="text" style="color:#666;font-family:'Open Sans',Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:22px;text-transform:none;text-align:center;padding:0;margin:0">{{ __('New form request.')}}</p>
                                        <tr>
                                            <td style="padding-bottom: 20px;" align="center" valign="top" class="description">
                                                <h1>{{ __('Form Details')}}</h1>
                                                <p>{{ __('Contact ID : #')}} <strong>{{$contact_id}}</strong></p>
                                                <p>{{ __('Email : ')}}<strong> {{$email}}</strong></p>
                                                <p>{{ __('Phone Number : ')}}<strong>{{$phone_number}}</strong></p>
                                                <p>{{ __('Business Name : ')}}<strong>{{$business_name}}</strong></p>
                                                <p>{{ __('Person Name : ')}} <strong>{{$responsible_person_name}}</strong></p>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size:1px;line-height:1px" height="20">&nbsp;</td>
                            </tr>

                            </tbody>
                        </table>
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="space">
                            <tbody>
                            <tr>
                                <td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <br><br><small><i>{{ __("This email was sent from an email address that can't receive emails. Please don't reply to this email.")}}</i></small>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>
