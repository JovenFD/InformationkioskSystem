const msg = document.querySelector('#msg');
loginForm.onsubmit = async(e) => {
    e.preventDefault();

    let response = await fetch('../index.php?action=login-user', {
        method: 'POST',
        credentials: "same-origin",
        body: new FormData(loginForm)
    });

    document.querySelector("#login").value = "Please Wait...";

    let { message, status } = await response.json();

    if (status == 'success_admin') {
        msg.innerHTML = `<div class="alert font-bold alert-success text-center" role="alert">
                        ${message}
                        </div>`;
        setTimeout(() => document.querySelector(".alert-success").remove(), 3000);
        window.location = "../admin/admin.php";
    } else if (status == 'success_user') {
        msg.innerHTML = `<div class="font-bold alert alert-success text-center" role="alert">
                        ${message}
                        </div>`;
        setTimeout(() => document.querySelector(".alert-success").remove(), 3000);
        window.location = "../teacher/teacher.php";

    } else if (status == 'success_guard') {
        msg.innerHTML = `<div class="font-bold alert alert-success text-center" role="alert">
                        ${message}
                        </div>`;
        setTimeout(() => document.querySelector(".alert-success").remove(), 3000);
        window.location = "../guard/guard.php";
    } else {
        msg.innerHTML = `<div class="font-bold alert alert-warning text-center" role="alert">
                        ${message}
                        </div>`;
        setTimeout(() => document.querySelector(".alert-warning").remove(), 3000);
        document.querySelector("#login").value = "LOGIN";
    }
};

let pass = document.querySelector('#password');

togglePassword.onclick = async (e) => {
    const type = pass.getAttribute('type') === 'password' ? 'text' : 'password';
    pass.setAttribute('type', type);
    togglePassword.classList.toggle("fa-eye-slash");
}