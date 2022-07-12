app.value('configURL', {
        loginPost : function(userLogin){
            return {
                method: 'POST',
                url: rootUrl+'api/login',
                data: userLogin,
                headers: {'Content-Type':'application/x-www-form-urlencoded'}
            }
        },
        listUserGet: {
                method: 'GET',
                url: rootUrl+'api/listUser',
        },
        deleteUser: (idUser) => {
            return{
                method: 'GET',
                url: rootUrl+'api/deleteListUser/'+idUser,
            }
        }
        
    }
);