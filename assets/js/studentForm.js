function Student(DynamicLogo, stdScanner) {
    this.DynamicLogo = DynamicLogo;
    this.stdScanner  = stdScanner;

    this.msgStudent = async(msg, type_icon) => {
        swal({
            title: msg,
            icon: type_icon,
            timer: 2000,
            buttons: {
                cancel: "Close",
            }
        });
    }

    this.dateFormatStudent = (input) => {
        setTimeout(() => {
            input.type = 'text';
        }, 60000);
    }

    this.fetchStudent = async() => {
        const response = await fetch("../index.php?action=student&view", {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            this.tableBodyStudent(message);
        } else {
            this.msgStudent(message, status); 
        }
    };

    this.filterStudent = () => {
        filterstudent.onchange = async(e) => {
            let val = e.currentTarget.value;
            const response = await fetch(`../index.php?action=student&stdsort=${val}`, {
                credentials: "same-origin",
                method: "GET",
            });
            let { message, status} = await response.json();

            if(status == 'success') {
                this.tableBodyStudent(message);
                this.totalPagesStudent();
            } else {
                this.msgStudent(message, status); 
            }
        }
    };

    this.totalPagesStudent = async() => {
        const response = await fetch(`../index.php?action=student&totalpage`, {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            let total_pages = Math.ceil(message/05);
            let output = ``;

            let pagenumber = 1;
            prev.onclick = async() => {
                if(pagenumber >= 1) {
                    this.paginationStudent(pagenumber -= 1);
                    total_pages -= 1;
                } 

                let btnNext = document.querySelector(`#btnList${pagenumber}`);

                if(btnNext != undefined) {
                     btnNext.classList.remove("bg-blue-200")
                }
            };
        
            next.onclick = async() => {
    
                if(pagenumber < total_pages) {
                    this.paginationStudent(pagenumber += 1);
                    total_pages += 1;
                }

                let btnNext = document.querySelector(`#btnList${pagenumber}`);

                if(btnNext != undefined) {
                    btnNext.classList.add("bg-blue-200");
                }
                
            };

            for (let i = 1; i < total_pages+1; i++) {
                output += `<div id="btnList${i}" onclick="(stdObj.paginationStudent(${i}))" class="child -bottom-12p-1 mr-2 rounded-md cursor-pointer w-16 h-14 border-solid border-2 flex items-center justify-center border-gray-400 hover:bg-blue-100 font-bold">${i}</div>
                `;
            }

            document.querySelector('#std-btn-pages').innerHTML = output;

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
            this.msgStudent(message, status); 
        }
    };


    this.paginationStudent = async(pagenum) => {
        const response = await fetch(`../index.php?action=student&pagenum=${pagenum}`, {
            credentials: "same-origin",
            method: "GET",
        });
        let { message, status} = await response.json();

        if(status == 'success') {   

            this.tableBodyStudent(message);

        } else {
            this.msgStudent(message, status); 
        }
    }

    this.searchStudent = () => {
        searchstd.oninput = async(e) => {
            let count = e.currentTarget.value.length;
            let data  = e.currentTarget.value;
            
            if(count > 0) {
                let formData = new FormData();
                formData.append('data', data);
    
                let response = await fetch(`../index.php?action=student`, {
                  credentials: "same-origin",
                  method: 'POST',
                  body: formData
                });
                let { message, status} = await response.json();

                if(status == 'success') {
                    this.tableBodyStudent(message);
                } else {
                    this.msgStudent(message, status); 
                }
            } else {
                this.fetchStudent();
            }
        };

        searchStdUnactive.oninput = async(e) => {
            let count = e.currentTarget.value.length;
            let data  = e.currentTarget.value;
            
            if(count > 0) {
                let formData = new FormData();
                formData.append('dataUnactive', data);
    
                let response = await fetch(`../index.php?action=student`, {
                  credentials: "same-origin",
                  method: 'POST',
                  body: formData
                });
                let { message, status} = await response.json();

                if(status == 'success') {
                    this.tableBodyUnactiveStudent(message);
                } else {
                    this.msgStudent(message, status); 
                }
            } else {
                this.fetchUnactiveStudent();
            }
        };
    }

    this.viewQrCode = (
        code, 
        fname, 
        mname, 
        lname
        ) => {
        document.querySelector('#filenameQr').value = 
        `${fname} 
        ${mname}, 
        ${lname}`;
        window.qrcode = new QrCodeWithLogo({
            canvas: document.querySelector("#studentQr"),
            content: code,
            width: 380,
            image: document.querySelector("#studentQrimg"),
            logo: {
              src: this.DynamicLogo,
              logoSize: 0.2
            }
        });
    }

    this.testQrBtn = () => {

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
                this.stdScanner.start(cameras[0]);
              } else {
                this.msgGrades('No cameras found', 'warning');
              }
          }).catch((e) => {
              console.error(e);
          });

          this.stdScanner.addListener('scan',(code) => {
            this.sound();
            this.testNowQrCode(code);
        });
    }

    this.stopScanner = () => {
          Instascan.Camera.getCameras().then((cameras) => {
              if(cameras.length > 0 ) {
                this.stdScanner.stop(cameras[0]);
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

            let response = await fetch('../index.php?action=student', {
                method: 'POST',
                body: formData
            });
            
            let { message, status } = await response.json();
            
            if (status == 'success') {
                this.msgStudent(message, 'success');
            } else {
                this.msgStudent(message, 'error');
            }
        }
    }

    this.printStudentQrCode = () => {
        let w = 700;
        let h = 450;
        let fname = document.querySelector('#filenameQr').value;
        let img = document.querySelector('#studentQrimg').src;
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
                        <p>STUDENT</p> 
                    </div>
                </div>
            </div>
        `;
        setTimeout(()=>{
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

    this.printAllStudentData = () => {
        btnStudentPrint.onclick = async(e) => {
            swal({
                title: "Are you sure you want to print all this student record?",
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
                    
                    const response = await fetch(`../index.php?action=student&print`, {
                        credentials: "same-origin",
                        method: "GET",
                    });

                    let {status} = await response.json();

                    if(status == 'success') {
                        let mywindow = window.open(
                            `print_student_data.php`, 
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
                        this.msgStudent(message, status);
                    }
                } else {
                    swal("Cancel printing!");
                }
            });
        }
    }

    this.cehckAllStduent = () => {
        checkAll.onclick = async() => {
            let items = document.getElementsByName('std_chk[]');
            if (checkAll.checked == true){
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

        checkAllUnactive.onclick = async() => {
            let items = document.getElementsByName('stdUn_chk[]');
            if (checkAllUnactive.checked == true){
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
        
    this.tableBodyStudent = (data) => {
        let inc = 0;
        let row = ``;
        let empVal = `<td colspan="12" class="font-5xl text-center font-extrabold animate-bounce">Data Not Found...</td>`;

        if(data != true) {
            data.forEach(el => {
                row += `
                <tr>
                    <td class="px-5 py-5">
                        <input class="w-5 h-5" type="checkbox" name="std_chk[]" value="${el.student_id}">
                    </td>
                    <td class="px-5 py-5">${++inc}</td>
                    <td class="px-5 py-5">
                        <div class="relative mx-auto w-20 h-20 rounded-full border-gray-300 border-2">
                            <img class="w-full h-full rounded-full" src="${el.avatar}" alt="avatar" />
                        </div>
                    </td>
                    <td class="px-5 py-5">${el.id_pass}</td>
                    <td class="px-5 py-5">${el.student_no}</td>
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
                        <button onclick="stdObj.addValueUpdateStudent(${el.student_id})" type="button" data-toggle="modal" data-target="#studentUpdateModal" class="w-16 h-16 hover:border-blue-600 hover:bg-blue-100 hover:text-blue-600 tracking-wide text-white bg-blue-400 py-2 rounded-full border-blue-500 border-2">
                            <i class="fa fa-pen text-2xl"></i>
                        </button>
                    </td>
                    <td class="px-5 py-5 text-black">
                        <button type="button" onclick="stdObj.viewQrCode(
                            '${el.id_pass}',
                            '${el.fname}',
                            '${el.mname.charAt(0).toUpperCase()}',
                            '${el.lname}'
                            ), qrcode.toCanvas()" data-toggle="modal" data-target="#studentQrcodeModal" class="w-16 h-16 hover:border-blue-600 hover:bg-blue-100 hover:text-blue-600 tracking-wide text-white bg-blue-400 py-2 rounded-full border-blue-500 border-2">
                            <i class="fas fa-qrcode text-2xl"></i>
                        </button>
                    </td>
                </tr>
                `;
            }); 
        } else {
            row = empVal
        }
        document.querySelector("#tbodystudent").innerHTML = row;
    };

    this.addfromStudent = () => {
        camerastudent.onclick = (e) => {
            document.querySelector('#fileChooserstudent').click();
        }
        
        fileChooserstudent.onchange = (e) => {
            if (e.target.files && e.target.files[0]) {
                document.querySelector('#avatarstudent').src = URL.createObjectURL(event.target.files[0]);
            }
        }

        stdAddForm.onsubmit = async (e) => {
            e.preventDefault();
            let btnVal = document.querySelector("#btnStudent");
            let resetForm = document.querySelector("#stdAddForm");
            let resetavatar = document.querySelector("#avatarstudent");
            let closeModaL = document.querySelector("#studentAddModal");
            let defaultavatar = '../assets/images/account.png';
        
            btnVal.value = "Please Wait...";
        
            let response = await fetch('../index.php?action=student', {
                credentials: "same-origin",
                method: 'POST',
                body: new FormData(stdAddForm)
            });
        
            let { message, status } = await response.json();
            
            if (status == 'success') {
                setTimeout(() => {
                    btnVal.value = "Save";
                    this.fetchStudent();
                    this.totalPagesStudent();
                    this.msgStudent(message, 'success');
                    closeModaL.click();
                    resetavatar.src = defaultavatar;
                    resetForm.reset();
                }, 1000);
            } else {
                this.msgStudent(message, 'error');
                btnVal.value = "Field to Save";
            }
        };
    }

    this.addValueUpdateStudent = async(stdid) => {
        let formData = new FormData();
        formData.append('stdid', stdid);

        let response = await fetch(`../index.php?action=student`, {
          credentials: "same-origin",
          method: 'POST',
          body: formData
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            document.querySelector('#stdid').value = message.student_id;
            document.querySelector('#stdfname').value = message.fname;
            document.querySelector('#stdmname').value = message.mname;
            document.querySelector('#stdlname').value = message.lname;
            document.querySelector('#stdstudentno').value = message.student_no;
            document.querySelector('#stddob').value = message.dob;
            document.querySelector('#stdaddress').value = message.address;
            document.querySelector('#stdgender').value = message.gender;
            document.querySelector('#stdemail').value = message.email;
            document.querySelector('#stdcontactno').value = message.contact_no;
            document.querySelector('#stdnewavatar').src = message.avatar;
            document.querySelector('#stdcurrentavatar').value = message.avatar;
        } else {
            this.msgStudent(message, status); 
        }
    }   

    this.updatefromStudent = () => {
        stdnewcameras.onclick = (e) => {
            document.querySelector('#stdnewfileChooser').click();
        }
        
        stdnewfileChooser.onchange = (e) => {
            if (e.target.files && e.target.files[0]) {
                document.querySelector('#stdnewavatar').src = URL.createObjectURL(event.target.files[0]);
            }
        }

        stdNewUpdateForm.onsubmit = async (e) => {
            e.preventDefault();
            let btnVal = document.querySelector("#btnNewStudent");
            let resetForm = document.querySelector("#stdNewUpdateForm");
            let resetavatar = document.querySelector("#stdnewavatar");
            let closeModaL = document.querySelector("#studentUpdateModal");
            let defaultavatar = '../assets/images/account.png';
        
            btnVal.value = "Please Wait...";
        
            let response = await fetch('../index.php?action=student', {
                credentials: "same-origin",
                method: 'POST',
                body: new FormData(stdNewUpdateForm)
            });
        
            let { message, status } = await response.json();
            
            if (status == 'success') {
                setTimeout(() => {
                    btnVal.value = "Update";
                    this.fetchStudent();
                    this.totalPagesStudent();
                    this.msgStudent(message, 'success');
                    closeModaL.click();
                    resetavatar.src = defaultavatar;
                    resetForm.reset();
                }, 1000);
            } else {
                this.msgStudent(message, 'error');
                btnVal.value = "Field to Save";
            }
        };
    }

    this.removeStudent = () => {
        stdDelForm.onsubmit = (e) => {
            e.preventDefault();

            swal({
                title: "Are you sure do you want to set Inactive this Student?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then( async(remove) => {
                if (remove) {
                    let response = await fetch(`../index.php?action=student`, {
                        credentials: "same-origin",
                        method: 'POST',
                        body: new FormData(stdDelForm)
                    });
            
                    let { message, status } = await response.json();
            
                    if (status == 'success') {
                        this.msgStudent(message, status);
                        this.fetchStudent();
                        this.totalPagesStudent();
                        this.fetchUnactiveStudent();
                    } else {
                        this.msgStudent(message, status);
                    }
                } else {
                    swal("Cancel Changes");
                }
            });
        };   

        studentUnactiveForm.onsubmit = (e) => {
            e.preventDefault();

            swal({
                title: "Are you sure do you want to set active this Student?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then( async(remove) => {
                if (remove) {
                    let response = await fetch(`../index.php?action=student`, {
                        credentials: "same-origin",
                        method: 'POST',
                        body: new FormData(studentUnactiveForm)
                    });
            
                    let { message, status } = await response.json();
            
                    if (status == 'success') {
                        this.msgStudent(message, status);
                        this.fetchStudent();
                        this.totalPagesStudent();
                        this.fetchUnactiveStudent();
                    } else {
                        this.msgStudent(message, status);
                    }
                } else {
                    swal("Cancel Change");
                }
            });
        };   
    }

    this.fetchUnactiveStudent = async() => {
        const response = await fetch("../index.php?action=student&viewUnactive", {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            this.tableBodyUnactiveStudent(message);
        } else {
            this.msgStudent(message, status); 
        }
    };

    this.tableBodyUnactiveStudent = (data) => {
        let inc = 0;
        let row = ``;
        let empVal = `<td colspan="12" class="font-5xl text-center font-extrabold animate-bounce">Data Not Found...</td>`;

        if(data != true) {
            data.forEach(el => {
                row += `
                <tr>
                    <td class="px-5 py-5 text-black">
                        <input class="w-5 h-5" type="checkbox" name="stdUn_chk[]" value="${el.student_id}">
                    </td>
                    <td class="px-5 py-5 text-black">${++inc}</td>
                    <td class="px-5 py-5 text-black">
                        <div class="relative mx-auto w-20 h-20 rounded-full border-gray-300 border-2">
                            <img class="w-full h-full rounded-full" src="${el.avatar}" alt="avatar" />
                        </div>
                    </td>
                    <td class="px-5 py-5 text-black">${el.id_pass}</td>
                    <td class="px-5 py-5 text-black">${el.pinCode}</td>
                    <td class="px-5 py-5 text-black">${el.student_no}</td>
                    <td class="px-5 py-5 text-black">
                        ${el.fname} 
                        ${el.mname.charAt(0).toUpperCase()}, 
                        ${el.lname}
                    </td>
                    <td class="px-5 py-5 text-black">${new Date(el.dob).toDateString()}</td>
                    <td class="px-5 py-5 text-black">${el.gender}</td>
                    <td class="px-5 py-5 text-black">${el.address}</td>
                    <td class="px-5 py-5 text-black">${el.email}</td>
                    <td class="px-5 py-5 text-black">${el.contact_no}</td>
                </tr>
                `;
            }); 
        } else {
            row = empVal
        }
        document.querySelector("#tbodyStudentUncative").innerHTML = row;
    };

    this.dowonloadCSVStudent = () => {
        downloadCSVStudent.onclick = async(e) => {
            let header = 'Student_No,FirstName,MiddleName,LastName,Date_of_Birt,Gender,Address,Email,Contact_Number\n';
        
            let el = document.createElement('a');
            el.href = 'data:text/csv;charset=utf-8,' + encodeURI(header);
            el.target = '_blank';
    
            let current = new Date();
            let cDate = current.getFullYear() + '-' + (current.getMonth() + 1) + '-' + current.getDate();
            let cTime = current.getHours() + ":" + current.getMinutes() + ":" + current.getSeconds();
            let dateTime = cDate + ' ' + cTime;
            
            el.download = 'Student_'+dateTime+'.csv';
            el.click();
        }
    }
}
const stdScanner = new Instascan.Scanner({ video: document.querySelector('#preview')});
let stdObj = new Student(DynamicLogo, stdScanner);
stdObj.fetchStudent();
stdObj.addfromStudent();
stdObj.updatefromStudent();
stdObj.removeStudent();
stdObj.searchStudent();
stdObj.filterStudent();
stdObj.totalPagesStudent();
stdObj.printAllStudentData();
stdObj.cehckAllStduent();
stdObj.fetchUnactiveStudent();
stdObj.testQrBtn();
stdObj.dowonloadCSVStudent();
