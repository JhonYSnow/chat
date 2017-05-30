const WebSocket = require('ws');

const wss = new WebSocket.Server({
	port: 8020,
	clientTracking: true
});

var name = '';
var toId = '';
var type = '';    		
/*wss.broadcast = function broadcast(data){
	wss.clients.forEach(function each(client){
		console.log('client: ' + client.id);
		if(client.readyState == WebSocket.OPEN){
			client.send(data);
		}
	});
}*/

wss.on('connection', function connection(ws){
	ws.on('message', function incoming(message){

		if(typeof(message) != 'string'){
			console.log('pic');
 		  var a = wss.clients.size;
  		//console.log(a);
  		//
      for (let item of wss.clients){
  			//console.log(item.upgradeReq.headers);
  			//console.log('info:---- ' + wss.info);
  			item.send(message);
        item.send('picTo%' + name + '%' + toId + '%' + type + '%' + a);
  			console.log(message);
  		}
		}else{
			console.log(message);
 		  //console.log('test:  headers');
  		var a = wss.clients.size;
  		//console.log(a);
  		//
      if(message[0]=='p'){
        name = message.split('%')[1];
        toId = message.split('%')[2];
	type = message.split('%')[3];
      }else{
        for (let item of wss.clients){
    			console.log(item.upgradeReq.headers);
    			console.log('mes:---- ' + message);
    			item.send(message + '%' + a);
    			console.log('clients:----' + a);
    		}
      }
		}
		
	});

	ws.send('GO!!!');
});
