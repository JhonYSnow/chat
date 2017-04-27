/**
 * Created by Administrator on 2017/4/24.
 */
var url = window.location.href;
var toId = url.split('id=')[1];
//alert(toId);

if ("WebSocket" in window){
    //alert("您的浏览器支持 WebSocket!");

    // 打开一个 web socket
    var ws = new WebSocket("ws:www.yuanpengyi.cn:8020");

    ws.onopen = function()
    {
        // Web Socket 已连接上，使用 send() 方法发送数据
        var name = document.getElementById('username').innerHTML;
        var mes = document.getElementById('mes').value;
        var toName = "all";
        //alert("%" + name + "%" + mes + "%" + toName);
        if(name != '' && mes != '' && toId != ''){
            ws.send("%" + name + "%" + mes + "%" + toId);
            alert(toId);
        } else{
            ws.send('conversation start');
        }
        //alert("数据发送中...");
    };

    ws.onmessage = function (evt) {
        var received_msg = evt.data;
        //alert(received_msg);
        if(received_msg[0] == '%'){
            var mes = received_msg.split('%');
            //alert(mes[0]);
            if(mes[1] == document.getElementById('username').innerHTML){
                //me to others
                $('#list').append("<div style='text-align: right; margin: 10px;'><p>"
                    + mes[2] + "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                    + mes[1] + "&nbsp;&nbsp;&nbsp;<span class='glyphicon glyphicon-user'></span></p></div>");
            }else if(mes[3] == document.getElementById('userid').innerHTML){
                //others to me
                $('#list').append("<div style='margin: 10px;'><p><span class='glyphicon glyphicon-user'>&nbsp;</span>"
                    + mes[1] + "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                    + mes[2] + "</p></div>");
            }
            document.getElementById('num').innerHTML = "当前在线人数：" + mes[4];
        }else if(received_msg[0] == 'c'){
            var mes = received_msg.split('%');
            document.getElementById('num').innerHTML = "当前在线人数：" + mes[1];
        }
        //alert("数据已接收...");
    };

    ws.onclose = function(){
        // 关闭 websocket
        alert("连接已关闭...");
    };
}else{
    // 浏览器不支持 WebSocket
    alert("您的浏览器不支持 WebSocket!");
}

function WebSocketTest(){
    ws.onopen();
}

// function yourName(){
//     if(document.getElementById('name').value != ''){
//         document.getElementById('name').readOnly = true;
//         document.getElementById('send').disabled = false;
//     }
// }