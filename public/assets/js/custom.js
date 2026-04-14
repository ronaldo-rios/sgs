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
        const user = document.querySelector('#user')?.value ?? ''
        if (user === '') {
            e.preventDefault()
            setMsg('Campo usuário é obrigatório.')
            return
        }

        const password = document.querySelector('#password')?.value ?? ''
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
        const nameUser = document.querySelector('#name')?.value ?? ''
        if (nameUser === '') {
            e.preventDefault()
            setMsg('Campo nome é obrigatório.')
            return
        }

        const emailUser = document.querySelector('#email')?.value ?? ''
        if (emailUser === '') {
            e.preventDefault()
            setMsg('Campo email é obrigatório.')
            return
        }

        const user = document.querySelector('#user')?.value ?? ''
        if (user === '') {
            e.preventDefault()
            setMsg('Campo usuário é obrigatório.')
            return
        }

        const passwordUser = document.querySelector('#password')?.value ?? ''
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
