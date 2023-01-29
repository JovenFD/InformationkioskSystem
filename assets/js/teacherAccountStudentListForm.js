function StrudentListForm() {

    this.msgStudentList = async(msg, type_icon) => {
        swal({
            title: msg,
            icon: type_icon,
            timer: 2000,
            buttons: {
                cancel: "Close",
            }
        });
    }

    this.fetchStudentList = async() => {
        const response = await fetch("../index.php?action=teacherAccount&view", {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {

            this.tableBodyStudentList(message);

        } else {
            this.msgStudentList(message, 'error'); 
        }
    }

    this.searchStudentList = () => {
        searchstdlist.oninput = async(e) => {

            let count = e.currentTarget.value.length;
            let data  = e.currentTarget.value;
            
            if(count > 0) {
                let formData = new FormData();
                formData.append('datastudentlist', data);
    
                let response = await fetch(`../index.php?action=teacherAccount`, {
                  credentials: "same-origin",
                  method: 'POST',
                  body: formData
                });
                let { message, status} = await response.json();

                if(status == 'success') {
                    this.tableBodyStudentList(message);
                } else {
                    this.msgStudentList(message, 'error'); 
                }
            } else {
                this.fetchStudentList();
            }
        };
    }

    this.printAllStudentListData = () => {
        btnPrintStudentList.onclick = async(e) => {
            swal({
                title: "Are you sure you do want to print all this Student List Records?",
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

                    const response = await fetch(`../index.php?action=teacherAccount&print`, {
                        credentials: "same-origin",
                        method: "GET",
                    });

                    let {status} = await response.json();

                    if(status != 'error') {
                        let mywindow = window.open(
                            `print_studentlist_data.php`, 
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
                        this.msgStudentList(message, 'error');
                    }
                } else {
                    swal("Cancel printing!");
                }
            });
        }
    }

    this.limitStudentList = async() => {
        limitstdlist.onchange = async(e) => {
            let val = e.currentTarget.value;
            
            const response = await fetch(`../index.php?action=teacherAccount&stdlistsort=${val}`, {
                credentials: "same-origin",
                method: "GET",
            });
            let { message, status} = await response.json();

            if(status == 'success') {
                this.tableBodyStudentList(message);
            } else {
                this.msgStudentList(message, 'error');
            }
        };
    };

    this.totalStudentList = async() => {
        const response  = await fetch(`../index.php?action=teacherAccount&widgetstudent`, {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            let total_pages = Math.ceil(message/05);
            let output = ``;
            let pagenumber = 1;

            prevStdList.onclick = async(e) => {
                if(pagenumber >= 1) {
                    this.paginationStudentList(pagenumber -= 1);
                } 

                let btnPrev = document.querySelector(`#btnList${pagenumber +1}`);

                if(btnPrev != undefined) {
                    btnPrev.classList.remove("bg-blue-200");
                }
            };
        
            nextStdList.onclick = async(e) => {
                if(pagenumber < total_pages) {
                    this.paginationStudentList(pagenumber += 1);
                }

                let btnNext = document.querySelector(`#btnList${pagenumber}`);

                if(btnNext != undefined) {
                    btnNext.classList.add("bg-blue-200");
                }
            };

            for (let i = 1; i < total_pages+1; i++) {
                output += `<div id="btnList${i}" onclick="(stdObj.paginationStudentList(${i}))" class="child -bottom-12p-1 mr-2 rounded-md cursor-pointer w-16 h-14 border-solid border-2 flex items-center justify-center border-gray-400 hover:bg-blue-100 font-bold">${i}</div>
                `;
            }

            document.querySelector('#StdList-btn-pages').innerHTML = output;

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
            this.msgStudentList(message, 'error'); 
        }
    };

    this.paginationStudentList = async(pagenum) => {
        const response = await fetch(`../index.php?action=teacherAccount&pagenum=${pagenum}`, {
            credentials: "same-origin",
            method: "GET",
        });
        let { message, status} = await response.json();

        if(status == 'success') { 
            this.tableBodyStudentList(message);
        } else {
            this.msgStudentList(message, 'error'); 
        }
    }

    this.listDropDown = async() => {
        let classList = document.querySelector('#listClass');

        const response = await fetch("../index.php?action=class&view", {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            let listclass = '';
        
            if(message != true) {
                message.forEach(el => {
                    listclass += `<option value="${el.class_id}">${el.classname}</option>`;

                })
            }

            classList.innerHTML = `
                <option value="false">Select Class</option>
                ${listclass}
            `;
            classList.style.borderColor = 'rgb(60, 179, 113)';

        } else {
            this.msgStudentList(message, 'error'); 
        }

        listClass.oninput = async() => {

            let yearlevel = document.querySelector('#ListYearLevel');

            yearlevel.disabled = false;
            yearlevel.style.borderColor = 'rgb(60, 179, 113)';
            classList.style.borderColor = '';

            const response = await fetch("../index.php?action=level&view", {
                credentials: "same-origin",
                method: "GET",
            });
    
            let { message, status} = await response.json();
    
            if(status == 'success') {
                let listYearLevel = '';
    
                if(message != true) {
                    message.forEach(el => {
                        listYearLevel += `<option value="${el.level_id}">${el.grade_level}</option>`;
                    }) 
                }
    
                document.querySelector('#ListYearLevel').innerHTML = `
                    <option value="false">Select Year Level</option>
                    ${listYearLevel}
                `;
    
            } else {
                this.msgStudentList(message, 'error'); 
            }

            ListYearLevel.oninput = async(e) => {
    
                let response = await fetch(`../index.php?action=teacherAccount&listClass=${listClass.value}&ListYearLevel=${ListYearLevel.value}`, {
                  credentials: "same-origin",
                  method: 'GET'
                });

                let { message, status} = await response.json();
    
                if(status == 'success') {

                    yearlevel.disabled = true;
                    yearlevel.style.borderColor = '';
                    classList.style.borderColor = 'rgb(60, 179, 113)';
                    this.tableBodyStudentList(message);
    
                } else {
                    this.msgStudentList(message, 'error'); 
                    yearlevel.disabled = true;
                    yearlevel.style.borderColor = '';
                    classList.style.borderColor = 'rgb(60, 179, 113)';
                }
            }
        }
    }

    this.tableBodyStudentList = (data) => {
        let inc = 0;
        let row = ``;
        let empVal = `<td colspan="5" class="text-center font-extrabold animate-bounce">Data Not Found...</td>`;

        if(data != true) {

            data.forEach(data => {
                if(data != true) {
                    data.forEach(el => {
                        row += `
                        <tr>
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
                            <td class="px-5 py-5">${el.grade_level} - ${el.discription}</td>
                        </tr>
                        `;
                    }); 
                } else {
                    row = empVal
                }
            });
            
        } else {
            row = empVal
        }
        document.querySelector("#tbodyStudentList").innerHTML = row;
    };
}

let stdObj = new StrudentListForm();
stdObj.fetchStudentList();
stdObj.searchStudentList();
stdObj.limitStudentList();
stdObj.totalStudentList();
stdObj.printAllStudentListData();
stdObj.listDropDown();