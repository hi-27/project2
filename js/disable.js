var title = document.getElementById('title');
var description = document.getElementById('description');
title.onclick = function () {
    $('#description').attr("disabled",true);
};
title.onblur = function(){
    if(title.innerHTML == null){
        $('#description').attr("disabled",false);
    }
}

description.onclick = function () {
    $('#title').attr("disabled",true);
}
description.onblur = function(){
    if(description.innerHTML == null){
        $('#title').attr("disabled",false);
    }
}
