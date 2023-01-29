function Class() {
    this.msgClass = (msg, type_icon) => {
        swal({
            title: msg,
            icon: type_icon,
            timer: 2000,
            buttons: {
                cancel: "Close",
            }
        });
    }
    
    this.fetchClass = async() => {
        const response = await fetch("../index.php?action=class&view", {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            this.tableBodyClass(message);
        } else {
            this.msgClass(message, 'error'); 
        }
    }

    this.searchClass = () => {
        searchcls.oninput = async(e) => {
            let count = e.currentTarget.value.length;
            let data  = e.currentTarget.value;
            
            if(count > 0) {
                let formData = new FormData();
                formData.append('data', data);
    
                let response = await fetch(`../index.php?action=class`, {
                  credentials: "same-origin",
                  method: 'POST',
                  body: formData
                });
                let { message, status} = await response.json();

                if(status == 'success') {
                    this.tableBodyClass(message);
                } else {
                    this.msgClass(message, 'error'); 
                }
            } else {
                this.fetchClass();
            }
        };

        searchClsUnact.oninput = async(e) => {
            let count = e.currentTarget.value.length;
            let data  = e.currentTarget.value;
            
            if(count > 0) {
                let formData = new FormData();
                formData.append('dataUnact', data);
    
                let response = await fetch(`../index.php?action=class`, {
                  credentials: "same-origin",
                  method: 'POST',
                  body: formData
                });
                let { message, status} = await response.json();

                if(status == 'success') {
                    this.tableBodyUnactClass(message);
                } else {
                    this.msgClass(message, 'error'); 
                }
            } else {
                this.fetchUnactClass();
            }
        };
    }

    this.modalListOptionYearLevel = async() => {
        let select   = document.querySelector('#listLevel');
        let selectNew = document.querySelector('#listnewLevel');
        let defaultop = `<option value=''>Select Year Level</option>`
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
            this.msgClass(message, 'error'); 
        }
    }

    this.modalListOptionSchoolYear = async() => {
        let select   = document.querySelector('#listYear');
        let selectNew = document.querySelector('#listnewYear');
        let defaultop = `<option value=''>Select School Year</option>`;
        let output = ``;
        const response = await fetch("../index.php?action=year&view", {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            if(message != true) {
                message.forEach(el => {
                    output += `
                        <option value="${el.id}">${el.schoolyear}</option>
                    `;
                });
            } else  {
                    output = `<option value=''>Empty School Year</option>`;
             } 
            select.innerHTML   = defaultop+output;
            selectNew.innerHTML = defaultop+output;
        } else {
            this.msgClass(message, 'error'); 
        }
    }

    this.addformClass = () => {
        classAddForm.onsubmit = async (e) => {
            e.preventDefault();
            let btnVal = document.querySelector("#class-btn");
            let resetForm = document.querySelector("#classAddForm");
            let closeModaL = document.querySelector("#classAddModal");
        
            btnVal.value = "Please Wait...";
        
            let response = await fetch('../index.php?action=class', {
                credentials: "same-origin",
                method: 'POST',
                body: new FormData(classAddForm)
            });
        
            let { message, status } = await response.json();
            
            if (status == 'success') {
                setTimeout(() => {
                    btnVal.value = "Save";
                    this.fetchClass();
                    this.totalPagesClass();
                    this.msgClass(message, 'success');
                    closeModaL.click();
                    resetForm.reset();
                }, 1000);
            } else {
                this.msgClass(message, 'error');
                btnVal.value = "Field to Save";
            }
        };
    }

    this.checkAllClass = () => {
        clscheckAll.onclick = async() => {
            let items = document.getElementsByName('cls_chk[]');
            if (clscheckAll.checked == true){
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

        clsUnactcheckAll.onclick = async() => {
            let items = document.getElementsByName('clsUnact_chk[]');
            if (clsUnactcheckAll.checked == true){
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

    this.removeClass = () => {
        classDelForm.onsubmit = (e) => {
            e.preventDefault();

            swal({
                title: "Are you sure do you want to set UnActive this Class?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then( async(remove) => {
                if (remove) {
                    let response = await fetch(`../index.php?action=class`, {
                        credentials: "same-origin",
                        method: 'POST',
                        body: new FormData(classDelForm)
                    });
            
                    let { message, status } = await response.json();
            
                    if (status == 'success') {
                        this.msgClass(message, 'success');
                        this.fetchClass();   
                        this.totalPagesClass();
                        this.fetchUnactClass();
                    } else {
                        this.msgClass(message, 'error');
                    }
                } else {
                    swal("Cancel Changes!");
                }
            });
        };  
        
        classUnactForm.onsubmit = (e) => {
            e.preventDefault();

            swal({
                title: "Are you sure do you want to set Active this Class?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then( async(remove) => {
                if (remove) {
                    let response = await fetch(`../index.php?action=class`, {
                        credentials: "same-origin",
                        method: 'POST',
                        body: new FormData(classUnactForm)
                    });
            
                    let { message, status } = await response.json();
            
                    if (status == 'success') {
                        this.msgClass(message, 'success');
                        this.fetchClass();   
                        this.totalPagesClass();
                        this.fetchUnactClass();
                    } else {
                        this.msgClass(message, 'error');
                    }
                } else {
                    swal("Cancel Changes!");
                }
            });
        }; 
    }

    this.printAllClassData = () => {
        btnPrintAllClassData.onclick = async() => {
            swal({
                title: "Are you sure you want to print all this School Class records?",
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

                    const response = await fetch(`../index.php?action=class&print`, {
                        credentials: "same-origin",
                        method: "GET",
                    });

                    let {status} = await response.json();

                    if(status != 'error') {
                        let mywindow = window.open(
                            `print_class_data.php`, 
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
                        this.msgClass(message, 'error');
                    }
                } else {
                    swal("Cancel printing!");
                }
            });
        }
    }

    this.limitPagesClass= () => {
        clsSort.onchange = async(e) => {
            let val = e.currentTarget.value;
            
            const response = await fetch(`../index.php?action=class&clssort=${val}`, {
                credentials: "same-origin",
                method: "GET",
            });
            let { message, status} = await response.json();

            if(status == 'success') {
                this.tableBodyClass(message);
                this.totalPagesClass();
            } else {
                this.msgClass(message, 'success'); 
            }
        };
    };

    this.totalPagesClass = async() => {
        const response  = await fetch(`../index.php?action=class&totalpage`, {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            let total_pages = Math.ceil(message/05);
            let output = ``;
            let pagenumber = 1;

            clsPrev.onclick = async() => {
                if(pagenumber >= 1) {
                    this.paginationClass(pagenumber -= 1);
                } 

                let btnPrev = document.querySelector(`#btnList${pagenumber+1}`);

                if(btnPrev != undefined) {
                    btnPrev.classList.remove("bg-blue-200");
                }
            };
        
            clsNext.onclick = async() => {
                if(pagenumber < total_pages) {
                    this.paginationClass(pagenumber += 1);
                }

                let btnNext = document.querySelector(`#btnList${pagenumber}`);

                if(btnNext != undefined) {
                    btnNext.classList.add("bg-blue-200");
                }
            };

            for (let i = 1; i < total_pages+1; i++) {
                output += `<div id="btnList${i}" onclick="(clsObj.paginationClass(${i}))" class="child -bottom-12p-1 mr-2 rounded-md cursor-pointer w-16 h-14 border-solid border-2 flex items-center justify-center border-gray-400 hover:bg-blue-100 font-bold">${i}</div>
                `;
            }

            document.querySelector('#cls-btn-pages').innerHTML = output;

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
            this.msgClass(message, 'error'); 
        }
    };

    this.paginationClass = async(pagenum) => {
        const response = await fetch(`../index.php?action=class&pagenum=${pagenum}`, {
            credentials: "same-origin",
            method: "GET",
        });
        let { message, status} = await response.json();

        if(status == 'success') { 
            this.tableBodyClass(message);
        } else {
            this.msgClass(message, 'error'); 
        }
    }

    this.addValueUpdateClass = async(clsid) => {
        let formData = new FormData();
        formData.append('clsid', clsid);

        let response = await fetch(`../index.php?action=class`, {
          credentials: "same-origin",
          method: 'POST',
          body: formData
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            this.modalListOptionYearLevel();
            this.modalListOptionSchoolYear();
            document.querySelector('#clsid').value = message.class_id;
            document.querySelector('#classnewname').value = message.classname;
            document.querySelector('#listnewYear').value = message.schoolyear;
            document.querySelector('#listnewLevel').value = message.grade_level;
        } else {
            this.msgClass(message, 'error'); 
        }
    }   

    this.updatefromClass = () => {
        classUpdateForm.onsubmit = async (e) => {
            e.preventDefault();
            let btnVal = document.querySelector("#newclass-btn");
            let resetForm = document.querySelector("#classUpdateForm");
            let closeModaL = document.querySelector("#classUpdateModal");
        
            btnVal.value = "Please Wait...";
        
            let response = await fetch('../index.php?action=class', {
                credentials: "same-origin",
                method: 'POST',
                body: new FormData(classUpdateForm)
            });
        
            let { message, status } = await response.json();
            
            if (status == 'success') {
                setTimeout(() => {
                    btnVal.value = "Update";
                    this.fetchClass();
                    this.totalPagesClass();
                    this.msgClass(message, 'success');
                    closeModaL.click();
                    resetForm.reset();
                }, 1000);
            } else {
                this.msgClass(message, 'error');
                btnVal.value = "Field to Save";
            }
        };
    }  

    this.tableBodyClass = (data) => {
        let inc = 0;
        let row = ``;
        let empVal = `<td colspan="6" class="font-5xl text-center font-extrabold animate-bounce">Data Not Found...</td>`;

        if(data != true) {
            data.forEach(el => {
                row += `
                <tr>
                    <td class="px-5 py-5">
                        <input class="w-5 h-5" type="checkbox" name="cls_chk[]" value="${el.class_id}">
                    </td>
                    <td class="px-5 py-5">${++inc}</td>
                    <td class="px-5 py-5">${el.classname}</td>
                    <td class="px-5 py-5">${el.schoolyear}</td>
                    <td class="px-5 py-5">${el.grade_level}</td>                    
                    <td class="px-5 py-5">
                        <button onclick="clsObj.addValueUpdateClass(${el.class_id})" type="button" data-toggle="modal" data-target="#classUpdateModal" class="w-16 h-16 hover:border-blue-600 hover:bg-blue-100 hover:text-blue-600 tracking-wide text-lg text-white bg-blue-400 py-2 rounded-full border-blue-500 border-2">
                            <i class="fa fa-pen text-2xl"></i>
                        </button>
                    </td>
                </tr>
                `;
            }); 
        } else {
            row = empVal
        }
        document.querySelector("#tbodyclass").innerHTML = row;
    };

    this.fetchUnactClass = async() => {
        const response = await fetch("../index.php?action=class&viewUnact", {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            this.tableBodyUnactClass(message);
        } else {
            this.msgClass(message, 'error'); 
        }
    }

    this.tableBodyUnactClass = (data) => {
        let inc = 0;
        let row = ``;
        let empVal = `<td colspan="5" class="font-5xl text-center font-extrabold animate-bounce">Data Not Found...</td>`;

        if(data != true) {
            data.forEach(el => {
                row += `
                <tr>
                    <td class="px-5 py-5">
                        <input class="w-5 h-5" type="checkbox" name="clsUnact_chk[]" value="${el.class_id}">
                    </td>
                    <td class="px-5 py-5">${++inc}</td>
                    <td class="px-5 py-5">${el.classname}</td>
                    <td class="px-5 py-5">${el.schoolyear}</td>
                    <td class="px-5 py-5">${el.grade_level}</td>                    
                </tr>
                `;
            }); 
        } else {
            row = empVal
        }
        document.querySelector("#tbodyUnactClass").innerHTML = row;
    };
}

let clsObj = new Class();
clsObj.fetchClass();
clsObj.searchClass();
clsObj.modalListOptionYearLevel();
clsObj.modalListOptionSchoolYear();
clsObj.addformClass();
clsObj.removeClass();
clsObj.limitPagesClass();
clsObj.totalPagesClass();
clsObj.updatefromClass();
clsObj.printAllClassData();
clsObj.checkAllClass();
clsObj.fetchUnactClass();