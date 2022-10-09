<!DOCTYPE html>
<html>
<head>
  <title>Find Wala</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <style type="text/css">
    img.social-email:hover {
      transform: rotate(359deg);
    }
    img.social-email {
      width: 30px;
      display: inline-block;
      transition: all 0.5s ease;
    }
    @media only screen and (max-width: 600px) {
      .main {
        width: 320px !important;
      }
      .inside-footer {
        width: 320px !important;
      }
      table[class="contenttable"] { 
        width: 320px !important;
        text-align: left !important;
      }
      td[class="force-col"] {
        display: block !important;
      }
      td[class="rm-col"] {
        display: none !important;
      }
      .mt {
        margin-top: 15px !important;
      }
      *[class].width300 {width: 255px !important;}
      *[class].block {display:block !important;}
      *[class].blockcol {display:none !important;}
      .emailButton{
        width: 100% !important;
      }

      .emailButton a {
        display:block !important;
        font-size:18px !important;
      }

    }
  </style>

</head>
<body link="#00a5b5" vlink="#00a5b5" alink="#00a5b5">

  <table class=" main contenttable" align="center" style="font-weight: normal;border-collapse: collapse;border: 0;margin-left: auto;margin-right: auto;padding: 0;font-family: Arial, sans-serif;color: #555559;background-color: white;font-size: 16px;line-height: 26px;width: 600px;">
    <tr>
      <td class="border" style="border-collapse: collapse;border: 1px solid #eeeff0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;">
        <table style="font-weight: normal;border-collapse: collapse;border: 0;margin: 0;padding: 0;font-family: Arial, sans-serif;">
          <tr>
            <td colspan="4" valign="top" class="image-section" style="border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;background-color: #fff;border-bottom: 4px solid #e33030">
              <a href="https://findwala.com"><img class="top-image" src="{!! asset('public/images/findwala-logo.png') !!}" style="line-height: 1;width: 200px;padding: 10px; max-width: 100%;"></a>
            </td>
          </tr>
          <tr>
            <td valign="top" class="side title" style="border-collapse: collapse;border: 0;margin: 0;padding: 20px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;vertical-align: top;background-color: white;border-top: none;">
              <table style="font-weight: normal;border-collapse: collapse;border: 0;margin: 0;padding: 0;font-family: Arial, sans-serif;">
                <tr>
                  <td class="top-padding" style="border-collapse: collapse;border: 0;margin: 0;padding: 5px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;"></td>
                </tr>
                
                <tr>
                  <td class="top-padding" style="border-collapse: collapse;border: 0;margin: 0;padding: 15px 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 21px;">
                    <hr size="1" color="#eeeff0">
                  </td>
                </tr>
                <tr>
                  <td class="text" style="border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;">
                    <div class="mktEditable" id="main_text">
                      Hi {{$name}}! <br><br>
                      Thank you for joining findwala.com. You need to confirm your account to start using our services. Just press the button below.<br><br>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="text" style="border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 24px;">
                    <div class="mktEditable" id="download_button" style="text-align: center;">
                      <a style="color:#ffffff; background-color: #e33030; border: 20px solid #e33030; border-left: 20px solid #e33030; border-right: 20px solid #e33030; border-top: 10px solid #e33030; border-bottom: 10px solid #e33030;border-radius: 3px; text-decoration:none;" href="{{ route('verify_email',['verification_token' => $verification_token]) }}" target="_blank">Confirm Account</a><br><br>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="text" style="border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;">
                    <div class="mktEditable" id="main_text">

                      Thank You.<br>
                      FindWala Team.<br>
                      <a href="https://findwala.com">www.findwala.com</a>
                    </div>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td valign="top" align="center" style="border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;">
              <table style="font-weight: normal;border-collapse: collapse;border: 0;margin: 0;padding: 0;font-family: Arial, sans-serif;">
                <tr>
                  <td align="center" valign="middle" class="social" style="border-collapse: collapse;border: 0;margin: 0;padding: 10px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;text-align: center;">
                    <table style="font-weight: normal;border-collapse: collapse;border: 0;margin: 0;padding: 0;font-family: Arial, sans-serif;">
                      <tr>
                        <td style="border-collapse: collapse;border: 0;margin: 0;padding: 5px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;"><a href="#"><img class="social-email" src="{!! asset('public/images/facebook1.png') !!}"></a></td>
                        <td style="border-collapse: collapse;border: 0;margin: 0;padding: 5px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;"><a href="#"><img class="social-email" src="{!! asset('public/images/twitter1.png') !!}"></a></td>
                        <td style="border-collapse: collapse;border: 0;margin: 0;padding: 5px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;"><a href="#"><img class="social-email" src="{!! asset('public/images/linkin1.png') !!}"></a></td"></a></td>
                        <td style="border-collapse: collapse;border: 0;margin: 0;padding: 5px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;"><a href="#"><img class="social-email" src="{!! asset('public/images/whatsapp1.png') !!}"></a></td>
                        <td style="border-collapse: collapse;border: 0;margin: 0;padding: 5px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;"><a href="#"><img class="social-email" src="{!! asset('public/images/pinterest1.png') !!}"></a></td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr bgcolor="#fff" style="border-top: 4px solid #e33030;">
            <td valign="top" class="footer" style="border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;background: #fff;text-align: center;">
              <table style="font-weight: normal;border-collapse: collapse;border: 0;margin: 0;padding: 0;font-family: Arial, sans-serif;">
                <tr>
                  <td class="inside-footer" align="center" valign="middle" style="border-collapse: collapse;border: 0;margin: 0;padding: 20px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 12px;line-height: 16px;vertical-align: middle;text-align: center;width: 580px;">
                    <div id="address" class="mktEditable">
                      <b>copyright &copy;2020 all rights reserved</b><br>
                    </div>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
