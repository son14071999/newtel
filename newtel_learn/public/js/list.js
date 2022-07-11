
// itemPerPage.addEventListener('change', function(){
//     console.log(this.value);
// });


document.addEventListener("DOMContentLoaded", function(){
    var input = document.getElementById('itemPerPage');
    input.addEventListener('change', function(){
        var url = window.location.href;   
        console.log(this.value); 
        if (url.indexOf('?') > -1){
        url += '&limit='+this.value
        }else{
        url += '?param='+this.value
        }
        window.location.href = url;
    });
    
});