import httpService from "./httpService.js"



// alert("xdcfgvhbjnfkasdhifgjb")
document.addEventListener("DOMContentLoaded",async function (params) {
   const tBody=document.querySelector(".tBody")
      const  response=  await  httpService.getData(`${httpService.WEBROOT}/?controller=clients&action=liste`)
      console.log(reponse);
      
      const {data}=response
   

  
   //page-link
  
    
})

function paginate(){
  alert("ok");
}

function generateTr(data){
  return data.map(d=> `<tr>
                                    <th scope="row">${d.numero}</th>
                                    <td>${d.solde}</td>
                                    <td><a href="">Transaction</a>
                                    </td>
                                </tr>`).join("")
}

function generateLi(nbrePage,currentPage,telClient){
  let lis=`<li class="page-item"><a class="page-link" href="#">Prec</a></li>`
  for (let i=1; i <=nbrePage ; i++) {
    let url=httpService.WEBROOT+"controller=js&tel="+telClient+"&page="+i
   lis+= `<li class="page-item ${i==currentPage?"active":''}"><button class="page-link onclick="window.paginate()"  data-url="${url}" >${i}</a></li>`
  }
  lis+=`<li class="page-item"><a class="page-link" href="#">Next</a></li>`
  return lis

}