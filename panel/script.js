const editor = ace.edit('editor', {
  mode: 'ace/mode/json',
  selectionStyle: 'text',
  showPrintMargin: false,
  theme: 'ace/theme/chrome' });

  //{"name":"something"}

const formatText = (spacing = 0) => {
  try {
    const current = JSON.parse(editor.getValue());
    editor.setValue(JSON.stringify(current, null, spacing));
    editor.focus();
    editor.selectAll();
    //console.log(editor.getValue());
    let userchangers = editor.getValue();


    // Sending a receiving data in JSON format using GET method
    var xhr = new XMLHttpRequest();
    var url = "/wp-content/plugins/girlfriend/panel/update.php?data=" + encodeURIComponent(JSON.stringify(userchangers));
    xhr.open("GET", url, true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.send();

  } catch (err) {
    alert('ERROR: Unable to parse text as JSON');
  }
};

editor.on('paste', event => {
  try {
    event.text = JSON.stringify(JSON.parse(event.text), null, 4);
  } catch (err) {
    // meh
  }
});


function getthecontent() {
  fetch('/wp-content/plugins/girlfriend/panel/getmsg.php')
      .then(res => res.json())
      .then((out) => {
        editor.setValue(out)
        console.log(out)
  }).catch(err => console.error(err));

 // editor.setValue('{"name":"somsdfsdsdething"}')
}

document.getElementById('minify').addEventListener('click', () => formatText());
document.getElementById('beautify').addEventListener('click', () => formatText(4));
document.getElementById('loadfile').addEventListener('click', () => getthecontent());