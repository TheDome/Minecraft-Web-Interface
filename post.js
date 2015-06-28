function submit(path, params, method, site) {
    method = method || "post";
    site = site || "home";

    var form = document.createElement("form");
    var type = "hidden";

    form.setAttribute("method", method);
    form.setAttribute("action", path);
    form.setAttribute("enctype", "multipart/form-data");
    form.setAttribute("name", "form");

    var hiddenField = document.createElement("input");
    hiddenField.setAttribute("type", type);
    hiddenField.setAttribute("name", "site");
    hiddenField.setAttribute("value", site);

    form.appendChild(hiddenField);





    for (var key in params) {
        if (params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", type);
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
        }
    }
    document.body.appendChild(form);
    form.submit();
}
