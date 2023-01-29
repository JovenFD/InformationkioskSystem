function VisitorsForm(DynamicLogo, vstrScanner) {
    this.DynamicLogo = DynamicLogo;
    this.vstrScanner  = vstrScanner;

    this.msgVisitors = (msg, type_icon) => {
        swal({
            title: msg,
            icon: type_icon,
            timer: 2000,
            buttons: {
                cancel: "Close",
            }
        });
    }

    this.visitorsDateFormat = (input) => {
        setTimeout(() => {
            input.type = 'text';
        }, 60000);
    }

    this.fetchVisitors = async() => {
        const response = await fetch(`../index.php?action=visitors&view`, {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            this.tableBodyVisitors(message);
        } else {
            this.msgVisitors(message, 'error'); 
        }
    }

    this.resetTableData = async() => {
        const response = await fetch(`../index.php?action=visitors&reset`, {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            console.log(message);

        } else if(status == 'reset') {
            console.log(message);

        } else {
            this.msgVisitors(message, 'error'); 
        }
        this.fetchVisitors();
        this.totalPagesVisitors();
    }

    this.searchVisitors = () => {
        searchvstrs.oninput = async(e) => {
            let count = e.currentTarget.value.length;
            let data  = e.currentTarget.value;
            
            if(count > 0) {
                let formData = new FormData();
                formData.append('data', data);
    
                let response = await fetch(`../index.php?action=visitors`, {
                  credentials: "same-origin",
                  method: 'POST',
                  body: formData
                });
                let { message, status} = await response.json();

                if(status == 'success') {
                    this.tableBodyVisitors(message);
                } else {
                    this.msgVisitors(message, 'error'); 
                }
            } else {
                this.resetTableData();
                this.fetchVisitors();
            }
        };

        searchUnactVstrs.oninput = async(e) => {
            let count = e.currentTarget.value.length;
            let data  = e.currentTarget.value;
            
            if(count > 0) {
                let formData = new FormData();
                formData.append('dataUnact', data);
    
                let response = await fetch(`../index.php?action=visitors`, {
                  credentials: "same-origin",
                  method: 'POST',
                  body: formData
                });
                let { message, status} = await response.json();

                if(status == 'success') {
                    this.tableBodyUnactVisitors(message);
                } else {
                    this.msgVisitors(message, 'error'); 
                }
            } else {
                this.resetTableData();
                this.fetchUnactVisitors();
            }
        };
    }

    this.tableBodyVisitors = (data) => {
        let inc = 0;
        let row = ``;
        let empVal = `<td colspan="12" class="font-5xl text-center font-extrabold animate-bounce">Data Not Found...</td>`;

        if(data != true) {
            data.forEach(el => {
                row += `
                <tr>
                    <td class="px-5 py-5">
                        <input class="w-5 h-5" type="checkbox" name="vstrs_chk[]" value="${el.	visitors_id}">
                    </td>
                    <td class="px-5 py-5">${++inc}</td>
                    <td class="px-5 py-5">
                        <div class="relative mx-auto w-20 h-20 rounded-full border-gray-300 border-2">
                            <img class="w-full h-full rounded-full" src="../assets/images/account.png" alt="avatar" />
                        </div>
                    </td>
                    <td class="px-5 py-5">${el.id_pass}</td>
                    <td class="px-5 py-5">
                        ${el.fname} 
                        ${el.mname.charAt(0).toUpperCase()}, 
                        ${el.lname}
                    </td>
                    <td class="px-5 py-5">${new Date(el.dob).toDateString()}</td>
                    <td class="px-5 py-5">${el.gender}</td>
                    <td class="px-5 py-5">${el.address}</td>
                    <td class="px-5 py-5">${el.contactno}</td>
                    <td class="px-5 py-5">${el.porpose}</td>
                    <td class="px-5 py-5">
                        <button type="button" onclick="vstrsObj.viewQrCode(
                            '${el.id_pass}',
                            '${el.fname}',
                            '${el.mname.charAt(0).toUpperCase()}',
                            '${el.lname}'
                            ), qrcode.toCanvas()" data-toggle="modal" data-target="#visitorsQrcodeModal" class="w-16 h-16 hover:border-blue-600 hover:bg-blue-100 hover:text-blue-600 tracking-wide text-lg text-white bg-blue-400 py-2 rounded-full border-blue-500 border-2">
                            <i class="fas fa-qrcode text-2xl"></i>
                        </button>
                    </td>
                </tr>
                `;
            }); 
        } else {
            row = empVal
        }
        document.querySelector("#tbodyvisitors").innerHTML = row;
    };

    this.visitorsForm = () => {
        vipVisitorsAddForm.onsubmit = async (e) => {
            e.preventDefault();

            let btnVal = document.querySelector("#visitors-btn");
            let resetForm = document.querySelector("#vipVisitorsAddForm");
            let closeModaL = document.querySelector("#visitorsModal");
        
            btnVal.value = "Please Wait...";
        
            let response = await fetch(`../index.php?action=visitors`, {
                method: 'POST',
                body: new FormData(vipVisitorsAddForm)
            });
        
            let { message, status } = await response.json();
        
            if (status == 'success') {
                setTimeout(() => {
                   this.fetchVisitors();
                   this.resetTableData();
                    resetForm.reset();
                    closeModaL.click();
                    this.msgVisitors(message, 'success'); 
                    btnVal.value = "Save";
                }, 2000);
            } else {
                this.msgVisitors(message, 'error');
                btnVal.value = "Field To Save";
            }
        };
    }

    this.checkAllVisitors = () => {
        vstrscheckAll.onclick = async() => {
            let items = document.getElementsByName('vstrs_chk[]');
            if (vstrscheckAll.checked == true){
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

        vstrsUnactcheckAll.onclick = async() => {
            let items = document.getElementsByName('vstrsUnact_chk[]');
            if (vstrsUnactcheckAll.checked == true){
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

    this.removeVisitors = () => {
        vipVisitorsForm.onsubmit = (e) => {
            e.preventDefault();

            swal({
                title: "Are you sure do you want to set UnActive this Visitors?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then( async(remove) => {
                if (remove) {
                    let response = await fetch(`../index.php?action=visitors`, {
                        credentials: "same-origin",
                        method: 'POST',
                        body: new FormData(vipVisitorsForm)
                    });
            
                    let { message, status } = await response.json();
            
                    if (status == 'success') {
                        this.msgVisitors(message, 'success');
                        this.fetchVisitors();
                        this.totalPagesVisitors();
                        this.fetchUnactVisitors();
                        this.resetTableData();
                    } else {
                        this.msgVisitors(message, 'error');
                    }
                } else {
                    swal("Cancel Changes!");
                }
            });
        };   

        visitorUnactForm.onsubmit = (e) => {
            e.preventDefault();

            swal({
                title: "Are you sure do you want to set Active this Visitors?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then( async(remove) => {
                if (remove) {
                    let response = await fetch(`../index.php?action=visitors`, {
                        credentials: "same-origin",
                        method: 'POST',
                        body: new FormData(visitorUnactForm)
                    });
            
                    let { message, status } = await response.json();
            
                    if (status == 'success') {
                        this.msgVisitors(message, 'success');
                        this.fetchVisitors();
                        this.totalPagesVisitors();
                        this.fetchUnactVisitors();
                        this.resetTableData();
                    } else {
                        this.msgVisitors(message, 'error');
                    }
                } else {
                    swal("Cancel Changes!");
                }
            });
        };   
    }

    this.printAllVisitorsData = () => {
        btnPrintAllVisiData.onclick = async() => {
            swal({
                title: "Are you sure you want to print all this visitors records?",
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

                    const response = await fetch(`../index.php?action=visitors&print`, {
                        credentials: "same-origin",
                        method: "GET",
                    });

                    let {status} = await response.json();

                    if(status != 'error') {
                        let mywindow = window.open(
                            `print_visitors_data.php`, 
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
                        this.msgVisitors(message, status);
                    }
                } else {
                    swal("Cancel printing!");
                }
            });
        }
    }

    this.limitPagesVisitors = () => {
        vstrsSort.onchange = async(e) => {
            let val = e.currentTarget.value;
            
            const response = await fetch(`../index.php?action=visitors&vstrssort=${val}`, {
                credentials: "same-origin",
                method: "GET",
            });
            let { message, status} = await response.json();

            if(status == 'success') {
                this.tableBodyVisitors(message);
                this.totalPagesVisitors();
            } else {
                this.msgVisitors(message, status); 
            }
        };
    };

    this.totalPagesVisitors = async() => {
        const response = await fetch(`../index.php?action=visitors&totalpage`, {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            let total_pages = Math.ceil(message/05);
            let output = ``;
            let pagenumber = 1;

            this.btnPagination(total_pages);

            vstrsPrev.onclick = async() => {
                if(pagenumber >= 1) {
                    this.paginationVisitors(pagenumber -= 1);
                } 

                let btnPrev = document.querySelector(`#btnList${pagenumber+1}`);

                if(btnPrev != undefined) {
                    btnPrev.classList.remove("bg-blue-200");
                }
            };

            vstrsNext.onclick = async() => {
                if(pagenumber < total_pages) {
                    this.paginationVisitors(pagenumber += 1);
                }

                let btnNext = document.querySelector(`#btnList${pagenumber}`);

                if(btnNext != undefined) {
                    btnNext.classList.add("bg-blue-200");
                }
            };

            for (let i = 1; i < total_pages+1; i++) {
                output += `<div id="btnList${i}" onclick="(vstrsObj.paginationVisitors(${i}))" class="child p-1 mr-2 rounded-md cursor-pointer w-16 h-14 border-solid border-2 flex items-center justify-center border-gray-400 hover:bg-blue-100 font-bold">${i}</div>
                `;
            }
            
            document.querySelector('#vstrs-btn-pages').innerHTML = output;

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
            this.msgVisitors(message, status); 
        }
    };

    this.btnPagination = (total_pages) => {
        let btn = document.querySelector('#btnPagination');

        if(total_pages == 0) {
            btn.style.visibility = "hidden";
        } else {
            btn.style.visibility = "visible";
        }
    }

    this.paginationVisitors = async(pagenum) => {
        const response = await fetch(`../index.php?action=visitors&pagenum=${pagenum}`, {
            credentials: "same-origin",
            method: "GET",
        });
        let { message, status} = await response.json();

        if(status == 'success') { 
            this.tableBodyVisitors(message);
        } else {
            this.msgVisitors(message, status); 
        }
    }

    this.viewQrCode = (
        code, 
        fname, 
        mname, 
        lname
        ) => {
        document.querySelector('#filenameQr').value = 
        `${fname} 
        ${mname}, 
        ${lname}`;
        window.qrcode = new QrCodeWithLogo({
            canvas: document.querySelector("#visitorsQr"),
            content: code,
            width: 380,
            image: document.querySelector("#visitorsQrimg"),
            logo: {
            src: this.DynamicLogo,
            logoSize: 0.2
            }
        });
    }

    this.testQrBtn = () => {
        testQrBtn.onclick = async(e) => {
            let label = 'Test QrCode';
            
            if(testQrBtn.value == label) {
                testQrBtn.value = 'Scanning...';
                this.playScanner();
            } else {
                testQrBtn.value = label;
                this.stopScanner();
            }
        }
    }

    this.playScanner = () => {
        Instascan.Camera.getCameras().then((cameras) => {
              if(cameras.length > 0) {
                this.vstrScanner.start(cameras[0]);
              } else {
                this.msgGrades('No cameras found', 'warning');
              }
          }).catch((e) => {
              console.error(e);
          });

          this.vstrScanner.addListener('scan',(code) => {
            this.sound();
            this.testNowQrCode(code);
        });
    }

    this.stopScanner = () => {
          Instascan.Camera.getCameras().then((cameras) => {
              if(cameras.length > 0 ) {
                this.vstrScanner.stop(cameras[0]);
              } else {
                  this.msgGrades('No cameras found', 'warning');
              }
          }).catch((e) => {
              console.error(e);
          });
    };

    this.sound = () => {
      let audio = new Audio("../assets/qr/sound/shutter.mp3" );
      return audio.play();
    };

    this.testNowQrCode = async(testCode) => {
        if(testCode != undefined) {
            let formData = new FormData();
            formData.append("testCode", testCode);

            let response = await fetch('../index.php?action=visitors', {
                method: 'POST',
                body: formData
            });
            
            let { message, status } = await response.json();
            
            if (status == 'success') {
                this.msgVisitors(message, 'success');
            } else {
                this.msgVisitors(message, 'error');
            }
        }
    }

    this.printVisitorsQrCode = () => {
        let w = 700;
        let h = 450;
        let img = document.querySelector('#visitorsQrimg').src;
        let fname = document.querySelector('#filenameQr').value;
        let content = `
            <style>
            .card-container {
                display: flex;
                justify-content: center;
            }
            .card {
                box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
                transition: 0.3s;
                width: 50%;
              }
              
              .card:hover {
                box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
              }
              
              .container {
                padding: 2px 16px;
                text-align: center;
              } 
            </style>
            
            <div class="card-container">
                <div class="card">
                    <img src="${img}" alt="QrCode" style="width:100%">
                    <div class="container">
                        <h4><b>${fname}</b></h4> 
                        <p>VISITOR</p> 
                    </div>
                </div>
            </div>
        `;

        setTimeout(() => {
        let left = (screen.width/2 - w/2);
        let top  = (screen.height/2 - h/2);
        let mywindow = window.open(``, 
            `Print`, 
            `height=${h},
            width=${w},
            left=${left}, 
            top=${top}`
        );
            mywindow.document.write('<html><body style="background:rgb(240, 240, 240);">');
            mywindow.document.write(content);
            mywindow.document.write('</body></html>');
            mywindow.document.close();
            mywindow.focus();
            mywindow.print();
        },1000);
    }

    this.fetchUnactVisitors = async() => {
        const response = await fetch(`../index.php?action=visitors&viewUnact`, {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            this.tableBodyUnactVisitors(message);
        } else {
            this.msgVisitors(message, 'error'); 
        }
    }

    this.tableBodyUnactVisitors = (data) => {
        let inc = 0;
        let row = ``;
        let empVal = `<td colspan="10" class="font-5xl text-center font-extrabold animate-bounce">Data Not Found...</td>`;

        if(data != true) {
            data.forEach(el => {
                row += `
                <tr>
                    <td class="px-5 py-5">
                        <input class="w-5 h-5" type="checkbox" name="vstrsUnact_chk[]" value="${el.	visitors_id}">
                    </td>
                    <td class="px-5 py-5">${++inc}</td>
                    <td class="px-5 py-5">
                        <div class="relative mx-auto w-20 h-20 rounded-full border-gray-300 border-2">
                            <img class="w-full h-full rounded-full" src="../assets/images/account.png" alt="avatar" />
                        </div>
                    </td>
                    <td class="px-5 py-5">${el.id_pass}</td>
                    <td class="px-5 py-5">
                        ${el.fname} 
                        ${el.mname.charAt(0).toUpperCase()}, 
                        ${el.lname}
                    </td>
                    <td class="px-5 py-5">${new Date(el.dob).toDateString()}</td>
                    <td class="px-5 py-5">${el.gender}</td>
                    <td class="px-5 py-5">${el.address}</td>
                    <td class="px-5 py-5">${el.contactno}</td>
                    <td class="px-5 py-5">${el.porpose}</td>
                </tr>
                `;
            }); 
        } else {
            row = empVal
        }
        document.querySelector("#tbodyUnactVstrs").innerHTML = row;
    };
}

const vstrScanner = new Instascan.Scanner({ video: document.querySelector('#preview')});
let vstrsObj = new VisitorsForm(DynamicLogo, vstrScanner);
vstrsObj.fetchVisitors();
vstrsObj.visitorsForm();
vstrsObj.removeVisitors();
vstrsObj.limitPagesVisitors();
vstrsObj.searchVisitors();
vstrsObj.totalPagesVisitors();
vstrsObj.printAllVisitorsData();
vstrsObj.checkAllVisitors();
vstrsObj.fetchUnactVisitors();
vstrsObj.testQrBtn();
vstrsObj.resetTableData();
        