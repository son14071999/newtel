var app = angular.module("app-demo", []);
app.value('convertObjectToString', function(object){
    text = JSON.stringify(object);
    text = text.replaceAll("{","");
    text = text.replaceAll("}","");
    text = text.replaceAll(",","&");
    text = text.replaceAll(`"`,``);
    text = text.replaceAll(`:`,`=`);
    return text;
});