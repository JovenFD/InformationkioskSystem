function UploadFile() {

    this.msgUploadFile = (msg, type_icon) => {
        swal({
            title: msg,
            icon: type_icon,
            timer: 2000,
            buttons: {
                cancel: "Close",
            }
        });
    }
    
    this.excelParser = () => {
        excelParser.onchange = async(e) => {
            let i = 0;

            if (i == 0) {
                i = 1;
                let elem = document.querySelector('#progressbar');
                let count = document.querySelector('#percent');
                let width = 1;
                let id = setInterval(frame, 10);
                function frame () {
                  if (width >= 100) {
                    clearInterval(id);
                    i = 0;
                  } else {
                    width++;
                    count.innerHTML  = width + "%";
                    elem.style.width = width + "%";
                  }
                }
            }

            setTimeout(() => {
                this.showUploadFile(e);
            }, 2000);
        }
    }

    this.showUploadFile = async(e) => {
        if (e.target.files && e.target.files[0]) {
            
            let results = await new Promise((resolve, reject) => {
                Papa.parse(e.target.files[0], {
                    header: false, // makes the value of first row as the column name or key
                    skipEmptyLines: true,
                    dynamicTyping: true, // converts numerical strings to number
                    complete: function(results) {
                        resolve(results.data);
                        let elem = document.querySelector('#progressbar');
                        let closeModal = document.querySelector('#uploadStudentGradesModal');
                        let reset = document.querySelector('#excelParser');
                        let count = document.querySelector('#percent');
                        reset.value = null;
                        count.innerHTML = 0 + "%";
                        elem.style.width = 3 + "%";
                        closeModal.click();
                    }
                });
            });
    
            let tbody = document.querySelector('#importTable>tbody');
            let inc = 1;
            let schoolYearId = results[0][0];
            let SubjectId = results[0][1];
            let ClassId   = results[0][2];
            let TeacherId = results[0][3];
            let output = ``;

            for (let i = 2; i < results.length; i++) {
                results[i][6] = schoolYearId;
                results[i][7] = SubjectId;
                results[i][8] = ClassId;
                results[i][9] = TeacherId;

                if(typeof results[i][1] === 'object'
                || typeof results[i][2] === 'object'
                || typeof results[i][3] === 'object'
                || typeof results[i][4] === 'object'
                || typeof results[i][5] === 'object'
                || typeof results[i][6] === 'object'
                || typeof results[i][7] === 'object'
                || typeof results[i][8] === 'object'
                || typeof results[i][9] === 'object'
                ) {
                    output = ` 
                        <tr>
                            <td colspan="7" class="text-center font-extrabold animate-bounce">Empty Upload Data...</td>
                        </tr>
                    `;

                    this.msgUploadFile('Empty one or more fields.', 'warning');
                } else {

                    output +=  `
                        <tr>
                            <td class="px-5 py-5 text-2xl"><input class="w-5 h-5" type="checkbox" data='${JSON.stringify(results[i])}'></td>
                            <td class="px-5 py-5 text-md">${inc++}</td>
                            <td class="px-5 py-5 text-md">${results[i][1]}</td>
                            <td class="px-5 py-5 text-md">${results[i][2]}</td>
                            <td class="px-5 py-5 text-md">${results[i][3]}</td>
                            <td class="px-5 py-5 text-md">${results[i][4]}</td>
                            <td class="px-5 py-5 text-md">${results[i][5]}</td>
                            <td class="px-5 py-5 text-md hidden">${results[i][0]}</td>
                            <td class="px-5 py-5 text-md hidden">${results[i][6]}</td>
                            <td class="px-5 py-5 text-md hidden">${results[i][7]}</td>
                            <td class="px-5 py-5 text-md hidden">${results[i][8]}</td>
                            <td class="px-5 py-5 text-md hidden">${results[i][9]}</td>
                        <tr>
                    `;
                }
            }
            tbody.innerHTML = output;
        }
    };

    this.checkAllListUpload = () => {
        checkBox.onclick = async(e) => {
            if (checkBox.checked == true){
                let checkBoxes = document.querySelectorAll('#importTable>tbody :not(input:checked)');
                checkBoxes.forEach(checkBox => checkBox.click());
            } else {
                let checkBoxes = document.querySelectorAll('#importTable>tbody input:checked');

                checkBoxes.forEach(checkBox => checkBox.click());
            }
        }
    }

    this.saveData = () => {
        saveAllChecked.onclick = async(e) => {
            let allChecked = document.querySelectorAll('#importTable>tbody input:checked');

            if (allChecked.length) {
                for (let i = 0; i < allChecked.length; i++) {
                    let checkBox = allChecked[i];
                    let data = JSON.parse(checkBox.getAttribute('data'));

                    let tr = checkBox.parentNode.parentNode;
                    let formData = new FormData();

                    Object.keys(data).forEach(key => {
                        formData.append(key, data[key]);
                    });
        
                    let response = await fetch(`../index.php?action=teacherAccount`, {
                        credentials: "same-origin",
                        method: 'POST',
                        body: formData
                    });
                    let { message, status } = await response.json();
        
                    if (status == 'success') {
                        this.msgUploadFile(message, 'success');
                    } else {
                        this.msgUploadFile(message, 'error');
                    }
                }
            } else {
                this.msgUploadFile('Empty Fields', 'warning');
            }
        }
    }
}

let upObj = new UploadFile();
upObj.excelParser();
upObj.saveData();
upObj.checkAllListUpload();