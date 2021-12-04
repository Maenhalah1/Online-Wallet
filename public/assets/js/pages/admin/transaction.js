import * as Helper from '../../modules/helpers.js'

async function changeTransactionStatus(status, transactionId, targetButton) {
    let response = await Helper.ajaxCall("/ajax/transaction/change-status", {transactionId, status})
    if(response.status_number === 'S201'){
        let htmlElement = status === 1 ? `<span class="transaction-status approved">Approved</span>`
                                        :  `<span class="transaction-status rejected">Rejected</span>`;
        targetButton.parents("td").siblings("td.status").empty().append(htmlElement)
        targetButton.siblings(".btn.status-button").remove();
        targetButton.remove();
        return true;
    }
    return false;
}

$(document).on('click', '.accept-transaction',function () {
    swal({
        title: 'Accept Transaction',
        text: 'Are You Sure To Accept This Transaction ?',
        icon: "warning",
        buttons: ["No", "Yes"],
        dangerMode: true,
    }).then(async (accept) => {
        if (await changeTransactionStatus(1, $(this).data('id'), $(this))) {
            swal("The Transaction Has Been Accepted Successfully", {
                icon: "success",
            });
        }
    })
});

$(document).on('click', '.reject-transaction',async function () {
    swal({
        title: 'Reject Transaction',
        text: 'Are You Sure To Reject This Transaction ?',
        icon: "warning",
        buttons: ["No", "Yes"],
        dangerMode: true,
    }).then(async (accept) => {
        if (await changeTransactionStatus(0, $(this).data('id'), $(this))) {
            swal("The Transaction Has Been Rejected Successfully", {
                icon: "success",
            });
        }
    })
});
