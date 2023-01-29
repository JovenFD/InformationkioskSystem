function TeacherPrintRecords() {

    this.msgPrintStudent = async(msg, type_icon) => {
        swal({
            title: msg,
            icon: type_icon,
            timer: 2000,
            buttons: {
                cancel: "Close",
            }
        });
    }

    this.activeDropown = async(type, bcolor, status) => {
        let val  = document.querySelector(`#${type}`);

        val.style.borderColor = bcolor;
        val.disabled = status;
    }

    this.modalListOptionClass = async() => {
        let select   = document.querySelector('#listPrintClass');
        let defaultop = `<option value=''>Select Class</option>`;
        let output = ``;

        this.activeDropown(
            'listPrintClass',
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
                        'listPrintClass',
                        "",
                        false
                    );
                    this.activeDropown(
                        'listPrintSubject',
                        "rgb(60, 179, 113)",
                        false
                    );
                    
                });
            } else  {
                    output = `<option value=''>Empty Class</option>`;
             } 
            select.innerHTML = defaultop+output;
        } else {
            this.msgPrintStudent(message, 'error'); 
        }
    }

    this.modalListOptionSubject = async() => {
        let select   = document.querySelector('#listPrintSubject');
        let defaultop = `<option value=''>Select Subject</option>`;
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
                        <option value="${el.subject_id}">${el.subject_name}-${el.discription_subject}</option>
                    `;
                });
                select.addEventListener('input', (e) => {
                    this.activeDropown(
                        'listPrintSubject',
                        "",
                        false
                    );
                    this.activeDropown(
                        'listPrintYear',
                        "rgb(60, 179, 113)",
                        false
                    );
                    
                });
            } else  {
                    output = `<option value=''>Empty Class</option>`;
             } 
            select.innerHTML = defaultop+output;
        } else {
            this.msgPrintStudent(message, 'error'); 
        }
    }

    this.modalListOptionSchoolYear = async() => {
        let select    = document.querySelector('#listPrintYear');
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
            select.innerHTML   = defaultop+output;
        } else {
            this.msgPrintStudent(message, 'error'); 
        }

        select.addEventListener('input', async(e) => {
            let classVal  = document.querySelector('#listPrintClass').value;
            let subjectVal  = document.querySelector('#listPrintSubject').value;
            let yearVal  = e.currentTarget.value;

            if(subjectVal.length > 0 
                && yearVal.length > 0
                && classVal.length > 0
                || !isNaN(classVal)
                || !isNaN(subjectVal)
                || !isNaN(yearVal)
            ) {
                const response = await fetch(`../index.php?action=teacherAccount&clsidPrint=${classVal}&subid=${subjectVal}&yridPrint=${yearVal}`, {
                    credentials: "same-origin",
                    method: "GET",
                }); 
                let { level, section, message, status} = await response.json();

                if(status == 'success') {

                    this.tableBodyPrintStudentRecords(
                        message,
                        level,
                        section 
                    );
                } else {
                    this.msgPrintStudent(message, 'error'); 
                }
            }
        });
    }

    this.printRecords = () => {
        printRecords.onclick = async(e) => {
            swal({
                title: "Are you sure you do want to print this Records?",
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

                    const response = await fetch(`../index.php?action=teacherAccount&printRecords`, {
                        credentials: "same-origin",
                        method: "GET",
                    });

                    let {status} = await response.json();

                    if(status != 'error') {
                        let mywindow = window.open(
                            `print_records_data.php`, 
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

                            this.unset();
                        },3000);

                    } else {
                        this.msgPrintStudent(message, 'error');
                    }
                } else {
                    swal("Cancel printing!");
                    this.unset();
                }
            });
        }
    }

    this.unset = async() => {
        const response = await fetch(`../index.php?action=teacherAccount&unsetPrint`, {
            credentials: "same-origin",
            method: "GET",
        });

        let {message, status} = await response.json();

        if(status == 'success') {
            console.log('done printing...');
        } else {
            this.msgPrintStudent(message, 'error');
        }
    }

    this.tableBodyPrintStudentRecords = (
        data, 
        level, 
        section
    ) => {
        let inc = 0;
        let row = ``;
        let remarks = '';
        let tname = '';
        let year = '';
        let subject = '';

        let empVal = `<td colspan="8" class="text-center font-extrabold animate-bounce">Data Not Found...</td>`;

        if(data != true) {
            data.forEach(el => {

                tname   = el.tname;
                year    = el.schoolyear;
                subject = el.subject_name;

                ((el.remarks == 'PASSED') 
                ? remarks =  `<label class="text-green-500 text-bold">${el.remarks}</label>`
                : ((el.remarks == 'FAILED')
                ? remarks =  `<label class="text-red-500 text-bold">${el.remarks}</label>`
                : remarks =  `<label class="text-red-500 text-bold">No Final Remarks</label>`));

                row += `
                <tr>
                    <td class="px-5 py-5 text-md">${++inc}</td>
                    <td class="px-5 py-5 text-md">
                        ${el.sname.toUpperCase()} 
                    </td>
                    <td class="px-5 py-5 text-md">${el.firstquarter}</td>
                    <td class="px-5 py-5 text-md">${el.secondquarter}</td>
                    <td class="px-5 py-5 text-md">${el.thirthquarter}</td>
                    <td class="px-5 py-5 text-md">${el.fourthquarter}</td>
                    <td class="px-5 py-5 text-md">${el.gradeaverage}</td>
                    <td class="px-5 py-5 text-md">${remarks}</td>
                </tr>
                `;
            }); 

            this.activeDropown(
                'listPrintYear',
                "",
                true
            );
            this.activeDropown(
                'listPrintSubject',
                "",
                true
            );
            this.activeDropown(
                'listPrintClass',
                "rgb(60, 179, 113)",
                false
            );
            document.querySelector('#teacherName').innerHTML = tname;
            document.querySelector('#year').innerHTML = year;
            document.querySelector('#subjectName').innerHTML = subject;
            document.querySelector('#gradeSec').innerHTML = level.toUpperCase()+' - '+section.toUpperCase();
        } else {
            row = empVal;
            this.unset();
        }
        document.querySelector("#tbodyPrintRecords").innerHTML = row;
    };
}

let printObj = new TeacherPrintRecords();
printObj.modalListOptionClass();
printObj.modalListOptionSubject();
printObj.modalListOptionSchoolYear();
printObj.printRecords();