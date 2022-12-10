let suggestions = [];
const searchWrapper = document.querySelector(".search-input");
const inputBox = searchWrapper.querySelector("input");
const suggBox = searchWrapper.querySelector(".autocom-box");
const icon = searchWrapper.querySelector(".icon");
let linkTag = searchWrapper.querySelector("a");
let webLink;
let cantsum;
// if user press any key and release
inputBox.addEventListener('input', (e)=>{
    let userData = e.target.value; //user enetered data
    let emptyArray = [];
    if(userData){
        var code = userData
        var formularioDatos = new FormData()
        formularioDatos.append('buscador', 'buscador')
        formularioDatos.append('codigo',  code)
        fetch('recibe.php', {
            method: 'POST',
            body: formularioDatos
        }).then((res) => res.json()).then((Response) => {
            if(Response == "error"){
                result = ["error"]
            }
            else{
            result = Response.map(function(a){
                return {id: a.id,
                    codigo: a.codigo,
                    unidad: a.unidad,
                    precio: a.precio}
            })}
            suggestions = result
            
        icon.onclick = ()=>{
            webLink = `https://www.google.com/search?q=${userData}`;
            linkTag.setAttribute("href", webLink);
            linkTag.click();
        }
        emptyArray = suggestions;
        emptyArray = emptyArray.map((data)=>{
            // passing return data inside li tag
            if(data.codigo == undefined){
                return data = ""
            }
            return data = `<div class="row list-class"><div class="col-sm-10"> <li>${data.codigo} | ${data.unidad} | ${data.precio}</div> <div class="col-sm-2"> <i id="${data.id}" class="btn marg btn-warning fa-solid fa-plus"></i></li></div></div>`;
        });
        searchWrapper.classList.add("active"); //show autocomplete box
        showSuggestions(emptyArray);
        let allList = suggBox.querySelectorAll("li");
        for (let i = 0; i < allList.length; i++) {
            //adding onclick attribute in all li tag
            allList[i].setAttribute("onclick", "select(this)");
        }

    var addArticle = document.getElementsByClassName("marg");
    for (var i = 0; i < addArticle.length; i++) {
        addArticle[i].addEventListener('click',function add(){
          id = this.id; 
          addCar(id);
    });
}
            })
    }else{
        searchWrapper.classList.remove("active"); //hide autocomplete box
    }
})
function select(element){
    let selectData = element.textContent;
    inputBox.value = selectData;
    icon.onclick = ()=>{
        webLink = `https://www.google.com/search?q=${selectData}`;
        linkTag.setAttribute("href", webLink);
        linkTag.click();
    }
    searchWrapper.classList.remove("active");
}
function showSuggestions(list){
    let listData;
    if(!list.length){
        userValue = inputBox.value;
        listData = `<li>${userValue}</li>`;
    }else{
      listData = list.join('');
    }
    suggBox.innerHTML = listData;
}


function addCar(id) {
    var article = new FormData()
    article.append('id', id)
    article.append('accion', 'get-article')
    fetch('../includes/functions.php',{
        method: 'POST',
        body: article
    }).then((res) => res.json()).then((Response) => {
        if(Response == "error"){
            result = ["error"]
        }
        else{
           
        Response.map(function(a){
            if(document.getElementById(`cant-${a.id}`) != null){
                cantsum =   document.getElementById(`cant-${a.id}`).textContent
                cantsum = parseFloat(cantsum) + 1
                total =   parseFloat(a.precio) * parseFloat(cantsum)
                document.getElementById(`cant-${a.id}`).innerHTML = cantsum;
                document.getElementById(`total-${a.id}`).innerHTML = total.toFixed(2);
            }
            else{
           
            console.log(parseFloat(a.precio))
            result = `
            <tr id="row-${a.id}">
            <td>${a.id}</td>
            <td>${a.codigo}</td>
            <td id='cant-${a.id}'>1</td>
            <td>${a.codigo}</td>
            <td>${a.precio}</td>
            <td id="total-${a.id}">${a.precio}</td>
          </tr>`;
          innerData = 
          document.getElementById("formtable").innerHTML += result;
        }
        })
        }
       
})
}
