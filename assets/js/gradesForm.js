function ScannerGrades() {

    const scanner = new Instascan.Scanner({ video: document.querySelector('#preview')});

    this.autoplay = () => {
        Instascan.Camera.getCameras().then((cameras) => {
              if(cameras.length > 0) {
                scanner.start(cameras[0]);
              } else {
                this.msgGrades('No cameras found', 'warning');
              }
          }).catch((e) => {
              console.error(e);
          });

        scanner.addListener('scan',(code) => {
            this.sound();
            this.sendData(code);
        });
    }

    this.getStop = () => {
        stopBtnGrades.onclick = async(e) => {
          Instascan.Camera.getCameras().then((cameras) => {
              if(cameras.length > 0 ) {
                scanner.stop(cameras[0]);
              } else {
                  this.msgGrades('No cameras found', 'warning');
              }
          }).catch((e) => {
              console.error(e);
          });
        }
    };

    this.sound = () => {
      let audio = new Audio("./assets/qr/sound/shutter.mp3" );
      return audio.play();
    };

    this.sendData = async(passCode) => {

        if(passCode != undefined) {
            let formData = new FormData();
            formData.append("passCode", passCode);

            let response = await fetch('./index.php?action=view-grades', {
                method: 'POST',
                body: formData
            });
            
            let { message, status } = await response.json();
            
            if (status == 'success') {
                document.querySelector('#passCode').value = message.id_pass;
                document.querySelector('#passCodeForget').value = message.id_pass;
                document.querySelector('#btn-pincode-grades').click();
            } else {
                msgGrades(message, 'error');
            }
        }
    }

    this.pinCodeEvent = () => {
        let input = document.querySelector('#output');
        let passcode = document.querySelector('#passCode');
        input.disabled = true;

        togglePassword.onclick = async (e) => {
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            togglePassword.classList.toggle("fa-eye-slash");
        }
        clear.onclick = async (e) => {
            input.value = null;
        }
        zero.onclick = async (e) => {
            input.value += 0;
        }
        one.onclick = async (e) => {
            input.value += 1;
        }
        two.onclick = async (e) => {
            input.value += 2;
        }
        three.onclick = async (e) => {
            input.value += 3;
        }
        four.onclick = async (e) => {
            input.value += 4;
        }
        five.onclick = async (e) => {
            input.value += 5;
        }
        six.onclick = async (e) => {
            input.value += 6;
        }
        seven.onclick = async (e) => {
            input.value += 7;
        }
        eight.onclick = async (e) => {
            input.value += 8;
        }
        nine.onclick = async (e) => {
            input.value += 9;
        }
        submit.onclick = async (e) => {

            let formData = new FormData();
            let obj = {
                passcode: passcode.value,
                pincode: input.value
            }

            formData.append("credential", JSON.stringify(obj));

            let response = await fetch('./index.php?action=view-grades', {
                method: 'POST',
                body: formData
            });
            
            let { message, status } = await response.json();
            
            if (status == 'success') {
                input.style.borderColor = 'rgb(60, 179, 113)';
                passcode.value = null;
                input.value = null;
                this.viewGrades(message.id_pass);
                document.querySelector('#btn-pincode-grades').click();
            } else {
                submit.style.borderColor = '';
                msgGrades(message, 'error');
            }
        }
    }

    this.forgetPincode = () => {
        let btnVal = document.querySelector('#forgetBtn');
        emailForm.onsubmit = async (e) => {
            e.preventDefault();

            btnVal.value = "Sending...";
        
            let response = await fetch('./index.php?action=view-grades', {
                credentials: "same-origin",
                method: 'POST',
                body: new FormData(emailForm)
            });
        
            let { message, status } = await response.json();
            
            if (status == 'success') {
                msgGrades(message, 'success');
                emailForm.reset();
                btnVal.value = "Successfully Send";
            } else {
                msgGrades(message, 'error');
            }
        }
    }

    this.viewGrades = async (passCode) => {

        if(passCode != undefined) {
            let formData = new FormData();
            formData.append("validateConfirm", passCode);

            let response = await fetch('./index.php?action=view-grades', {
                method: 'POST',
                body: formData
            });
            
            let { message, fname, mname, lname, status } = await response.json();
            
            if (status == 'success') {
                this.tableBodyStudentGrades(
                    message,
                    fname,
                    mname,
                    lname
                );
            } else {
                msgGrades(message, 'error');
            }
        }
    }

    this.tableBodyStudentGrades = (data, fname, mname, lname) => {
        let inc = 0;
        let row = ``;
        let year = '';
        let empVal = `<td colspan="11" class="font-5xl text-center font-extrabold animate-bounce">Data Not Found...</td>`;

        if(data != true) {
            data.forEach(el => {
                year = el.schoolyear;
                
                ((el.remarks == 'PASSED') 
                ? remarks =  `<label class="text-green-500 text-bold">${el.remarks}</label>`
                : ((el.remarks == 'FAILED')
                ? remarks =  `<label class="text-red-500 text-bold">${el.remarks}</label>`
                : remarks =  `<label class="text-red-500 text-bold">No Final Remarks</label>`));

                row += `
                <tr>
                    <td>${++inc}</td>
                    <td>${el.subject_name}</td>
                    <td>${el.firstquarter}</td>
                    <td>${el.secondquarter}</td>
                    <td>${el.thirthquarter}</td>
                    <td>${el.fourthquarter}</td>
                    <td>${el.gradeaverage}</td>
                    <td>${remarks}</td>
                    <td>${el.tname.toUpperCase()}</td>
                </tr>
                `;
            });  
        } else {
            row = empVal
        }
        document.querySelector("#studentName").innerHTML = `        
            ${fname.toUpperCase()}
            ${mname.toUpperCase()}, 
            ${lname.toUpperCase()} 
        `;
        document.querySelector("#sy").innerHTML = year;
        document.querySelector("#tbodyGrades").innerHTML = row;
        document.querySelector('#btn-modal-grades').click();
    }

    msgGrades = (msg, status) => {
        if(status == 'success') {
            swal({
                title: msg,
                icon: status,
                timer: 2000,
                buttons: {
                    cancel: "Close",
                }
            });
        } else {
            swal({
                title: msg,
                icon: status,
                timer: 2000,
                buttons: {
                    cancel: "Close",
                }
            });
        }
    }
}

let scannerGradeObj = new ScannerGrades();
scannerGradeObj.getStop();
scannerGradeObj.sendData();
scannerGradeObj.autoplay();
scannerGradeObj.pinCodeEvent();
scannerGradeObj.viewGrades();
scannerGradeObj.forgetPincode();