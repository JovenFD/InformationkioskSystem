function StdClass() {

    this.msgstdClass = (msg, type_icon) => {
        swal({
            title: msg,
            icon: type_icon,
            timer: 2000,
            buttons: {
                cancel: "Close",
            }
        });
    }

    this.fetchStdClass = async() => {
        const response = await fetch("../index.php?action=stdclass&view", {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            this.tableBodyStdClass(message);
        } else {
            this.msgstdClass(message, 'error'); 
        }
    }

    this.searchstdClass = () => {
        searchstdclass.oninput = async(e) => {
            let count = e.currentTarget.value.length;
            let data  = e.currentTarget.value;
            
            if(count > 0) {
                let formData = new FormData();
                formData.append('data', data);
    
                let response = await fetch(`../index.php?action=stdclass`, {
                  credentials: "same-origin",
                  method: 'POST',
                  body: formData
                });
                let { message, status} = await response.json();

                if(status == 'success') {
                    this.tableBodyStdClass(message);
                } else {
                    this.msgStdClass(message, 'error'); 
                }
            } else {
                this.fetchStdClass();
            }
        };

        searchStdClassUnactive.oninput = async(e) => {
            let count = e.currentTarget.value.length;
            let data  = e.currentTarget.value;
            
            if(count > 0) {
                let formData = new FormData();
                formData.append('unactdata', data);
    
                let response = await fetch(`../index.php?action=stdclass`, {
                  credentials: "same-origin",
                  method: 'POST',
                  body: formData
                });
                let { message, status} = await response.json();

                if(status == 'success') {
                    this.tableBodyStdClassUnactive(message);
                } else {
                    this.msgStdClass(message, 'error'); 
                }
            } else {
                this.fetchUnactiveStdClass();
            }
        };
    }

    this.modalListOptionClass = async() => {
        let select   = document.querySelector('#listclass');
        let selectNew = document.querySelector('#listnewclass');
        let output = ``;
        let defaultop = `<option>Select Class</option>`;
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
            this.msgStdClass(message, 'error'); 
        }
    }

    this.fetchStudent = async() => {
        const response = await fetch("../index.php?action=student&view", {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {

        this.tbodyStudent(message);
            
        } else {
            this.msgStdClass(message, status); 
        }
    };

    this.tbodyStudent = (data) => {
        let row = ``;
        let empVal = `<tr><td class="font-5xl text-center font-extrabold animate-bounce">Data Not Found...</td></tr>`;

        if(data != true) {
            data.forEach(el => {
                row += `
                <tr>
                    <td>
                        <button type="button" class="hover:border-gray-600 hover:bg-gray-100 hover:text-gray-600 tracking-wide bg-gray-200 w-full" onclick="stdclsObj.addValStudentOption(
                            '${el.student_id}',
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
        document.querySelector("#dpListStudent").innerHTML = row;
        document.querySelector("#newDpListStudent").innerHTML = row;
    } 

    this.addValStudentOption = (id, fname, mname, lname) => {
        document.querySelector('#stdId').value = id;
        document.querySelector('#searchdplist').value = `${fname} ${mname}, ${lname}`;

        document.querySelector('#newStdId').value = id;
        document.querySelector('#newSearchdplist').value = `${fname} ${mname}, ${lname}`;
    }

    this.searchstdList = () => {
        searchdplist.oninput = async(e) => {
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
                    this.tbodyStudent(message);
                } else {
                    this.msgStdClass(message, status); 
                }
            } else {
                this.fetchStudent();
            }
        };
    }

    this.modalListOptionSubject = async() => {
        let select   = document.querySelector('#listsubject');
        let selectNew = document.querySelector('#listnewsubject');
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
            this.msgStdClass(message, 'error'); 
        }
    }

    this.addFormstdClass = () => {
        stdClassAddForm.onsubmit = async (e) => {
            e.preventDefault();
            let btnVal = document.querySelector("#stdclass-btn");
            let resetForm = document.querySelector("#stdClassAddForm");
            let closeModaL = document.querySelector("#stdClassAddModal");
        
            btnVal.value = "Please Wait...";
        
            let response = await fetch('../index.php?action=stdclass', {
                credentials: "same-origin",
                method: 'POST',
                body: new FormData(stdClassAddForm)
            });
        
            let { message, status } = await response.json();
            
            if (status == 'success') {
                setTimeout(() => {
                    btnVal.value = "Save";
                    this.fetchStdClass();
                    this.totalPagesStdClass();
                    this.msgstdClass(message, 'success');
                    closeModaL.click();
                    resetForm.reset();
                }, 1000);
            } else {
                this.msgstdClass(message, 'error');
                btnVal.value = "Field to Save";
            }
        };
    }

    this.printAllStdClassData = () => {
        btnPrintStdClass.onclick = async() => {
            swal({
                title: "Are you sure you want to print all this Student Class Records?",
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
    
                    const response = await fetch(`../index.php?action=stdclass&print`, {
                        credentials: "same-origin",
                        method: "GET",
                    });
    
                    let {status} = await response.json();
    
                    if(status != 'error') {
                        let mywindow = window.open(
                            `print_studentclass_data.php`, 
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
                        this.msgstdClass(message, 'error');
                    }
                } else {
                    swal("Cancel printing!");
                }
            });
        }
    }

      this.limitPagesStdClass = () => {
        limitstdclass.onchange = async(e) => {
            let val = e.currentTarget.value;
            
            const response = await fetch(`../index.php?action=stdclass&stdclasssort=${val}`, {
                credentials: "same-origin",
                method: "GET",
            });
            let { message, status} = await response.json();

            if(status == 'success') {
                this.tableBodyStdClass(message);
                this.totalPagesStdClass(message);
            } else {
                this.msgstdClass(message, 'success'); 
            }
        };
    };

    this.totalPagesStdClass = async() => {
        const response  = await fetch(`../index.php?action=stdclass&totalpage`, {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            let total_pages = Math.ceil(message/05);
            let output = ``;
            let pagenumber = 1;

            prevstdclass.onclick = async(e) => {
                if(pagenumber >= 1) {
                    this.paginationstdClass(pagenumber -= 1);
                } 

                let btnPrev = document.querySelector(`#btnList${pagenumber+1}`);

                if(btnPrev != undefined) {
                    btnPrev.classList.add("bg-blue-200")
                }
            };

            nextstdclass.onclick = async(e) => {
                if(pagenumber < total_pages) {
                    this.paginationstdClass(pagenumber += 1);
                }

                let btnNext = document.querySelector(`#btnList${pagenumber}`);

                if(btnNext != undefined) {
                    btnNext.classList.add("bg-blue-200")
                }
            };

            for (let i = 1; i < total_pages+1; i++) {
                output += `<div id="btnList${i}" onclick="(stdclsObj.paginationstdClass(${i}))" class="child -bottom-12p-1 mr-2 rounded-md cursor-pointer w-16 h-14 border-solid border-2 flex items-center justify-center border-gray-400 hover:bg-blue-100 font-bold">${i}</div>
                `;
            }

            document.querySelector('#stdclass-btn-pages').innerHTML = output;

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
            this.msgstdClass(message, 'error'); 
        }
    };

    this.paginationstdClass = async(pagenum) => {
        const response = await fetch(`../index.php?action=stdclass&pagenum=${pagenum}`, {
            credentials: "same-origin",
            method: "GET",
        });
        let { message, status} = await response.json();

        if(status == 'success') { 
            this.tableBodyStdClass(message);
        } else {
            this.msgstdClass(message, 'error'); 
        }
    }

    this.checkAllStdClass = () => {
        stdclscheckAll.onclick = async() => {
            let items = document.getElementsByName('stdclass_chk[]');
            if (stdclscheckAll.checked == true){
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

        stdclsunactivecheckAll.onclick = async() => {
            let items = document.getElementsByName('unactstdclass_chk[]');
            if (stdclsunactivecheckAll.checked == true){
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

    this.removeStdClass = () => {
        stdclassDelForm.onsubmit = async (e) => {
            e.preventDefault();

            swal({
                title: "Are you sure do you want to set unactive this Student Class?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then( async(remove) => {
                if (remove) {
                    
                    let response = await fetch(`../index.php?action=stdclass`, {
                        credentials: "same-origin",
                        method: 'POST',
                        body: new FormData(stdclassDelForm)
                    });
            
                    let { message, status } = await response.json();
            
                    if (status == 'success') {
                        this.msgstdClass(message, 'success');
                        this.fetchStdClass();   
                        this.totalPagesStdClass();
                        this.fetchUnactiveStdClass();
                    } else {
                        this.msgstdClass(message, 'error');
                    }
                } else {
                    swal("Cancel Changes!");
                }
            });
        };   

        studentClassUnactiveForm.onsubmit = async (e) => {
            e.preventDefault();

            swal({
                title: "Are you sure do you want to set active this Student Class?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then( async(remove) => {
                if (remove) {
                    
                    let response = await fetch(`../index.php?action=stdclass`, {
                        credentials: "same-origin",
                        method: 'POST',
                        body: new FormData(studentClassUnactiveForm)
                    });
            
                    let { message, status } = await response.json();
            
                    if (status == 'success') {
                        this.msgstdClass(message, 'success');
                        this.fetchStdClass();   
                        this.totalPagesStdClass();
                        this.fetchUnactiveStdClass();
                    } else {
                        this.msgstdClass(message, 'error');
                    }
                } else {
                    swal("Cancel Changes!");
                }
            });
        };   
    }

    this.addValueUpdateStudentClass = async(stdclassid, fname, mname, lname) => {
        let formData = new FormData();
        formData.append('stdclassid', stdclassid);

        let response = await fetch(`../index.php?action=stdclass`, {
          credentials: "same-origin",
          method: 'POST',
          body: formData
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            document.querySelector('#stdclassid').value = message.studentclass_id;
            document.querySelector('#listnewclass').value = message.classid;
            document.querySelector('#newStdId').value = message.studentid;
            document.querySelector('#newSearchdplist').value = `${fname} ${mname}, ${lname}`;
            document.querySelector('#listnewsubject').value = message.subjectid;
        } else {
            this.msgstdClass(message, 'error'); 
        }
    } 

    this.updateFormStudentClass = () => {
        stdClassUpdateForm.onsubmit = async (e) => {
            e.preventDefault();
            let btnVal = document.querySelector("#newstdclass-btn");
            let resetForm = document.querySelector("#stdClassUpdateForm");
            let closeModaL = document.querySelector("#stdClassUpdateModal");
        
            btnVal.value = "Please Wait...";
        
            let response = await fetch('../index.php?action=stdclass', {
                credentials: "same-origin",
                method: 'POST',
                body: new FormData(stdClassUpdateForm)
            });
        
            let { message, status } = await response.json();
            
            if (status == 'success') {
                setTimeout(() => {
                    btnVal.value = "Update";
                    this.fetchStdClass();
                    this.totalPagesStdClass();
                    this.msgstdClass(message, 'success');
                    closeModaL.click();
                    resetForm.reset();
                }, 1000);
            } else {
                this.msgstdClass(message, 'error');
                btnVal.value = "Field to Save";
            }
        };
    }  

    this.tableBodyStdClass = (data) => {
        let inc = 0;
        let row = ``;
        let empVal = `<td colspan="7" class="font-5xl text-center font-extrabold animate-bounce">Data Not Found...</td>`;

        if(data != true) {
            data.forEach(el => {
                row += `
                <tr>
                    <td class="px-5 py-5">
                        <input class="w-5 h-5" type="checkbox" name="stdclass_chk[]" value="${el.studentclass_id}">
                    </td>
                    <td class="px-5 py-5">
                        <div class="relative mx-auto w-20 h-20 rounded-full border-gray-300 border-2">
                            <img class="w-full h-full rounded-full" src="${el.avatar}" alt="avatar" />
                        </div>
                    </td>
                    <td class="px-5 py-5">${++inc}</td>
                    <td class="px-5 py-5">${el.classname}</td>

                    <td class="px-5 py-5">
                        ${el.fname} 
                        ${el.mname.charAt(0).toUpperCase()}, 
                        ${el.lname}
                    </td>

                    <td class="px-5 py-5">${el.subject_name} - ${el.discription_subject}</td>
                    <td class="px-5 py-5">
                        <button onclick="stdclsObj.addValueUpdateStudentClass(
                            '${el.studentclass_id}',
                            '${el.fname}',
                            '${el.mname}',
                            '${el.lname}'
                            )" type="button" data-toggle="modal" data-target="#stdClassUpdateModal" class="w-16 h-16 hover:border-blue-600 hover:bg-blue-100 hover:text-red-600 tracking-wide text-lg text-white bg-blue-400 py-2 rounded-full border-blue-500 border-2">
                        <i class="fa fa-pen text-2xl"></i>
                        </button>
                    </td>
                </tr>
                `;
            }); 
        } else {
            row = empVal
        }
        document.querySelector("#tbodystdclass").innerHTML = row;
    };

    this.fetchUnactiveStdClass = async() => {
        const response = await fetch("../index.php?action=stdclass&viewUnactive", {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            this.tableBodyStdClassUnactive(message);
        } else {
            this.msgstdClass(message, 'error'); 
        }
    }

    this.tableBodyStdClassUnactive = (data) => {
        let inc = 0;
        let row = ``;
        let empVal = `<td colspan="6" class="font-5xl text-center font-extrabold animate-bounce">Data Not Found...</td>`;

        if(data != true) {
            data.forEach(el => {
                row += `
                <tr>
                    <td class="px-5 py-5">
                        <input class="w-5 h-5" type="checkbox" name="unactstdclass_chk[]" value="${el.studentclass_id}">
                    </td>
                    <td class="px-5 py-5">
                        <div class="relative mx-auto w-20 h-20 rounded-full border-gray-300 border-2">
                            <img class="w-full h-full rounded-full" src="${el.avatar}" alt="avatar" />
                        </div>
                    </td>
                    <td class="px-5 py-5">${++inc}</td>
                    <td class="px-5 py-5">${el.classname}</td>

                    <td class="px-5 py-5">
                        ${el.fname} 
                        ${el.mname.charAt(0).toUpperCase()}, 
                        ${el.lname}
                    </td>

                    <td class="px-5 py-5 text-md">${el.subject_name} - ${el.discription_subject}</td>
                </tr>
                `;
            }); 
        } else {
            row = empVal
        }
        document.querySelector("#tbodyStdClassUncative").innerHTML = row;
    };
}
let stdclsObj = new StdClass();
stdclsObj.fetchStdClass();
stdclsObj.searchstdClass();
stdclsObj.modalListOptionClass();
stdclsObj.searchstdList();
stdclsObj.fetchStudent();
stdclsObj.modalListOptionSubject();
stdclsObj.addFormstdClass();
stdclsObj.limitPagesStdClass();
stdclsObj.totalPagesStdClass();
stdclsObj.removeStdClass();
stdclsObj.updateFormStudentClass();
stdclsObj.printAllStdClassData();
stdclsObj.checkAllStdClass();
stdclsObj.fetchUnactiveStdClass();