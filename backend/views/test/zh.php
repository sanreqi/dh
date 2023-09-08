zh ----  ss


<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>

<script>

    wx.config({
        beta: true,// 调用wx.invoke形式的接口值时，该值必须为true。
        debug: true, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
        appId: "<?php echo $appId ?>", // 必填，政务微信的cropID
        timestamp: "<?php echo $timestamp ?>", // 必填，生成签名的时间戳
        nonceStr: "<?php echo $nonceStr ?>", // 必填，生成签名的随机串
        signature: "<?php echo $signature ?>",// 必填，签名，见附录1
        jsApiList: ["startAutoLBS","stopAutoLBS"] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
    });

    alert(123);
</script>
