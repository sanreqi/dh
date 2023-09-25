<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script type="text/javascript" src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
<h2>SETTIMEOUT</h2>

<script>

    $(document).ready(function () {
        let fn = function() {
            $.ajax({
                type:"get",
                dateType:"json",
                url:"/test/save-wq",
                data:{},
                success: function () {}
            });
        }
        setTimeout(fn,5000);
    });

</script>