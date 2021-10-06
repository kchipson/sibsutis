r1.onmousedown = r2.onmousedown = r3.onmousedown = r4.onmousedown = movning;
r1.ondragstart = r2.ondragstart = r3.ondragstart = r4.ondragstart = dontdrag;

function movning(event) {
    // (1) start the process
    dragElement = event.currentTarget;

    let shiftX = event.clientX - dragElement.getBoundingClientRect().left;
    let shiftY = event.clientY - dragElement.getBoundingClientRect().top;
    // (2) prepare to moving: make absolute and top by z-index
    dragElement.style.position = "absolute";
    dragElement.style.zIndex = 1000;
    document.body.append(dragElement);
    // ...and put that absolutely positioned dragElement under the cursor
    moveAt(event.pageX, event.pageY);

    // centers the dragElement at (pageX, pageY) coordinates
    function moveAt(pageX, pageY) {
        dragElement.style.left = pageX - shiftX + "px";
        dragElement.style.top = pageY - shiftY + "px";
    }

    let currentDroppable = null;
    function onMouseMove(event) {
        moveAt(event.pageX, event.pageY);

        dragElement.hidden = true;
        let elemBelow = document.elementFromPoint(event.clientX, event.clientY);
        dragElement.hidden = false;
        if (!elemBelow) return;

        let droppableBelow = elemBelow.closest(".droppable");

        if (currentDroppable != droppableBelow) {
            if (currentDroppable) {
                leaveDroppable(currentDroppable);
            }
            currentDroppable = droppableBelow;
            if (currentDroppable) {
                enterDroppable(currentDroppable);
            }
        }
    }

    // (3) move the dragElement on mousemove
    document.addEventListener("mousemove", onMouseMove);

    // (4) drop the dragElement, remove unneeded handlers
    dragElement.onmouseup = function() {
        document.removeEventListener("mousemove", onMouseMove);
        dragElement.onmouseup = null;
        if (currentDroppable != null) {
            leaveDroppable(currentDroppable);
            console.log(currentDroppable.className);
            switch (currentDroppable.className) {
                case "droppable box1":
                    dragElement.style.top = "115px";
                    dragElement.style.left = "300px";
                    break;
                case "droppable box2":
                    dragElement.style.top = "115px";
                    dragElement.style.left = "390px";
                    break;
                case "droppable box3":
                    dragElement.style.top = "275px";
                    dragElement.style.left = "300px";
                    break;
                case "droppable box4":
                    dragElement.style.top = "275px";
                    dragElement.style.left = "390px";
                    break;
            }
        }
    };
}

function dontdrag() {
    return false;
}

function enterDroppable(elem) {
    elem.style.border = "2px dashed #000";
}

function leaveDroppable(elem) {
    elem.style.border = "";
}
