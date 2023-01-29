function Gaurd() {
    this.msgGaurd = async(msg, type_icon) => {
        swal({
            title: msg,
            icon: type_icon,
            timer: 2000,
            buttons: {
                cancel: "Close",
            }
        });
    }

    this.dateFormatGaurd = (input) => {
        setTimeout(() => {
            input.type = 'text';
        }, 60000);
    }

    this.password = () => {
        let pass = document.querySelector('#password');

        toggleTPassword.onclick = async (e) => {
            const type = pass.getAttribute('type') === 'password' ? 'text' : 'password';
            pass.setAttribute('type', type);
            toggleTPassword.classList.toggle("fa-eye-slash");
        }

        let cPass = document.querySelector('#CPassword');

        CTTogglePassword.onclick = async (e) => {
            const TypeC = cPass.getAttribute('type') === 'password' ? 'text' : 'password';
            cPass.setAttribute('type', TypeC);
            CTTogglePassword.classList.toggle("fa-eye-slash");
        }
    }

    this.Updatepassword = () => {
        let passU = document.querySelector('#UPassword');

        toggleUPassword.onclick = async (e) => {
            const type = passU.getAttribute('type') === 'password' ? 'text' : 'password';
            passU.setAttribute('type', type);
            toggleUPassword.classList.toggle("fa-eye-slash");
        }

        let cUPass = document.querySelector('#CUPassword');

        CUTogglePassword.onclick = async (e) => {
            const TypeC = cUPass.getAttribute('type') === 'password' ? 'text' : 'password';
            cUPass.setAttribute('type', TypeC);
            CUTogglePassword.classList.toggle("fa-eye-slash");
        }
    }

    this.fetchGaurd = async() => {
        const response = await fetch(`../index.php?action=gaurd&view`, {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            this.tableBodyGaurd(message);
        } else {
            this.msgGaurd(message, 'error'); 
        }
    };

    this.addFormGaurd = () => {
        cameragaurd.onclick = (e) => {
            document.querySelector('#fileChoosergaurd').click();
        }
        
        fileChoosergaurd.onchange = (e) => {
            if (e.target.files && e.target.files[0]) {
                document.querySelector('#avatargaurd').src = URL.createObjectURL(event.target.files[0]);
            }
        }

        gaurdAddForm.onsubmit = async (e) => {
            e.preventDefault();
            let btnVal = document.querySelector("#btnGuard");
            let resetForm = document.querySelector("#gaurdAddForm");
            let resetavatar = document.querySelector("#avatargaurd");
            let closeModaL = document.querySelector("#gaurdAddModal");
            let defaultavatar = '../assets/images/account.png';
        
            btnVal.value = "Please Wait...";
        
            let response = await fetch('../index.php?action=gaurd', {
                credentials: "same-origin",
                method: 'POST',
                body: new FormData(gaurdAddForm)
            });
        
            let { message, status } = await response.json();
            
            if (status == 'success') {
                setTimeout(() => {
                    btnVal.value = "Save";
                    this.fetchGaurd();
                    this.totalPagesGaurd();
                    this.msgGaurd(message, 'success');
                    closeModaL.click();
                    resetavatar.src = defaultavatar;
                    resetForm.reset();
                }, 1000);
            } else {
                this.msgGaurd(message, 'error');
                btnVal.value = "Field to Save";
            }
        };
    }

    this.searchGuard = () => {
        searchGuard.oninput = async(e) => { 
            let count = e.currentTarget.value.length;
            let data  = e.currentTarget.value;
            
            if(count > 0) {
                let formData = new FormData();
                formData.append('dataSearch', data);
    
                let response = await fetch(`../index.php?action=gaurd`, {
                  credentials: "same-origin",
                  method: 'POST',
                  body: formData
                });
                let { message, status} = await response.json();

                if(status == 'success') {
                    this.tableBodyGaurd(message);
                } else {
                    this.msgGaurd(message, 'error'); 
                }

            } else {
                this.fetchGaurd();
            }
        };

        searchInactGuard.oninput = async(e) => { 
            let count = e.currentTarget.value.length;
            let data  = e.currentTarget.value;
            
            if(count > 0) {
                let formData = new FormData();
                formData.append('dataInactSearch', data);
    
                let response = await fetch(`../index.php?action=gaurd`, {
                  credentials: "same-origin",
                  method: 'POST',
                  body: formData
                });
                
                let { message, status} = await response.json();

                if(status == 'success') {
                    this.tableBodyInactGaurd(message);
                } else {
                    this.msgGaurd(message, 'error'); 
                }

            } else {
                this.fetchInactiveGaurd();
            }
        };
    }

    this.printAllGuardData = () => {
        btnGuardDataPrint.onclick = async() => {
            swal({
                title: "Are you sure you want to print all this security personel records?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then( async(remove) => {
                if (remove) {
                    let w = 1500;
                    let h = 700;
                    let left = (screen.width/2 - w/2);
                    let top  = (screen.height/2 - h/2);

                    const response = await fetch(`../index.php?action=gaurd&print`, {
                        credentials: "same-origin",
                        method: "GET"
                    });

                    let {status} = await response.json();

                    if(status != 'error') {
                        let mywindow = window.open(
                            `print_gaurd_data.php`, 
                            `Print`, 
                            `height=${h},
                            width=${w},
                            left=${left}, 
                            top=${top}`
                        );

                        setTimeout(()=>{
                            mywindow.document.close();
                            mywindow.focus();
                            mywindow.print();
                        },3000);
                
                    } else {
                        this.msgGaurd(message, 'error');
                    }
                } else {
                    swal("Cancel printing!");
                }
           });
        }
    }

    this.limitPagesGuard = () => {
        gaurdSort.onchange = async(e) => {
            let val = e.currentTarget.value;
            
            const response = await fetch(`../index.php?action=gaurd&gaurdsort=${val}`, {
                credentials: "same-origin",
                method: "GET",
            });
            let { message, status} = await response.json();

            if(status == 'success') {
                this.tableBodyGaurd(message);
                this.totalPagesGaurd();
            } else {
                this.msgGaurd(message, 'error'); 
            }
        }
    };

    this.totalPagesGaurd = async() => {
        const response = await fetch(`../index.php?action=gaurd&totalpage`, {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            let total_pages = Math.ceil(message/05);
            let output = ``;
            let pagenumber = 1;

            gaurdPrev.onclick = async() => {
                if(pagenumber >= 1) {
                    this.paginationGaurd(pagenumber -= 1);
                } 

                let btnPrev = document.querySelector(`#btnList${pagenumber}`);

                if(btnPrev != undefined) {
                    btnPrev.classList.add("bg-blue-200")
                }
            };
        
            gaurdNext.onclick = async() => {
                if(pagenumber < total_pages) {
                    this.paginationGaurd(pagenumber += 1);
                }

                let btnNext = document.querySelector(`#btnList${pagenumber}`);

                if(btnNext != undefined) {
                    btnNext.classList.add("bg-blue-200")
                }
            };

            for (let i = 1; i < total_pages+1; i++) {
                output += `<div id="btnList${i}" onclick="(gaurdObj.paginationGaurd(${i}))" class="child p-1 mr-2 rounded-md cursor-pointer w-16 h-14 border-solid border-2 flex items-center justify-center border-gray-400 hover:bg-blue-100 font-bold">${i}</div>
                `;
            }

            document.querySelector('#gaurd-btn-pages').innerHTML = output;

            let elements = document.getElementsByClassName("child");

            for(let i = 0; i < elements.length; i++) {   
                elements[i].addEventListener('click', function(e) {
                    e.preventDefault();
                      
                    let el = elements[0];
                    
                    while(el) {
                        if(el.tagName == "DIV"){
                            //remove class
                            el.classList.remove("bg-blue-200");
                        }
                        // pass to the new sibling
                        el = el.nextSibling;
                    }
                  this.classList.add("bg-blue-200");  
                });
            }

        } else {
            this.msgGaurd(message, 'error'); 
        }
    };

    this.paginationGaurd= async(pagenum) => {
        const response = await fetch(`../index.php?action=gaurd&pagenum=${pagenum}`, {
            credentials: "same-origin",
            method: "GET",
        });
        let { message, status} = await response.json();

        if(status == 'success') {  
            this.tableBodyGaurd(message);
        } else {
            this.msgGaurd(message, 'error'); 
        }
    }

    this.addValueUpdateGuard= async(gaurdid) => {
        let formData = new FormData();
        formData.append('gaurdid', gaurdid);

        let response = await fetch(`../index.php?action=gaurd`, {
          credentials: "same-origin",
          method: 'POST',
          body: formData
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            document.querySelector('#gaurdid').value = message.gaurd_id;
            document.querySelector('#gaurdfname').value = message.fname;
            document.querySelector('#gaurdmname').value = message.mname;
            document.querySelector('#gaurdlname').value = message.lname;
            document.querySelector('#gaurddob').value = message.dob;
            document.querySelector('#gaurdaddress').value = message.address;
            document.querySelector('#gaurdgender').value = message.gender;
            document.querySelector('#gaurdemail').value = message.email;
            document.querySelector('#gaurdcontactno').value = message.contact_no;
            document.querySelector('#newavatargaurd').src = message.avatar;
            document.querySelector('#gaurdcurrentavatar').value = message.avatar;
        } else {
            this.msgGaurd(message, 'error'); 
        }
    } 

    this.updateFormGaurd = () => {
        newcameragaurd.onclick = (e) => {
            document.querySelector('#newFileChoosergaurd').click();
        }
        
        newFileChoosergaurd.onchange = (e) => {
            if (e.target.files && e.target.files[0]) {
                document.querySelector('#newavatargaurd').src = URL.createObjectURL(event.target.files[0]);
            }
        }

        gaurdUpdateForm.onsubmit = async (e) => {
            e.preventDefault();
            let btnVal = document.querySelector("#newBtnGuard");
            let resetForm = document.querySelector("#gaurdUpdateForm");
            let resetavatar = document.querySelector("#newavatargaurd");
            let closeModaL = document.querySelector("#gaurdUpdateModal");
            let defaultavatar = '../assets/images/account.png';
        
            btnVal.value = "Please Wait...";
        
            let response = await fetch('../index.php?action=gaurd', {
                credentials: "same-origin",
                method: 'POST',
                body: new FormData(gaurdUpdateForm)
            });
        
            let { message, status } = await response.json();
            
            if (status == 'success') {
                setTimeout(() => {
                    btnVal.value = "Update";
                    this.fetchGaurd();
                    this.totalPagesGaurd();
                    this.msgGaurd(message, 'success');
                    closeModaL.click();
                    resetavatar.src = defaultavatar;
                    resetForm.reset();
                }, 1000);
            } else {
                this.msgGaurd(message, 'error');
                btnVal.value = "Field to Save";
            }
        };
    }

    this.checkAllGaurd = () => {
        checkAllGaurd.onclick = async() =>{
            let items = document.getElementsByName('gaurd_chk[]');
            if (checkAllGaurd.checked == true){
                for(let i=0; i<items.length; i++){
                    if(items[i].type=='checkbox')
                        items[i].checked=true;
                }
            } else {
                for(let i=0; i<items.length; i++) {
                    if(items[i].type =='checkbox')
                        items[i].checked=false;
                }
            }
        }

        checkAllInactGaurd.onclick = async() =>{
            let items = document.getElementsByName('gaurdInact_chk[]');
            if (checkAllInactGaurd.checked == true){
                for(let i=0; i<items.length; i++) {
                    if(items[i].type=='checkbox')
                        items[i].checked=true;
                }
            } else {
                for(let i=0; i<items.length; i++) {
                    if(items[i].type =='checkbox')
                        items[i].checked=false;
                }
            }
        }
    }

        this.removeGaurd = () => {
            gaurdRevForm.onsubmit = async (e) => {
                e.preventDefault();
                swal({
                title: "Are you sure do you want to set Inactive this Security Gaurd?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then( async(remove) => {
                if (remove) {

                    let response = await fetch(`../index.php?action=gaurd`, {
                        credentials: "same-origin",
                        method: 'POST',
                        body: new FormData(gaurdRevForm)
                    });
            
                    let { message, status } = await response.json();
            
                    if (status == 'success') {
                        this.msgGaurd(message, 'success');
                        this.fetchGaurd();
                        this.totalPagesGaurd();
                        this.fetchInactiveGaurd();
                    } else {
                        this.msgGaurd(message, 'error');
                    }
                } else {
                    swal("Cancel Changes!");
                }
            });
        }

        gaurdInactForm.onsubmit = async (e) => {
            e.preventDefault();
            swal({
            title: "Are you sure do you want to set Active this Security Gaurd?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then( async(remove) => {
            if (remove) {

                let response = await fetch(`../index.php?action=gaurd`, {
                    credentials: "same-origin",
                    method: 'POST',
                    body: new FormData(gaurdInactForm)
                });
        
                let { message, status } = await response.json();
        
                if (status == 'success') {
                    this.msgGaurd(message, 'success');
                    this.fetchGaurd();
                    this.totalPagesGaurd();
                    this.fetchInactiveGaurd();
                } else {
                    this.msgGaurd(message, 'error');
                }
            } else {
                swal("Cancel Changes!");
            }
        });
        }
    }

    this.tableBodyGaurd= (data) => {
        let inc = 0;
        let row = ``;
        let empVal = `<td colspan="10" class="font-5xl text-center font-extrabold animate-bounce">Data Not Found...</td>`;

        if(data != true) {
            data.forEach(el => {
                row += `
                <tr>
                    <td class="px-5 py-5">
                        <input class="w-5 h-5" type="checkbox" name="gaurd_chk[]" value="${el.gaurd_id}">
                    </td>
                    <td class="px-5 py-5">${++inc}</td>
                    <td class="px-5 py-5">
                        <div class="relative mx-auto w-20 h-20 rounded-full border-gray-300 border-2">
                            <img class="w-full h-full rounded-full" src="${el.avatar}" alt="avatar" />
                        </div>
                    </td>
                    <td class="px-5 py-5">
                        ${el.fname} 
                        ${el.mname.charAt(0).toUpperCase()}, 
                        ${el.lname}
                    </td>
                    <td class="px-5 py-5">${new Date(el.dob).toDateString()}</td>
                    <td class="px-5 py-5">${el.gender}</td>
                    <td class="px-5 py-5">${el.address}</td>
                    <td class="px-5 py-5">${el.email}</td>
                    <td class="px-5 py-5">${el.contact_no}</td>
                    <td class="px-5 py-5">
                        <button onclick="gaurdObj.addValueUpdateGuard(${el.gaurd_id })" type="button" data-toggle="modal" data-target="#gaurdUpdateModal" class="w-16 h-16 hover:border-blue-600 hover:bg-blue-100 hover:text-blue-600 tracking-wide text-lg text-white bg-blue-400 py-2 rounded-full border-blue-500 border-2">
                            <i class="fa fa-pen text-2xl"></i>
                        </button>
                    </td>
                </tr>
                `;
            }); 
        } else {
            row = empVal
        }
        document.querySelector("#tbodygaurd").innerHTML = row;
    }

    this.fetchInactiveGaurd= async() => {
        const response = await fetch(`../index.php?action=gaurd&viewInact`, {
            credentials: "same-origin",
            method: "GET",
        }); 

        let { message, status} = await response.json();

        if(status == 'success') {
            this.tableBodyInactGaurd(message);
        } else {
            this.msgTeacher(message, 'error'); 
        }
    };

    this.tableBodyInactGaurd= (data) => {
        let inc = 0;
        let row = ``;
        let empVal = `<td colspan="10" class="font-5xl text-center font-extrabold animate-bounce">Data Not Found...</td>`;

        if(data != true) {
            data.forEach(el => {
                row += `
                <tr>
                    <td class="px-5 py-5">
                        <input class="w-5 h-5" type="checkbox" name="gaurdInact_chk[]" value="${el.gaurd_id}">
                    </td>
                    <td class="px-5 py-5">${++inc}</td>
                    <td class="px-5 py-5">
                        <div class="relative mx-auto w-20 h-20 rounded-full border-gray-300 border-2">
                            <img class="w-full h-full rounded-full" src="${el.avatar}" alt="avatar" />
                        </div>
                    </td>
                    <td class="px-5 py-5">
                        ${el.fname} 
                        ${el.mname.charAt(0).toUpperCase()}, 
                        ${el.lname}
                    </td>
                    <td class="px-5 py-5">${new Date(el.dob).toDateString()}</td>
                    <td class="px-5 py-5">${el.gender}</td>
                    <td class="px-5 py-5">${el.address}</td>
                    <td class="px-5 py-5">${el.email}</td>
                    <td class="px-5 py-5">${el.contact_no}</td>
                </tr>
                `;
            }); 
        } else {
            row = empVal
        }
        document.querySelector("#tbodyinactivegaurd").innerHTML = row;
    }
}

let gaurdObj = new Gaurd();
gaurdObj.fetchGaurd();
gaurdObj.addFormGaurd();
gaurdObj.password();
gaurdObj.searchGuard();
gaurdObj.printAllGuardData();
gaurdObj.limitPagesGuard();
gaurdObj.totalPagesGaurd();
gaurdObj.Updatepassword();
gaurdObj.updateFormGaurd();
gaurdObj.checkAllGaurd();
gaurdObj.removeGaurd();
gaurdObj.fetchInactiveGaurd();