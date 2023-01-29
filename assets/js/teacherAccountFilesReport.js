function FileReports() {

    this.msgReportFiles = (msg, type_icon) => {
        swal({
            title: msg,
            icon: type_icon,
            timer: 2000,
            buttons: {
                cancel: "Close",
            }
        });
    }

    this.fetchReportsFiles = async() => {
        const response = await fetch("../index.php?action=reportfile&view", {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            this.showReportFiles(message);
        } else {
            this.msgReportFiles(message, 'error'); 
        }
    }

    this.searchFolder = () => {
        searchFolderName.oninput = async(e) => {
            let count = e.currentTarget.value.length;
            let dataSearch  = e.currentTarget.value;
            
            if(count > 0) {
                let formData = new FormData();
                formData.append('dataSearch', dataSearch);
    
                let response = await fetch(`../index.php?action=reportfile`, {
                  credentials: "same-origin",
                  method: 'POST',
                  body: formData
                });
                let { message, status} = await response.json();

                if(status == 'success') {
                    this.showReportFiles(message);
                } else {
                    this.showReportFiles(message, 'error'); 
                }
            } else {
                this.fetchReportsFiles();
            }
        };
    }

    this.addFormReportFiles = () => {
        addFolderForm.onsubmit = async (e) => {
            e.preventDefault();
            let btnVal = document.querySelector("#folder-btn");
            let closeModaL = document.querySelector("#addNewFolderModal");
        
            btnVal.value = "Please Wait...";
        
            let response = await fetch('../index.php?action=reportfile', {
                credentials: "same-origin",
                method: 'POST',
                body: new FormData(addFolderForm)
            });
        
            let { message, status } = await response.json();
            
            if (status == 'success') {
                setTimeout(() => {
                    btnVal.value = "Save";
                    this.fetchReportsFiles();
                    this.msgReportFiles(message, 'success');
                    closeModaL.click();
                    addFolderForm.reset();
                }, 1000);
            } else {
                this.msgReportFiles(message, 'error');
                btnVal.value = "Field to Save";
            }
        };
    }
    
    this.showReportFiles = (data) => {
        let row = ``;
        let empVal = `<div class="animate-bounce font-extrabold">
            <h2>Folder Not Found...</h2>
        </div>`;

        if(data != true) {
            data.forEach(el => {
                row += `
                    <div class="text-center">
                        <div class="dropdown">
                            <a class="dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-folder-open text-5xl text-red-900"></i>
                            <br><small>${el.folder_name}</small>
                            <br><small>${el.create_date}</small>
                            </a>
                            
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" data-toggle="modal" data-target="#updateFolderModal" onclick="fileObj.updateValueFolderName('${el.folder_id}')">Rename</a>
                            <a class="dropdown-item" onclick="fileObj.removeFolder('${el.folder_id}')">Delete</a>
                            <li class="nav-uploadFile">
                                <a class="dropdown-item" href="./teacher.php?page=uploadFile&folderId=${el.folder_id}">View</a>
                            </li>
                            </div>
                        </div>
                    </div>
                `;
            }); 
        } else {
            row = empVal
        }
        document.querySelector("#folderList").innerHTML = row;
    };

    this.updateValueFolderName = async(idFoderName) => {
        let formData = new FormData();
        formData.append('idFoderName', idFoderName);

        let response = await fetch(`../index.php?action=reportfile`, {
          credentials: "same-origin",
          method: 'POST',
          body: formData
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            document.querySelector('#id').value = message.folder_id;
            document.querySelector('#folderName').value = message.folder_name;
        } else {
            this.msgReportFiles(message, 'error'); 
        }
    }

    this.updateFolderName = () => {
        updateFolderName.onsubmit = async (e) => {
            e.preventDefault();
            let btnVal = document.querySelector("#rename-folder-btn");
            let closeModaL = document.querySelector("#updateFolderModal");
        
            btnVal.value = "Please Wait...";
        
            let response = await fetch('../index.php?action=reportfile', {
                credentials: "same-origin",
                method: 'POST',
                body: new FormData(updateFolderName)
            });
        
            let { message, status } = await response.json();
            
            if (status == 'success') {
                setTimeout(() => {
                    btnVal.value = "Rename";
                    this.fetchReportsFiles();
                    this.msgReportFiles(message, 'success');
                    closeModaL.click();
                    updateFolderName.reset();
                }, 1000);
            } else {
                this.msgReportFiles(message, 'error');
                btnVal.value = "Field to Save";
            }
        };
    }  

    this.removeFolder = (id) => {
        swal({
            title: "Are you sure you do want to remove this folder?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then( async(remove) => {
            if (remove) {
                let formData = new FormData();
                formData.append('removeFolder', id);

                let response = await fetch(`../index.php?action=reportfile`, {
                    credentials: "same-origin",
                    method: 'POST',
                    body: formData
                });
        
                let { message, status } = await response.json();
        
                if (status == 'success') {
                    this.msgReportFiles(message, 'success');
                    this.fetchReportsFiles();   
                } else {
                    this.msgReportFiles(message, 'error');
                }
            } else {
                swal("Cancel Changes!");
            }
        });
    }
}

let fileObj = new FileReports();
fileObj.fetchReportsFiles();
fileObj.addFormReportFiles();
fileObj.searchFolder();
fileObj.updateFolderName();