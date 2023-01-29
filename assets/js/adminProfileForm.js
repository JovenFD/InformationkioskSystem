function AdminProfile() {

    this.msgProfile = (msg, type_icon) => {
        swal({
            title: msg,
            icon: type_icon,
            timer: 2000,
            buttons: {
                cancel: "Close",
            }
        });
    }

    this.profileAdminDateForm = (input) => {
        setTimeout(() => {
            input.type = 'text';
        }, 60000);
    }

    this.password = () => {
        let pass = document.querySelector('#password');

        togglePassword.onclick = async (e) => {
            const type = pass.getAttribute('type') === 'password' ? 'text' : 'password';
            pass.setAttribute('type', type);
            togglePassword.classList.toggle("fa-eye-slash");
        }

        let cPass = document.querySelector('#CPassword');

        CTogglePassword.onclick = async (e) => {
            const TypeC = cPass.getAttribute('type') === 'password' ? 'text' : 'password';
            cPass.setAttribute('type', TypeC);
            CTogglePassword.classList.toggle("fa-eye-slash");
        }
    }
    
    this.fetchAdminProfile = async() => {
            const response = await fetch("../index.php?action=adminprofile&view", {
                credentials: "same-origin",
                method: "GET"
            });

            let { message, status } = await response.json();
            let output = ``;
            
            if(status == 'success') {
                message.forEach(el => {
                    output += `
                    <tr>
                    <th colspan=2>
                        <div class="w-full p-10 mt-2">
                            <div class="relative mx-auto w-32 h-32 rounded-full border-gray-400 border-4">
                                <img class="w-full h-full rounded-full"
                                    src="${el.avatar}" />
                            </div>
                        </div>
                    </th>
                    </tr>
                
                    <tr>
                    <th>Fullname</th>
                    <td>${el.fname} ${el.mname}, ${el.lname}</td>
                    </tr>
                    <tr>
                        <th>User Type</th>
                        <td>Admin</td>
                    </tr>
                    <tr>
                        <th>Gender</th>
                        <td>${el.gender}</td>
                    </tr>
                    <tr>
                        <th>Date of Birth</th>
                        <td>${el.dob}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>${el.email}</td>
                    </tr>
                    <tr>
                        <th>Contact no.</th>
                        <td>${el.contact_no}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>${el.address}</td>
                    </tr>`;
                });

                document.querySelector("#tbodyadminprofile").innerHTML = output;
                this.profileUpdateValue(message);

            } else {
                this.msgProfile(message, 'error');
            }
    };
    
    this.profileUpdateValue = (message) => {
        message.forEach(el => {
            document.querySelector('#avatarprofile').src = el.avatar;
            document.querySelector('#userId').value = el.user_id;
            document.querySelector('#fname').value = el.fname;
            document.querySelector('#mname').value = el.mname;
            document.querySelector('#lname').value = el.lname;
            document.querySelector('#email').value = el.email;
            document.querySelector('#birthday').value = el.dob;
            document.querySelector('#contactno').value = el.contact_no;
            document.querySelector('#gender').value = el.gender;
            document.querySelector('#address').value = el.address;
        });     
    };

    this.adminProfileForm = () => {

        cameraprofile.onclick = (e) => {
            document.querySelector('#fileChooserprofile').click();
        }
        
        fileChooserprofile.onchange = (e) => {
            if (e.target.files && e.target.files[0]) {
                document.querySelector('#avatarprofile').src = URL.createObjectURL(event.target.files[0]);
            }
        }

        profileForm.onsubmit = async (e) => {
            e.preventDefault();
            let btnVAl = document.querySelector("#profileBtn");
        
            btnVAl.value = "Please Wait...";
        
            let response = await fetch('../index.php?action=adminprofile&adminform', {
                credentials: "same-origin",
                method: 'POST',
                body: new FormData(profileForm)
            });
        
            let { message, status } = await response.json();
            
            if (status == 'success') {
                setTimeout(() => {
                    btnVAl.value = "Update";
                    this.fetchAdminProfile();   
                    this.msgProfile(message, 'success');
                    this.logout();
                }, 2000);
            } else {
                this.msgProfile(message, 'error');
                btnVAl.value = "Update";
            }
        };
    }

    this.logout = () => {
        setTimeout( () => {
            swal({
                title: "Do You Want To Logout?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then(async(willDelete) => {
                if (willDelete) {
                    let response = await fetch('../index.php?action=logout-user', {
                        method: 'GET',
                    });
                    let { message, status } = await response.json();

                    if(status == 'success') {
                        window.location = "logout.php";
                    } else {
                        console.log(message);
                    }
                    
                } else {
                    swal("You Choose Stay Login!");
                }
            });
        }, 3000);
    } 
}

let profileObj = new AdminProfile();
profileObj.adminProfileForm();
profileObj.fetchAdminProfile();
profileObj.password();
