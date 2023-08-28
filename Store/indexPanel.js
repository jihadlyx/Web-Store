


let btnUplode = document.querySelector(".input-box .up-photo")
if(btnUplode != null)
btnUplode.onclick = () => {
    document.querySelector(".input-box #upload-photo").click();
}


let inputs = document.querySelectorAll(".wrapper input");
if(inputs != null){
    inputs.forEach(input => {
        input.addEventListener("keyup", e => {
            let name = input.getAttribute("name");
            
            let resultRe ;
                switch(name){
                    // case "emp_name" : resultRe = /^[a-z]{3,16}$/; break;
                    case "username" : 
                        resultRe = /^([a-zA-Z0-9._-]){6,30}$/;
                        testing(resultRe, input); 
                        break;
                    case "email" : 
                        resultRe = /^([a-zA-Z])([a-zA-Z0-9._-]){2,30}@([a-zA-Z0-9.-])+\.([a-zA-Z0-9]){2,5}$/; 
                        testing(resultRe, input); 
                        break;
                    // case "phone" : resultRe = /^[a-z0-9_-]{3,16}$/; break;
                    case "password" : 
                        resultRe = /^([a-zA-Z0-9]){6,20}$/ ; 
                        testing(resultRe, input); 
                        break;
                    /*
                        -- Product
                    */
                    case "prod_id"  : 
                    resultRe = /^([0-9]{1,10})$/; 
                    testing(resultRe, input); 
                    break;
                    case "prod_price"   : 
                    resultRe = /^([0-9]{1,10})$/; 
                    testing(resultRe, input); 
                    break;
                    case "prod_quantity"  : 
                    resultRe = /^([0-9]{1,10})$/; 
                    testing(resultRe, input); 
                    break;
                }
        })
    })
    
}

function testing(resultRe, input){
    let test = resultRe.test(input.value);
    

    if(test)
        input.classList.remove("error");
    else
        input.classList.add("error");
}















