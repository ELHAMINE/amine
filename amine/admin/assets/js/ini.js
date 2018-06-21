function $(selector) {
    var elements = document.querySelectorAll(selector);

    if (selector.indexOf('#') == 0) {
        if (elements.length == 1)
            return elements[0];
        return undefined;
    }

    return elements;
}