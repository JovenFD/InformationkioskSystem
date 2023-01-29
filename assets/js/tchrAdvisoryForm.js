function TeacherAdvisory() {

    this.msgtchrAdvisory = (msg, type_icon) => {
        swal({
            title: msg,
            icon: type_icon,
            timer: 2000,
            buttons: {
                cancel: "Close",
            }
        });
    }

    this.fetchtchrAdvisory = async() => {
        const response = await fetch("../index.php?action=teacherAvisory&view", {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            this.tableBodyTchrAdvisory(message);
        } else {
            this.msgtchrAdvisory(message, 'error'); 
        }
    }   

    this.searchstdTchrAdvisory = () => {
        searchtchrAdvisory.oninput = async(e) => {
            let count = e.currentTarget.value.length;
            let data  = e.currentTarget.value;
            
            if(count > 0) {
                let formData = new FormData();
                formData.append('data', data);
    
                let response = await fetch(`../index.php?action=teacherAvisory`, {
                  credentials: "same-origin",
                  method: 'POST',
                  body: formData
                });
                let { message, status} = await response.json();

                if(status == 'success') {
                    this.tableBodyTchrAdvisory(message);
                } else {
                    this.msgtchrAdvisory(message, 'error'); 
                }
            } else {
                this.fetchtchrAdvisory();
            }
        };

        searchtchrUnactAdvisory.oninput = async(e) => {
            let count = e.currentTarget.value.length;
            let data  = e.currentTarget.value;
            
            if(count > 0) {
                let formData = new FormData();
                formData.append('dataUnact', data);
    
                let response = await fetch(`../index.php?action=teacherAvisory`, {
                  credentials: "same-origin",
                  method: 'POST',
                  body: formData
                });
                let { message, status} = await response.json();

                if(status == 'success') {
                    this.tableBodyUnactTchrAdvisory(message);
                } else {
                    this.msgtchrAdvisory(message, 'error'); 
                }
            } else {
                this.fetchUnactTchrAdvisory();
            }
        };
    }

    this.fetchTeacher = async() => {
        const response = await fetch(`../index.php?action=teacher&view`, {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            this.tbodyTeacher(message);
        } else {
            this.msgtchrAdvisory(message, 'error'); 
        }
    };

    this.searchTeacher = () => {
        searchdplist.oninput = async(e) => { 
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
                    this.tbodyTeacher(message);
                } else {
                    this.msgtchrAdvisory(message, 'error'); 
                }
            } else {
                this.fetchTeacher();
            }
        };
    }

    this.tbodyTeacher = (data) => {
        let row = ``;
        let empVal = `<tr><td class="font-5xl text-center font-extrabold animate-bounce">Data Not Found...</td></tr>`;

        if(data != true) {
            data.forEach(el => {
                row += `
                <tr>
                    <td>
                        <button type="button" class="hover:border-gray-600 hover:bg-gray-100 hover:text-gray-600 tracking-wide bg-gray-200 w-full" onclick="tchrAdvObj.addValTeacherOption(
                            '${el.teacher_id}',
                            '${el.fname}',
                            '${el.mname.charAt(0).toUpperCase()}',
                            '${el.lname}'
                            )">
                            ${el.fname} 
                            ${el.mname.charAt(0).toUpperCase()}, 
                            ${el.lname}
                        <button>
                    </td>
                </tr>
                `;
            }); 
        } else {
            row = empVal
        }
        document.querySelector("#dpListTeacher").innerHTML = row;
        document.querySelector("#newDpListTeacher").innerHTML = row;
    } 

    this.addValTeacherOption = (id, fname, mname, lname) => {
        document.querySelector('#tchrId').value = id;
        document.querySelector('#searchdplist').value = `${fname} ${mname}, ${lname}`;
        document.querySelector('#newTchrId').value = id;
        document.querySelector('#newSearchdplist').value = `${fname} ${mname}, ${lname}`;
    }

    this.modalListOptionClass = async() => {
        let select   = document.querySelector('#listclass');
        let selectNew = document.querySelector('#newlistclass');
        let defaultop = `<option>Select Class</option>`;
        let output = ``;
        const response = await fetch("../index.php?action=class&view", {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            if(message != true) {
                message.forEach(el => {
                    output += `
                        <option value="${el.class_id}">${el.classname}</option>
                    `;
                });
            } else  {
                    output = `<option value=''>Empty Class</option>`;
             } 
            select.innerHTML   = defaultop+output;
            selectNew.innerHTML = defaultop+output;
        } else {
            this.msgtchrAdvisory(message, 'error'); 
        }
    }
    
    this.modalListOptionSubject = async() => {
        let select   = document.querySelector('#listsubject');
        let selectNew = document.querySelector('#newlistsubject');
        let defaultop = `<option>Select Subject</option>`;
        let output = ``;
        const response = await fetch("../index.php?action=subject&view", {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            if(message != true) {
                message.forEach(el => {
                    output += `
                        <option value="${el.subject_id}">
                            ${el.subject_name} - ${el.discription_subject}
                        </option>
                    `;
                });
            } else  {
                    output = `<option value=''>Empty Subject</option>`;
             } 
            select.innerHTML   = defaultop+output;
            selectNew.innerHTML = defaultop+output;
        } else {
            this.msgtchrAdvisory(message, 'error'); 
        }
    }

    this.addFormTchrAdv = () => {
        tchrAdvAddForm.onsubmit = async (e) => {
            e.preventDefault();
            let btnVal = document.querySelector("#tchrAdv-btn");
            let resetForm = document.querySelector("#tchrAdvAddForm");
            let closeModaL = document.querySelector("#tchrAdvAddModal");
        
            btnVal.value = "Please Wait...";
        
            let response = await fetch('../index.php?action=teacherAvisory', {
                credentials: "same-origin",
                method: 'POST',
                body: new FormData(tchrAdvAddForm)
            });
        
            let { message, status } = await response.json();
            
            if (status == 'success') {
                setTimeout(() => {
                    btnVal.value = "Save";
                    this.fetchtchrAdvisory();
                    this.msgtchrAdvisory(message, 'success');
                    this.totalPagesTchrAdv();
                    closeModaL.click();
                    resetForm.reset();
                }, 1000);
            } else {
                this.msgtchrAdvisory(message, 'error');
                btnVal.value = "Field to Save";
            }
        };
    }

    this.printAllTchrAdvData = () => {
        btnPrintTeacherAdvisoryData.onclick = async(e) => {
            swal({
                title: "Are you sure you want to print all this Teacher Advisory Records?",
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

                    const response = await fetch(`../index.php?action=teacherAvisory&print`, {
                        credentials: "same-origin",
                        method: "GET",
                    });

                    let {status} = await response.json();

                    if(status == 'success') {
                        let mywindow = window.open(
                            `print_teacheradvisory_data.php`, 
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
                        this.msgtchrAdvisory(message, 'error');
                    }
                } else {
                    swal("Cancel printing!");
                }
            });
        }
    }

    this.checkAlltchrAdvisory = () => {
        tchrAdvcheckAll.onclick = async() => {
            let items = document.getElementsByName('tchrAdv_chk[]');
            if (tchrAdvcheckAll.checked == true){
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

        tchrAdvUnactcheckAll.onclick = async() => {
            let items = document.getElementsByName('UnactTchrAdvsy_chk[]');
            if (tchrAdvUnactcheckAll.checked == true){
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

    this.removetchrAdv = () => {
        tchrAdvisoryDelForm.onsubmit = (e) => {
            e.preventDefault();
            
            swal({
                title: "Are you sure you do want to set UnActive this Teacher Advisory?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then( async(remove) => {
                if (remove) {
                    let response = await fetch(`../index.php?action=teacherAvisory`, {
                        credentials: "same-origin",
                        method: 'POST',
                        body: new FormData(tchrAdvisoryDelForm)
                    });
            
                    let { message, status } = await response.json();
            
                    if (status == 'success') {
                        this.msgtchrAdvisory(message, 'success');
                        this.fetchtchrAdvisory();   
                        this.totalPagesTchrAdv();
                        this.fetchUnactTchrAdvisory();
                    } else {
                        this.msgtchrAdvisory(message, 'error');
                    }
                } else {
                    swal("Cancel Changes!");
                }
            });
        };   

        tchrAdvisoryUnactForm.onsubmit = (e) => {
            e.preventDefault();
            
            swal({
                title: "Are you sure you do want to set Active this Teacher Advisory?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then( async(remove) => {
                if (remove) {
                    let response = await fetch(`../index.php?action=teacherAvisory`, {
                        credentials: "same-origin",
                        method: 'POST',
                        body: new FormData(tchrAdvisoryUnactForm)
                    });
            
                    let { message, status } = await response.json();
            
                    if (status == 'success') {
                        this.msgtchrAdvisory(message, 'success');
                        this.fetchtchrAdvisory();   
                        this.totalPagesTchrAdv();
                        this.fetchUnactTchrAdvisory();
                    } else {
                        this.msgtchrAdvisory(message, 'error');
                    }
                } else {
                    swal("Cancel Changes!");
                }
            });
        };   
    }

    this.limitPagestchrAdv = () => {
        limittchrAdvisory.onchange = async(e) => {
            let val = e.currentTarget.value;
            
            const response = await fetch(`../index.php?action=teacherAvisory&tchradvsort=${val}`, {
                credentials: "same-origin",
                method: "GET",
            });
            let { message, status} = await response.json();

            if(status == 'success') {
                this.tableBodyTchrAdvisory(message);
                this.totalPagesTchrAdv();
            } else {
                this.msgtchrAdvisory(message, 'success'); 
            }
        };
    };

    this.totalPagesTchrAdv = async() => {
        const response  = await fetch(`../index.php?action=teacherAvisory&totalpage`, {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            let total_pages = Math.ceil(message/05);
            let output = ``;
            let pagenumber = 1;

            prevtchrAdvisory.onclick = async() => {
                if(pagenumber >= 1) {
                    this.paginationTchrAdv(pagenumber -= 1);
                } 

                let btnPrev = document.querySelector(`#btnList${pagenumber+1}`);

                if(btnPrev != undefined) {
                    btnPrev.classList.add("bg-blue-200");
                }
            };
        
            nexttchrAdvisory.onclick = async() => {
                if(pagenumber < total_pages) {
                    this.paginationTchrAdv(pagenumber += 1);
                }

                let btnNext = document.querySelector(`#btnList${pagenumber}`);

                if(btnNext != undefined) {
                    btnNext.classList.add("bg-blue-200");
                }
            };

            for (let i = 1; i < total_pages+1; i++) {
                output += `<div id="btnList${i}" onclick="(tchrAdvObj.paginationTchrAdv(${i}))" class="child -bottom-12p-1 mr-2 rounded-md cursor-pointer w-16 h-14 border-solid border-2 flex items-center justify-center border-gray-400 hover:bg-blue-100 font-bold">${i}</div>
                `;
            }

            document.querySelector('#tchrAdvisory-btn-pages').innerHTML = output;

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
            this.msgtchrAdvisory(message, 'error'); 
        }
    };

    this.paginationTchrAdv = async(pagenum) => {
        const response = await fetch(`../index.php?action=teacherAvisory&pagenum=${pagenum}`, {
            credentials: "same-origin",
            method: "GET",
        });
        let { message, status} = await response.json();

        if(status == 'success') { 
            this.tableBodyTchrAdvisory(message);
        } else {
            this.msgtchrAdvisory(message, 'error'); 
        }
    }

    this.addValueUpdateTchrAdv = async(tchradvid, fname, mname, lname) => {
        let formData = new FormData();
        formData.append('tchradvid', tchradvid);

        let response = await fetch(`../index.php?action=teacherAvisory`, {
          credentials: "same-origin",
          method: 'POST',
          body: formData
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            document.querySelector('#tchrAdvid').value = message.teacheradvisory_id;
            document.querySelector('#newTchrId').value = message.teacherid;
            document.querySelector('#newSearchdplist').value = `${fname} ${mname}, ${lname}`;
            document.querySelector('#newlistclass').value = message.classid;
            document.querySelector('#newlistsubject').value = message.subjectid;
        } else {
            this.msgtchrAdvisory(message, 'error'); 
        }
    } 

    this.updateFormTchrAdv = () => {
        tchrAdvUpdateForm.onsubmit = async (e) => {
            e.preventDefault();
            let btnVal = document.querySelector("#newtchrAdv-btn");
            let resetForm = document.querySelector("#tchrAdvUpdateForm");
            let closeModaL = document.querySelector("#tchrUpdatevAddModal");
        
            btnVal.value = "Please Wait...";
        
            let response = await fetch('../index.php?action=teacherAvisory', {
                credentials: "same-origin",
                method: 'POST',
                body: new FormData(tchrAdvUpdateForm)
            });
        
            let { message, status } = await response.json();
            
            if (status == 'success') {
                setTimeout(() => {
                    btnVal.value = "Update";
                    this.fetchtchrAdvisory();
                    this.totalPagesTchrAdv();
                    this.msgtchrAdvisory(message, 'success');
                    closeModaL.click();
                    resetForm.reset();
                }, 1000);
            } else {
                this.msgtchrAdvisory(message, 'error');
                btnVal.value = "Field to Save";
            }
        };
    }  

    this.tableBodyTchrAdvisory = (data) => {
        let inc = 0;
        let row = ``;
        let empVal = `<td colspan="7" class="font-5xl text-center font-extrabold animate-bounce">Data Not Found...</td>`;

        if(data != true) {
            data.forEach(el => {
                row += `
                <tr>
                    <td class="px-5 py-5">
                        <input class="w-5 h-5" type="checkbox" name="tchrAdv_chk[]" value="${el.teacheradvisory_id}">
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
                    <td class="px-5 py-5">${el.classname}</td>
                    <td class="px-5 py-5">${el.subject_name} - ${el.discription_subject}</td>
                    <td class="px-5 py-5">
                        <button onclick="tchrAdvObj.addValueUpdateTchrAdv(
                            '${el.teacheradvisory_id}',
                            '${el.fname}',
                            '${el.mname}',
                            '${el.lname}'
                            )" type="button" data-toggle="modal" data-target="#tchrUpdatevAddModal" class="w-16 h-16 hover:border-blue-600 hover:bg-blue-100 hover:text-red-600 tracking-wide text-lg text-white bg-blue-400 py-2 rounded-full border-blue-500 border-2">
                        <i class="fa fa-pen text-2xl"></i>
                        </button>
                    </td>
                </tr>
                `;
            }); 
        } else {
            row = empVal
        }
        document.querySelector("#tbodytchrAdvisory").innerHTML = row;
    };

    this.fetchUnactTchrAdvisory = async() => {
        const response = await fetch("../index.php?action=teacherAvisory&viewUnact", {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            this.tableBodyUnactTchrAdvisory(message);
        } else {
            this.msgtchrAdvisory(message, 'error'); 
        }
    }   

    this.tableBodyUnactTchrAdvisory = (data) => {
        let inc = 0;
        let row = ``;
        let empVal = `<td colspan="6" class="font-5xl text-center font-extrabold animate-bounce">Data Not Found...</td>`;

        if(data != true) {
            data.forEach(el => {
                row += `
                <tr>
                    <td class="px-5 py-5">
                        <input class="w-5 h-5" type="checkbox" name="UnactTchrAdvsy_chk[]" value="${el.teacheradvisory_id}">
                    </td>
                    <td class="px-5 py-5">
                        <div class="relative mx-auto w-20 h-20 rounded-full border-gray-300 border-2">
                            <img class="w-full h-full rounded-full" src="${el.avatar}" alt="avatar" />
                        </div>
                    </td>
                    <td class="px-5 py-5">${++inc}</td>
                    <td class="px-5 py-5">
                        ${el.fname} 
                        ${el.mname.charAt(0).toUpperCase()}, 
                        ${el.lname}
                    </td>
                    <td class="px-5 py-5">${el.classname}</td>
                    <td class="px-5 py-5">${el.subject_name} - ${el.discription_subject}</td>
                </tr>
                `;
            }); 
        } else {
            row = empVal
        }
        document.querySelector("#tbodyUnactTchrAdvisory").innerHTML = row;
    };
}
let tchrAdvObj = new TeacherAdvisory();
tchrAdvObj.fetchtchrAdvisory();
tchrAdvObj.searchstdTchrAdvisory();
tchrAdvObj.searchTeacher();
tchrAdvObj.modalListOptionSubject();
tchrAdvObj.modalListOptionClass();
tchrAdvObj.fetchTeacher();
tchrAdvObj.addFormTchrAdv();
tchrAdvObj.removetchrAdv();
tchrAdvObj.limitPagestchrAdv();
tchrAdvObj.totalPagesTchrAdv();
tchrAdvObj.updateFormTchrAdv();
tchrAdvObj.printAllTchrAdvData();
tchrAdvObj.checkAlltchrAdvisory();
tchrAdvObj.fetchUnactTchrAdvisory();
