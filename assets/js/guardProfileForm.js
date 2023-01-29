function GuardProfile() {
    this.msgProfileGaurd = async(msg, type_icon) => {
        swal({
            title: msg,
            icon: type_icon,
            timer: 2000,
            buttons: {
                cancel: "Close",
            }
        });
    }

    this.profileguardDateForm = (input) => {
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

    this.fetchProfileGaurd = async() => {
        const response = await fetch(`../index.php?action=gaurd&viewProfile`, {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();
        let output = ``;
        
            if(status == 'success') {
                output = `
                <tr>
                <th colspan=2>
                    <div class="w-full p-10 mt-2">
                        <div class="relative mx-auto w-32 h-32 rounded-full border-gray-400 border-4">
                            <img class="w-full h-full rounded-full"
                                src="${message.avatar}" />
                        </div>
                    </div>
                </th>
                </tr>
            
                <tr>
                <th>Guard Name</th>
                    <td>                        
                        ${message.fname} 
                        ${message.mname.charAt(0).toUpperCase()}, 
                        ${message.lname}
                    </td>
                </tr>
                <tr>
                    <th>User Type</th>
                    <td>Security Guard</td>
                </tr>
                <tr>
                    <th>Gender</th>
                    <td>${message.gender}</td>
                </tr>
                <tr>
                    <th>Date of Birth</th>
                    <td>${new Date(message.dob).toDateString()}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>${message.email}</td>
                </tr>
                <tr>
                    <th>Contact no.</th>
                    <td>${message.contact_no}</td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td>${message.address}</td>
                </tr>`;
                
                document.querySelector("#tbodyguard").innerHTML = output;
                this.profileUpdateGaurdValue(message);
        } else {
            this.msgProfileGaurd(message, 'error'); 
        }
    };

    this.profileUpdateGaurdValue = (el) => {
        document.querySelector('#avatarguardprofile').src = el.avatar;
        document.querySelector('#currentAvatar').value = el.avatar;
        document.querySelector('#guarid').value = el.gaurd_id;
        document.querySelector('#guardfname').value = el.fname;
        document.querySelector('#guardmname').value = el.mname;
        document.querySelector('#guardlname').value = el.lname;
        document.querySelector('#guardemail').value = el.email;
        document.querySelector('#guarddob').value = el.dob;
        document.querySelector('#guardcontactno').value = el.contact_no;
        document.querySelector('#guardgender').value = el.gender;
        document.querySelector('#guardaddress').value = el.address;  
    }

    this.teacherProfileForm = () => {
        guardcameraprofile.onclick = (e) => {
            document.querySelector('#guardfileChooserprofile').click();
        }
        
        guardfileChooserprofile.onchange = (e) => {
            if (e.target.files && e.target.files[0]) {
                document.querySelector('#avatarguardprofile').src = URL.createObjectURL(event.target.files[0]);
            }
        }

        profileGuardForm.onsubmit = async (e) => {
            e.preventDefault();
            let btnVAl = document.querySelector("#profileGuardBtn");
        
            btnVAl.value = "Please Wait...";
        
            let response = await fetch('../index.php?action=gaurd', {
                credentials: "same-origin",
                method: 'POST',
                body: new FormData(profileGuardForm)
            });
        
            let { message, status } = await response.json();
            
            if (status == 'success') {
                setTimeout(() => {
                    btnVAl.value = "Update";
                    this.fetchProfileGaurd();   
                    this.msgProfileGaurd(message, 'success');
                    this.logout();
                }, 2000);
            } else {
                this.msgProfileGaurd(message, 'error');
                btnVAl.value = "Update";
            }
        };
    }

    this.logout = () => {
        setTimeout( () => {
            swal({
                title: "Do you want to Logout?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then( async(remove) => {
                if (remove) {
                    let response = await fetch('../index.php?action=logout-user', {
                        method: 'GET',
                    });
                    let { message, status } = await response.json();

                    if(status == 'success') {
                        window.location = "../guard/logout.php";
                    } else {
                        this.msgProfileGaurd(message, 'error');
                    }
                    
                } else {
                    swal("You choose stay login!");
                }
            });
        }, 3000);
    } 
}

let profGuadObj = new  GuardProfile();
profGuadObj.fetchProfileGaurd();
profGuadObj.teacherProfileForm();
profGuadObj.password();