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

    wx.getLocation({
        type: 'wgs84', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
        success: function (res) {
            var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
            alert(latitude);
            var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
            var speed = res.speed; // 速度，以米/每秒计
            var accuracy = res.accuracy; // 位置精度
            var gps_status =  res.gps_status; //gps状态，-1：应用未获取GPS权限；
                                              // 0：已获取GPS权限，GPS信号异常；
                                              // 1：已获取GPS权限，GPS信号正常，AGPS信号异常；
                                              // 2：已获取GPS权限，GPS信号异常，AGPS信号正常；
                                              // 3：已获取GPS权限，GPS/AGPS信号正常
        }
    });

    wx.invoke('startAutoLBS',{
        type: 'gcj02', // wgs84是gps坐标，gcj02是火星坐标
        continue:  1, // 默认关闭，值为1的时候启用。页面关闭后，也可继续获取成员的位置信息。需在“应用详情” - “接收消息”页面配置“实时位置信息事件”回调接口，此参数才会生效。
    }, function(res) {
        if (res.err_msg == "startAutoLBS:ok") {
            //调用成功
            alert('success');
        } else {
            alert('fail');
            //错误处理
        }
    });

</script>
