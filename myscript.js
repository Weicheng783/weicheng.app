function serverTime(){
    var st = new Date(document.getElementById("serverYMD").innerHTML);
    st = new Date(st.setSeconds(st.getSeconds() + 1));

    document.getElementById("serverYMD").innerHTML = st.getFullYear() + "/" + (st.getMonth()+1) + "/" + st.getDate() + " " + st.getHours() + ":" + st.getMinutes() + ":" + st.getSeconds();
    setTimeout("serverTime()",1000);
}

var language = 0;

function language_switch(){
    // Language Codes: 0 English, 1 Simplified Chinese.
    if(language == 0){
        language = 1;
        document.getElementById("follow").innerHTML="看看我的Github空间";
    }else{
        language = 0;
        document.getElementById("follow").innerHTML="Follow Me on Github";
    }
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
        if(language == 0){
            var notice = "Good Night, Have a deep rest."
        }else{
            var notice = "夜深了，但新的一天开始啦~ 凌晨时分，快些睡觉吧!"
        }
    }else if(hh > 6 & hh < 11){
        if(language == 0){
            var notice = "Now is morning, keep doing and smile. :)"
        }else{
            var notice = "上午开始啦！抓住大好时光，去做事情吧！"
        }
    }else if(hh >= 11  & hh <= 12){
        if(language == 0){
            var notice = "We are currently at noon. Eat lunch for our own creation :)"
        }else{
            var notice = "午间时分咯~ 注意快些结束事情，准备干饭叭！"
        }
    }else if(hh > 12 & hh <= 18){
        if(language == 0){
            var notice = "We are currently at afternoon, keep doing... Let's Go!"
        }else{
            var notice = "下午开始啦！抓住大好时光，去做事情吧！"
        }
    }else if(hh >= 19 & hh <= 22){
        if(language == 0){
            var notice = "Evening Coming..."
        }else{
            var notice = "晚上了~ 这段时间应该好好安排一下咯~"
        }
    }else if(hh > 22 & hh <= 23){
        if(language == 0){
            var notice = "Good Night, Have a deep rest."
        }else{
            var notice = "夜深了，差不多收拾一下，准备休息吧。"
        }
    }else{
        // A very strange corner case if your time is 25 hours per day :)
        if(language == 0){
            var notice = "Have a nice day."
        }else{
            var notice = "继续加油哦~ :)"
        }
    }

    document.getElementById("ymd").innerHTML = +y+"-"+m+"-"+d+" "+hh+":"+mm+":"+ss+" "+notice+"";
    setTimeout("fun()",1000)
}

window.onload = function(){
    setTimeout("fun()",0)
    setTimeout("serverTime()",1000)
}