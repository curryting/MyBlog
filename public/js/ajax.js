/**
 * 参数 就一个 是个对象
 * obj = {
 * 		'type':请求的类型   get post
 * 		'url': 要发送的地址
 * 		'data': 参数   {'name':'goudan', 'age':18}
 * 		'async':是异步还是同步  true 异步 false  同步
 * 		'success': 结果了返回后调用的函数
 * }
 */
//http://www.haha.com?r=0.123123123&name=goudan&age=18
//name=goudan&age=18
function ajax(obj)
{
	//撸代码
	var xhr = new XMLHttpRequest();
	//处理url  防止浏览器缓存
	obj.url += '&r=' + Math.random();

	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4 && xhr.status == 200) {
			obj.success(xhr.responseText);
		}
	};
	//处理参数
	//name=goudan,
	//age=18
	var params = [];
	for (var i in obj.data) {
		//有一个问题  什么问题呢 快说 问题就是 我们的url中不能带中文 会乱码
		var key = encodeURIComponent(i);
		var value = encodeURIComponent(obj.data[i]);
		params.push(key + '=' + value);
	}

	//name=goudan&age=18
	obj.data = params.join('&');
	if (obj.type == 'get') {
		obj.url += '&' + obj.data 
	}
	xhr.open(obj.type, obj.url, obj.async);
	if (obj.type == 'get') {
		xhr.send();
	} else if (obj.type == 'post') {
		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(obj.data);
	}

}