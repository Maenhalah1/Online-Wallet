import * as Cookie from './cookies.js'

let user = Cookie.getCookie("User")
if(user === null || user === undefined)
    location.href = '/login'
