function StudentGrades() {

    this.msgStudentGrades = (msg, type_icon) => {
        swal({
            title: msg,
            icon: type_icon,
            timer: 2000,
            buttons: {
                cancel: "Close",
            }
        });
    }

    this.fetchStudentGrades = async() => {
        const response = await fetch("../index.php?action=teacherAccount&viewStudentGrades", {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            this.tableBodyStudentGrade(message);
        } else {
            this.msgStudentGrades(message, 'error'); 
        }
    }

    this.modalListOptionClass = async() => {
        let select    = document.querySelector('#listClass');
        let defaultop = `<option value='false'>Select Class</option>`;
        let output = ``;

        this.activeDropown(
            'listClass',
            "rgb(60, 179, 113)",
            false
        );

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
                select.addEventListener('input', (e) => {
                    this.activeDropown(
                        'listClass',
                        "",
                        false
                    );

                    this.activeDropown(
                        'listYear',
                        "rgb(60, 179, 113)",
                        false
                    );
                });
            } else  {
                output = `<option value='false'>Empty Class</option>`;
            } 
            select.innerHTML = defaultop+output;
        } else {
            this.msgStudentGrades(message, 'error'); 
        }
    }

    this.modalListOptionSchoolYear = async() => {
        let select   = document.querySelector('#listYear');
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
                select.addEventListener('input', (e) => {
                    this.activeDropown(
                        'listYear',
                        "",
                        false
                    );
                    this.activeDropown(
                        'listSubject',
                        "rgb(60, 179, 113)",
                        false
                    );
                    
                });
            } else  {
                    output = `<option value=''>Empty School Year</option>`;
             } 
            select.innerHTML = defaultop+output;
        } else {
            this.msgStudentGrades(message, 'error'); 
        }
    }

    this.modalListOptionSubject = async() => {
        let select    = document.querySelector('#listSubject');
        let defaultop = `<option value='false'>Select Subject</option>`;
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
        } else {
            this.msgStudentGrades(message, 'error'); 
        }

        select.addEventListener('input', async(e) => {
            let classVal  = document.querySelector('#listClass').value;
            let yearVal   = document.querySelector('#listYear').value;
            let subjectVal  = e.currentTarget.value;

            if(classVal.length > 0 
                && yearVal.length > 0
                && subjectVal.length > 0
                || !isNaN(classVal)
                || !isNaN(yearVal)
                || !isNaN(subjectVal)
            ) {
                const response = await fetch(`../index.php?action=teacherAccount&clsid=${classVal}&yrid=${yearVal}&subid=${subjectVal}`, {
                    credentials: "same-origin",
                    method: "GET",
                }); 
                let { message, status} = await response.json();

                if(status == 'success') {
                    this.tableBodyStudentGrade(message);
                } else {
                    this.msgStudentGrades(message, 'error'); 
                }
            } else {
                this.fetchStudentGrades();
            }
        });
    }

    this.modalListOptionAddSchoolYear = async() => {
        let selectSchoolYear = document.querySelector('#addListYear');
        selectSchoolYear.style.borderColor = "rgb(60, 179, 113)";
        let defaultop = `<option value='false'>Select School Year</option>`;
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
             selectSchoolYear.innerHTML = defaultop+output;
        } else {
            this.msgStudentGrades(message, 'error'); 
        }

        //Set Value Dropdwonw Option Class
        selectSchoolYear.addEventListener('input', async(e) => {
            let yearVal = e.currentTarget.value;
            
            if(yearVal.length > 0 || !isNaN(yearVal)) {
                let formData = new FormData();
                formData.append('yrid', yearVal);
    
                let response = await fetch(`../index.php?action=teacherAccount`, {
                  credentials: "same-origin",
                  method: 'POST',
                  body: formData
                });
                let { message, status} = await response.json();
                let selectValClass = document.querySelector('#addListClass');
                let defaultopclass = `<option class="text-1xl" value='false'>Select Class</option>`;
                let outputClass = ``;

                if(status == 'success') {
                    if(message != true) {
                        message.forEach(el => {
                            outputClass += `
                                <option value="${el.class_id}">${el.classname}</option>
                            `;
                        });
                        selectValClass.style.borderColor = "rgb(60, 179, 113)";
                    } else {
                        outputClass = `<option value='false'>Empty Data</option>`;
                        selectValClass.style.borderColor  = "rgba(255, 99, 71, 0.6)";
                    }
                    selectValClass.innerHTML = defaultopclass+outputClass;
                }

                //Set Value DropDown Student List

                selectValClass.addEventListener('input', async(e) => {
                    let classVal = e.currentTarget.value;

                    if(classVal.length > 0 || !isNaN(yearVal)) {
                        let formData = new FormData();
                        formData.append('cid', classVal);
            
                        let response = await fetch(`../index.php?action=teacherAccount`, {
                          credentials: "same-origin",
                          method: 'POST',
                          body: formData
                        });
                        let { message, status} = await response.json();
                        let selectValStudent = document.querySelector('#addListStudent');
                        let defaultopStudent = `<option value='false'>Select Student</option>`;
                        let outputStudent = ``;
        
                        if(status == 'success') {
                            if(message != true) {
                                message.forEach(el => {
                                    outputStudent += `
                                        <option value="${el.studID}">                     
                                            ${el.fname} 
                                            ${el.mname.charAt(0).toUpperCase()}, 
                                            ${el.lname}
                                        </option>
                                    `;
                                });

                                selectValStudent.style.borderColor = "rgb(60, 179, 113)";
                            } else {
                                outputStudent = `<option value='false'>Empty Data</option>`;
                                selectValStudent.style.borderColor  = "rgba(255, 99, 71, 0.6)"; 
                            }
                            selectValStudent.innerHTML=defaultopStudent+outputStudent;
                        }

                        // Set DropDown Value Subject

                        selectValStudent.addEventListener('input', async(e) => {
                            let studentVAl = e.currentTarget.value;

                            if(studentVAl.length > 0 || !isNaN(yearVal)) {
                                let formData = new FormData();
                                formData.append('subid', studentVAl);
                    
                                let response = await fetch(`../index.php?action=teacherAccount`, {
                                  credentials: "same-origin",
                                  method: 'POST',
                                  body: formData
                                });
                                let { message, status} = await response.json();
                                let selectValSubject = document.querySelector('#addListSubject');
                                let defaultopSubject = `<option value='false'>Select Subject</option>`;
                                let outputSubject = ``;
                
                                if(status == 'success') {
                                    if(message != true) {
                                        message.forEach(el => {
                                            outputSubject += `
                                                <option value="${el.subject_id}">
                                                ${el.subject_name} - ${el.discription_subject}
                                                </option>
                                            `;
                                        });
                                        selectValSubject.style.borderColor = "rgb(60, 179, 113)";
                                    } else {
                                        outputSubject = `<option value='false'>Empty Data</option>`;
                                        selectValStudent.style.borderColor  = "rgba(255, 99, 71, 0.6)";
                                    }
                                    selectValSubject.innerHTML = defaultopSubject+outputSubject;
                                }

                                // End of Process Set Value Dropdown Add Options
                            }
                            
                        });
                    }   
                });

            } else {
                this.msgStudentGrades(message, 'error');
            }
        });
    }

    this.activeDropown = async(type, bcolor, status) => {
        let val  = document.querySelector(`#${type}`);

        val.style.borderColor = bcolor;
        val.disabled = status;
    }

    this.resetForm = () => {
        let selectValClass   = document.querySelector('#addListClass');
        let selectValStudent = document.querySelector('#addListStudent');
        let selectValSubject = document.querySelector('#addListSubject');

        selectValClass.style.borderColor = "";
        selectValStudent.style.borderColor = "";
        selectValSubject.style.borderColor = "";
    }

    this.addStudentGradesForm = () => {
        addStudentGradesForm.onsubmit = async (e) => {
            e.preventDefault();
            let btnVal = document.querySelector("#stdGrades-btn");
            let resetForm = document.querySelector("#addStudentGradesForm");
            let closeModaL = document.querySelector("#AddGradesModal");
        
            btnVal.value = "Please Wait...";
        
            let response = await fetch('../index.php?action=teacherAccount', {
                credentials: "same-origin",
                method: 'POST',
                body: new FormData(addStudentGradesForm)
            });
        
            let { message, status } = await response.json();
            
            
            if (status == 'success') {
                setTimeout(() => {
                    btnVal.value = "Save";
                    this.fetchStudentGrades();
                    this.totalStudentGrades();
                    closeModaL.click();
                    resetForm.reset();
                    this.resetForm();
                    this.msgStudentGrades(message, 'success');
                }, 1000);
            } else {
                this.msgStudentGrades(message, 'error');
                btnVal.value = "Field to Save";
            }
        };
    }

    this.tableBodyStudentGrade = (data) => {
        let inc = 0;
        let row = ``;
        let remarks = '';
        let empVal = `<td colspan="10" class="text-center font-extrabold animate-bounce">Data Not Found...</td>`;

        if(data != true) {

            data.forEach(el => {

                ((el.remarks == 'PASSED') 
                ? remarks =  `<label class="text-green-500 text-bold">${el.remarks}</label>`
                : ((el.remarks == 'FAILED')
                ? remarks =  `<label class="text-red-500 text-bold">${el.remarks}</label>`
                : remarks =  `<label class="text-red-500 text-bold">No Final Remarks</label>`));

                row += `
                <tr>
                    <td class="px-5 py-5">
                        <input class="w-5 h-5" type="checkbox" name="sg_chk[]" value="${el.grade_id }">
                    </td>
                    <td class="px-5 py-5">${++inc}</td>
                    <td class="px-5 py-5">
                        ${el.sname.toUpperCase()} 
                    </td>
                    <td class="px-5 py-5">${el.firstquarter}</td>
                    <td class="px-5 py-5">${el.secondquarter}</td>
                    <td class="px-5 py-5">${el.thirthquarter}</td>
                    <td class="px-5 py-5">${el.fourthquarter}</td>
                    <td class="px-5 py-5">${el.gradeaverage}</td>
                    <td class="px-5 py-5">${remarks}</td>
                    <td class="px-5 py-5">
                        <button onclick="stdGradesObj.addValueUpdateStudentGrades(
                            '${el.grade_id}',
                            '${el.schoolyear}',
                            '${el.classname}',
                            '${el.subject_name}',
                            '${el.discription_subject}',
                            '${el.sname}',
                            '${el.firstquarter}',
                            '${el.secondquarter}',
                            '${el.thirthquarter}',
                            '${el.fourthquarter}'
                            )" type="button" data-toggle="modal" data-target="#studentGradesUpdateModal" class="w-16 h-16 hover:border-blue-600 hover:bg-blue-100 hover:text-red-600 tracking-wide text-lg text-white bg-blue-400 py-2 rounded-full border-blue-500 border-2">
                        <i class="fa fa-pen text-2xl"></i>
                        </button>
                    </td>
                </tr>
                `;
            }); 

            this.activeDropown(
                'listYear',
                "",
                true
            );
            this.activeDropown(
                'listSubject',
                "",
                true
            );
            this.activeDropown(
                'listClass',
                "rgb(60, 179, 113)",
                false
            );
        } else {
            row = empVal
        }
        document.querySelector("#tbodystdgrades").innerHTML = row;
    };

    this.addValueUpdateStudentGrades = (sgid, year, cname, subname, subdesc, sname, firstQ, secondQ, thirdQ, fourthQ) => {
        document.querySelector('#sgid').value = sgid;
        document.querySelector('#newschoolyear').value = year;
        document.querySelector('#newclass').value = cname;
        document.querySelector('#stdname').value = sname;
        document.querySelector('#newsubject').value = subname+' - '+subdesc;
        document.querySelector('#firstQ').value  = firstQ;
        document.querySelector('#secondQ').value = secondQ;
        document.querySelector('#thirdQ').value  = thirdQ;
        document.querySelector('#fourthQ').value = fourthQ;
    }

    this.updateFormStudentGrades = () => {
        updateStudentGradesForm.onsubmit = async (e) => {
            e.preventDefault();
            let btnVal = document.querySelector("#newstdGrades-btn");
            let resetForm = document.querySelector("#updateStudentGradesForm");
            let closeModaL = document.querySelector("#studentGradesUpdateModal");
        
            btnVal.value = "Please Wait...";
        
            let response = await fetch('../index.php?action=teacherAccount', {
                credentials: "same-origin",
                method: 'POST',
                body: new FormData(updateStudentGradesForm)
            });
        
            let { message, status } = await response.json();
            
            if (status == 'success') {
                setTimeout(() => {
                    btnVal.value = "Update";
                    this.fetchStudentGrades();
                    this.totalStudentGrades();
                    this.msgStudentGrades(message, 'success');
                    closeModaL.click();
                    resetForm.reset();
                }, 1000);
            } else {
                this.msgStudentGrades(message, 'error');
                btnVal.value = "Field to Save";
            }
        };
    }  

    this.checkAllStudentGrades = () => {
        gradeCheckBox.onclick = async(e) => {
            let items = document.getElementsByName('sg_chk[]');
            if (gradeCheckBox.checked == true){
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

        gradeUnactCheckBox.onclick = async(e) => {
            let items = document.getElementsByName('sgUnact_chk[]');
            if (gradeUnactCheckBox.checked == true){
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

    this.removeStudentGrades = () => {
        stdGradesDelForm.onsubmit = (e) => {
            e.preventDefault();

            swal({
                title: "Are you sure you do want to set UnActive this Student Grades Records?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then( async(remove) => {
                if (remove) {
                    let response = await fetch(`../index.php?action=teacherAccount&btn-remove=btn-remove`, {
                        credentials: "same-origin",
                        method: 'POST',
                        body: new FormData(stdGradesDelForm)
                    });
            
                    let { message, status } = await response.json();
            
                    if (status == 'success') {
                        this.msgStudentGrades(message, 'success');
                        this.fetchStudentGrades();   
                        this.totalStudentGrades();
                        this.fetchStudentUnactGrades();
                    } else {
                        this.msgStudentGrades(message, 'error');
                    }
                } else {
                    swal("Cancel Changes!");
                }
            });
        };   

        gradesUnactForm.onsubmit = (e) => {
            e.preventDefault();

            swal({
                title: "Are you sure you do want to set Active this Student Grades Records?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then( async(remove) => {
                if (remove) {
                    let response = await fetch(`../index.php?action=teacherAccount&btn-remove=btn-remove`, {
                        credentials: "same-origin",
                        method: 'POST',
                        body: new FormData(gradesUnactForm)
                    });
            
                    let { message, status } = await response.json();
            
                    if (status == 'success') {
                        this.msgStudentGrades(message, 'success');
                        this.fetchStudentGrades();   
                        this.totalStudentGrades();
                        this.fetchStudentUnactGrades();
                    } else {
                        this.msgStudentGrades(message, 'error');
                    }
                } else {
                    swal("Cancel Changes!");
                }
            });
        };
    }

    this.limitStudentGrades = () => {
        document.querySelector('#limitatStdGrades').addEventListener('change', async(e) => {

            let val = e.currentTarget.value;
            
            const response = await fetch(`../index.php?action=teacherAccount&sgsort=${val}`, {
                credentials: "same-origin",
                method: "GET",
            });
            let { message, status} = await response.json();

            if(status == 'success') {
                this.tableBodyStudentGrade(message);
                this.totalStudentGrades();
            } else {
                this.msgStudentGrades(message, 'success'); 
            }
        });
    };

    this.totalStudentGrades = async() => {
        const response  = await fetch(`../index.php?action=teacherAccount&totalpageStdGrades`, {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            let total_pages = Math.ceil(message/05);
            let output = ``;
            let pagenumber = 1;

            document.querySelector('#prevstdGrades').addEventListener('click', e => {
            e.preventDefault();
                if(pagenumber >= 1) {
                    this.paginationStudentGrades(pagenumber -= 1);
                } 

                let btnPrev = document.querySelector(`#btnList${pagenumber +1}`);

                if(btnPrev != undefined) {
                    btnPrev.classList.remove("bg-blue-200");
                }
            });
        
            document.querySelector('#nextstdGrades').addEventListener('click', e => {
            e.preventDefault();
    
                if(pagenumber < total_pages) {
                    this.paginationStudentGrades(pagenumber += 1);
                }

                let btnNext = document.querySelector(`#btnList${pagenumber}`);

                if(btnNext != undefined) {
                    btnNext.classList.add("bg-blue-200");
                }
            });

            for (let i = 1; i < total_pages+1; i++) {
                output += `<div id="btnList${i}" onclick="(stdGradesObj.paginationStudentGrades(${i}))" class="child -bottom-12p-1 mr-2 rounded-md cursor-pointer w-16 h-14 border-solid border-2 flex items-center justify-center border-gray-400 hover:bg-blue-100 font-bold">${i}</div>
                `;
            }

            document.querySelector('#stdGrades-btn-pages').innerHTML = output;

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
            this.msgStudentGrades(message, 'error'); 
        }
    }

    this.paginationStudentGrades = async(pagenum) => {
        const response = await fetch(`../index.php?action=teacherAccount&pagenumstdGrades=${pagenum}`, {
            credentials: "same-origin",
            method: "GET",
        });
        let { message, status} = await response.json();

        if(status == 'success') { 
            this.tableBodyStudentGrade(message);
        } else {
            this.msgStudentGrades(message, 'error'); 
        }
    }

    this.fetchStudentUnactGrades = async() => {
        const response = await fetch("../index.php?action=teacherAccount&viewUnactStudentGrades", {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            this.tableBodyUnactStudentGrade(message);
        } else {
            this.msgStudentGrades(message, 'error'); 
        }
    }

    this.modalListOptionUnactClass = async() => {
        let select    = document.querySelector('#listUnactClass');
        let defaultop = `<option value='false'>Select Class</option>`;
        let output = ``;

        this.activeDropown(
            'listUnactClass',
            "rgb(60, 179, 113)",
            false
        );

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
                select.addEventListener('input', (e) => {
                    this.activeDropown(
                        'listUnactClass',
                        "",
                        false
                    );

                    this.activeDropown(
                        'listUnactYear',
                        "rgb(60, 179, 113)",
                        false
                    );
                });
            } else  {
                output = `<option value='false'>Empty Class</option>`;
            } 
            select.innerHTML = defaultop+output;
        } else {
            this.msgStudentGrades(message, 'error'); 
        }
    }

    this.modalListOptionSchoolUnactYear = async() => {
        let select   = document.querySelector('#listUnactYear');
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
                select.addEventListener('input', (e) => {
                    this.activeDropown(
                        'listUnactYear',
                        "",
                        false
                    );
                    this.activeDropown(
                        'listUnactSubject',
                        "rgb(60, 179, 113)",
                        false
                    );
                    
                });
            } else  {
                    output = `<option value=''>Empty School Year</option>`;
             } 
            select.innerHTML = defaultop+output;
        } else {
            this.msgStudentGrades(message, 'error'); 
        }
    }

    this.modalListOptionUnactSubject = async() => {
        let select    = document.querySelector('#listUnactSubject');
        let defaultop = `<option value='false'>Select Subject</option>`;
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
            select.innerHTML = defaultop+output;
        } else {
            this.msgStudentGrades(message, 'error'); 
        }

        select.addEventListener('input', async(e) => {
            let classVal  = document.querySelector('#listUnactClass').value;
            let yearVal   = document.querySelector('#listUnactYear').value;
            let subjectVal  = e.currentTarget.value;

            if(classVal.length > 0 
                && yearVal.length > 0
                && subjectVal.length > 0
                || !isNaN(classVal)
                || !isNaN(yearVal)
                || !isNaN(subjectVal)
            ) {
                const response = await fetch(`../index.php?action=teacherAccount&clsidUnact=${classVal}&yridUnact=${yearVal}&subidUnact=${subjectVal}`, {
                    credentials: "same-origin",
                    method: "GET",
                }); 
                let { message, status} = await response.json();

                if(status == 'success') {
                    this.tableBodyUnactStudentGrade(message);
                } else {
                    this.msgStudentGrades(message, 'error'); 
                }
            } else {
                this.fetchStudentUnactGrades();
            }
        });
    }

    this.tableBodyUnactStudentGrade = (data) => {
        let inc = 0;
        let row = ``;
        let remarks = '';
        let empVal = `<td colspan="9" class="text-center font-extrabold animate-bounce">Data Not Found...</td>`;

        if(data != true) {

            data.forEach(el => {
                ((el.remarks == 'PASSED') 
                ? remarks =  `<label class="text-green-500 text-bold">${el.remarks}</label>`
                : ((el.remarks == 'FAILED')
                ? remarks =  `<label class="text-red-500 text-bold">${el.remarks}</label>`
                : remarks =  `<label class="text-red-500 text-bold">No Final Remarks</label>`));

                row += `
                <tr>
                    <td class="px-5 py-5">
                        <input class="w-5 h-5" type="checkbox" name="sgUnact_chk[]" value="${el.grade_id }">
                    </td>
                    <td class="px-5 py-5">${++inc}</td>
                    <td class="px-5 py-5">
                        ${el.sname.toUpperCase()} 
                    </td>
                    <td class="px-5 py-5">${el.firstquarter}</td>
                    <td class="px-5 py-5">${el.secondquarter}</td>
                    <td class="px-5 py-5">${el.thirthquarter}</td>
                    <td class="px-5 py-5">${el.fourthquarter}</td>
                    <td class="px-5 py-5">${el.gradeaverage}</td>
                    <td class="px-5 py-5">${remarks}</td>
                </tr>
                `;
            }); 

            this.activeDropown(
                'listUnactYear',
                "",
                true
            );
            this.activeDropown(
                'listUnactSubject',
                "",
                true
            );
            this.activeDropown(
                'listUnactClass',
                "rgb(60, 179, 113)",
                false
            );
        } else {
            row = empVal
        }
        document.querySelector("#tbodyUnactGrades").innerHTML = row;
    };
}

let stdGradesObj = new StudentGrades();
stdGradesObj.fetchStudentGrades();
stdGradesObj.modalListOptionSchoolYear();
stdGradesObj.modalListOptionClass();
stdGradesObj.modalListOptionSubject();
stdGradesObj.modalListOptionAddSchoolYear();
stdGradesObj.addStudentGradesForm();
stdGradesObj.updateFormStudentGrades();
stdGradesObj.limitStudentGrades();
stdGradesObj.totalStudentGrades();
stdGradesObj.checkAllStudentGrades();
stdGradesObj.removeStudentGrades();
stdGradesObj.fetchStudentUnactGrades();
stdGradesObj.modalListOptionUnactClass();
stdGradesObj.modalListOptionSchoolUnactYear();
stdGradesObj.modalListOptionUnactSubject();