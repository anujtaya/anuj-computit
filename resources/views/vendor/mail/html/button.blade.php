<table class="action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
        <td align="center">
            <table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
                <tr>
                    <td align="center">
                        <table border="0" cellpadding="0" cellspacing="0" role="presentation">
                            <tr>
                                <td>
                                    <a href="{{ $url }}" class="button button-{{ $color ?? 'primary' }}" style="-webkit-box-shadow: 0px 17px 33px -8px rgba(37, 96, 133, 0.46); -moz-box-shadow: 0px 17px 33px -8px rgba(37, 96, 133, 0.46);box-shadow: 0px 17px 33px -8px rgba(37, 96, 133, 0.46);" target="_blank">{{ $slot }}</a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
