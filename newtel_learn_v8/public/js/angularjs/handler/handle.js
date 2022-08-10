app.value('functionHandle', {
    'getListUser': (data, userFactory) => {
        userFactory
            .then(function (response) {
                data.users = response.data.users.data
                data.itemPerPage = response.data.users.per_page
                data.pages = Array.from({ length: Math.ceil(response.data.users.total/response.data.users.per_page) }, (_, i) => i + 1)
                data.currentPage = response.data.users.current_page
            })
            .catch(function(err){
                if(err.status==401){
                    window.location.replace(rootUrl + "login");
                }else{
                    alert(err.data.message)
                }
            })
    },

    'getListRole': (data, roleFactory) => {
        roleFactory
            .then(function (response) {
                data.roles = response.data.roles.data
                data.itemPerPage = response.data.roles.per_page
                data.pages = Array.from({ length: Math.ceil(response.data.roles.total/response.data.roles.per_page) }, (_, i) => i + 1)
                data.currentPage = response.data.roles.current_page
            })
            .catch(function(err){
                if(err.status==401){
                    window.location.replace(rootUrl + "login");
                }else{
                    alert(err.data.message)
                }
            })
    },
    'header': {
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
            'Accept': 'application/json'
        }

    }
})
