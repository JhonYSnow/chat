/**
 * Created by Administrator on 2017/4/24.
 */
var url = window.location.href;
var state = 0;
var addFriend = 0;
var str = url.split('00/')[1];

function resetState() {
    if(str[0] == 'c') {
        state = 1;
    }else if(str[0] == 'f' || str[0] == '') {
        state = 2;
    }else if(str[0] == 'a'){
        state = 4;
    }else if(str[0] == 't'){
        state = 5;
    }
}
resetState();
//alert(toId);

if ("WebSocket" in window){
    //alert("您的浏览器支持 WebSocket!");

    // 打开一个 web socket
    var ws = new WebSocket("ws:www.yuanpengyi.cn:8020");

    ws.onopen = function()
    {
        var user1 = document.getElementById('userid').innerHTML;
        if(state == 1) {
            // Web Socket 已连接上，使用 send() 方法发送数据

            var name = document.getElementById('username').innerHTML;
            var mes = document.getElementById('mes').value;
            var toId = url.split('id=')[1];
            //alert("%" + name + "%" + mes + "%" + toId);
            if (name != '' && mes != '' && toId != '') {
                ws.send("mes%" + name + "%" + mes + "%" + toId);
            } else {
                ws.send('conversation start');
            }
        }else if(state == 2){

            if(addFriend == 0) {
                ws.send('connect');
            }else{

                ws.send("add%" + user1 + "%" + addFriend);
            }
        }else if(state == 3){

            ws.send("res%" + user1 + "%" + addFriend);

            resetState();
            //alert(state);
        }else if(state == 4){
            var name = document.getElementById('username').innerHTML;
            var mes = document.getElementById('mes').value;

            if(document.getElementById('mes').value == ''){
                ws.send("conversation start");
            }else{
                ws.send("toAll%" + name + "%" + mes);
            }
        }else if(state == 5){
            var name = document.getElementById('username').innerHTML;
            var mes = document.getElementById('mesPic').files[0];
            var toId = url.split('id=')[1];

            if(!(document.getElementById('mesPic').files)){
                ws.send("conversation start");
            }else{
                ws.send("picTo%" + name + "%" + toId);
                ws.send(mes);
                document.getElementById('mesPic').value = '';
            }

            resetState();
        }

    };

    ws.onmessage = function (evt) {
        var received_msg = evt.data;
        console.log(evt);
        if(received_msg[0] == 'm'){

            var mes = received_msg.split('%');

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
            document.getElementById('num1').innerHTML = "当前在线人数：" + mes[4];
        }else if(received_msg[0] == 'a'){

            var mes = received_msg.split('%');
            //alert(mes[2]);
            if(mes[2] == document.getElementById('userid').innerHTML){
                $('#myModal').modal('show');
                document.getElementById('myModalLabel').innerHTML = mes[1] + "@请求添加您为好友";
            }
        }else if(received_msg[0] == 'r'){

            var mes = received_msg.split('%');
            if(mes[2] == document.getElementById('userid').innerHTML){
                $('#myModal').modal('show');
                $('#acceptBtn').hide();
                document.getElementById('myModalLabel').innerHTML = mes[1] + "@接受了您的好友请求";
            }
        }else if(received_msg[0] == 'c'){

            var mes = received_msg.split('%');
            document.getElementById('num').innerHTML = "当前在线人数：" + mes[1];
            document.getElementById('num1').innerHTML = "当前在线人数：" + mes[1];
        }else if(received_msg[0] == 't'){
            var mes = received_msg.split('%');
            //alert(mes[0]);
            if(mes[1] == document.getElementById('username').innerHTML){
                //me to others
                $('#list').append("<div style='text-align: right; margin: 10px;'><p>"
                    + mes[2] + "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                    + mes[1] + "&nbsp;&nbsp;&nbsp;<span class='glyphicon glyphicon-user'></span></p></div>");
            }else{
                //others to me
                $('#list').append("<div style='margin: 10px;'><p><span class='glyphicon glyphicon-user'>&nbsp;</span>"
                    + mes[1] + "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                    + mes[2] + "</p></div>");
            }
            document.getElementById('num').innerHTML = "当前在线人数：" + mes[3];
            document.getElementById('num1').innerHTML = "当前在线人数：" + mes[3];
        }else if(typeof(received_msg) != "string"){
            console.log('pic');
            var reader = new FileReader();
            reader.onload = function(evt){
                if(evt.target.readyState == FileReader.DONE){
                    var blob = evt.data;
                    var url = evt.target.result;
                    var picName = document.cookie.split('picName=')[1].split(';')[0];
                    var picToId = document.cookie.split('picToId=')[1].split(';')[0];
                    if(picName == document.getElementById('username').innerHTML) {
                        $('#list').append("<div style='text-align: right; margin: 10px;'><img style='height: 150px;' src='" + url + "'>&nbsp;&nbsp;&nbsp;"
                            + picName + "&nbsp;&nbsp;&nbsp;<span class='glyphicon glyphicon-user'></span></div>");
                    }else{
                        $('#list').append("<div style='margin: 10px;'><span class='glyphicon glyphicon-user'></span>"
                            + picName + "&nbsp;&nbsp;&nbsp;"
                            + "<img style='height: 150px;' src='" + url + "'>"
                            +"</div>");
                    }
                }
            }
            reader.readAsDataURL(received_msg);
        }else if(received_msg[0] == 'p'){
            var mes = received_msg.split('%');

            document.cookie = "picName=" + mes[1] + ";" ;
            document.cookie = "picToId=" + mes[2] + ";" ;
            document.getElementById('num').innerHTML = "当前在线人数：" + mes[3];
            document.getElementById('num1').innerHTML = "当前在线人数：" + mes[3];
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
    console.log(document.getElementById('mesPic').files);
    if(document.getElementById('mesPic').files.length != 0){
        state = 5;
    }
    ws.onopen();
    document.getElementById('mes').value = '';
}

function webSocketAdd(user2) {
    addFriend = user2;
    ws.onopen();
}

function webSocketAccept(user2) {
    state = 3;
    addFriend = user2;
    ws.onopen();
}

// function yourName(){
//     if(document.getElementById('name').value != ''){
//         document.getElementById('name').readOnly = true;
//         document.getElementById('send').disabled = false;
//     }
// }