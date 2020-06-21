function upload() {
    var file = document.getElementById('upload').files[0];
    var pic = document.getElementById('pic');
    var reader = new FileReader();
    if (file){
        reader.readAsDataURL(file);
    }else{
        pic.src="";
    }
    reader.onloadend = function(){
        pic.src = reader.result;
        pic.style.display = "block";
    }
}