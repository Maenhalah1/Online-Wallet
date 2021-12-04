import * as Cookie from './cookies.js'

let user = Cookie.getCookie("User")
if(user !== null && user !== undefined)
    user = JSON.parse(user)
else
    user = {}
let currencySelected;
const convertAmountToLocalCurrency = (amount) => {
    let currencySelected = localStorage.getItem('currency_selected')
    let code = '$'
    currencySelected = currencySelected ? JSON.parse(currencySelected) : null
    if(currencySelected){
        amount = amount * currencySelected.difference_in_dollar;
        code = currencySelected.code
    }
    return `${code} ${amount}`
}

export {user, convertAmountToLocalCurrency}


