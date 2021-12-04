import * as Request from '../../utils/helpers/request.js'
import * as Cookies from '../../utils/helpers/cookies.js'
import * as Master from '../../utils/helpers/master.js'

let wallet;



const loadResources = async () => await Request.apiCall('/api/home');


const drawWallet = wallet => {
    let htmlElement = `<div class="col-lg-4 m-auto">
                            <div class="card text-center">
                                <div class="card-header">
                                    <h5>Total Amount In My Wallet</h5>
                                </div>
                                <div class="card-body">
                                    <h2 class="card-title">${Master.convertAmountToLocalCurrency(wallet.total_amount)}</h2>
                                    <h5>Last Change: ${wallet.last_update}</h5>
                                </div>
                            </div>
                        </div>`;

    $("#WalletBox").empty().html(htmlElement).fadeIn()
}

loadResources()
    .then(response => {
        if(response.status_number === "S401"){
            Cookies.removeCookie('user')
            location.href = '/login'
            return;
        }
        ({wallet} = response.data)
        drawWallet(wallet)
    });


