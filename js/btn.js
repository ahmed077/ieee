/*global console*/
/*--------------------------button moves------------------------*/

var aElem = document.getElementsByClassName('btn');
var boundingClientRect = [];
var btnBody = document.getElementsByClassName('btn-body');
var i;
var previousBody;
var newTop = [];
var didOnce = false;
var startSY = 0;
var i;
document.body.onload = function () {
    'use strict';
    if (window.scrollY > 0) {
        if (newTop.length > 0) {
            for (i = 0; i < newTop.length; i = i + 1) {
                newTop[i] += window.scrollY;
            }
            startSY = window.scrollY;
            didOnce = true;
        }
    }
};

document.body.onscroll = function () {
    'use strict';
    var i;
    for (i = 0; i < boundingClientRect.length; i = i + 1) {
        if (didOnce) {newTop[i] -= (window.scrollY); didOnce = false;
            }
        newTop[i] = boundingClientRect[i].top - window.scrollY + startSY;
    }
};

for (i = 0; i < aElem.length; i = i + 1) {
//    @@@@@
//    @@@@@
//    @@@@@
    aElem[i].onclick = function (e) {
        'use strict';
        e.preventDefault();
        var btn = e.target,
            oldBtn = document.getElementsByClassName('extrabtn')[0];
        if (oldBtn) {
            removeClass(oldBtn, 'extrabtn');
        }
        btn.className += ' extrabtn';
    };
    
    boundingClientRect[i] = aElem[i].getBoundingClientRect();
    newTop[i] =  boundingClientRect[i].top;
    aElem[i].onmousemove = function (e) {
        'use strict';
        var index = e.target.getAttribute('data-index'),
            x = e.clientX - boundingClientRect[index].left,
            y = e.clientY - newTop[index],
            xc = boundingClientRect[index].width / 2,
            yc = boundingClientRect[index].height / 2,
            dx = x - xc,
            dy = y - yc;
        btnBody[index].style.cssText = '--rx: ' + (dy / -1) + 'deg';
        btnBody[index].style.cssText += '--ry: ' + (dx / 10) + 'deg';
    };
    
    aElem[i].onmouseleave = function (e) {
        
        'use strict';
        var index = e.target.getAttribute('data-index');

        btnBody[index].style.cssText = '--ty: 0';
        btnBody[index].style.cssText += '--rx: 0';
        btnBody[index].style.cssText += '--ry: 0';
        
    };

    aElem[i].onmousedown = function (e) {
        'use strict';
        var index = e.target.getAttribute('data-index');
        btnBody[index].style.cssText = '--tz: -25px';
    };
    btnBody[i].onmouseup = function (e) {
        'use strict';
        var index = e.target.firstElementChild.getAttribute('data-index');
        btnBody[index].style.cssText = '--tz: -12px';
    };

}

function removeClass(elem, cls) {
    'use strict';
    var classes = elem.className,
        start = classes.search(cls),
        end = cls.length,
        a = classes.substring(0, start),
        b = classes.substring(a.length + end);
    elem.className = a.concat(b).trim();
    return elem;
}

/*--------------------------button Action------------------------*/

var workshop = document.getElementById('workshop'),
    sessions = document.getElementById('sessions'),
    visits = document.getElementById('visits'),
    wsClasses = workshop.className,
    workshopDiv = document.getElementsByClassName('workshop'),
    sessionsDiv = document.getElementsByClassName('session'),
    visitsDiv = document.getElementsByClassName('visit'),    
    j,
    h,
    k;

visits.onclick = function () {
    'use strict';
    for (k = 0; k < sessionsDiv.length; k = k + 1) {
        sessionsDiv[k].style.display = "none";
    }
    for (h = 0; h < workshopDiv.length; h = h + 1) {
        workshopDiv[h].style.display = "none";
    }
    for (j = 0; j < visitsDiv.length; j = j + 1) {
        visitsDiv[j].style.display = "block";
    }

};

workshop.onclick = function () {
    'use strict';
    for (k = 0; k < sessionsDiv.length; k = k + 1) {
        sessionsDiv[k].style.display = "none";
    }
    for (h = 0; h < workshopDiv.length; h = h + 1) {
        workshopDiv[h].style.display = "block";
    }
    for (j = 0; j < visitsDiv.length; j = j + 1) {
        visitsDiv[j].style.display = "none";
    }
    
};

sessions.onclick = function () {
    'use strict';
    for (k = 0; k < sessionsDiv.length; k = k + 1) {
        sessionsDiv[k].style.display = "block";
    }
    for (h = 0; h < workshopDiv.length; h = h + 1) {
        workshopDiv[h].style.display = "none";
    }
    for (j = 0; j < visitsDiv.length; j = j + 1) {
        visitsDiv[j].style.display = "none";
    }
    
};
 








