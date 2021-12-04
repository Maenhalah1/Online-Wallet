import * as Request from '../../utils/helpers/request.js'
import * as Cookies from '../../utils/helpers/cookies.js'
import * as Master from "../../utils/helpers/master.js";

let transactions = [],
    paymentMethods = [],
    transactionTypeChoose,
    paymentMethodIndexChoose,
    currencyIndexChoose;



const loadResources = async () => {
    return await Request.apiCall('/api/transaction');

}
const drawTransactions = transactions => {
    let htmlElement = ``;
    transactions.forEach((transaction, index) => {
        const type = transaction.type === "d" ? "Deposit" : "Withdrawal";
        const status = transaction.status === -1 ? "Waiting" : transaction.status === 1 ? "Accepted" : "Rejected";
        const statusClass = status.toLowerCase();
        htmlElement += `<div class="card">
                            <div class="card-body">
                                <div class="row" id="Transaction">
                                    <div class="col-lg-3" style="font-weight: 600;color: var(--primary);">${type}</div>
                                    <div class="col-lg-3">${Master.convertAmountToLocalCurrency(transaction.amount)}</div>
                                    <div class="col-lg-3">${transaction.at}</div>
                                    <div class="col-lg-3"><span class="status ${statusClass}">${status}</span></div>
                                </div>
                            </div>
                        </div>`;
    })
    $("#TransactionsBox").empty().html(htmlElement)


}
const drawPaymentMethods = paymentMethods => {
    let htmlElement = ``;
    paymentMethods.forEach((method, index) => {
        htmlElement += `<div class="col-lg-3 mb-3 payment-method" data-index="${index}">
                            <div class="card link text-center">
                                <div class="image-box">
                                    <img class="card-img-top" src="${method.photo}" alt="Card image cap">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">${method.name}</h5>
                                </div>
                            </div>
                        </div>`;
    })
    $("#CreateTransactionBox").empty().html(htmlElement).fadeIn()
}

const drawCurrencies = currencies => {
    let htmlElement = ``;
    currencies.forEach((currency, index) => {
        htmlElement += `<div class="col-lg-3 mb-3 currency" data-index="${index}">
                            <div class="card link text-center">
                                <div class="card-body">
                                    <h5 class="card-title">${currency.code}</h5>
                                </div>
                            </div>
                        </div>`;
    })
    $("#CreateTransactionBox").empty().html(htmlElement).fadeIn()
}
const drawForm = () => {
    let htmlElement = `<div class="col-lg-12 text-left"><form id="TransactionForm">
                            <div class="row">
                                <div class="col-lg-6 col-md-8">
                                    <div class="form-group">
                                        <label>Amount</label>
                                        <input type="text" name="amount" class="form-control form-input">
                                        <div class="invalid-feedback" style="display: none"></div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <button class="btn btn-primary">Send</button>
                        </form></div>`;
    $("#CreateTransactionBox").empty().html(htmlElement).fadeIn()
}

loadResources()
    .then(response => {
        if(response.status_number === "S401"){
            Cookies.removeCookie('user')
            location.href = '/login'
            return;
        }
        ({transactions, paymentMethods} = response.data)
        // drawPaymentMethods(paymentMethods)
        drawTransactions(transactions)
    });


$(document).on('click', '.transaction-type', function () {
    transactionTypeChoose = $(this).data('type')
     $(this).parent().fadeOut(300, function (){
         drawPaymentMethods(paymentMethods)
     }).empty();
})

$(document).on('click', '.payment-method', function () {
    paymentMethodIndexChoose = $(this).data('index')
    $(this).parent().fadeOut(300, function (){
        drawCurrencies(paymentMethods[paymentMethodIndexChoose].currencies)
    }).empty();
})

$(document).on('click', '.currency', function () {
    currencyIndexChoose = $(this).data('index')
    $(this).parent().fadeOut(300, function (){
        drawForm()
    }).empty();
})

$(document).on('submit', "#TransactionForm", async function (e) {
    e.preventDefault();
    const $AmountInput = $('input[name="amount"]')
    let data = {
        payment_method: paymentMethods[paymentMethodIndexChoose].id,
        type: transactionTypeChoose,
        currency: paymentMethods[paymentMethodIndexChoose].currencies[currencyIndexChoose].id,
        amount: $AmountInput.val()
    }
    let response = await Request.apiCall('/api/transaction', data, "POST")
    if(response.status_number === "S201"){
        location.reload()
    }else if (response.status_number === 'S400'){
        for (const type in response.errors ){
            if(type === "amount"){
                $AmountInput.addClass("is-invalid")
                $AmountInput.next().empty().fadeIn().text(response.errors[type])
            }
        }
    }else if(response.status_number === 'S401'){
        Cookies.removeCookie('user')
        location.href = '/login'
    }
})
