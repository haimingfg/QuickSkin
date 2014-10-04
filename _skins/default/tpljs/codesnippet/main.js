var xml = xmlObject();
var url;
var button;
var result;
function xmlObject () {
  if (typeof XMLHttpRequest == 'undefined') {
    objects = Array(
      'Microsoft.XmlHttp',
      'MSXML2.XmlHttp',
      'MSXML2.XmlHttp.3.0',
      'MSXML2.XmlHttp.4.0',
      'MSXML2.XmlHttp.5.0'
    );
    for (i = 0; i < objects.length; i++) {
      try {
        return new ActiveXObject(objects[i]);
      } catch (e) {}
    }
  } else {
    return new XMLHttpRequest();
  }
}
function resultElement () {
  if (!document.getElementById('result')) {
    result = document.createElement('div');
    result.id = 'result';
    document.body.appendChild(result);
  }
}
function handleResults () {
  if (xml.readyState == 4) {
    if (xml.responseText == 'url.blank') {
      result.innerHTML = 'Enter a valid URL';
    } else {
      result.innerHTML = xml.responseText;
    }
  } else {
    result.innerHTML = 'Loading..';
  }
}
function getResults () {
  resultElement();
  xml.open('get', 'res.inc.php?url=' + escape(url.value));
  xml.onreadystatechange = handleResults;
  xml.send(null);
}
function loadHandler () {
  url = document.getElementById('url');
  button = document.getElementById('button');
  button.onclick = getResults;
}
window.onload = loadHandler;