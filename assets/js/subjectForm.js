function Subject() {

    this.msgSubject = (msg, type_icon) => {
        swal({
            title: msg,
            icon: type_icon,
            timer: 2000,
            buttons: {
                cancel: "Close",
            }
        });
    }
    
    this.fetchSubject = async() => {
        const response = await fetch("../index.php?action=subject&view", {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            this.tableBodySubject(message);
        } else {
            this.msgSubject(message, 'error'); 
        }
    }

    this.searchSubject = () => {
        searcsbj.oninput = async(e) => {
            let count = e.currentTarget.value.length;
            let data  = e.currentTarget.value;
            
            if(count > 0) {
                let formData = new FormData();
                formData.append('data', data);
    
                let response = await fetch(`../index.php?action=subject`, {
                  credentials: "same-origin",
                  method: 'POST',
                  body: formData
                });
                let { message, status} = await response.json();

                if(status == 'success') {
                    this.tableBodySubject(message);
                } else {
                    this.msgSubject(message, 'error'); 
                }
            } else {
                this.fetchSubject();
            }
        };

        searchSbjUnact.oninput = async(e) => {
            let count = e.currentTarget.value.length;
            let data  = e.currentTarget.value;
            
            if(count > 0) {
                let formData = new FormData();
                formData.append('dataUnact', data);
    
                let response = await fetch(`../index.php?action=subject`, {
                  credentials: "same-origin",
                  method: 'POST',
                  body: formData
                });
                let { message, status} = await response.json();

                if(status == 'success') {
                    this.tableBodyUnactSubject(message);
                } else {
                    this.msgSubject(message, 'error'); 
                }
            } else {
                this.fetchUnactSubject();
            }
        };
    }

    this.addformSubject = () => {
        subjectAddForm.onsubmit = async (e) => {
            e.preventDefault();
            let btnVal = document.querySelector("#subject-btn");
            let resetForm = document.querySelector("#subjectAddForm");
            let closeModaL = document.querySelector("#subjectAddModal");
        
            btnVal.value = "Please Wait...";
        
            let response = await fetch('../index.php?action=subject', {
                credentials: "same-origin",
                method: 'POST',
                body: new FormData(subjectAddForm)
            });
        
            let { message, status } = await response.json();
            
            if (status == 'success') {
                setTimeout(() => {
                    btnVal.value = "Save";
                    this.fetchSubject();
                    this.totalPagesSubject();
                    this.msgSubject(message, 'success');
                    closeModaL.click();
                    resetForm.reset();
                }, 1000);
            } else {
                this.msgSubject(message, 'error');
                btnVal.value = "Field to Save";
            }
        };
    }

    this.modalListOptionYear = async() => {
        let select   = document.querySelector('#listLevel');
        let selectNew = document.querySelector('#listNewSubject');
        let defaultop = `<option value=''>Select Year Level</option>`;
        let output = ``;
        const response = await fetch("../index.php?action=level&view", {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            if(message != true) {
                message.forEach(el => {
                    output += `
                        <option value="${el.level_id}">${el.grade_level} - ${el.discription}</option>
                    `;
                });
            } else  {
                    output = `<option value=''>Empty Grade Level</option>`;
             } 
            select.innerHTML   = defaultop+output;
            selectNew.innerHTML = defaultop+output;
        } else {
            this.msgSubject(message, 'error'); 
        }
    }

    this.addformSubject = () => {
        subjectAddForm.onsubmit = async (e) => {
            e.preventDefault();
            let btnVal = document.querySelector("#subject-btn");
            let resetForm = document.querySelector("#subjectAddForm");
            let closeModaL = document.querySelector("#subjectAddModal");
        
            btnVal.value = "Please Wait...";
        
            let response = await fetch('../index.php?action=subject', {
                credentials: "same-origin",
                method: 'POST',
                body: new FormData(subjectAddForm)
            });
        
            let { message, status } = await response.json();
            
            if (status == 'success') {
                setTimeout(() => {
                    btnVal.value = "Save";
                    this.fetchSubject();
                    this.totalPagesSubject();
                    this.msgSubject(message, 'success');
                    closeModaL.click();
                    resetForm.reset();
                }, 1000);
            } else {
                this.msgSubject(message, 'error');
                btnVal.value = "Field to Save";
            }
        };
    }

     this.printAllSubjectData = () => {
        btnPrintAllSubjectData.onclick = async(e) => { 
            swal({
                title: "Are you sure you want to print all this subject records?",
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

                    const response = await fetch(`../index.php?action=subject&print`, {
                        credentials: "same-origin",
                        method: "GET",
                    });

                    let {status} = await response.json();

                    if(status != 'error') {
                        let mywindow = window.open(
                            `print_subject_data.php`, 
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
                        this.msgSubject(message, 'error');
                    }
                } else {
                    swal("Cancel printing!");
                }
            });
        }
    }

    this.checkAllSubject = () => {
        sbjcheckAll.onclick = async(e) => {
        let items = document.getElementsByName('sbj_chk[]');
            if (sbjcheckAll.checked == true){
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

        sbjUnactcheckAll.onclick = async(e) => {
            let items = document.getElementsByName('sbjUnact_chk[]');
                if (sbjUnactcheckAll.checked == true){
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

    this.removeSubject = () => {
        subjectDelForm.onsubmit = (e) => {
            e.preventDefault();

            swal({
                title: "Are you sure do you want to set UnActive this Subject?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then( async(remove) => {
                if (remove) {   

                    let response = await fetch(`../index.php?action=subject`, {
                        credentials: "same-origin",
                        method: 'POST',
                        body: new FormData(subjectDelForm)
                    });
            
                    let { message, status } = await response.json();
            
                    if (status == 'success') {
                        this.msgSubject(message, 'success');
                        this.fetchSubject();   
                        this.totalPagesSubject();
                        this.fetchUnactSubject();
                    } else {
                        this.msgSubject(message, 'error');
                    }
                    
                } else {
                    swal("Cancel Changes!");
                }
            });
        }; 
        
        subjectUnactForm.onsubmit = (e) => {
            e.preventDefault();

            swal({
                title: "Are you sure do you want to set Active this Subject?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then( async(remove) => {
                if (remove) {   

                    let response = await fetch(`../index.php?action=subject`, {
                        credentials: "same-origin",
                        method: 'POST',
                        body: new FormData(subjectUnactForm)
                    });
            
                    let { message, status } = await response.json();
            
                    if (status == 'success') {
                        this.msgSubject(message, 'success');
                        this.fetchSubject();   
                        this.totalPagesSubject();
                        this.fetchUnactSubject();
                    } else {
                        this.msgSubject(message, 'error');
                    }
                    
                } else {
                    swal("Cancel Changes!");
                }
            });
        }; 
    }

    this.limitPagesSubject = () => {
        limitsubject.onchange = async(e) => {
            let val = e.currentTarget.value;
            
            const response = await fetch(`../index.php?action=subject&sbjsort=${val}`, {
                credentials: "same-origin",
                method: "GET",
            });
            let { message, status} = await response.json();

            if(status == 'success') {
                this.tableBodySubject(message);
                this.totalPagesSubject();
            } else {
                this.msgSubject(message, 'error'); 
            }
        };
    };

    this.totalPagesSubject = async() => {
        const response  = await fetch(`../index.php?action=subject&totalpage`, {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            let total_pages = Math.ceil(message/05);
            let output = ``;
            let pagenumber = 1;

            prevSubject.onclick = async(e) => {
                if(pagenumber >= 1) {
                    this.paginationSubject(pagenumber -= 1);
                } 

                let btnPrev = document.querySelector(`#btnList${pagenumber+1}`);

                if(btnPrev != undefined) {
                    btnPrev.classList.remove("bg-blue-200");
                }
            };

            nextSubject.onclick = async(e) => {
                if(pagenumber < total_pages) {
                    this.paginationSubject(pagenumber += 1);
                }

                let btnNext = document.querySelector(`#btnList${pagenumber}`);

                if(btnNext != undefined) {
                    btnNext.classList.add("bg-blue-200");
                }
            };

            for (let i = 1; i < total_pages+1; i++) {
                output += `<div id="btnList${i}" onclick="(sbjObj.paginationSubject(${i}))" class="child -bottom-12p-1 mr-2 rounded-md cursor-pointer w-16 h-14 border-solid border-2 flex items-center justify-center border-gray-400 hover:bg-blue-100 font-bold">${i}</div>
                `;
            }

            document.querySelector('#sbj-btn-pages').innerHTML = output;

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
            this.msgSubject(message, 'error'); 
        }
    };

    this.paginationSubject= async(pagenum) => {
        const response = await fetch(`../index.php?action=subject&pagenum=${pagenum}`, {
            credentials: "same-origin",
            method: "GET",
        });
        let { message, status} = await response.json();

        if(status == 'success') { 
            this.tableBodySubject(message);
        } else {
            this.msgSubject(message, 'error'); 
        }
    }

    this.addValueUpdateLevel= async(sbjid) => {
        let formData = new FormData();
        formData.append('sbjid', sbjid);

        let response = await fetch(`../index.php?action=subject`, {
          credentials: "same-origin",
          method: 'POST',
          body: formData
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            document.querySelector('#sbjid').value = message.subject_id;
            document.querySelector('#sbjName').value = message.subject_name;
            document.querySelector('#sbjDesc').value = message.discription_subject;
            document.querySelector('#listNewSubject').value = message.subject_id;

        } else {
            this.msgSubject(message, 'error'); 
        }
    } 

    this.updatefromSubject = () => {
        subjectUpdateForm.onsubmit = async (e) => {
            e.preventDefault();
            let btnVal = document.querySelector("#newsubject-btn");
            let resetForm = document.querySelector("#subjectUpdateForm");
            let closeModaL = document.querySelector("#subjectUpdateModal");
        
            btnVal.value = "Please Wait...";
        
            let response = await fetch('../index.php?action=subject', {
                credentials: "same-origin",
                method: 'POST',
                body: new FormData(subjectUpdateForm)
            });
        
            let { message, status } = await response.json();
            
            if (status == 'success') {
                setTimeout(() => {
                    btnVal.value = "Update";
                    this.fetchSubject();
                    this.totalPagesSubject();
                    this.msgSubject(message, 'success');
                    closeModaL.click();
                    resetForm.reset();
                }, 1000);
            } else {
                this.msgSubject(message, 'error');
                btnVal.value = "Field to Save";
            }
        };
    }  

    this.tableBodySubject = (data) => {
        let inc = 0;
        let row = ``;
        let empVal = `<td colspan="6" class="font-5xl text-center font-extrabold animate-bounce">Data Not Found...</td>`;

        if(data != true) {
            data.forEach(el => {
                row += `
                <tr>
                    <td class="px-5 py-5">
                        <input class="w-5 h-5" type="checkbox" name="sbj_chk[]" value="${el.subject_id }">
                    </td>
                    <td class="px-5 py-5">${++inc}</td>
                    <td class="px-5 py-5">${el.subject_name}</td>
                    <td class="px-5 py-5">${el.discription_subject}</td>
                    <td class="px-5 py-5">${el.grade_level}</td>
                    <td class="px-5 py-5">
                        <button onclick="sbjObj.addValueUpdateLevel(${el.subject_id})" type="button" data-toggle="modal" data-target="#subjectUpdateModal" class="w-16 h-16 hover:border-blue-600 hover:bg-blue-100 hover:text-red-600 tracking-wide text-lg text-white bg-blue-400 py-2 rounded-full border-blue-500 border-2">
                        <i class="fa fa-pen text-2xl"></i>
                        </button>
                    </td>
                </tr>`;
            }); 
        } else {
            row = empVal
        }
        document.querySelector("#tbodysubject").innerHTML = row;
    };

    this.fetchUnactSubject = async() => {
        const response = await fetch("../index.php?action=subject&viewUnact", {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            this.tableBodyUnactSubject(message);
        } else {
            this.msgSubject(message, 'error'); 
        }
    }

    this.tableBodyUnactSubject = (data) => {
        let inc = 0;
        let row = ``;
        let empVal = `<td colspan="5" class="font-5xl text-center font-extrabold animate-bounce">Data Not Found...</td>`;

        if(data != true) {
            data.forEach(el => {
                row += `
                <tr>
                    <td class="px-5 py-5">
                        <input class="w-5 h-5" type="checkbox" name="sbjUnact_chk[]" value="${el.subject_id }">
                    </td>
                    <td class="px-5 py-5">${++inc}</td>
                    <td class="px-5 py-5">${el.subject_name}</td>
                    <td class="px-5 py-5">${el.discription_subject}</td>
                    <td class="px-5 py-5">${el.grade_level}</td>
                </tr>`;
            }); 
        } else {
            row = empVal
        }
        document.querySelector("#tbodyUnactsubject").innerHTML = row;
    };
}

let sbjObj = new Subject(); 
sbjObj.fetchSubject();
sbjObj.searchSubject();
sbjObj.addformSubject();
sbjObj.modalListOptionYear();
sbjObj.removeSubject();
sbjObj.limitPagesSubject();
sbjObj.totalPagesSubject();
sbjObj.updatefromSubject();
sbjObj.printAllSubjectData();
sbjObj.checkAllSubject();
sbjObj.fetchUnactSubject();