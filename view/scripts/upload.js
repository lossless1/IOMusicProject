var selectAuthors;
var selectTags;
$(document).ready(function()
{
	var buttonSend;

	
	buttonSend = $("#input_send");
	selectAuthors = $("#authors");
	selectTags = $("#tags");
	
	buttonSend.on("click", function()
	{
		SendFile();
	});
	
	selectAuthors.chosen();
	selectTags.chosen();
	
	
});

function SendFile()
{
	var url;
	var form;
	var file;
	var formData;
	
	form = $("#forn_file");
	file = $("#input_file");
	
	console.debug(file);
	
	formData = new FormData();
	
	$.each(file[0].files, function(key, value)
	{
		formData.append("userfile", value);
		console.log("Key[%s]=>Value[%s]", key, value);
	});
	
	formData.append("author", selectAuthors.val());
	formData.append("tags", selectTags.val());
	console.debug(formData);
	
	url = APP_URL + "/" + "updispatcher.php";
	console.debug(url);
	
	$.ajax(
	{
		method: "POST", 
		url: url,
		xhr : function()
		{
			var currentXhr;
			
			currentXhr = $.ajaxSettings.xhr();
			
			if(currentXhr.upload)
			{
				currentXhr.upload.addEventListener("progress", OnProgressEventListener, false);
			}
			
			return currentXhr;
		},
		data: formData,
		cache: false,
		contentType: false,
		processData: false,
		
		success: function(result, code, socket)
		{
			var inData;
			var outputDiv;
			var outputString;
			
			inData = $.parseJSON(result);
			outputDiv = $("#output_result");
			console.debug(inData);
			
			if(inData.result != "SUCCESS")
				return;
			
			
			data = inData.data;
			outputString = String.Format("Uploaded file:<br />" + 
			"Name:{0}<br />Size:{1}", data.name, data.filesize);
			outputDiv.html(outputString);
		}
	});

}
			
function OnProgressEventListener(event)
{
	if(event.lengthComputable)
	{
		var progressBar;

		progressBar = $("#output_progress");

		progressBar.attr(
		{
			value:event.loaded,
			max:event.total
		});
	}
}