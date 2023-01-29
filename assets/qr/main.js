function Scanner() {

    const scanner = new Instascan.Scanner({ video: document.querySelector('#preview')});

    this.msgLogs = (msg, type_icon) => {
      swal({
          title: msg,
          icon: type_icon,
          timer: 2000,
          buttons: {
              cancel: "Close",
          }
      });
    }

    this.autoplay = () => {
        Instascan.Camera.getCameras().then((cameras) => {
              if(cameras.length > 0) {
                scanner.start(cameras[0]);
              } else {
                this.msgLogs('No cameras found', 'warning');
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
        stopBtn.onclick = async(e) => {
          Instascan.Camera.getCameras().then((cameras) => {
              if(cameras.length > 0 ) {
                scanner.stop(cameras[0]);
              } else {
                  this.msgLogs('No cameras found', 'warning');
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

     this.sendData = async (passCode) => {

        if(passCode != undefined) {
            let formData = new FormData();
            formData.append("codetype", passCode);

            let response = await fetch('./index.php?action=add-logs', {
                method: 'POST',
                body: formData
            });
            
            let { fname, mname, lname, avatar, message, status } = await response.json();

            if (status == 'success') {

              this.alertMsgLogs(
                  fname,
                  mname,
                  lname,
                  avatar,
                  message, 
                  'success'
              );
            } else if(status == 'option') {
              
              this.msgLogs(message, 'success');
              setTimeout(() => {
                document.querySelector('#btn-modal-visitors').click();
                document.querySelector('#idpass').value = passCode;
              }, 2000);

            } else {
              this.msgLogs(message, 'error');
            }
        }
    }

    this.alertMsgLogs = (
      fname, 
      mname, 
      lname, 
      avatar,
      message, 
      status
      ) => {
        let modal = document.querySelector('#btn-modal-info');

        if(status == 'success') {
          let msg    = document.querySelector('#msgInfo');
          let pic    = document.querySelector('#imgInfo');
          let name   = document.querySelector('#nameInfo');
          let filename = avatar.slice(1, avatar.length);

          msg.innerHTML = message;
          pic.src = filename;
          name.innerHTML = `
            ${fname} 
            ${mname.charAt(0).toUpperCase()}, 
            ${lname}
          `;

          setTimeout(() => {
            modal.click();
          }, 1000);
        } else {
            swal({
                title: message,
                icon: status,
                timer: 2000,
                buttons: {
                    cancel: "Close",
                }
            });
        }

        setTimeout(() => {
          modal.click();
        }, 4000);
    }
}

let scannerObj = new Scanner();
scannerObj.getStop();
scannerObj.sendData();
scannerObj.autoplay();