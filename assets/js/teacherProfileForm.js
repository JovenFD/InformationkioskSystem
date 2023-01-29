function TeacherProfile() {

    this.msgTchrProfile = (msg, type_icon) => {
        swal({
            title: msg,
            icon: type_icon,
            timer: 2000,
            buttons: {
                cancel: "Close",
            }
        });
    }

    this.profileTchrDateForm = (input) => {
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

    this.fetchTeacherProfile = async() => {
        const response = await fetch("../index.php?action=teacherAccount&viewprofile", {
            credentials: "same-origin",
            method: "GET"
        });

        let { message, status } = await response.json();
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
            <th>Teacher Name</th>
                <td>                        
                    ${message.fname} 
                    ${message.mname.charAt(0).toUpperCase()}, 
                    ${message.lname}
                </td>
            </tr>
            <tr>
                <th>User Type</th>
                <td>Teacher</td>
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
            
            document.querySelector("#tbodyadminteacher").innerHTML = output;
            this.profileUpdateTchrValue(message);

        } else {
            this.msgTchrProfile(message, 'error');
        }
    };

    this.profileUpdateTchrValue = (el) => {
        document.querySelector('#avatartchrprofile').src = el.avatar;
        document.querySelector('#tchrid').value = el.teacher_id;
        document.querySelector('#tchrfname').value = el.fname;
        document.querySelector('#tchrmname').value = el.mname;
        document.querySelector('#tchrlname').value = el.lname;
        document.querySelector('#tchremail').value = el.email;
        document.querySelector('#tchrdob').value = el.dob;
        document.querySelector('#tchrcontactno').value = el.contact_no;
        document.querySelector('#tchrgender').value = el.gender;
        document.querySelector('#tchraddress').value = el.address;  
    };

    this.teacherProfileForm = () => {
        tchrcameraprofile.onclick = (e) => {
            document.querySelector('#tchrfileChooserprofile').click();
        }
        
        tchrfileChooserprofile.onchange = (e) => {
            if (e.target.files && e.target.files[0]) {
                document.querySelector('#avatartchrprofile').src = URL.createObjectURL(event.target.files[0]);
            }
        }

        profileTeacherForm.onsubmit = async (e) => {
            e.preventDefault();
            let btnVAl = document.querySelector("#profileTchrBtn");
        
            btnVAl.value = "Please Wait...";
        
            let response = await fetch('../index.php?action=teacherAccount&tchrform', {
                credentials: "same-origin",
                method: 'POST',
                body: new FormData(profileTeacherForm)
            });
        
            let { message, status } = await response.json();
            
            if (status == 'success') {
                setTimeout(() => {
                    btnVAl.value = "Update";
                    this.fetchTeacherProfile();   
                    this.msgTchrProfile(message, 'success');
                    this.logout();
                }, 2000);
            } else {
                this.msgTchrProfile(message, 'error');
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
                        window.location = "../teacher/logout.php";
                    } else {
                        this.msgTchrProfile(message, 'error');
                    }
                    
                } else {
                    swal("You choose stay login!");
                }
            });
        }, 3000);
    } 
}

let tchrpObj = new TeacherProfile();
tchrpObj.fetchTeacherProfile();
tchrpObj.teacherProfileForm ();
tchrpObj.password();