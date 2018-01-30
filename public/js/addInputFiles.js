window.onload=function() {
    document.querySelector('#addInputFile').onclick=function () {
        var input=document.createElement('input');
        input.type='file';
        input.name='images[]';
        document.querySelector('#inputFiles').appendChild(input);
        document.querySelector('#inputFiles').appendChild(document.createElement('br'));
}
}
