function Teacher(DynamicLogo, tchrScanner) {
    this.DynamicLogo = DynamicLogo;
    this.tchrScanner = tchrScanner;

    this.msgTeacher = async(msg, type_icon) => {
        swal({
            title: msg,
            icon: type_icon,
            timer: 2000,
            buttons: {
                cancel: "Close",
            }
        });
    }

    this.dateFormatTeacher = (input) => {
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

    this.fetchTeacher = async() => {
        const response = await fetch(`../index.php?action=teacher&view`, {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            this.tableBodyTeacher(message);
        } else {
            this.msgTeacher(message, 'error'); 
        }
    };

    this.searchTeacher = () => {
        searchtchr.oninput = async(e) => { 
            let count = e.currentTarget.value.length;
            let data  = e.currentTarget.value;
            
            if(count > 0) {
                let formData = new FormData();
                formData.append('data', data);
    
                let response = await fetch(`../index.php?action=teacher`, {
                  credentials: "same-origin",
                  method: 'POST',
                  body: formData
                });
                let { message, status} = await response.json();

                if(status == 'success') {
                    this.tableBodyTeacher(message);
                } else {
                    this.msgTeacher(message, 'error'); 
                }
            } else {
                this.fetchTeacher();
            }
        };

        searchtchrUnact.oninput = async(e) => { 
            let count = e.currentTarget.value.length;
            let data  = e.currentTarget.value;
            
            if(count > 0) {
                let formData = new FormData();
                formData.append('dataUnact', data);
    
                let response = await fetch(`../index.php?action=teacher`, {
                  credentials: "same-origin",
                  method: 'POST',
                  body: formData
                });
                let { message, status} = await response.json();

                if(status == 'success') {
                    this.tableBodyUnbactTeacher(message);
                } else {
                    this.msgTeacher(message, 'error'); 
                }
            } else {
                this.fetchUnActTeacher();
            }
        };
    }

    this.limitPagesTeacher = () => {
        tchrSort.onchange = async(e) => {
            let val = e.currentTarget.value;
            
            const response = await fetch(`../index.php?action=teacher&tchrsort=${val}`, {
                credentials: "same-origin",
                method: "GET",
            });
            let { message, status} = await response.json();

            if(status == 'success') {
                this.tableBodyTeacher(message);
                this.totalPagesTeacher(message);
            } else {
                this.msgTeacher(message, 'error'); 
            }
        }
    };

    this.totalPagesTeacher = async() => {
        const response = await fetch(`../index.php?action=teacher&totalpage`, {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            let total_pages = Math.ceil(message/05);
            let output = ``;
            let pagenumber = 1;

            tchrPrev.onclick = async() => {
                if(pagenumber >= 1) {
                    this.paginationTeacher(pagenumber -= 1);
                } 

                let btnPrev = document.querySelector(`#btnList${pagenumber}`);

                if(btnPrev != undefined) {
                    btnPrev.classList.add("bg-blue-200")
                }
            };
        
            tchrNext.onclick = async() => {
                if(pagenumber < total_pages) {
                    this.paginationTeacher(pagenumber += 1);
                }

                let btnNext = document.querySelector(`#btnList${pagenumber}`);

                if(btnNext != undefined) {
                    btnNext.classList.add("bg-blue-200")
                }
            };

            for (let i = 1; i < total_pages+1; i++) {
                output += `<div id="btnList${i}" onclick="(tchrObj.paginationTeacher(${i}))" class="child p-1 mr-2 rounded-md cursor-pointer w-16 h-14 border-solid border-2 flex items-center justify-center border-gray-400 hover:bg-blue-100 font-bold">${i}</div>
                `;
            }

            document.querySelector('#tchr-btn-pages').innerHTML = output;

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
            this.msgTeacher(message, 'error'); 
        }
    };

    this.paginationTeacher= async(pagenum) => {
        const response = await fetch(`../index.php?action=teacher&pagenum=${pagenum}`, {
            credentials: "same-origin",
            method: "GET",
        });
        let { message, status} = await response.json();

        if(status == 'success') {  
            this.tableBodyTeacher(message);
        } else {
            this.msgTeacher(message, 'error'); 
        }
    }

    this.cehckAllTeacher = () => {
        checkAllTeacher.onclick = async() =>{
            let items = document.getElementsByName('tchr_chk[]');
            if (checkAllTeacher.checked == true){
                for(let i=0; i<items.length; i++){
                    if(items[i].type=='checkbox')
                        items[i].checked=true;
                }
            } else {
                for(let i=0; i<items.length; i++){
                    if(items[i].type =='checkbox')
                        items[i].checked=false;
                }
            }
        }

        checkAllUnActTeacher.onclick = async() =>{
            let items = document.getElementsByName('tchrUnact_chk[]');
            if (checkAllUnActTeacher.checked == true){
                for(let i=0; i<items.length; i++){
                    if(items[i].type=='checkbox')
                        items[i].checked=true;
                }
            } else {
                for(let i=0; i<items.length; i++){
                    if(items[i].type =='checkbox')
                        items[i].checked=false;
                }
            }
        }
    }

    this.removeTeacher = () => {
        tchrRevForm.onsubmit = async (e) => {
            e.preventDefault();
             swal({
            title: "Are you sure do you want to set UnActive this teacher?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then( async(remove) => {
            if (remove) {

                let response = await fetch(`../index.php?action=teacher`, {
                    credentials: "same-origin",
                    method: 'POST',
                    body: new FormData(tchrRevForm)
                });
        
                let { message, status } = await response.json();
        
                if (status == 'success') {
                    this.msgTeacher(message, 'success');
                    this.fetchTeacher();
                    this.totalPagesTeacher();
                    this.fetchUnActTeacher();
                } else {
                    this.msgTeacher(message, 'error');
                }
            } else {
                swal("Cancel Changes!");
            }
        });
    };   

    tchrUnactForm.onsubmit = async (e) => {
            e.preventDefault();
             swal({
            title: "Are you sure do you want to set Active this teacher?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then( async(remove) => {
            if (remove) {

                let response = await fetch(`../index.php?action=teacher`, {
                    credentials: "same-origin",
                    method: 'POST',
                    body: new FormData(tchrUnactForm)
                });
        
                let { message, status } = await response.json();
        
                if (status == 'success') {
                    this.msgTeacher(message, 'success');
                    this.fetchTeacher();
                    this.totalPagesTeacher();
                    this.fetchUnActTeacher();
                } else {
                    this.msgTeacher(message, 'error');
                }
            } else {
                swal("Cancel Changes!");
            }
        });
    };  

    }

    this.printAllTeacherData = () => {
        btnTeacherDataPrint.onclick = async() => {
            swal({
                title: "Are you sure you want to print all this teacher records?",
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

                    const response = await fetch(`../index.php?action=teacher&print`, {
                        credentials: "same-origin",
                        method: "GET",
                    });

                    let {status} = await response.json();

                    if(status != 'error') {
                        let mywindow = window.open(
                            `print_teacher_data.php`, 
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
                        this.msgTeacher(message, 'error');
                    }
                } else {
                    swal("Cancel printing!");
                }
           });
        }
    }

    this.viewQrCode = (
        code, 
        fname, 
        mname, 
        lname) => {
        document.querySelector('#filenameQr').value = 
        `${fname} 
        ${mname}, 
        ${lname}`;
        window.qrcode = new QrCodeWithLogo({
            canvas: document.querySelector("#teacherQr"),
            content: code,
            width: 380,
            image: document.querySelector("#teacherQrimg"),
            logo: {
              src: this.DynamicLogo,
              logoSize: 0.2
            }
        });
    }

    this.testQrTchrBtn = () => {
        testQrBtn.onclick = async(e) => {
            let label = 'Test QrCode';
            
            if(testQrBtn.value == label) {
                testQrBtn.value = 'Scanning...';
                this.playScanner();
            } else {
                testQrBtn.value = label;
                this.stopScanner();
            }
        }
    }

    this.playScanner = () => {
        Instascan.Camera.getCameras().then((cameras) => {
              if(cameras.length > 0) {
                this.tchrScanner.start(cameras[0]);
              } else {
                this.msgGrades('No cameras found', 'warning');
              }
          }).catch((e) => {
              console.error(e);
          });

          this.tchrScanner.addListener('scan',(code) => {
            this.sound();
            this.testNowQrCode(code);
        });
    }

    this.stopScanner = () => {
          Instascan.Camera.getCameras().then((cameras) => {
              if(cameras.length > 0 ) {
                this.tchrScanner.stop(cameras[0]);
              } else {
                  this.msgGrades('No cameras found', 'warning');
              }
          }).catch((e) => {
              console.error(e);
          });
    };

    this.sound = () => {
      let audio = new Audio("../assets/qr/sound/shutter.mp3" );
      return audio.play();
    };

    this.testNowQrCode = async(testCode) => {
        if(testCode != undefined) {
            let formData = new FormData();
            formData.append("testCode", testCode);

            let response = await fetch('../index.php?action=teacher', {
                method: 'POST',
                body: formData
            });
            
            let { message, status } = await response.json();
            
            if (status == 'success') {
                this.msgTeacher(message, 'success');
            } else {
                this.msgTeacher(message, 'error');
            }
        }
    }

    this.printTeacherQrCode = () => {
        let w = 700;
        let h = 450;
        let img = document.querySelector('#teacherQrimg').src;
        let fname = document.querySelector('#filenameQr').value;
        let content = `
            <style>
            .card-container {
                display: flex;
                justify-content: center;
            }
            .card {
                box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
                transition: 0.3s;
                width: 50%;
              }
              
              .card:hover {
                box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
              }
              
              .container {
                padding: 2px 16px;
                text-align: center;
              } 
            </style>
            
            <div class="card-container">
                <div class="card">
                    <img src="${img}" alt="QrCode" style="width:100%">
                    <div class="container">
                        <h4><b>${fname}</b></h4> 
                        <p>TEACHER</p> 
                    </div>
                </div>
            </div>
        `;

        setTimeout(() => {
        let left = (screen.width/2 - w/2);
        let top  = (screen.height/2 - h/2);
        let mywindow = window.open(``, 
            `Print`, 
            `height=${h},
            width=${w},
            left=${left}, 
            top=${top}`
        );
            mywindow.document.write('<html><body style="background:rgb(240, 240, 240);">');
            mywindow.document.write(content);
            mywindow.document.write('</body></html>');
            mywindow.document.close();
            mywindow.focus();
            mywindow.print();
        },1000);
    }

    this.addfromTeacher = () => {
        cameratchr.onclick = (e) => {
            document.querySelector('#fileChoosertchr').click();
        }
        
        fileChoosertchr.onchange = (e) => {
            if (e.target.files && e.target.files[0]) {
                document.querySelector('#avatartchr').src = URL.createObjectURL(event.target.files[0]);
            }
        }

        tchrAddForm.onsubmit = async (e) => {
            e.preventDefault();
            let btnVal = document.querySelector("#btnTeacher");
            let resetForm = document.querySelector("#tchrAddForm");
            let resetavatar = document.querySelector("#avatartchr");
            let closeModaL = document.querySelector("#teacherAddModal");
            let defaultavatar = '../assets/images/account.png';
        
            btnVal.value = "Please Wait...";
        
            let response = await fetch('../index.php?action=teacher', {
                credentials: "same-origin",
                method: 'POST',
                body: new FormData(tchrAddForm)
            });
        
            let { message, status } = await response.json();
            
            if (status == 'success') {
                setTimeout(() => {
                    btnVal.value = "Save";
                    this.fetchTeacher();
                    this.totalPagesTeacher();
                    this.msgTeacher(message, 'success');
                    closeModaL.click();
                    resetavatar.src = defaultavatar;
                    resetForm.reset();
                }, 1000);
            } else {
                this.msgTeacher(message, 'error');
                btnVal.value = "Field to Save";
            }
        };
    }

    this.addValueUpdateTeacher = async(tchrid) => {
        let formData = new FormData();
        formData.append('tchrid', tchrid);

        let response = await fetch(`../index.php?action=teacher`, {
          credentials: "same-origin",
          method: 'POST',
          body: formData
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            document.querySelector('#tchrid').value = message.teacher_id;
            document.querySelector('#tchrfname').value = message.fname;
            document.querySelector('#tchrmname').value = message.mname;
            document.querySelector('#tchrlname').value = message.lname;
            document.querySelector('#tchrdob').value = message.dob;
            document.querySelector('#tchraddress').value = message.address;
            document.querySelector('#tchrgender').value = message.gender;
            document.querySelector('#tchremail').value = message.email;
            document.querySelector('#tchrcontactno').value = message.contact_no;
            document.querySelector('#avatarnewteacher').src = message.avatar;
            document.querySelector('#tchrcurrentavatar').value = message.avatar;
        } else {
            this.msgTeacher(message, 'error'); 
        }
    } 

     this.updatefromTeacher = () => {
        tchrnewcameras.onclick = (e) => {
            document.querySelector('#tchrnewfileChooser').click();
        }
        
        tchrnewfileChooser.onchange = (e) => {
            if (e.target.files && e.target.files[0]) {
                document.querySelector('#avatarnewteacher').src = URL.createObjectURL(event.target.files[0]);
            }
        }

        tchrUpdateForm.onsubmit = async (e) => {
            e.preventDefault();
            let btnVal = document.querySelector("#btnNewTeacher");
            let resetForm = document.querySelector("#tchrUpdateForm");
            let resetavatar = document.querySelector("#avatarnewteacher");
            let closeModaL = document.querySelector("#teacherUpdateModal");
            let defaultavatar = '../assets/images/account.png';
        
            btnVal.value = "Please Wait...";
        
            let response = await fetch('../index.php?action=teacher', {
                credentials: "same-origin",
                method: 'POST',
                body: new FormData(tchrUpdateForm)
            });
        
            let { message, status } = await response.json();
            
            if (status == 'success') {
                setTimeout(() => {
                    btnVal.value = "Update";
                    this.fetchTeacher();
                    this.totalPagesTeacher();
                    this.msgTeacher(message, 'success');
                    closeModaL.click();
                    resetavatar.src = defaultavatar;
                    resetForm.reset();
                }, 1000);
            } else {
                this.msgTeacher(message, 'error');
                btnVal.value = "Field to Save";
            }
        };
    }
    
    this.tableBodyTeacher = (data) => {
        let inc = 0;
        let row = ``;
        let empVal = `<td colspan="12" class="font-5xl text-center font-extrabold animate-bounce">Data Not Found...</td>`;

        if(data != true) {
            data.forEach(el => {
                row += `
                <tr>
                    <td class="px-5 py-5">
                        <input class="w-5 h-5" type="checkbox" name="tchr_chk[]" value="${el.teacher_id}">
                    </td>
                    <td class="px-5 py-5">${++inc}</td>
                    <td class="px-5 py-5">
                        <div class="relative mx-auto w-20 h-20 rounded-full border-gray-300 border-2">
                            <img class="w-full h-full rounded-full" src="${el.avatar}" alt="avatar" />
                        </div>
                    </td>
                    <td class="px-5 py-5">${el.id_pass}</td>
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
                        <button onclick="tchrObj.addValueUpdateTeacher(${el.teacher_id})" type="button" data-toggle="modal" data-target="#teacherUpdateModal" class="w-16 h-16 hover:border-blue-600 hover:bg-blue-100 hover:text-blue-600 tracking-wide text-lg text-white bg-blue-400 py-2 rounded-full border-blue-500 border-2">
                            <i class="fa fa-pen text-2xl"></i>
                        </button>
                    <td class="px-5 py-5">
                        <button type="button" onclick="tchrObj.viewQrCode(
                        '${el.id_pass}',
                        '${el.fname}',
                        '${el.mname.charAt(0).toUpperCase()}',
                        '${el.lname}'
                        ), qrcode.toCanvas()" data-toggle="modal" data-target="#teacherQrcodeModal" class="w-16 h-16 hover:border-blue-600 hover:bg-blue-100 hover:text-blue-600 tracking-wide text-lg text-white bg-blue-400 py-2 rounded-full border-blue-500 border-2">
                            <i class="fas fa-qrcode text-2xl"></i>
                        </button>
                    </td>
                </tr>
                `;
            }); 
        } else {
            row = empVal
        }
        document.querySelector("#tbodyteacher").innerHTML = row;
    };

    this.fetchUnActTeacher = async() => {
        const response = await fetch(`../index.php?action=teacher&viewUnact`, {
            credentials: "same-origin",
            method: "GET",
        }); 

        let { message, status} = await response.json();

        if(status == 'success') {
            this.tableBodyUnbactTeacher(message);
        } else {
            this.msgTeacher(message, 'error'); 
        }
    };

    this.tableBodyUnbactTeacher = (data) => {
        let inc = 0;
        let row = ``;
        let empVal = `<td colspan="10" class="font-5xl text-center font-extrabold animate-bounce">Data Not Found...</td>`;

        if(data != true) {
            data.forEach(el => {
                row += `
                <tr>
                    <td class="px-5 py-5">
                        <input class="w-5 h-5" type="checkbox" name="tchrUnact_chk[]" value="${el.teacher_id}">
                    </td>
                    <td class="px-5 py-5">${++inc}</td>
                    <td class="px-5 py-5">
                        <div class="relative mx-auto w-20 h-20 rounded-full border-gray-300 border-2">
                            <img class="w-full h-full rounded-full" src="${el.avatar}" alt="avatar" />
                        </div>
                    </td>
                    <td class="px-5 py-5">${el.id_pass}</td>
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
        document.querySelector("#tbodyunactteacher").innerHTML = row;
    };

    this.dowonloadCSVTeacher = () => {
        downloadCSVTeacher.onclick = async(e) => {
            let header = 'FirstName,MiddleName,LastName,Date_of_Birt,Gender,Address,Email,Contact_Number,Password\n';
        
            let el = document.createElement('a');
            el.href = 'data:text/csv;charset=utf-8,' + encodeURI(header);
            el.target = '_blank';
    
            let current = new Date();
            let cDate = current.getFullYear() + '-' + (current.getMonth() + 1) + '-' + current.getDate();
            let cTime = current.getHours() + ":" + current.getMinutes() + ":" + current.getSeconds();
            let dateTime = cDate + ' ' + cTime;
            
            el.download = 'Teacher_'+dateTime+'.csv';
            el.click();
        }
    }
}

const tchrScanner = new Instascan.Scanner({ video: document.querySelector('#preview')});
let tchrObj = new Teacher(DynamicLogo, tchrScanner);
tchrObj.fetchTeacher();
tchrObj.searchTeacher();
tchrObj.limitPagesTeacher();
tchrObj.totalPagesTeacher();
tchrObj.addfromTeacher();
tchrObj.updatefromTeacher();
tchrObj.removeTeacher();
tchrObj.printAllTeacherData();
tchrObj.cehckAllTeacher();
tchrObj.fetchUnActTeacher();
tchrObj.password();
tchrObj.Updatepassword();
tchrObj.testQrTchrBtn();
tchrObj.dowonloadCSVTeacher();