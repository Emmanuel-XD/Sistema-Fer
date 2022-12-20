let suggestions = [];
const searchWrapper = document.querySelector(".search-input");
const inputBox = searchWrapper.querySelector("input");
const suggBox = searchWrapper.querySelector(".autocom-box");
const icon = searchWrapper.querySelector(".icon");
const saveReq = document.getElementById("save-btn");
let linkTag = searchWrapper.querySelector("a");
let webLink;
let cantsum;
let inputcant;
let cantsuminp;
var precio;
//Search bar & event to add product to the car
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
            precio = data.codigo
            // passing return data inside li tag
            if(data.codigo == undefined){
                return data = ""
            }
            return data = `<div class="row list-class"><div class="col-sm-8"> <li> ${data.id}| ${data.codigo} | ${data.descripcion} | ${data.unidad} | ${data.precio}</div> <div class="col-sm-2"><input type="number" class="quantity-mult" min='1' placeholder=00 name="quantity-mult" id="quantity-mult-${data.id}"></div> <div class="col-sm-2"> 
            <i data-del="${data.id}" class="margDel btn-minus fa-solid fa-minus"></i><i data-add="${data.id}" class="btn margAdd btn-warning fa-solid fa-plus"></i></li></div></div>`;
        });
        searchWrapper.classList.add("active"); //show autocomplete box
        showSuggestions(emptyArray);
        let allList = suggBox.querySelectorAll("li");
        for (let i = 0; i < allList.length; i++) {
            //adding onclick attribute in all li tag
            allList[i].setAttribute("onclick", "select(this)");
        }

    var addArticle = document.getElementsByClassName("margAdd");
    var delArticle = document.getElementsByClassName("margDel");
    for (var i = 0; i < addArticle.length; i++) {
        addArticle[i].addEventListener('click',function add(){
          id = this.getAttribute("data-add");
          addCar(id);
    });
}
    for(var i = 0; i < delArticle.length; i++){
        delArticle[i].addEventListener('click', function del(){
            id = this.getAttribute("data-del");
            delCar(id);
        })
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
                    }
                cantsum = parseFloat(cantsum) + parseFloat(cantsum2);

                inputcant = document.getElementById(`total-${a.id}`)
                total =   parseFloat(a.precio) * parseFloat(cantsum)
                document.getElementById(`cant-${a.id}`).value = cantsum;
                document.getElementById(`cant-${a.id}`).innerHTML = cantsum;
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
                    alert('No se encontro numero de articulos para agregar, se agrego 1 de forma automatica')
                    cantsum2 = 1
                    }
                //sumcant = parseFloat(cantsum) + parseFloat(cantsum2);
                total =   parseFloat(a.precio) * parseFloat(cantsum2)
                
            result = `
            <tr class="rowslist" id="row-${a.id}">
            <td class="prd-id">${a.id}</td>
            <td class="producto-code">${a.codigo}</td>
            <td>${a.descripcion}</td>
            <td class="prd-cant" id="cant-${a.id}">${cantsum2}</td>
            <td class="prd-unit">${a.unidad}</td>
            <td class="prd-price" id="unit-${a.id}">${a.precio}</td>
            <td class="totals" id="total-${a.id}">${total.toFixed(2)}</td>
          </tr>
          
    
          `;


          innerData = 
          document.getElementById("formtable").innerHTML += result;
          cantsuminp = document.getElementById(`cant-${a.id}`)
          inputcant = document.getElementById(`total-${a.id}`)



        }
        totales(id);
        })
        }
       
})
}
function delCar(id){

    var itemreduce;

    if(document.getElementById(`cant-${id}`) && parseInt(document.getElementById(`cant-${id}`).textContent) > 0){
        itemreduce = document.getElementById(`cant-${id}`)
        reducer = document.getElementById(`quantity-mult-${id}`).value


        if(reducer == null || reducer == '' || reducer < 1){ 
            document.getElementById(`quantity-mult-${id}`).classList.add('lowerNumber')
            alert('No se encontro numero de articulos para borrar, automaticamente se borro 1 articulo')
            reducer = 1
        }
        var reduced = parseFloat(itemreduce.textContent) - parseFloat(reducer)
        var unitVal = parseFloat(document.getElementById(`unit-${id}`).textContent)
        var total = document.getElementById(`total-${id}`)
        if(reduced < 1){
            const element = document.getElementById(`row-${id}`)
            element.remove()
        }
        itemreduce.textContent = parseFloat(itemreduce.textContent) - parseFloat(reducer)
        total.textContent = parseFloat(unitVal * parseFloat(itemreduce.textContent)).toFixed(2);
        totales(id);
    }
}




saveReq.addEventListener('click', (a) => { 
    if(confirm("ADVERTENCIA LA COMPRA SE GUARDARA EN EL REGISTRO AUNQUE NO TENGA PRODUCTOS ¿CONTINUAL?")){
    a.preventDefault
    var rowList = document.getElementsByClassName("rowslist");
    var prdId = document.getElementsByClassName("prd-id");
    var rowList = document.getElementsByClassName("rowslist");
    var text1
    const arrayex = [
        [],
        [],
        []
    ]
    var products =  new FormData();
    Array.from(prdId).forEach(element => {
        arrayex[0].push(element.textContent)
        arrayex[2].push(document.getElementById(`cant-${element.textContent}`).textContent)
    });
    console.log(arrayex)

    arrayex[1].push(document.getElementById('folio').value)
    arrayex[1].push(document.getElementById('depto').value)
    arrayex[1].push(document.getElementById("sumatotal").textContent)
    arrayex[1].push(document.getElementById('user').value)
    arrayex[1].push(document.getElementById('monto').value)
    jsonarray = JSON.stringify(arrayex)
    fetch('../includes/guardarReq.php', {
    method: 'POST',
    body: jsonarray}).then( alert("COMPRA GUARDADA, CONSULTA EL HISTORIAL"))
}
 })
 viewHist.addEventListener('click', (a) => {
    a.preventDefault
    if(confirm("Tus datos no guardados se perderan ¿Continuar?") === true){
    window.location.href = 'historial.php'
}
 })
function totales(id) {
    ele =  document.getElementsByClassName('totals')
    var totals = 0;
    var sumtot = 0;
        
    Array.from(ele).forEach((el) => {
            sumtot = parseFloat(el.textContent).toFixed(2)
            totalsvalid = parseFloat(totals) + parseFloat(sumtot)
            var validpresu = parseFloat(document.getElementById("top-total").textContent) - totalsvalid;


            if(validpresu <= 0){
                alert("Tus  articulos por agregar superan tu presupuesto, el ultimo articulo no fue agregado")
                document.getElementById(`cant-${id}`).textContent = parseFloat(document.getElementById(`cant-${id}`).textContent) - document.getElementById(`quantity-mult-${id}`).value
                newtotal = parseFloat(document.getElementById(`unit-${id}`).textContent) * parseFloat(document.getElementById(`cant-${id}`).textContent)
                document.getElementById(`total-${id}`).textContent = newtotal.toFixed(2)
                var sum = 0;
                $('.totals').each(function(){
                    sum += parseFloat(this.textContent);
                });
                console.log(sum)
                document.getElementById("sumatotal").innerHTML = sum;
                if(parseFloat(document.getElementById(`cant-${id}`).textContent) < 1){
                    const element = document.getElementById(`row-${id}`)
                     element.remove()
                     
                }
                
                
            }
            else{
        
                totals = parseFloat(totals) + parseFloat(sumtot);
                document.getElementById("sumatotal").innerHTML = totals.toFixed(2)
                /* validpresu = parseFloat(document.getElementById("top-total").textContent) - parseFloat(document.getElementById("sumatotal").textContent) */
                
                
            }
           
         })
         if(document.getElementById("formtable").childNodes.length === 2){
                    
            document.getElementById("sumatotal").innerHTML = 0;
        }

        }

        
           
