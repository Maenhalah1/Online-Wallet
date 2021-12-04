import * as Request from '../../utils/helpers/request.js'
import * as Cookies from '../../utils/helpers/cookies.js'

$('#loginForm').on('submit', async function (e) {
    e.preventDefault();
    const formData = new FormData($(this)[0])
    const response = await Request.formRequest($(this).attr('action'), formData)
    if(response.status_number === 'S200'){
        let user = {};
        user.name = response.data.user.name
        user.email = response.data.user.email
        user.username = response.data.user.username
        user.profilePhoto = response.data.user.photo_profile
        user.token = `Bearer ${response.data.token}`

        Cookies.setCookie("User", JSON.stringify(user))
        window.location.href = '/'
    }else{
        let message = response.message
        let htmlElement = `<ul><li>${message}</li></ul>`;
        $('.login-errors').fadeOut().empty().append(htmlElement).fadeIn()
    }
})

$('#RegisterForm').on('submit', async function (e) {
    e.preventDefault();
    const formData = new FormData($(this)[0])
    const response = await Request.formRequest($(this).attr('action'), formData)
    if(response.status_number === 'S200'){
        let user = {};
        user.name = response.data.user.name
        user.email = response.data.user.email
        user.username = response.data.user.username
        user.profilePhoto = response.data.user.photo_profile
        user.token = `Bearer ${response.data.token}`

        Cookies.setCookie("User", JSON.stringify(user))
        window.location.href = '/'
    }else{
        let loginBoxMinHeight = 600
        const loginBox = $('.login-box.flipped')
        $('.register-input').removeClass('is-invalid').next().fadeOut().text('')
        for(const type in response.errors){
            let input = $(`input[name="${type}"]`)
            input.addClass("is-invalid");
            input.next().fadeIn().text(response.errors[type]);
            if(type === 'password')
                loginBoxMinHeight += 35
            else
                loginBoxMinHeight += 25
        }
        loginBox.css('minHeight', `${loginBoxMinHeight}px`)
    }

})
