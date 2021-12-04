import * as Master from '../../utils/helpers/master.js'
import * as Request from "../../utils/helpers/request.js";
import * as Cookies from "../../utils/helpers/cookies.js";

$("#navbarDropdown").text(Master.user.username ? Master.user.username : 'user')

$(document).on('submit', "#logoutForm", async function (e) {
    e.preventDefault();
    let response = await Request.apiCall($(this).attr('action'), [], "POST")
    console.log(response)
    Cookies.removeCookie('user')
    location.href = '/login';
})



const loadCurrencies = async () => await Request.apiCall('/api/currency')

const drawCurrencies = currencies => {
    let currencySelected = localStorage.getItem('currency_selected')
    currencySelected = currencySelected ? JSON.parse(currencySelected) : null
    let htmlElement = `<select class="form-control" id="currencySelect"><option value="0">Default</option>`;
    currencies.forEach((currency, index) => {
        htmlElement += `<option value="${currency.id}" ${currencySelected ? (currencySelected.id === currency.id ? "selected" : '') : ''}>${currency.code}</option>`
    })
    htmlElement += '</select>'
    $("#CurrenciesDropdownBox").empty().html(htmlElement)
}

loadCurrencies().then(response => {
    if(response.status_number === "S401"){
        Cookies.removeCookie('user')
        location.href = '/login'
        return;
    }
    drawCurrencies(response.data)
})

$(document).on('change', '#currencySelect', async function () {
    if($(this).val() == 0){
        localStorage.clear();
    }else{
        const response = await Request.apiCall(`/api/currency/${$(this).val()}`)
        if (response.status_number === "S401") {
            Cookies.removeCookie('user')
            return location.href = '/login'
        }
        localStorage.setItem('currency_selected', JSON.stringify(response.data))
    }
    location.reload()
})
