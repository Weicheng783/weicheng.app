<html>
    <head>
        <meta charset="utf-8">
        <title>Radio Beta</title>
    </head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />

    <body style="background-color: antiquewhite;">

        <div id='header_group' style="display:block; text-align: center;"></div>

        <p class="narrator" style="font-size: x-large; text-align: center;">BBC Radio Manchester -- Radio [Canary Release 220820]</p>
        <p class="narrator" style="font-size: x-large; text-align: center; " id="ymd"></p>
        <p class="narrator" style="font-size: medium; text-align: center;">在下方选择你要看的时间段，每段十分钟，文件名为时段起止时间的大致估计。</p>
        

        <?php
            // live message showing
            // set default timezone
            date_default_timezone_set('Europe/London'); // CDT
            $current_date = date('Y/m/d H:i:s');
            echo '<p class="narrator" style="font-size: large; text-align: center; ">英国伦敦服务器时间: <strong id="serverYMD">'.$current_date.'</strong>.</p>';

            function getSymbolByQuantity($bytes) {
                $symbols = array('B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB', 'EiB', 'ZiB', 'YiB');
                $exp = floor(log($bytes)/log(1024));
            
                return sprintf('%.2f '.$symbols[$exp], ($bytes/pow(1024, floor($exp))));
            }

            // $ds contains the total number of bytes available on "/"
            $ds = disk_total_space("/");
            $ds_symbol = getSymbolByQuantity($ds);

            // $df contains the number of bytes available on "/"
            $df = disk_free_space("/");
            $du = $ds - $df;
            $du_symbol = getSymbolByQuantity($du);

            echo '<p class="narrator" style="font-size: medium; text-align: center;">服务器磁盘空间使用情况：已用 '.$du_symbol.' / 总共 '.$ds_symbol.'. 当可用磁盘空间小于一定数值时，前期Audio会被删除。</p>';
            echo '<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">';

            foreach (array_reverse(glob('/home/ubuntu/weicheng/live' . '/*.*')) as $filename) {
                $filename = substr($filename);
                echo "<p style='text-align:center; font-size: large;'><a href='https://weicheng.app/live/".$filename."' style='text-align:center;'>".$filename."</a></p>";
            }
        ?>

    </body>

</html>


<script>

    function serverTime(){
        var st = new Date(document.getElementById("serverYMD").innerHTML);
        // console.log(document.getElementById("serverYMD").innerHTML);
        st = new Date(st.setSeconds(st.getSeconds() + 1));

        document.getElementById("serverYMD").innerHTML = st.getFullYear() + "/" + (st.getMonth()+1) + "/" + st.getDate() + " " + st.getHours() + ":" + st.getMinutes() + ":" + st.getSeconds();
        setTimeout("serverTime()",1000);
    }

    function fun(){
        var date = new Date()
        var y = date.getFullYear();
        var m = date.getMonth()+1;
        var d = date.getDate(); 
        var hh = date.getHours();
        var mm = date.getMinutes();
        var ss = date.getSeconds();
        if(hh <= 6 & hh >= 0){
            var notice = "凌晨好."
        }else if(hh > 6 & hh < 11){
            var notice = "现在是早上或上午."
        }else if(hh >= 11  & hh <= 12){
            var notice = "正在中午."
        }else if(hh > 12 & hh <= 18){
            var notice = "现在是下午."
        }else if(hh >= 19 & hh <= 22){
            var notice = "晚上来了."
        }else if(hh > 22 & hh <= 23){
            var notice = "好梦."
        }else{
            var notice = "Have a nice day."
        }

        document.getElementById("ymd").innerHTML = +y+"-"+m+"-"+d+" "+hh+":"+mm+":"+ss+" "+notice;
        setTimeout("fun()",1000)
    }

    window.onload = function(){
        setTimeout("fun()",0)
        setTimeout("serverTime()",1000)
    }
</script>


<style>
    #map {
        position: relative; 
        top: 0; 
        right: 0; 
        bottom: 0; 
        left: 0;
        border-radius: 5px;
        border-width: 5px;
        border: solid;
        border-color: skyblue;
        background-color: antiquewhite;
        text-align: center;
        display:inline-block;
        margin-left: 25%;
    }

    .narrator{
        animation-name: narrator_enter; 
        animation-duration:5s;
        font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
    }

    .table_font{
        font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        font-size: 20px;
    }

    .input_font{
        font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        font-size: 25px;
        text-align: center;
    }

    @keyframes narrator_enter {
        0%   {margin-top:-50px;}
        100% {margin-top:15px;}
    }

    #logo{
        text-align:left;
    }

    #header {
        
        /* display: inline-block; */
        border-radius: 5px;
        border-width: 5px;
        border: solid;
        border-color: skyblue;
        background-color: antiquewhite;
        text-align: center;
        display:inline-block;
        margin-left: 25%;
        /* margin-right: 50%; */
        
    }

    .header_button {
        margin: 20px, 20px, 20px, 20px;
        border-radius: 10px;
        /* text-align: right; */

        font-size: large;
    }

    .header_button:hover{
        background-color: rgb(36, 200, 221);
    }

    .header_button:active{
        background-color: sandybrown;
    }

    .good{
        text-align: center;    
    }

</style>