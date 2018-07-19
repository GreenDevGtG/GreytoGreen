$("#opener").click(function () {
    $("#dialog").dialog("open");
});

$(document).ready(function () {
    $(function () {
        $("#dialog").dialog({
            autoOpen: false,
            resizable: false,
            draggable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: [
                {
                    text: "Déconnexion",
                    click: function () {
                    $(this).dialog("close");
                    }
                },
                {
                    text: "Annuler",
                    click: function () {
                    $(this).dialog("close");
                    }
                }
            ],
        });
    });
});