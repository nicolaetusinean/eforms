$(".clickConfirm").click(function() {
	// escape here if the confirm is false;
    if (!confirm('Esti sigur ca doresti sa faci aceasta actiune?')) return false;
    var btn = this;
    setTimeout(function () { $(btn).attr('disabled', 'disabled'); }, 1);
    return true;
});