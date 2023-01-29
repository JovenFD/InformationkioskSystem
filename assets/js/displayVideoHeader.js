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
        const response = await fetch("./index.php?action=uploadVideo&viewVideo", {
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
        let video = document.querySelector('#videoHeader');
        let source = document.createElement('source');

        if(data != true) {
            data.forEach(el => {
                
                source.setAttribute('src', el.filename)
                video.appendChild(source);
                video.play();

            }); 
        }
    };
}

let showVidObj = new videoHeader();
showVidObj.fetchHeaderVideo();