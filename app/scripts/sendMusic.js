var url, form, textID, data, code, json, js, like, likeInt;

function sendMusic() {

    textID = document.getElementById('name');
    textID = textID.value;
    url = "../php/search_server_music.php";
    $.ajax(
        {
            url: url,
            method: "GET",
            data: {name: textID},
            success: function (msg) {
                //$("#player").html(msg); JSON MESSAGE
                json = JSON.parse(msg);
                $("#song").empty();

                $.each(json, function (key, value) {
                    CreateTag(value);
                });
            }
        });
}

function CreateTag(data) {
    data.name = data.name.replace(new RegExp('_', 'g'), " ");

    var nameObject,tagSong,audioObject,authorObject;

    tagSong = $("#song");

    audioObject = BuildAudioObject(data.source);
    nameObject = BuildNameObject(data);
    authorObject = BuildAuthorObject(data);

    tagSong.append(nameObject);
    tagSong.append(authorObject);
    tagSong.append(audioObject);
    tagSong.append($("<br>"));
    tagSong.append($("<br>"));
}

function BuildNameObject(data){
    var name;
    name = $("<div>");
    name.html("<b>Song:</b>");

    nameObject = $("<a>");
    nameObject.attr("href","../php/page_song.php?id="+data.id+"&fullname="+data.fullname);/////
    nameObject.html(data.name+" ");
    name.append(nameObject);
    return name;
}
function BuildAuthorObject(data){
    var author;
    author = $("<div>");
    author.html("<b>Author:</b>");

    authorObject = $("<a>");
    authorObject.attr("href","../php/page_author.php?id="+data.id+"&author="+data.author);/////
    authorObject.html(data.author);
    author.append(authorObject);
    return author;
}
function BuildAudioObject(url) {
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