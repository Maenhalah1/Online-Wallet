function setCookie(name,value, expire = null){
    let cookieData = `${name}=${value};`;
    if(expire !== null){
        let date = new Date();
        date.setTime(date.getTime() + expire);
        cookieData += ` expires=${expire}`
    }
    document.cookie = cookieData;
}

function getCookie(name){
    let cookies = "; " + document.cookie, value;
    cookies = cookies.split("; " + name + "=");
    if(cookies.length === 1){return null;}
    value= cookies[1].split("; ");
    return value[0];
}

function removeCookie(name){
    document.cookie = name + "=" + null + "; expires=Thu, 01 Jan 1970 00:00:00 GMT";
}

export {setCookie, getCookie, removeCookie};
