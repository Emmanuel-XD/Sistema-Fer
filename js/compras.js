let suggestions = [];
const searchWrapper = document.querySelector(".search-input");
const inputBox = searchWrapper.querySelector("input");
const suggBox = searchWrapper.querySelector(".autocom-box");
const icon = searchWrapper.querySelector(".icon");
let linkTag = searchWrapper.querySelector("a");
let webLink;
let cantsum;
let inputcant;
let cantsuminp;
// if user press any key and release
inputBox.addEventListener('input', (e)=>{
    let userData = e.target.value; //user enetered data
    let emptyArray = [];
    if(userData){
        var code = userData
        var formularioDatos = new FormData()
        formularioDatos.append('buscador', 'buscador')
        formularioDatos.append('codigo',  code)
        formularioDatos.append('descripcion',  code)
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
                    descripcion: a.descripcion,
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
            return data = `<div class="row list-class"><div class="col-sm-8"> <li> ${data.id}| ${data.codigo} | ${data.descripcion} | ${data.unidad} | ${data.precio}</div> <div class="col-sm-2"><input type="number" class="quantity-mult" min='1' placeholder=00 name="quantity-mult" id="quantity-mult-${data.id}"></div> <div class="col-sm-2"> 
            <i id="delete-${data.id}" class="btn-minus fa-solid fa-minus"></i><i id="${data.id}" class="btn marg btn-warning fa-solid fa-plus"></i></li></div></div>`;
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
        webLink = ``;
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
                cantsuminp = document.getElementById(`cant-${a.id}`)
                cantsum =   document.getElementById(`cant-${a.id}`).textContent
                cantsum2 = document.getElementById(`quantity-mult-${a.id}`).value
                if(document.getElementById(`quantity-mult-${a.id}`).classList.contains('lowerNumber')){
                    document.getElementById(`quantity-mult-${a.id}`).classList.remove('lowerNumber')
                }   
                if(cantsum2 == null || cantsum2 == '' || cantsum2 < 1){ 
                    document.getElementById(`quantity-mult-${a.id}`).classList.add('lowerNumber')
                    alert('your values cant be lower than 1 or empty, automatically added 1 item')
                    cantsum2 = 1
                    console.log(`your value = ${cantsum2}`)}
                cantsum = parseFloat(cantsum) + parseFloat(cantsum2);

                inputcant = document.getElementById(`total-${a.id}`)
                total =   parseFloat(a.precio) * parseFloat(cantsum)
                document.getElementById(`cant-${a.id}`).value = cantsum;
                document.getElementById(`cant-${a.id}`).innerHTML = cantsum;
                console.log(cantsum2)
                inputcant.innerHTML = total.toFixed(2);

            }
            else{
                //cantsum =   document.getElementById(`cant-${a.id}`).textContent
                cantsum2 = document.getElementById(`quantity-mult-${a.id}`).value
                if(document.getElementById(`quantity-mult-${a.id}`).classList.contains('lowerNumber')){
                    document.getElementById(`quantity-mult-${a.id}`).classList.remove('lowerNumber')
                }
                if(cantsum2 == null || cantsum2 == '' || cantsum2 < 1){ 
                    document.getElementById(`quantity-mult-${a.id}`).classList.add('lowerNumber')
                    alert('your values cant be lower than 1 or empty, automatically added 1 item')
                    cantsum2 = 1
                    console.log(`your value = ${cantsum2}`)}
                //sumcant = parseFloat(cantsum) + parseFloat(cantsum2);
                total =   parseFloat(a.precio) * parseFloat(cantsum2)


            console.log(parseFloat(a.precio))
            result = `
            <tr id="row-${a.id}">
            <td>${a.id}</td>
            <td class="producto-code">${a.codigo}</td>
            <td>${a.descripcion}</td>
            <td id="cant-${a.id}">${cantsum2}</td>
            <td>${a.unidad}</td>
            <td>${a.precio}</td>
            <td id="total-${a.id}">${total.toFixed(2)}</td>
          </tr>
          
    
          `;


          innerData = 
          document.getElementById("formtable").innerHTML += result;
          cantsuminp = document.getElementById(`cant-${a.id}`)
          inputcant = document.getElementById(`total-${a.id}`)



        }
        ele =  document.getElementsByClassName('producto-code')
             Array.from(ele).forEach((el) => {
                console.log(el.textContent);
             })
        })
        }
       
})
}
function dbSaver(){

}
