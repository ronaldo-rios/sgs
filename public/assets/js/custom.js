if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}

const ALERT_AUTO_HIDE_MSG = 5000

function scheduleAlertRemoval(alertEl) {
    if (!alertEl?.classList?.contains('alert')) return
    setTimeout(() => alertEl.remove(), ALERT_AUTO_HIDE_MSG)
}

function setMsg(text, isError = true) {
    const el = document.getElementById('msg')
    if (!el) return
    const box = document.createElement('div')
    box.className = isError ? 'alert alert-danger' : 'alert alert-success'
    box.textContent = text
    el.replaceChildren(box)
    scheduleAlertRemoval(box)
}

document.querySelectorAll('.alert').forEach((node) => scheduleAlertRemoval(node))

const formLogin = document.getElementById('form-login')
if (formLogin) {
    formLogin.addEventListener('submit', (e) => {
        const user = formLogin.querySelector('#user')?.value ?? ''
        if (user === '') {
            e.preventDefault()
            setMsg('Campo usuário é obrigatório.')
            return
        }

        const password = formLogin.querySelector('#password')?.value ?? ''
        if (password === '') {
            e.preventDefault()
            setMsg('Campo senha é obrigatório.')
            return
        }
    })
}

const formNewUser = document.getElementById('form-newuser')
if (formNewUser) {
    formNewUser.addEventListener('submit', (e) => {
        const nameUser = formNewUser.querySelector('#name')?.value ?? ''
        if (nameUser === '') {
            e.preventDefault()
            setMsg('Campo nome é obrigatório.')
            return
        }

        const emailUser = formNewUser.querySelector('#email')?.value ?? ''
        if (emailUser === '') {
            e.preventDefault()
            setMsg('Campo email é obrigatório.')
            return
        }

        const user = formNewUser.querySelector('#user')?.value ?? ''
        if (user === '') {
            e.preventDefault()
            setMsg('Campo usuário é obrigatório.')
            return
        }

        const passwordUser = formNewUser.querySelector('#password')?.value ?? ''
        if (passwordUser === '') {
            e.preventDefault()
            setMsg('Campo senha é obrigatório.')
            return
        }

        if (passwordUser.length < 6) {
            e.preventDefault()
            setMsg('Senha deve ter no mínimo 6 caracteres.')
            return
        }

        const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/
        if (!regex.test(passwordUser)) {
            e.preventDefault()
            setMsg('Senha deve conter pelo menos uma letra maiúscula, uma letra minúscula e um número.')
            return
        }
    })
}

const formNewConfirmEmail = document.getElementById('form-new-confirm-email')
if (formNewConfirmEmail) {
    formNewConfirmEmail.addEventListener('submit', (e) => {
        // Check if the field email is empty
        let confirmEmail = formNewConfirmEmail.querySelector('#emailconfirm')?.value ?? ''
        if (confirmEmail === '') {
            e.preventDefault()
            setMsg('Campo e-mail para confirmação é obrigatório.')
            return
        }
    })
}

const formRecoverPassword = document.getElementById('recover-password')
if (formRecoverPassword) {
    formRecoverPassword.addEventListener('submit', (e) => {
        let emailToRecover = formRecoverPassword.querySelector('#emailrecover')?.value ?? ''
        if (emailToRecover === '') {
            e.preventDefault()
            setMsg('Campo e-mail é obrigatório.')
            return
        }
    })
}

const formAddUser = document.getElementById('form-adduser')
if (formAddUser) {
    formAddUser.addEventListener('submit', (e) => {
        const nameUser = formAddUser.querySelector('#name')?.value ?? ''
        if (nameUser === '') {
            e.preventDefault()
            setMsg('Campo nome é obrigatório.')
            return
        }

        const emailUser = formAddUser.querySelector('#email')?.value ?? ''
        if (emailUser === '') {
            e.preventDefault()
            setMsg('Campo email é obrigatório.')
            return
        }

        const user = formAddUser.querySelector('#user')?.value ?? ''
        if (user === '') {
            e.preventDefault()
            setMsg('Campo usuário é obrigatório.')
            return
        }

        const passwordUser = formAddUser.querySelector('#password')?.value ?? ''
        if (passwordUser === '') {
            e.preventDefault()
            setMsg('Campo senha é obrigatório.')
            return
        }

        if (passwordUser.length < 6) {
            e.preventDefault()
            setMsg('Senha deve ter no mínimo 6 caracteres.')
            return
        }

        const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/
        if (! regex.test(passwordUser)) {
            e.preventDefault()
            setMsg('Senha deve conter pelo menos uma letra maiúscula, uma letra minúscula e um número.')
            return
        }
    })
}

const formEditUser = document.getElementById('form-edituser')
if (formEditUser) {
    formEditUser.addEventListener('submit', (e) => {
        const nameUser = formEditUser.querySelector('#name')?.value ?? ''
        if (nameUser === '') {
            e.preventDefault()
            setMsg('Campo nome é obrigatório.')
            return
        }

        const emailUser = formEditUser.querySelector('#email')?.value ?? ''
        if (emailUser === '') {
            e.preventDefault()
            setMsg('Campo email é obrigatório.')
            return
        }

        const user = formEditUser.querySelector('#user')?.value ?? ''
        if (user === '') {
            e.preventDefault()
            setMsg('Campo usuário é obrigatório.')
            return
        }
    })
}

function inputFileValImg() {
    const image = document.querySelector('#image')
    if (! image) return

    const filePath = image.value
    const allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i

    if (! allowedExtensions.exec(filePath)) {
        image.value = ''
        setMsg('Erro: Necessário selecionar uma imagem JPG ou PNG!')
        return
    }

    previewImage(image)
}


function previewImage(image) {
    if (image.files && image.files[0]) {
        const reader = new FileReader()

        reader.onload = function(e) {
            document.getElementById('preview-img').innerHTML = "<img src='" + e.target.result + "' alt='Imagem' style='width: 100px;'>"
        }

        reader.readAsDataURL(image.files[0])
    }
}