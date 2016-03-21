var url, file, comment, author, form, formData;
function sendFile() {
    form = $("#fileform");
    console.log(form);
    file = $("#fileinput");
    console.log(file);

    comment = document.getElementById('comment');
    comment = comment.value;

    formData = new FormData();

    $.each(file[0].files, function (key, value) {
        formData.append("userfile", value);

        console.log("Key[%s]=>Value[%s]", key, value);
    });


    formData.append('comment', comment);

    console.debug(formData);
    console.debug(file);


    url = "../php/upload_server_music.php";
    //E:/xampp/htdocs/dashboard/IOMusicProject/app/php/upload.php

    $.ajax(
        {
            method: "POST",
            url: url,
            xhr: function () {
                var currentXhr;

                currentXhr = $.ajaxSettings.xhr();

                if (currentXhr.upload) {
                    currentXhr.upload.addEventListener("progress", progressEventListener, false);
                }

                return currentXhr;
            },
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                var dataDiv;

                dataDiv = $("#data");
                console.log(data);
                dataDiv.html(data);
            }
        });
}
function progressEventListener(event) {
    if (event.lengthComputable) {
        var progressBar;

        progressBar = $("progress");

        progressBar.attr(
            {
                value: event.loaded,
                max: event.total
            });
    }
}
