function callDispatcherPost(urlParams, postParams, callback)
{
	var url;
	url = APP_URL + "/" + "dispatcher.php?" + urlParams;
	$.ajax(
	{
		method: "POST",
		url: url,
		ContentType : 'application/json',
		data: postParams,
		success: function(result, code, socket)
		{
			var data;
			
			data = $.parseJSON(result);
			console.debug(result);
			if(data.result != "SUCCESS")
				return;
			
			if($.isFunction(callback))
				callback(data.data);
		}
	});
}

function buildAudioObject(url)
{
	var audioObject;
	var sourceObject;


	audioObject = $("<audio>");
	audioObject.attr("controls", "");
	sourceObject = $("<source>");
	sourceObject.attr("src", url);
	sourceObject.attr("type", "audio/ogg");
	
	audioObject.append(sourceObject);
	
	return audioObject;
}
