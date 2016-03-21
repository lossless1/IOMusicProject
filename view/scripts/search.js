$(document).ready(function ()
{
	var buttonFind;
	
	buttonFind = $("#input_find");
	
	buttonFind.on("click", function()
	{
		StartSearch();
	});
});

function StartSearch()
{
	var inputSearch;
	var objectSearch;
	
	inputSearch = $("#input_search");
	
	
	objectSearch = 
	{
		name: inputSearch.val()
	};
	
	callDispatcherPost("request=find", objectSearch, OnFound)
}

function OnFound(data)
{
	var outputDiv;
	var outputString;
	var audioObject;
	
	outputDiv = $("#output_result");
	outputDiv.empty();
	
	
	if(!$.isArray(data))
	{
		data = [data];
	}
	
	$.each(data, function(key, value)
	{
		outputString = String.Format("File found!!! <br />Name:{0}<br />Size:{1}<br/>Description:{2}<br/>Author:{3}<br/>Tags:{4}<br />", 
			value.name, value.filesize, value.description, value.author, value.tags);
	
		outputDiv.append(outputString);
		audioObject = buildAudioObject(value.source);
	
		outputDiv.append(audioObject);
		
		outputDiv.append("<br />--------------<br />");
	});

	
}