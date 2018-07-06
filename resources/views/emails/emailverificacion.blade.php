<?php
/**
 * Created by PhpStorm.
 * User: windows 8.1
 * Date: 06/07/2018
 * Time: 10:09 AM
 */
?>
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0073)http://tutsplus.github.io/a-simple-responsive-html-email/HTML/index.html# -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>A Simple Responsive HTML Email</title>
    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
            min-width: 100% !important;
        }

        img {
            height: auto;
        }

        .content {
            width: 100%;
            max-width: 600px;
        }

        .header {
            padding: 40px 30px 20px 30px;
        }

        .colormigoos {
            background:#5dbc01;
        }

        .innerpadding {
            padding: 30px 30px 30px 30px;
        }

        .borderbottom {
            border-bottom: 1px solid #f2eeed;
        }

        .subhead {
            font-size: 15px;
            color: #ffffff;
            font-family: sans-serif;
            letter-spacing: 10px;
        }

        .h1, .h2, .bodycopy {
            color: #153643;
            font-family: sans-serif;
        }

        .h1 {
            font-size: 33px;
            line-height: 38px;
            font-weight: bold;
        }

        .h2 {
            padding: 0 0 15px 0;
            font-size: 24px;
            line-height: 28px;
            font-weight: bold;
        }

        .bodycopy {
            font-size: 16px;
            line-height: 22px;
        }

        a {
            text-decoration: none;
        }

        .button {
            text-align: center;
            font-family: sans-serif;
            font-weight: bold;
            display: inline-block;
            white-space: nowrap;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 0.9rem;
            cursor: pointer;
            line-height: 1.6;
            border-radius: 0.25rem;
            -webkit-transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
        }

        .btn-primary {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }

        .button a {
            color: #ffffff;
            text-decoration: none;
        }

        .footer {
            padding: 20px 30px 15px 30px;
        }

        .footercopy {
            font-family: sans-serif;
            font-size: 14px;
            color: #ffffff;
        }

        .footercopy a {
            color: #ffffff;
            text-decoration: underline;
        }

        @media only screen and (max-width: 550px), screen and (max-device-width: 550px) {
            body[yahoo] .hide {
                display: none !important;
            }

            body[yahoo] .buttonwrapper {
                background-color: transparent !important;
            }

            body[yahoo] .button {
                padding: 0px !important;
            }

            body[yahoo] .button a {
                background-color: #e05443;
                padding: 15px 15px 13px !important;
            }

            body[yahoo] .unsubscribe {
                display: block;
                margin-top: 20px;
                padding: 10px 50px;
                background: #2f3942;
                border-radius: 5px;
                text-decoration: none !important;
                font-weight: bold;
            }
        }

        /*@media only screen and (min-device-width: 601px) {
          .content {width: 600px !important;}
          .col425 {width: 425px!important;}
          .col380 {width: 380px!important;}
          }*/

    </style>
    <link rel="stylesheet" type="text/css"
          href="chrome-extension://aedmpdookgbneegaeajpoldpnpfbpmlb/css/page.css?r=32813023.99631029">
</head>

<body yahoo="" bgcolor="#f6f8f1" style="">
<table width="100%" bgcolor="#f6f8f1" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
        <td>
            <!--[if (gte mso 9)|(IE)]>
            <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td>
            <![endif]-->
            <table bgcolor="#ffffff" class="content" align="center" cellpadding="0" cellspacing="0" border="0">
                <tbody>
                <tr>
                    <td style="background: linear-gradient( to left, #bbbc01,#5dbc01 82%);" class="header colormigoos">
                        <table width="70" align="left" border="0" cellpadding="0" cellspacing="0">
                            <tbody>
                            <tr>
                                <td height="70" style="padding: 0 20px 20px 0;">
                                    <img class="fix" src="{{asset('img/brand.png')}}" width="70"
                                         height="70" border="0" alt="">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <!--[if (gte mso 9)|(IE)]>
                        <table width="425" align="left" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td>
                        <![endif]-->
                        <table class="col425" align="left" border="0" cellpadding="0" cellspacing="0"
                               style="width: 100%; max-width: 425px;">
                            <tbody>
                            <tr>
                                <td height="70">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tbody>
                                        <tr>
                                            <td class="subhead" style="padding: 0 0 0 3px;">
                                                MIGOOS
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="h1" style="padding: 5px 0 0 0;color:white">
                                                Ya no tienes excusas para vivir tu aventura y nuevas experiencias.
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <!--[if (gte mso 9)|(IE)]>
                        </td>
                        </tr>
                        </table>
                        <![endif]-->
                    </td>
                </tr>
                <tr>
                    <td class="innerpadding borderbottom" style="border: 1px solid lightgrey;">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                                <td class="h2" align="center">
                                    Bienvenido a MIGOOS!
                                </td>
                            </tr>
                            <tr>
                                <td class="bodycopy">
                                    Hola <strong>{{$nombre}}</strong> para nosotros es importante validar tus datos y
                                    verificar que tu información sea
                                    real.
                                    Para completar tu registro en MIGOOS, ingresa al siguiente link:<br><br>
                                    <div style="text-align: center">
                                        <a href="{{url('/verificaremail/'.$email_token)}}" target="_blank"
                                           class="button btn-primary"
                                           style="text-align: center">
                                            verificar email
                                        </a>
                                    </div>
                                    <div style="text-align: center">
                                        <br><br>
                                        o copia y pega el siguiente link en el navegador:
                                        <h3>{{url('/verificaremail/'.$email_token)}}</h3>
                                    </div>


                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="footer colormigoos">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                                <td align="center" class="footercopy">
                                    ® {{date('Y')}} MIGOOS<br>
                                    <span class="hide">Todos los derechos reservados para migoos.com.co</span>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" style="padding: 20px 0 0 0;">
                                    <table border="0" cellspacing="0" cellpadding="0">
                                        <tbody>
                                        <tr>
                                            <td colspan="3">
                                                <h4 style="color:white">Siguenos en nuestras redes sociales</h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="37" style="text-align: center; padding: 0 10px 0 10px;">
                                                <a href="https://www.facebook.com/MigoosCommunity/" target="_blank">
                                                    <img src="{{asset('img/social/facebook.png')}}"
                                                         width="37" height="37" alt="Facebook" border="0">
                                                </a>
                                            </td>
                                            <td width="37" style="text-align: center; padding: 0 10px 0 10px;">
                                                <a href="http://www.twitter.com/" target="_blank">
                                                    <img src="{{asset('img/social/twitter.png')}}"
                                                         width="37" height="37" alt="Twitter" border="0">
                                                </a>
                                            </td>
                                            <td width="37" style="text-align: center; padding: 0 10px 0 10px;">
                                                <a href="http://www.twitter.com/" target="_blank">
                                                    <img src="{{asset('img/social/instagram.png')}}"
                                                         width="37" height="37" alt="Twitter" border="0">
                                                </a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
<div style="display:none;" id="px_data"><span
            id="px_path">chrome-extension://aedmpdookgbneegaeajpoldpnpfbpmlb/</span><span id="px_techs">jquery
github-pages</span><span id="px_show"></span></div>
</body>
</html>