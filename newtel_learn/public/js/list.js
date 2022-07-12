
// itemPerPage.addEventListener('change', function(){
//     console.log(this.value);
// });


document.addEventListener("DOMContentLoaded", function(){
    var input = document.getElementById('itemPerPage');
    if(input){
        input.addEventListener('change', function(){
            var url = window.location.href;
            let result = url.match(/limit=[0-9]+/i);
    
            if(result){
                let pattern = /(.*limit=)([0-9]+)(.*)/i;
                url = url.replace(pattern, "$1"+this.value+"$3");
            }else{
                if (url.indexOf('?') > -1){
                url += '&limit='+this.value
                }else{
                url += '?param='+this.value
                }
            }
            window.location.href = url;
        });
    }

});
