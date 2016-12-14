<form name="alipayment" action="../libs/alipay/alipayapi.php" method="post"  id="checkForm1">
    <div style="width: 100%;text-align: center;">
        <input type="hidden" name="WIDout_trade_no" id="WIDout_trade_no" value="<?php echo $data['orderNumber']?>">
        <input type="hidden" name="WIDshow_url" id="WIDshow_url" value="http://test.toeflonline.cn">
        <input type="hidden" name="WIDsubject" id="WIDsubject" value="课程购买">
        <input type="hidden" name="WIDtotal_fee" id="WIDtotal_fee" value="<?php echo $data['']?>">
        <input type="hidden" name="WIDbody" id="WIDbody" value="{x2;$goods['remarks']}">
    </div>
</form>