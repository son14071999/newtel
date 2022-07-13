app.value('functionHandle', {
    'insertUrl': function (name, value) {
        var url = window.location.href;
        url = url.replaceAll('#?', "?")
        url = url.replaceAll('#&', "&")
        var regex = new RegExp(name + '=[^&]*', 'i');
        let result = url.match(regex);
        if (result) {
            regex = new RegExp('(.*'+name + '=)([^&]*)(.*)', 'i');
            // let pattern = /(.*limit=)([0-9]+)(.*)/i;
            url = url.replace(regex, "$1" + value + "$3");
        } else {
            if (url.indexOf('?') > -1) {
                url += '&'+name+'=' + value
            } else {
                url += '?' + name + '=' + value
            }
        }
        return url
    }
})