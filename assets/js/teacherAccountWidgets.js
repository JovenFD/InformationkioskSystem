function TeacherAccount() {

    this.msgTchrAcc = (msg, type_icon) => {
        swal({
            title: msg,
            icon: type_icon,
            timer: 2000,
            buttons: {
                cancel: "Close",
            }
        });
    }

    this.widgetsStudent = async() => {
        const response = await fetch(`../index.php?action=teacherAccount&widgetstudent`, {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            document.querySelector('#tchrstdDom').innerHTML = message;
        } else {
            this.msgTchrAcc(message, 'error');  
        }
    }

    this.widgetsTeacher = async() => {
        const response = await fetch(`../index.php?action=teacherAccount&widgetstudentgrades`, {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            document.querySelector('#stdGradesDom').innerHTML = message;
        } else {
            this.msgTchrAcc(message, 'error');  
        }
    }

    this.widgetsAttendanceLog = async() => {
        const response = await fetch(`../index.php?action=teacherAccount&widgetattlog`, {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            document.querySelector('#attLogsDom').innerHTML = message;
        } else {
            this.msgTchrAcc(message, 'error');  
        }
    }
}

let tchrAccObj = new TeacherAccount();
tchrAccObj.widgetsStudent();
tchrAccObj.widgetsTeacher();
tchrAccObj.widgetsAttendanceLog();