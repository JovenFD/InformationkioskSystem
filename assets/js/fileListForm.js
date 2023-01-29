function FileList(folder_id) {
    this.folder_id = folder_id;

    this.msgReportFile = (msg, type_icon) => {
        swal({
            title: msg,
            icon: type_icon,
            timer: 2000,
            buttons: {
                cancel: "Close",
            }
        });
    }

    this.fetchFileList = async() => {
        const response = await fetch(`../index.php?action=reportfile&viewFile=${this.folder_id}`, {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            this.tableBodyFileReports(message);
        } else {
            this.msgReportFile(message, 'error'); 
        }
    }

    this.searchFileList = () => {
        searchReportFile.oninput = async(e) => {
            let count = e.currentTarget.value.length;
            let data  = e.currentTarget.value;
            
            if(count > 0) {
                let formData = new FormData();
                formData.append('reportFile', data);
    
                let response = await fetch(`../index.php?action=reportfile`, {
                  credentials: "same-origin",
                  method: 'POST',
                  body: formData
                });
                let { message, status} = await response.json();

                if(status == 'success') {
                    this.tableBodyFileReports(message);
                } else {
                    this.msgReportFile(message, 'error'); 
                }
            } else {
                this.fetchFileList();
            }
        };
    }
    
    this.uploadFile = () => {
        inputFile.onchange = async(e) => {
            let i = 0;
  
            if (i == 0) {
                i = 1;
                let elem = document.querySelector('#progressUploadbar');
                let count = document.querySelector('#percentUpload');
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
                addReportFiles.onsubmit = async (e) => {
                    e.preventDefault();
                    let closeModaL = document.querySelector("#uploadFileModal");
            
                    let response = await fetch('../index.php?action=reportfile', {
                        credentials: "same-origin",
                        method: 'POST',
                        body: new FormData(addReportFiles)
                    });
                
                    let { message, status } = await response.json();
                    
                    if (status == 'success') {
                        setTimeout(() => {
                            this.fetchFileList();
                            this.msgReportFile(message, 'success');
                            closeModaL.click();
                            addReportFiles.reset();
                        }, 1000);
                    } else {
                        this.msgReportFile(message, 'error');
                    }
                };

                document.querySelector('#btnSubmit').click();
              
            }, 2000);
        }
    }

    this.checkAllFile = () => {
        checkAllFileReport.onclick = async(e) => {
            let items = document.getElementsByName('file_chk[]');
            if (checkAllFileReport.checked == true){
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

    this.removeReportFile = () => {
        fileReportRemoveForm.onsubmit = (e) => {
            e.preventDefault();

            swal({
                title: "Are you sure you do want to remove this file?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then( async(remove) => {
                if (remove) {
                    let response = await fetch(`../index.php?action=reportfile`, {
                        credentials: "same-origin",
                        method: 'POST',
                        body: new FormData(fileReportRemoveForm)
                    });
            
                    let { message, status } = await response.json();
            
                    if (status == 'success') {
                        this.msgReportFile(message, 'success');
                        this.fetchFileList();   
                    } else {
                        this.msgReportFile(message, 'error');
                    }

                } else {
                    swal("Cancel Changes!");
                }
            });
        };  
    }

    this.tableBodyFileReports = (data) => {
        let inc = 0;
        let row = ``;
        let empVal = `<td colspan="6" class="text-center font-extrabold animate-bounce">Data Not Found...</td>`;

        if(data != true) {
            data.forEach(el => {
                row += `
                <tr>
                    <td class="px-5 py-5">
                        <input class="w-5 h-5" type="checkbox" name="file_chk[]" value="${el.file_id}">
                    </td>
                    <td class="px-5 py-5">${++inc}</td>
                    <td class="px-5 py-5">${el.filename}</td>
                    <td class="px-5 py-5">${el.size}</td>
                    <td class="px-5 py-5">${el.Type}</td>
                    <td class="px-5 py-5">
                        <button onclick="listObj.downloadReportFile('${el.filename}')" type="button" class="w-16 h-16 hover:border-blue-600 hover:bg-blue-100 hover:text-red-600 tracking-wide text-lg text-white bg-blue-400 py-2 rounded-full border-blue-500 border-2" data-toggle="tooltip" data-placement="top" title="Download File">
                        <i class="fa fa-download text-2xl"></i>
                        </button> 
                    </td>
                </tr>
                `;
            }); 
        } else {
            row = empVal
        }
        document.querySelector("#tbodyFileList").innerHTML = row;
    };

    this.downloadReportFile = (filename) => {
        let uri = '../uploads/';

        var link = document.createElement("a");
        link.download = filename;
        link.href = uri;
        link.click();
    }
}