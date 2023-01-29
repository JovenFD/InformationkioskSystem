function WidgetStatisticst() {

    this.msgStatistics = (msg, type_icon) => {
        swal({
            title: msg,
            icon: type_icon,
            timer: 2000,
            buttons: {
                cancel: "Close",
            }
        });
    }

    this.stdStatistics = async() => {
        const response = await fetch(`../index.php?action=statistics-count&student`, {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            document.querySelector('#stdDom').innerHTML = message;
        } else {
            this.msgStatistics(message, 'error'); 
        }
    };

    this.tchrStatistics = async() => {
        const response = await fetch(`../index.php?action=statistics-count&teacher`, {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            document.querySelector('#tchrDom').innerHTML = message;
        } else {
            this.msgStatistics(message, 'error');  
        }
    };

    this.vstrStatistics = async() => {
        const response = await fetch(`../index.php?action=statistics-count&visitors`, {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            document.querySelector('#vstrDom').innerHTML = message;
        } else {
            this.msgStatistics(message, 'error');  
        }
    };

    this.sbjStatistics = async() => {
        const response = await fetch(`../index.php?action=statistics-count&subject`, {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            document.querySelector('#sbjDom').innerHTML = message;
        } else {
            this.msgStatistics(message, 'error');  
        }
    };

    this.clsStatistics = async() => {
        const response = await fetch(`../index.php?action=statistics-count&class`, {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            document.querySelector('#clsDom').innerHTML = message;
        } else {
            this.msgStatistics(message, 'error');  
        }
    };

    this.shlogsStatistics = async() => {
        const response = await fetch(`../index.php?action=statistics-count&schoollogs`, {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            document.querySelector('#shlogsDom').innerHTML = message;
        } else {
            this.msgStatistics(message, 'error'); 
        }
    };

    this.shyrStatistics = async() => {
        const response = await fetch(`../index.php?action=statistics-count&schoolyear`, {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            document.querySelector('#shyrDom').innerHTML = message;
        } else {
            this.msgStatistics(message, 'error');  
        }
    };

    this.tchradvrStatistics = async() => {
        const response = await fetch(`../index.php?action=statistics-count&teacheradvidory`, {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            document.querySelector('#tchradvr').innerHTML = message;
        } else {
            this.msgStatistics(message, 'error');  
        }
    };

    this.yealLvlStatistics = async() => {
        const response = await fetch(`../index.php?action=statistics-count&yearlevel`, {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            document.querySelector('#yealLvl').innerHTML = message;
        } else {
            this.msgStatistics(message, 'error');  
        }
    };

    this.stdclsStatistics = async() => {
        const response = await fetch(`../index.php?action=statistics-count`, {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            document.querySelector('#stdcls').innerHTML = message;
        } else {
            this.msgStatistics(message, 'error');  
        }
    };
}

let widObj = new WidgetStatisticst();
widObj.stdStatistics();
widObj.tchrStatistics();
widObj.vstrStatistics();
widObj.sbjStatistics();
widObj.clsStatistics();
widObj.shlogsStatistics();
widObj.shyrStatistics();
widObj.tchradvrStatistics();
widObj.stdclsStatistics();
widObj.yealLvlStatistics();