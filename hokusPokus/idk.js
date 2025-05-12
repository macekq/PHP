
var USER = {
    selected: '', name: '', ctecka: '', editor: '',
    files: [], filesAsocDir: [], currDir: 'data/davidSchizofrenik/assets', ids: []
}
function findSlash(str){
    for(let i = str.length-1; i>=0; i--){
        if(str[i] == '/') return i
    }
}
function cd00(){
    let path = USER.currDir
    let index = findSlash(path)
    path.substring(0, index)
}
cd00()