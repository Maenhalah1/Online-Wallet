import * as Helper from '../../modules/helpers.js'
$('.change-activation').on('change', async function (e) {
    const activation = e.target.hasAttribute("checked") ? 1 : 0;
    const response = await Helper.ajaxCall("/ajax/user/change-activation", {activation, userId: $(this).data('id')});
    if(response.status_number === 'S201'){
        const message = activation ? "The User Has Been Activated" : "The User Has Been Blocked";
        swal(message, {
            icon: "success",
        });
    }
});
