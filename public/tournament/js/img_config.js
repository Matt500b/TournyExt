$(document).ready(function() {

    function showImage(src,target) {
        var fr=new FileReader();
        // when image is loaded, set the src of the image where you want to display it
        fr.onload = function(e) {target.src =  this.result; };
        src.addEventListener("change",function() {
            // fill fr with image data
            fr.readAsDataURL(src.files[0]);
        });
    }

    var src = document.getElementById("proImgInput");
    var target = document.getElementById("targetImgInput");

    if(target) {
        showImage(src,target);
    }





    function showImageTwo(srctwo,targettwo) {
        var fr=new FileReader();
        // when image is loaded, set the src of the image where you want to display it
        fr.onload = function(e) { targettwo.src = this.result; };
        srctwo.addEventListener("change",function() {
            // fill fr with image data
            fr.readAsDataURL(src.files[0]);

        });
    }

    var srctwo = document.getElementById("proImgInputTwo");
    var targettwo = document.getElementById("targetImgInputTwo");

    if (targettwo) {
        showImage(srctwo, targettwo);
    }







// end of document ready
})
