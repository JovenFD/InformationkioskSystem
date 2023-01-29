function videoHeader() {

  this.msgVideo = (msg, type_icon) => {
    swal({
        title: msg,
        icon: type_icon,
        timer: 2000,
        buttons: {
            cancel: "Close",
        }
    });
  }

  this.fetchHeaderVideo = async() => {
    const response = await fetch("../index.php?action=uploadVideo&viewVideo", {
        credentials: "same-origin",
        method: "GET",
    });

    let { message, status} = await response.json();

    if(status == 'success') {
      this.VideoHeaderValue(message);
    } else {
        this.msgVideo(message, 'error'); 
    }
}

this.VideoHeaderValue = (data) => {
  let row = ``;
  let empVal = `<td colspan="2" class="text-center font-extrabold animate-bounce">Video Not Found...</td>`;

  if(data != true) {
      data.forEach(el => {
          row += `
          <td>
            <video
                autoplay
                loop
                muted
                class= "w-full h-full"
              >
                <source
                src=".${el.filename}"
                type="video/mp4"
                />
                Your browser does not support the video tag.
            </video>
          </td>
          `;
          
      }); 
  } else {
      row = empVal
  }
  document.querySelector("#tbodyVidoe").innerHTML = row;
};

  this.updateVideo = () => {
    inputVideo.onchange = async(e) => {
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
            let btnSubmit = document.querySelector('#btnSubmit');
            btnSubmit.click();
            this.saveVideo();
          }, 2000);
      }
    }

  this.saveVideo = () => {
    videoHeaderForm.onsubmit = async (e) => {
      e.preventDefault();
      let elem = document.querySelector('#progressUploadbar');
      let count = document.querySelector('#percentUpload');
      let closedModal = document.querySelector('#uploadVideoModal');

      fetch('../index.php?action=uploadVideo', { 
          credentials: "same-origin",
          method: 'POST',
          body: new FormData(videoHeaderForm),
        }).then(
          response => response.json()
        ).then((response) => {

            if(response.status == 'success') {

              this.msgVideo(response.message, 'success'); 
              setTimeout(() => {
                closedModal.click();
                window.location.reload();
              }, 1000);

            } else {
              this.msgVideo(response.message, 'error'); 
            }
          }
        ).catch(() => {
            this.msgVideo('Uploading failed file size exceed 80mb', 'warning');
          }
        );
        count.innerHTML  = 0 + "%";
        elem.style.borderColor = 5 + "%";
        videoHeaderForm.reset();
      };
  }
}

let vidObj = new videoHeader();
vidObj.updateVideo();
vidObj.saveVideo();
vidObj.fetchHeaderVideo();