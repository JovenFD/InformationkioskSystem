let btnScrollUp = document.querySelector('#btnScrollUp');

window.onscroll = () => {
    scroll();
};

const scroll = () => {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        btnScrollUp.style.display = "block";
    } else {
        btnScrollUp.style.display = "none";
    }
}

btnScrollUp.onclick = async(e) => {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}